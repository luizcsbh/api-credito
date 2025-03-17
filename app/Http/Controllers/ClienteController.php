<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\ClienteService;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\ClienteResource;
use App\Http\Requests\{StoreClienteRequest, UpdateClienteRequest};

class ClienteController extends Controller
{
    protected $clienteService;

    public function __construct(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }

    /**
     * @OA\Get(
     *     path="/clientes",
     *     summary="Lista todos os clientes",
     *     description="Retorna uma lista de clientes armazenados no banco de dados.",
     *     tags={"Clientes"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de clientes retornada com sucesso",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Cliente"))
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Nenhum cliente encontrado",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Não há clientes cadastrados!")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno ao buscar os clientes",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Erro ao buscar os clientes."),
     *             @OA\Property(property="error", type="string", example="Detalhes do erro")
     *         )
     *     )
     * )
     */
    public function index()
    {
        try {
            $cacheKey = 'clientes_todos';
            $clientes = Cache::remember($cacheKey, now()->addMinutes(10), function () {
                return $this->clienteService->getAllCliente();
            });

            if ($clientes->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Não há clientes cadastrados!'
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'success' => true,
                'data' => ClienteResource::collection($clientes)
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar os clientes.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Get(
     *     path="/clientes/{id}",
     *     summary="Obtém os detalhes de um cliente",
     *     description="Retorna os detalhes de um cliente específico pelo ID.",
     *     tags={"Clientes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do cliente",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalhes do cliente retornados com sucesso",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", ref="#/components/schemas/Cliente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cliente não encontrado",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Cliente não encontrado!")
     *         )
     *     )
     * )
     */
    public function show($id)
    {
        try {
            $cacheKey = "cliente_{$id}";
            $cliente = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($id) {
                return $this->clienteService->getClienteById($id);
            });

            return response()->json([
                'success' => true,
                'data' => new ClienteResource($cliente)
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @OA\Post(
     *     path="/clientes",
     *     summary="Cria um novo cliente",
     *     description="Registra um novo cliente no banco de dados.",
     *     tags={"Clientes"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados necessários para criar um novo cliente",
     *         @OA\JsonContent(
     *             required={"nome", "email", "telefone"},
     *             @OA\Property(property="nome", type="string", example="João da Silva"),
     *             @OA\Property(property="email", type="string", format="email", example="joao@email.com"),
     *             @OA\Property(property="telefone", type="string", example="(11) 99999-9999")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Cliente criado com sucesso",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Cliente criado com sucesso."),
     *             @OA\Property(property="data", ref="#/components/schemas/Cliente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erro de validação ao criar o cliente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Erro ao processar a solicitação.")
     *         )
     *     )
     * )
     */
    public function store(StoreClienteRequest $request)
    {
        try {
            $validateData = $request->validated();
            $cliente = $this->clienteService->createCliente($validateData);

            Cache::forget('clientes_todos');

            return response()->json([
                'success' => true,
                'message' => 'Cliente criado com sucesso.',
                'data' => new ClienteResource($cliente)
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * @OA\Put(
     *     path="/clientes/{id}",
     *     summary="Atualiza um cliente existente",
     *     description="Atualiza os dados de um cliente com base no ID fornecido.",
     *     tags={"Clientes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do cliente a ser atualizado",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados para atualização do cliente",
     *         @OA\JsonContent(
     *             required={"nome", "email", "telefone"},
     *             @OA\Property(property="nome", type="string", example="Maria Oliveira"),
     *             @OA\Property(property="email", type="string", format="email", example="maria@email.com"),
     *             @OA\Property(property="telefone", type="string", example="(21) 98888-7777")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Cliente atualizado com sucesso",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Cliente atualizado com sucesso!"),
     *             @OA\Property(property="data", ref="#/components/schemas/Cliente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erro ao processar a atualização do cliente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Erro ao processar a solicitação.")
     *         )
     *     )
     * )
     */
    public function update(UpdateClienteRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $cliente = $this->clienteService->updateCliente($id, $validatedData);

            Cache::forget("cliente_{$id}");
            Cache::forget('clientes_todos');

            return response()->json([
                'success' => true,
                'message' => 'Cliente atualizado com sucesso!',
                'data' => new ClienteResource($cliente)
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * @OA\Delete(
     *     path="/clientes/{id}",
     *     summary="Exclui um cliente",
     *     description="Remove um cliente do banco de dados com base no ID fornecido.",
     *     tags={"Clientes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do cliente a ser excluído",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Cliente excluído com sucesso",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Cliente excluído com sucesso.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erro ao excluir o cliente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Erro ao excluir o cliente."),
     *             @OA\Property(property="error", type="string", example="Detalhes do erro.")
     *         )
     *     )
     * )
     */
    public function destroy($id)
    {
        try {
            $this->clienteService->deleteClienteWithAssociations($id);

            Cache::forget("cliente_{$id}");
            Cache::forget('clientes_todos');

            return response()->json([
                'success' => true,
                'message' => 'Cliente excluído com sucesso.'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao excluir o cliente.',
                'error' => $e->getMessage()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
