<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Instituicao;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CreditoController extends Controller
{
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