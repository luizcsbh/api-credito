<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Schema(
 *     schema="Instituicao",
 *     type="object",
 *     title="Instituição",
 *     description="Modelo de Instituição",
 *     required={"id", "nome"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID da instituição",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="nome",
 *         type="string",
 *         description="Nome da instituição",
 *         example="Banco XYZ"
 *     )
 * )
 */

class Instituicao extends Model
{
    use HasFactory;

    protected $fillable = ['codigo','nome'];

    protected $table = 'instituicoes';

    public function modalidades()
    {
        return $this->hasMany(Modalidade::class, 'instituicao_id');
    }

    public function clientes()
    {
        return $this->belongsToMany(
            Cliente::class, 
            'cliente_instituicoes', 
            'instituicao_id', 
            'cliente_id'
        )->withTimestamps();
    }
}