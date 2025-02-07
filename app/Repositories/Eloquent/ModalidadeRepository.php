<?php

namespace App\Repositories\Eloquent;

use App\Models\Modalidade;
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
        return Modalidade::create($data);
    }

    public function update(int $id, array $data)
    {
        $modalidade = Modalidade::find($id);
       
        if($modalidade) {
            $modalidade->update($data);
            return $modalidade;
        }
        return null;
    }

    public function delete(int $id)
    {
        return Modalidade::destroy($id);
    }
}