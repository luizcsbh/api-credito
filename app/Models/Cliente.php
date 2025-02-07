<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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