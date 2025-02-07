<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Classe de recurso para Modalidade
 */
class ModalidadeResource extends JsonResource
{
    /**
     * Transforma o recurso em um array.
     *
     * @param  \Illuminate\Http\Request  $request Requisição HTTP
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable Retorna os dados da modalidade
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'instituicao_id' => $this->instituicao_id,
            'credito_taxas_id' => $this->credito_taxas_id,
        ];
    }
}
