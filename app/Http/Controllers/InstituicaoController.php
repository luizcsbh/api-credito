<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\InstituicaoService;
use App\Http\Resources\InstituicaoResource;
use App\Http\Requests\{StoreInstituicaoRequest, UpdateInstituicaoRequest};
use Illuminate\Support\Facades\Cache;

class InstituicaoController extends Controller
{
    protected $instituicaoService;

    public function __construct(InstituicaoService $instituicaoService)
    {
        $this->instituicaoService = $instituicaoService;
    }

    public function index()
    {
       try {

            $cacheKey = 'instituicoes_todas';

            $instituicoes = Cache::remember($cacheKey, now()->addMinutes(10), function () {
                return $this->instituicaoService->getAllInstituicao();
            });

            if ($instituicoes->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Nenhuma instituição encontrada!'
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'success' => true,
                'data' => InstituicaoResource::collection($instituicoes)
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar as instituições.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function show($id)
    {
        try {
            $instituicao = $this->instituicaoService->getInstituicaoById($id);
            return response()->json([
                'success' => true,
                'data' => new InstituicaoResource($instituicao)
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }       
    }

    public function store(StoreInstituicaoRequest $request)
    {
        try {
            $validateData = $request->validated();
            $instituicao = $this->instituicaoService->createInstituicao($validateData);
            Cache::forget('instituicoes_todas');

            return response()->json([
                'success' => true,
                'message' => 'Instituição criada com sucesso.',
                'data' => new InstituicaoResource($instituicao)
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
    public function update(UpdateInstituicaoRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $instituicao = $this->instituicaoService->updateInstituicao($id, $validatedData);
            return response()->json([
                'success' => true,
                'message' => 'Instituição atualizada com sucesso!',
                'data' => new InstituicaoResource($instituicao)
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
            $this->instituicaoService->deleteInstituicaoWithValidation($id);
            return response()->json([
                'success' => true,
                'message' => 'Instituição excluída com sucesso.'
            ], Response::HTTP_OK);

       } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
       }
    }
}
