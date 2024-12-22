<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    use HasFactory;

    protected $fillable = [
        'modalidade_id',
        'cliente_instituicoes_id',
        'qnt_parcela_min',
        'qnt_parcela_max',
        'valor_min',
        'valor_max'
    ];

    protected $table = 'ofertas';

    public function modalidade()
{
    return $this->belongsTo(Modalidade::class, 'modalidade_id', 'id');
}

    public function clienteInstituicao()
    {
        return $this->belongsTo(ClienteInstituicao::class, 'cliente_instituicoes_id');
    }
}