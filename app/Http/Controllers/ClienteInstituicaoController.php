<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteInstituicaoRequest;
use App\Http\Requests\UpdateClienteInstituicaoRequest;
use Illuminate\Http\Response;
use App\Services\ClienteInstituicaoService;
use App\Http\Resources\ClienteInstituicaoResource;
use Illuminate\Support\Facades\Cache;

class ClienteInstituicaoController extends Controller
{
    protected $clienteInstituicaoService;

    public function __construct(ClienteInstituicaoService $clienteInstituicaoService)
    {
        $this->clienteInstituicaoService = $clienteInstituicaoService;
    }

    public function index()
    {
        try {

            $cacheKey = 'clienteInstituicao_todos';

            $clienteInstituicoes = Cache::remember($cacheKey, now()->addMinutes(10), function () {
                return $this->clienteInstituicaoService->getAllClienteInstituicao();
            });
            
            if ($clienteInstituicoes->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Não há registros cadastrados!',
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'success' => true,
                'data' => ClienteInstituicaoResource::collection($clienteInstituicoes)
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar os registros.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $clienteInstituicao = $this->clienteInstituicaoService->getClienteInstituicaoById($id);
            return response()->json([
                'success' => true,
                'data' => new ClienteInstituicaoResource($clienteInstituicao)
            ], Response::HTTP_OK);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function store(StoreClienteInstituicaoRequest $request)
    {
        try {

            $validateData = $request->validated();
            $clienteInstituicao = $this->clienteInstituicaoService->createClienteInstituicao($validateData);
            Cache::forget('clienteInstituicao_todos');
            
            return response()->json([
                'success' => true,
                'message' => 'Registro criado com sucesso!',
                'data'    => new ClienteInstituicaoResource($clienteInstituicao)
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function update(UpdateClienteInstituicaoRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $cliente = $this->clienteInstituicaoService->updateClienteInstituicao($id, $validatedData);
            return response()->json([
                'success' => true,
                'message' => 'Registro atualizado com sucesso!',
                'data' => new ClienteInstituicaoResource($cliente)
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
            $this->clienteInstituicaoService->deleteClienteInstituicao($id);

            return response()->json([
                'success' => true,
                'message' => 'Registro excluído com sucesso.'
            ], Response::HTTP_OK);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao excluir o registro.',
                'error' => $e->getMessage()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

}
