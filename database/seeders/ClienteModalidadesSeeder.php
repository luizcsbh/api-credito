<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteModalidadesSeeder extends Seeder
{
    public function run()
    {
        DB::table('cliente_modalidades')->insert([
            ['cliente_id' => 1, 'instituicao_id' => 1, 'modalidade_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['cliente_id' => 1, 'instituicao_id' => 2, 'modalidade_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['cliente_id' => 1, 'instituicao_id' => 3, 'modalidade_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['cliente_id' => 2, 'instituicao_id' => 3, 'modalidade_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['cliente_id' => 3, 'instituicao_id' => 4, 'modalidade_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['cliente_id' => 3, 'instituicao_id' => 5, 'modalidade_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            
        ]);
    }
}