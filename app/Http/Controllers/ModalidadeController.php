<?php

namespace App\Http\Controllers;

use App\Models\Modalidade;
use Illuminate\Http\Request;

class ModalidadeController extends Controller
{
    /**
     * Lista todas as modalidades.
     */
    public function index()
    {
        $modalidades = Modalidade::all();

        if ($modalidades->isEmpty()) {
            return response()->json(['message' => 'Não há modalidades cadastrados.'], 404);
        }

        return response()->json($modalidades);
    }

    /**
     * Exibe uma modalidade específica pelo ID.
     */
    public function show($id)
    {
        $modalidade = Modalidade::with('instituicao')->find($id);

        if (!$modalidade) {
            return response()->json(['message' => 'Modalidade não encontrada'], 404);
        }

        return response()->json($modalidade);
    }

    /**
     * Cria uma nova modalidade.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'instituicao_id' => 'required|exists:instituicoes,id',
            'nome' => 'required|string|max:255',
            'cod' => 'required|string|max:50',
        ]);

        $modalidade = Modalidade::create($validatedData);

        return response()->json($modalidade, 201);
    }

    /**
     * Atualiza uma modalidade existente.
     */
    public function update(Request $request, $id)
    {
        $modalidade = Modalidade::find($id);

        if (!$modalidade) {
            return response()->json(['message' => 'Modalidade não encontrada'], 404);
        }

        $validatedData = $request->validate([
            'instituicao_id' => 'sometimes|exists:instituicoes,id',
            'nome' => 'sometimes|string|max:255',
            'cod' => 'sometimes|string|max:50',
        ]);

        $modalidade->update($validatedData);

        return response()->json($modalidade);
    }

    /**
     * Remove uma modalidade.
     */
    public function destroy($id)
    {
        $modalidade = Modalidade::find($id);

        if (!$modalidade) {
            return response()->json(['message' => 'Modalidade não encontrada'], 404);
        }

        $modalidade->delete();

        return response()->json(['message' => 'Modalidade removida com sucesso']);
    }
}