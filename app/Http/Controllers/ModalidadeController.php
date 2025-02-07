<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\ModalidadeService;
use App\Http\Resources\ModalidadeResource;
use App\Http\Requests\{StoreModalidadeRequest, UpdateModalidadeRequest};


class ModalidadeController extends Controller
{
    protected $modalidadeService;

    public function __construct(ModalidadeService $modalidadeService)
    {
        $this->modalidadeService = $modalidadeService;
    }

    public function index()
    {
       try {
            $modalidades = $this->modalidadeService->getAllModalidade();

            if ($modalidades->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Nenhuma modalidade encontrada.'
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'success' => true,
                'data' => ModalidadeResource::collection($modalidades)
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar as modalidades.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function show($id)
    {
        try {
            $modalidade = $this->modalidadeService->getModalidadeById($id);
            return response()->json([
                'success' => true,
                'data' => new ModalidadeResource($modalidade)
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }       
    }

    public function store(StoreModalidadeRequest $request)
    {
        try {
            $validateData = $request->validated();
            $modalidade = $this->modalidadeService->createModalidade($validateData);
            return response()->json([
                'success' => true,
                'message' => 'Modalidade criada com sucesso.',
                'data' => new ModalidadeResource($modalidade)
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
    public function update(UpdateModalidadeRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $modalidade = $this->modalidadeService->updateModalidade($id, $validatedData);
            return response()->json([
                'success' => true,
                'message' => 'Modalidade atualizada com sucesso!',
                'data' => new ModalidadeResource($modalidade)
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
            $this->modalidadeService->deleteModalidade($id);
            return response()->json([
                'success' => true,
                'message' => 'Modalidade excluída com sucesso.'
            ], Response::HTTP_OK);

       } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
       }
    }
}
