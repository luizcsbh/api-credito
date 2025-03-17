<?php

namespace App\Repositories\Eloquent;

use Exception;
use App\Models\ClienteModalidade;
use Illuminate\Support\Facades\DB;
use App\Repositories\ClienteModalidadeRepositoryInterface;

class ClienteModalidadeRepository implements ClienteModalidadeRepositoryInterface
{
    public function all()
    {
        return ClienteModalidade::all();
    }

    public function findById(int $id)
    {
        return ClienteModalidade::find($id);
    }

    public function create(array $data)
    {
        DB::beginTransaction();

        try {
            $clienteModalidade = ClienteModalidade::create($data);
            DB::commit();
            return $clienteModalidade;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Erro ao criar ClienteModalidade: " . $e->getMessage());
        }
    }

    public function update(int $id, array $data)
    {
        DB::beginTransaction();

        try {
            $clienteModalidade = ClienteModalidade::find($id);

            if (!$clienteModalidade) {
                DB::rollBack();
                return null;
            }

            $clienteModalidade->update($data);
            DB::commit();
            return $clienteModalidade;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Erro ao atualizar ClienteModalidade: " . $e->getMessage());
        }
    }

    public function delete(int $id)
    {
        DB::beginTransaction();

        try {
            $deleted = ClienteModalidade::destroy($id);

            if (!$deleted) {
                DB::rollBack();
                return false;
            }

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Erro ao deletar ClienteModalidade: " . $e->getMessage());
        }
    }
}