<?php

namespace App\Repositories\Eloquent;

use Exception;
use App\Models\Modalidade;
use Illuminate\Support\Facades\DB;
use App\Repositories\ModalidadeRepositoryInterface;

class ModalidadeRepository implements ModalidadeRepositoryInterface
{
    public function all()
    {
        return Modalidade::all();
    }

    public function findById(int $id)
    {
        return Modalidade::find($id);
    }

    public function create(array $data)
    {
        DB::beginTransaction();

        try {
            $modalidade = Modalidade::create($data);
            DB::commit();
            return $modalidade;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Erro ao criar Modalidade: " . $e->getMessage());
        }
    }

    public function update(int $id, array $data)
    {
        DB::beginTransaction();

        try {
            $modalidade = Modalidade::find($id);

            if (!$modalidade) {
                DB::rollBack();
                return null;
            }

            $modalidade->update($data);
            DB::commit();
            return $modalidade;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Erro ao atualizar Modalidade: " . $e->getMessage());
        }
    }

    public function delete(int $id)
    {
        DB::beginTransaction();

        try {
            $deleted = Modalidade::destroy($id);

            if (!$deleted) {
                DB::rollBack();
                return false;
            }

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Erro ao deletar Modalidade: " . $e->getMessage());
        }
    }
}