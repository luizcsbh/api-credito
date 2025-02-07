<?php

namespace App\Repositories\Eloquent;

use App\Models\ClienteInstituicao;
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
        return ClienteInstituicao::create($data);
    }

    public function update(int $id, array $data)
    {
        $clienteInstituicao = ClienteInstituicao::find($id);

        if ($clienteInstituicao) {
            $clienteInstituicao->update($data);
            return $clienteInstituicao;
        }

        return null;
    }

    public function delete(int $id)
    {
        return ClienteInstituicao::destroy($id);
    }
}