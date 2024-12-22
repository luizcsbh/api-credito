<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreditoTaxasSeeder extends Seeder
{
    public function run()
    {
        

        // Inserir Modalidades
        DB::table('credito_taxas')->insert([
            ['id' => 1, 'credito_id' => 1,  'taxa_juros_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'credito_id' => 1 , 'taxa_juros_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'credito_id' => 1 , 'taxa_juros_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'credito_id' => 1 , 'taxa_juros_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'credito_id' => 1 , 'taxa_juros_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'credito_id' => 1 , 'taxa_juros_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'credito_id' => 2,  'taxa_juros_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'credito_id' => 2 , 'taxa_juros_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'credito_id' => 2 , 'taxa_juros_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'credito_id' => 2 , 'taxa_juros_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 11, 'credito_id' => 2 , 'taxa_juros_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 12, 'credito_id' => 3 , 'taxa_juros_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 13, 'credito_id' => 3,  'taxa_juros_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 14, 'credito_id' => 3 , 'taxa_juros_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 15, 'credito_id' => 4 , 'taxa_juros_id' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 16, 'credito_id' => 4 , 'taxa_juros_id' => 16, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 17, 'credito_id' => 4 , 'taxa_juros_id' => 17, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 18, 'credito_id' => 4, 'taxa_juros_id' => 18, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 19, 'credito_id' => 5 , 'taxa_juros_id' => 19, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 20, 'credito_id' => 5 , 'taxa_juros_id' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 21, 'credito_id' => 5 , 'taxa_juros_id' => 21, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 22, 'credito_id' => 5 , 'taxa_juros_id' => 22, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 23, 'credito_id' => 5 , 'taxa_juros_id' => 23, 'created_at' => now(), 'updated_at' => now()],
        ]);

    }
}