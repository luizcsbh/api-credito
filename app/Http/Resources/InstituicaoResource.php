<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Classe de recurso para Instituição
 */
class InstituicaoResource extends JsonResource
{
    /**
     * Transforma o recurso em um array.
     *
     * @param  \Illuminate\Http\Request  $request Requisição HTTP
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable Retorna os dados da instituição
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'codigo' => $this->codigo,
            'nome' => $this->nome,
        ];
    }
}
