<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\ClienteService;
use App\Http\Resources\ClienteResource;
use App\Http\Requests\{StoreClienteRequest, UpdateClienteRequest};
use Illuminate\Support\Facades\Cache;

class ClienteController extends Controller
{
    protected $clienteService;

    public function __construct(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }
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
                'message' => 'Erro ao buscar os  clientes.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function show($id)
    {
        try {
            $cliente = $this->clienteService->getClienteById($id);
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
    public function update(UpdateClienteRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $cliente = $this->clienteService->updateCliente($id, $validatedData);
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

    public function destroy($id)
    {
        try {
            $this->clienteService->deleteClienteWithAssociations($id);

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