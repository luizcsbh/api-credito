<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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