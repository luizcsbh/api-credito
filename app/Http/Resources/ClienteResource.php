<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Classe de recurso para Instituição
 */
class ClienteResource extends JsonResource
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
            'nome' => $this->nome,
            'cpf' => $this->cpf,
            'instituicoes' => InstituicaoResource::collection($this->whenLoaded('instituicoes')),
            'modalidades' => ModalidadeResource::collection($this->whenLoaded('modalidades')),
        ];
    }
}
