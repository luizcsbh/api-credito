<?php

namespace App\Repositories\Eloquent;

use App\Models\Cliente;
use App\Repositories\ClienteRepositoryInterface;

class ClienteRepository implements ClienteRepositoryInterface
{
   public function all()
   {
      return Cliente::with(['instituicoes', 'modalidades'])->get();
   }

   public function findById(int $id)
   {
      return Cliente::find($id);
   }

   public function create(array $data)
   {
      return Cliente::create($data);
   }
   public function update(int $id, array $data)
   {
      $cliente = Cliente::find($id);

      if($cliente) {
         $cliente->update($data);
         return $cliente;
      }

      return null;
   }

   public function delete(int $id)
   {
      return Cliente::destroy($id);
   }
}