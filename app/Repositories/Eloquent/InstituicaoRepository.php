<?php

namespace App\Repositories\Eloquent;

use Exception;
use App\Models\Instituicao;
use Illuminate\Support\Facades\DB;
use App\Repositories\InstituicaoRepositoryInterface;

class InstituicaoRepository implements InstituicaoRepositoryInterface
{
    
    public function all()
    {
        return Instituicao::all();
    }

    public function findById(int $id)
    {
        return Instituicao::find($id);
    }

    public function create(array $data)
    {
        DB::beginTransaction();

        try {
            $instituicao = Instituicao::create($data);
            DB::commit();
            return $instituicao;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Erro ao criar Instituicao: " . $e->getMessage());
        }
    }

    public function update(int $id, array $data)
    {
        DB::beginTransaction();

        try {
            $instituicao = Instituicao::find($id);

            if (!$instituicao) {
                DB::rollBack();
                return null;
            }

            $instituicao->update($data);
            DB::commit();
            return $instituicao;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Erro ao atualizar Instituicao: " . $e->getMessage());
        }
    }

    public function delete(int $id)
    {
        DB::beginTransaction();

        try {
            $deleted = Instituicao::destroy($id);

            if (!$deleted) {
                DB::rollBack();
                return false;
            }

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Erro ao deletar Instituicao: " . $e->getMessage());
        }
    }
}