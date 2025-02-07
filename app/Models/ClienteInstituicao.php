<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteInstituicao extends Model
{
    use HasFactory;

    protected $fillable = ['cliente_id', 'instituicao_id'];

    protected $table = 'cliente_instituicoes';
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    public function instituicao()
    {
        return $this->belongsTo(Instituicao::class);
    }
}