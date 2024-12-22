<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteInstituicoesSeeder extends Seeder
{
    public function run()
    {
        DB::table('cliente_instituicoes')->insert([
            ['cliente_id' => 1, 'instituicao_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['cliente_id' => 1, 'instituicao_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['cliente_id' => 1, 'instituicao_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['cliente_id' => 2, 'instituicao_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['cliente_id' => 3, 'instituicao_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['cliente_id' => 3, 'instituicao_id' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}