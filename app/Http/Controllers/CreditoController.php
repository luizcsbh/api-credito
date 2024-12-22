<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Instituicao;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CreditoController extends Controller
{
/**
 * @OA\Post(
 *     path="/simulacao/credito",
 *     summary="Consulta de crédito",
 *     description="Obtém as instituições financeiras e modalidades de crédito disponíveis para um cliente baseado no CPF.",
 *     tags={"Crédito"},
 *     @OA\RequestBody(
 *         required=true,
 *         description="CPF do cliente no formato JSON",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="cpf", type="string", example="12312312312")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Lista de instituições financeiras e modalidades de crédito disponíveis.",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="instituicao_id", type="integer", example=1),
 *                 @OA\Property(property="instituicao_nome", type="string", example="Banco Exemplo"),
 *                 @OA\Property(
 *                     property="modalidades",
 *                     type="array",
 *                     @OA\Items(
 *                         @OA\Property(property="modalidade_cod", type="integer", example=101),
 *                         @OA\Property(property="modalidade_nome", type="string", example="Crédito Pessoal"),
 *                         @OA\Property(property="taxa_juros", type="number", format="float", example=1.5)
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="CPF não encontrado ou sem ofertas disponíveis.",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="CPF não encontrado")
 *         )
 *     )
 * )
 */
    public function credito(Request $request)
    {
        $cpf = $request->input('cpf');
    
        // Verificar se o CPF existe na tabela de clientes
        $cliente = Cliente::where('cpf', $cpf)->first();
    
        if (!$cliente) {
            return response()->json(['message' => 'CPF não encontrado'], Response::HTTP_NOT_FOUND);
        }
    
        // Obter as instituições e suas modalidades relacionadas ao cliente
        $instituicoes = Instituicao::whereHas('modalidades.clientes', function ($query) use ($cliente) {
            $query->where('clientes.id', $cliente->id);
        })
        ->with([
            'modalidades' => function ($query) use ($cliente) {
                $query->whereHas('clientes', function ($query) use ($cliente) {
                    $query->where('clientes.id', $cliente->id);
                })
                ->with(['credito', 'taxa']);
            }
        ])
        ->get()
        ->map(function ($instituicao) {
            return [
                'instituicao_id' => $instituicao->id,
                'instituicao_nome' => $instituicao->nome,
                'modalidades' => $instituicao->modalidades->map(function ($modalidade) {
                    return [
                        'modalidade_cod' => $modalidade->credito->id ?? null,
                        'modalidade_nome' => $modalidade->credito->nome ?? null,
                        'taxa_juros' => $modalidade->taxa->taxa_juros ?? null,
                    ];
                })->filter(fn($modalidade) => $modalidade['modalidade_cod'] !== null), // Remove modalidades inválidas
            ];
        });
    
        if ($instituicoes->isEmpty()) {
            return response()->json(['message' => 'Nenhuma oferta disponível para o CPF informado'], Response::HTTP_NOT_FOUND);
        }
    
        return response()->json($instituicoes);
    }

    /**
     * @OA\Post(
     *     path="/simulacao/simula-oferta",
     *     summary="Simulação de ofertas de crédito",
     *     description="Simula as ofertas de crédito disponíveis para um cliente com base no CPF informado.",
     *     tags={"Crédito"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"cpf"},
     *             @OA\Property(property="cpf", type="string", example="11111111111")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ofertas de crédito simuladas.",
     *         @OA\JsonContent(
     *             @OA\Property(property="cpf", type="string", example="11111111111"),
     *             @OA\Property(
     *                 property="ofertas",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="instituicaoFinanceira", type="string", example="Banco Exemplo"),
     *                     @OA\Property(property="modalidadeCredito", type="string", example="Crédito Consignado"),
     *                     @OA\Property(property="valorSolicitado", type="number", example=5000.00),
     *                     @OA\Property(property="valorAPagar", type="number", example=5400.00),
     *                     @OA\Property(property="taxaJuros", type="string", example="1.2%"),
     *                     @OA\Property(property="qntParcelas", type="integer", example=12)
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="CPF não encontrado ou sem ofertas disponíveis.",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Nenhuma oferta encontrada para o CPF informado")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro ao processar a solicitação.",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Erro ao processar a solicitação"),
     *             @OA\Property(property="error", type="string", example="Detalhes do erro")
     *         )
     *     )
     * )
     */
    public function simulaOferta(Request $request)
    {
        $request->validate([
            'cpf' => 'required|string',
        ]);
    
        try {
            // Verificar se o CPF existe
            $cpf = $request->input('cpf');
            $cliente = Cliente::where('cpf', $cpf)->first();
    
            if (!$cliente) {
                return response()->json(['message' => 'CPF não encontrado'], Response::HTTP_NOT_FOUND);
            }
    
            // Consultar instituições com ofertas de crédito disponíveis para o cliente
            $instituicoes = Instituicao::whereHas('modalidades.clientes', function ($query) use ($cliente) {
                $query->where('clientes.id', $cliente->id);
            })
            ->with(['modalidades' => function ($query) use ($cliente) {
                $query->whereHas('clientes', function ($subQuery) use ($cliente) {
                    $subQuery->where('clientes.id', $cliente->id);
                })->with(['ofertas', 'taxa']);
            }])
            ->get();
    
            if ($instituicoes->isEmpty()) {
                return response()->json(['message' => 'Nenhuma oferta encontrada para o CPF informado'], Response::HTTP_NOT_FOUND);
            }
    
            // Processar e estruturar as ofertas
            $resultados = $instituicoes->map(function ($instituicao) {
                return $instituicao->modalidades->flatMap(function ($modalidade) {
                    return $modalidade->ofertas->map(function ($oferta) use ($modalidade) {
                        $valorSolicitado = ($oferta->valor_min + $oferta->valor_max) / 2;
    
                        // Fórmula do sistema PRICE
                        $taxaJuros = $modalidade->taxa->taxa_juros / 100; // Convertendo taxa de juros para decimal
                        $numParcelas = $oferta->qnt_parcela_min;
    
                        // Cálculo da parcela fixa
                        $parcela = ($valorSolicitado * $taxaJuros * pow(1 + $taxaJuros, $numParcelas)) /
                                   (pow(1 + $taxaJuros, $numParcelas) - 1);
    
                        // Valor total a pagar
                        $valorAPagar = $parcela * $numParcelas;
                        return [
                            'instituicaoFinanceira' => $modalidade->instituicao->nome,
                            'modalidadeCredito' => $modalidade->credito->nome,
                            'valorSolicitado' => round($valorSolicitado, 2),
                            'valorAPagar' => round($valorAPagar, 2),
                            'taxaJuros' => round($taxaJuros * 100, 2) . '%',
                            'qntParcelas' => $numParcelas,
                        ];
                    });
                });
            });
    
            return response()->json([
                'cpf' => $cpf,
                'ofertas' => $resultados->flatten(1), // Agrupa todas as ofertas em um único nível
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao processar a solicitação',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }    
    
}