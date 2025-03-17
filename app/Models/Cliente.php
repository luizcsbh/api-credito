<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Cliente",
 *     type="object",
 *     title="Cliente",
 *     description="Modelo de Cliente",
 *     required={"nome", "cpf"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID do cliente",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="nome",
 *         type="string",
 *         description="Nome do cliente",
 *         example="João da Silva"
 *     ),
 *     @OA\Property(
 *         property="cpf",
 *         type="string",
 *         description="CPF do cliente",
 *         example="123.456.789-00"
 *     ),
 *     @OA\Property(
 *         property="instituicoes",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Instituicao"),
 *         description="Lista de instituições associadas ao cliente"
 *     ),
 *     @OA\Property(
 *         property="modalidades",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Modalidade"),
 *         description="Lista de modalidades associadas ao cliente"
 *     )
 * )
 */

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'cpf'];

    protected $table = 'clientes'; 

    public function instituicoes()
    {
        return $this->belongsToMany(
            Instituicao::class, 
            'cliente_instituicoes', 
            'cliente_id', 
            'instituicao_id'
        );
    }

    public function modalidades()
    {
        return $this->belongsToMany(
            Modalidade::class, 
            'cliente_modalidades', 
            'cliente_id', 
            'modalidade_id'
        );
    }
}