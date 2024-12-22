<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxasSeeder extends Seeder
{
    public function run()
    {
        
        // Inserir Taxas
        DB::table('taxas')->insert([
            ['id' => 1, 'taxa_juros' => '2.21', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'taxa_juros' => '1.71', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'taxa_juros' => '2.44', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'taxa_juros' => '1.58', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'taxa_juros' => '2.77', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'taxa_juros' => '6.09', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'taxa_juros' => '6.32', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'taxa_juros' => '10.74', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'taxa_juros' => '8.50', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'taxa_juros' => '9.79', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 11, 'taxa_juros' => '4.51', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 12, 'taxa_juros' => '2.06', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 13, 'taxa_juros' => '2.08', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 14, 'taxa_juros' => '2.72', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 15, 'taxa_juros' => '8.27', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 16, 'taxa_juros' => '7.98', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 17, 'taxa_juros' => '8.00', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 18, 'taxa_juros' => '8.19', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 19, 'taxa_juros' => '1.99', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 20, 'taxa_juros' => '2.05', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 21, 'taxa_juros' => '1.79', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 22, 'taxa_juros' => '1.59', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 23, 'taxa_juros' => '1.48', 'created_at' => now(), 'updated_at' => now()],

        ]);
    }
}