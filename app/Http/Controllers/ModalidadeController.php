<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\ModalidadeService;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\ModalidadeResource;
use App\Http\Requests\{StoreModalidadeRequest, UpdateModalidadeRequest};


class ModalidadeController extends Controller
{
    protected $modalidadeService;

    public function __construct(ModalidadeService $modalidadeService)
    {
        $this->modalidadeService = $modalidadeService;
    }
    /**
     * @OA\Get(
     *     path="/modalidades",
     *     summary="Lista todas as modalidades",
     *     description="Retorna uma lista de modalidades cadastradas.",
     *     tags={"Modalidades"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de modalidades retornada com sucesso.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Modalidade")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Nenhuma modalidade encontrada.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Nenhuma modalidade encontrada.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno ao buscar as modalidades.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Erro ao buscar as modalidades."),
     *             @OA\Property(property="error", type="string", example="Detalhes do erro.")
     *         )
     *     )
     * )
     */
    public function index()
    {
       try {
            
            $cacheKey = 'modalidades_todas';
            $modalidades = Cache::remember($cacheKey, now()->addMinutes(10), function () {
                return $this->modalidadeService->getAllModalidade();
            });

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
    /**
     * @OA\Get(
     *     path="/modalidades/{id}",
     *     summary="Obtém uma modalidade específica",
     *     description="Retorna os detalhes de uma modalidade pelo ID.",
     *     tags={"Modalidades"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID da modalidade a ser consultada",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalhes da modalidade retornados com sucesso.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", ref="#/components/schemas/Modalidade")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Modalidade não encontrada.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Modalidade não encontrada.")
     *         )
     *     )
     * )
     */
    public function show($id)
    {
        try {

            $cacheKey = "modalidade_{$id}";
            $modalidade = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($id) {
                return $this->modalidadeService->getModalidadeById($id);
            }); 
            
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

    /**
     * @OA\Post(
     *     path="/modalidades",
     *     summary="Cria uma nova modalidade",
     *     description="Cadastra uma nova modalidade no sistema.",
     *     tags={"Modalidades"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Modalidade")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Modalidade criada com sucesso.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Modalidade criada com sucesso."),
     *             @OA\Property(property="data", ref="#/components/schemas/Modalidade")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erro ao validar os dados da modalidade.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Erro ao processar a requisição.")
     *         )
     *     )
     * )
     */

    public function store(StoreModalidadeRequest $request)
    {
        try {

            $validateData = $request->validated();
            $modalidade = $this->modalidadeService->createModalidade($validateData);

            Cache::forget('modalidades_todas');

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

    /**
     * @OA\Put(
     *     path="/modalidades/{id}",
     *     summary="Atualiza uma modalidade existente",
     *     description="Edita os dados de uma modalidade com base no ID.",
     *     tags={"Modalidades"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID da modalidade a ser atualizada",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Modalidade")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Modalidade atualizada com sucesso.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Modalidade atualizada com sucesso!"),
     *             @OA\Property(property="data", ref="#/components/schemas/Modalidade")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erro ao validar os dados da modalidade.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Erro ao processar a requisição.")
     *         )
     *     )
     * )
     */
    public function update(UpdateModalidadeRequest $request, $id)
    {
        try {

            $validatedData = $request->validated();
            $modalidade = $this->modalidadeService->updateModalidade($id, $validatedData);

            Cache::forget("modalidade_{$id}");
            Cache::forget('modalidades_todas');

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

    /**
     * @OA\Delete(
     *     path="/modalidades/{id}",
     *     summary="Exclui um modalidade",
     *     description="Remove uma modalidadea do banco de dados com base no ID fornecido.",
     *     tags={"Modalidades"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID da modalidade a ser excluído",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Modalidade excluída com sucesso",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Modalidade excluída com sucesso.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erro ao excluir uma modalidade",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Erro ao excluir uma modalidade."),
     *             @OA\Property(property="error", type="string", example="Detalhes do erro.")
     *         )
     *     )
     * )
     */
    public function destroy($id)
    {
       try {

            $this->modalidadeService->deleteModalidade($id);

            Cache::forget("modalidade_{$id}");
            Cache::forget('modalidades_todas');
            
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
