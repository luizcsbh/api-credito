<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditoTaxa extends Model
{
    use HasFactory;

    protected $fillable = ['credito_id', 'taxa_juros_id'];

    protected $table = 'credito_taxas';

    public function credito()
    {
        return $this->belongsTo(Credito::class);
    }

    public function taxa()
    {
        return $this->belongsTo(Taxa::class);
    }
}