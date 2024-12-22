<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    protected $table = 'creditos';

    public function taxas()
    {
        return $this->belongsToMany(Taxa::class, 'credito_taxas')
            ->withTimestamps();
    }
}