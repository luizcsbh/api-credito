<?php

namespace App\Repositories\Eloquent;

use Exception;
use App\Models\ClienteInstituicao;
use Illuminate\Support\Facades\DB;
use App\Repositories\ClienteInstituicaoRepositoryInterface;

class ClienteInstituicaoRepository implements ClienteInstituicaoRepositoryInterface
{
    public function all()
    {
        return ClienteInstituicao::all();
    }

    public function findById(int $id)
    {
        return ClienteInstituicao::find($id);
    }

    public function create(array $data)
    {
        DB::beginTransaction();

        try {
            $clienteInstituicao = ClienteInstituicao::create($data);
            DB::commit();
            return $clienteInstituicao;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Erro ao criar ClienteInstituicao: " . $e->getMessage());
        }
    }

    public function update(int $id, array $data)
    {
        DB::beginTransaction();

        try {
            $clienteInstituicao = ClienteInstituicao::find($id);

            if (!$clienteInstituicao) {
                DB::rollBack();
                return null;
            }

            $clienteInstituicao->update($data);
            DB::commit();
            return $clienteInstituicao;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Erro ao atualizar ClienteInstituicao: " . $e->getMessage());
        }
    }

    public function delete(int $id)
    {
        DB::beginTransaction();

        try {
            $deleted = ClienteInstituicao::destroy($id);

            if (!$deleted) {
                DB::rollBack();
                return false;
            }

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Erro ao deletar ClienteInstituicao: " . $e->getMessage());
        }
    }
}