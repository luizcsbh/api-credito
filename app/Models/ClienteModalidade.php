<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteModalidade extends Model
{
    use HasFactory;

    protected $fillable = ['cliente_id', 'instituicao_id', 'modalidade_id'];

    protected $table = 'cliente_modalidades';

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function instituicao()
    {
        return $this->belongsTo(Instituicao::class);
    }

    public function modalidade()
    {
        return $this->belongsTo(Modalidade::class);
    }
}