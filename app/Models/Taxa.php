<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxa extends Model
{
    use HasFactory;

    protected $fillable = ['taxa_juros'];

    protected $table = 'taxas';

    public function modalidades()
    {
        return $this->hasMany(Modalidade::class, 'credito_taxas_id');
    }
}
