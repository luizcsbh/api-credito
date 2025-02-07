<?php

namespace App\Repositories\Eloquent;

use App\Models\Instituicao;
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
        return Instituicao::create($data);
    }

    public function update(int $id, array $data)
    {
        $instituicao = Instituicao::find($id);
       
        if($instituicao) {
            $instituicao->update($data);
            return $instituicao;
        }
        return null;
    }

    public function delete(int $id)
    {
        return Instituicao::destroy($id);
    }
}