<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreditoSeeder extends Seeder
{
    public function run()
    {
        // Inserir Credito
        DB::table('creditos')->insert([
            ['id' => 1, 'nome' => 'Crédito pessoal não-consignado', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nome' => 'Cartão de crédito - parcelado', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nome' => 'Crédito pessoal consignado privado', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'nome' => 'Cheque especial', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'nome' => 'Antecipação saque-aniversário FGTS','created_at' => now(), 'updated_at' => now()],
        ]);

    }
}