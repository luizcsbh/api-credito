<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstituicoesSeeder extends Seeder
{
    public function run()
    {
        // Inserir Instituições
        DB::table('instituicoes')->insert([
            ['id' => 1, 'codigo' => 336, 'nome' => 'BCO C6 S.A', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'codigo' => 077, 'nome' => 'BANCO INTER', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'codigo' => 104, 'nome' => 'CAIXA ECONOMICA FEDERAL', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'codigo' => 341, 'nome' => 'ITAÚ UNIBANCO HOLDING S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'codigo' => 394, 'nome' => 'BCO BRADESCO FINANC. S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'codigo' => 237, 'nome' => 'BCO BRADESCO S.A.', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}