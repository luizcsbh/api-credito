<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfertasSeeder extends Seeder
{
    public function run()
    {
        
        // Inserir Ofertas
        DB::table('ofertas')->insert([
            [
                
                'modalidade_id' => 1,
                'qnt_parcela_min' => 12,
                'qnt_parcela_max' => 48,
                'valor_min' => 3000,
                'valor_max' => 7000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                
                'modalidade_id' => 2,
                'qnt_parcela_min' => 6,
                'qnt_parcela_max' => 36,
                'valor_min' => 2000,
                'valor_max' => 5000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                
                'modalidade_id' => 3,
                'qnt_parcela_min' => 24,
                'qnt_parcela_max' => 60,
                'valor_min' => 5000,
                'valor_max' => 15000,
                
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                
                'modalidade_id' => 9,
                'qnt_parcela_min' => 10,
                'qnt_parcela_max' => 24,
                'valor_min' => 3000,
                'valor_max' => 7000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        
    }
}