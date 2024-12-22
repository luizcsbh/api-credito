<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

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