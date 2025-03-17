<?php

namespace App\Repositories\Eloquent;

use Exception;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
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
      DB::beginTransaction();

      try {
          $cliente= Cliente::create($data);
          DB::commit();
          return $cliente;
      } catch (Exception $e) {
          DB::rollBack();
          throw new Exception("Erro ao criar Cliente: " . $e->getMessage());
      }
   }
   public function update(int $id, array $data)
   {
      DB::beginTransaction();

      try {
          $cliente = Cliente::find($id);

          if (!$cliente) {
              DB::rollBack();
              return null;
          }

          $cliente->update($data);
          DB::commit();
          return $cliente;
      } catch (Exception $e) {
          DB::rollBack();
          throw new Exception("Erro ao atualizar Cliente: " . $e->getMessage());
      }
   }

   public function delete(int $id)
   {
      DB::beginTransaction();

      try {
          $deleted = Cliente::destroy($id);

          if (!$deleted) {
              DB::rollBack();
              return false;
          }

          DB::commit();
          return true;
      } catch (Exception $e) {
          DB::rollBack();
          throw new Exception("Erro ao deletar Cliente: " . $e->getMessage());
      }
   }
}