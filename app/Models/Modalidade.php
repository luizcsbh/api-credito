<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Schema(
 *     schema="Modalidade",
 *     type="object",
 *     title="Modalidade",
 *     description="Modelo de Modalidade",
 *     required={"instituicao_id", "credito_taxas_id"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID da modalidade",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="instituicao_id",
 *         type="integer",
 *         description="ID da instituição associada",
 *         example=2
 *     ),
 *     @OA\Property(
 *         property="credito_taxas_id",
 *         type="integer",
 *         description="ID da taxa de crédito associada",
 *         example=3
 *     )
 * )
 */

class Modalidade extends Model
{
    use HasFactory;

    protected $fillable = ['instituicao_id', 'credito_taxas_id'];
    
    protected $table = 'modalidades';
    public function instituicao()
    {
        return $this->belongsTo(Instituicao::class);
    }

    public function credito()
    {
        return $this->belongsTo(Credito::class, 'credito_taxas_id');
    }

    public function taxa()
    {
        return $this->belongsTo(Taxa::class, 'credito_taxas_id');
    }

    public function ofertas()
{
    return $this->hasMany(Oferta::class, 'modalidade_id', 'id');
}

    public function clientes()
    {
        return $this->belongsToMany(
            Cliente::class, 
            'cliente_modalidades', 
            'modalidade_id', 
            'cliente_id'
        )->withTimestamps();
    }
}