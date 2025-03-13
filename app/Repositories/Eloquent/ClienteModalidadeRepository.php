<?php

namespace App\Repositories\Eloquent;

use App\Models\ClienteModalidade;
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
        return ClienteModalidade::create($data);
    }

    public function update(int $id, array $data)
    {
        $clienteModalidade = ClienteModalidade::find($id);

        if ($clienteModalidade) {
            $clienteModalidade->update($data);
            return $clienteModalidade;
        }

        return null;
    }

    public function delete(int $id)
    {
        return ClienteModalidade::destroy($id);
    }
}