<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClienteController extends Controller
{
    /**
     * @OA\Get(
     *     path="/clientes",
     *     tags={"Clientes"},
     *     summary="Listar todos os clientes",
     *     description="Retorna uma lista de clientes cadastrados.",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de clientes.",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Cliente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Nenhum cliente encontrado.",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Não há clientes cadastrados.")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $clientes = Cliente::with(['instituicoes', 'modalidades'])->get();

        if ($clientes->isEmpty()) {
            return response()->json(['message' => 'Não há clientes cadastrados.'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($clientes, Response::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     path="/clientes",
     *     tags={"Clientes"},
     *     summary="Cria um novo cliente",
     *     description="Cadastra um novo cliente no sistema.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"nome", "cpf"},
     *             @OA\Property(property="nome", type="string", example="João da Silva"),
     *             @OA\Property(property="cpf", type="string", example="123.456.789-00")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Cliente criado com sucesso.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Cliente criado com sucesso."),
     *             @OA\Property(property="cliente", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="nome", type="string", example="João da Silva"),
     *                 @OA\Property(property="cpf", type="string", example="123.456.789-00"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-12-21T10:00:00.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-12-21T10:00:00.000000Z")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erro de validação.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Os dados fornecidos são inválidos."),
     *             @OA\Property(property="errors", type="object",
     *                 @OA\Property(property="nome", type="array", 
     *                     @OA\Items(type="string", example="O campo nome é obrigatório.")
     *                 ),
     *                 @OA\Property(property="cpf", type="array", 
     *                     @OA\Items(type="string", example="O campo cpf é obrigatório.")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:clientes,cpf',
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome deve ser um texto.',
            'nome.max' => 'O campo nome não pode ter mais de 255 caracteres.',
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.string' => 'O campo CPF deve ser um texto.',
            'cpf.max' => 'O campo CPF não pode ter mais de 14 caracteres.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
        ]);
    
        $cliente = Cliente::create($request->only(['nome', 'cpf']));

        return response()->json([
            'message' => 'Cliente criado com sucesso',
            'cliente' => $cliente
        ], Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *     path="/clientes/{id}",
     *     tags={"Clientes"},
     *     summary="Exibe os detalhes de um cliente",
     *     description="Retorna os detalhes de um cliente específico, incluindo suas associações com instituições e modalidades.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do cliente",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalhes do cliente retornados com sucesso.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="nome", type="string", example="João da Silva"),
     *             @OA\Property(property="cpf", type="string", example="123.456.789-00"),
     *             @OA\Property(property="instituicoes", type="array", @OA\Items(type="object")),
     *             @OA\Property(property="modalidades", type="array", @OA\Items(type="object"))
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cliente não encontrado."
     *     )
     * )
     */
    public function show(Cliente $cliente)
    {
        $cliente->load(['instituicoes', 'modalidades']);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente não encontrado'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($cliente, Response::HTTP_OK);
    }

    /**
     * @OA\Put(
     *     path="/clientes/{id}",
     *     tags={"Clientes"},
     *     summary="Atualiza as informações de um cliente",
     *     description="Atualiza os dados de um cliente existente.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do cliente",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="nome", type="string", example="João da Silva"),
     *             @OA\Property(property="cpf", type="string", example="123.456.789-00")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Cliente atualizado com sucesso.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Cliente atualizado com sucesso."),
     *             @OA\Property(property="cliente", type="object", 
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="nome", type="string", example="João da Silva"),
     *                 @OA\Property(property="cpf", type="string", example="123.456.789-00")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cliente não encontrado."
     *     )
     * )
     */
    public function update(Request $request, Cliente $cliente)
    {
       // Validar os dados de entrada
        $request->validate([
            'nome' => 'sometimes|string|max:255',
            'cpf' => 'sometimes|string|max:14|unique:clientes,cpf,' . $cliente->id,
        ], [
            'nome.string' => 'O campo nome deve ser um texto.',
            'nome.max' => 'O campo nome não pode ter mais de 255 caracteres.',
            'cpf.string' => 'O campo CPF deve ser um texto.',
            'cpf.max' => 'O campo CPF não pode ter mais de 14 caracteres.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
        ]);

        $cliente->update($request->only(['nome', 'cpf']));

        return response()->json([
            'message' => 'Cliente atualizado com sucesso',
            'cliente' => $cliente
        ], Response::HTTP_OK);
    }

    /**
     * @OA\Delete(
     *     path="/clientes/{id}",
     *     tags={"Clientes"},
     *     summary="Remove um cliente",
     *     description="Remove um cliente e suas associações com instituições e modalidades, se existirem.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do cliente",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Cliente removido com sucesso.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Cliente removido com sucesso.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro ao remover o cliente.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Erro ao remover o cliente."),
     *             @OA\Property(property="error", type="string", example="Mensagem de erro detalhada.")
     *         )
     *     )
     * )
     */
    public function destroy(Cliente $cliente)
    {
        try {
            // Remover associações com instituições
            if ($cliente->instituicoes()->exists()) {
                $cliente->instituicoes()->detach();
            }
    
            // Remover associações com modalidades
            if ($cliente->modalidades()->exists()) {
                $cliente->modalidades()->detach();
            }
    
            // Excluir o cliente
            $cliente->delete();
    
            return response()->json(['message' => 'Cliente removido com sucesso.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao remover o cliente.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}