<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Cliente",
 *     type="object",
 *     title="Cliente",
 *     required={"nome", "cpf"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nome", type="string", example="João Silva"),
 *     @OA\Property(property="cpf", type="string", example="123.456.789-00"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
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
        )->withTimestamps();
    }

    public function modalidades()
    {
        return $this->belongsToMany(
            Modalidade::class, 
            'cliente_modalidades', 
            'cliente_id', 
            'modalidade_id'
        )->withTimestamps();
    }
}