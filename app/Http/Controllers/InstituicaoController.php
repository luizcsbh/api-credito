<?php

namespace App\Http\Controllers;

use App\Models\Instituicao;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Instituicoes",
 *     description="Gerenciamento de instituições financeiras"
 * )
 */
class InstituicaoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/instituicoes",
     *     summary="Listar instituições",
     *     tags={"Instituicoes"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de instituições financeiras.",
     *         @OA\JsonContent(type="array", @OA\Items(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="nome", type="string", example="Banco Exemplo")
     *         ))
     *     )
     * )
     */
    public function index()
    {
        $instituicoes = Instituicao::all();
        return response()->json($instituicoes, 200);
    }

    /**
     * @OA\Post(
     *     path="/instituicoes",
     *     summary="Criar nova instituição",
     *     tags={"Instituicoes"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nome"},
     *             @OA\Property(property="nome", type="string", example="Banco Novo")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Instituição criada com sucesso.",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="nome", type="string", example="Banco Novo")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erro de validação.",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="O campo nome é obrigatório.")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            ['nome' => 'required|string|max:255'],
            ['nome.required' => 'O campo nome é obrigatório.']
        );

        $instituicao = Instituicao::create($validated);

        return response()->json($instituicao, 201);
    }

    /**
     * @OA\Get(
     *     path="/instituicoes/{id}",
     *     summary="Exibir uma instituição",
     *     tags={"Instituicoes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID da instituição"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalhes da instituição.",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="nome", type="string", example="Banco Exemplo")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Instituição não encontrada.",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Instituição não encontrada.")
     *         )
     *     )
     * )
     */
    public function show($id)
    {
        $instituicao = Instituicao::find($id);

        if (!$instituicao) {
            return response()->json(['message' => 'Instituição não encontrada.'], 404);
        }

        return response()->json($instituicao, 200);
    }

    /**
     * @OA\Put(
     *     path="/instituicoes/{id}",
     *     summary="Atualizar uma instituição",
     *     tags={"Instituicoes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID da instituição"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nome"},
     *             @OA\Property(property="nome", type="string", example="Banco Atualizado")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Instituição atualizada com sucesso.",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="nome", type="string", example="Banco Atualizado")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Instituição não encontrada.",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Instituição não encontrada.")
     *         )
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $instituicao = Instituicao::find($id);

        if (!$instituicao) {
            return response()->json(['message' => 'Instituição não encontrada.'], 404);
        }

        $validated = $request->validate(
            ['nome' => 'required|string|max:255'],
            ['nome.required' => 'O campo nome é obrigatório.']
        );

        $instituicao->update($validated);

        return response()->json($instituicao, 200);
    }

    /**
     * @OA\Delete(
     *     path="/instituicoes/{id}",
     *     summary="Excluir uma instituição",
     *     tags={"Instituicoes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID da instituição"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Instituição excluída com sucesso.",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Instituição excluída com sucesso.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Instituição não encontrada.",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Instituição não encontrada.")
     *         )
     *     )
     * )
     */
    public function destroy($id)
    {
        $instituicao = Instituicao::find($id);

        if (!$instituicao) {
            return response()->json(['message' => 'Instituição não encontrada.'], 404);
        }

        $instituicao->delete();

        return response()->json(['message' => 'Instituição excluída com sucesso.'], 200);
    }
}
