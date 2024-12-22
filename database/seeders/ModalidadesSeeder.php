<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModalidadesSeeder extends Seeder
{
    public function run()
    {
        // Inserir Modalidades
        DB::table('modalidades')->insert([
            ['id' => 1, 'instituicao_id' => 1, 'credito_taxas_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'instituicao_id' => 2, 'credito_taxas_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'instituicao_id' => 3, 'credito_taxas_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'instituicao_id' => 4, 'credito_taxas_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'instituicao_id' => 5, 'credito_taxas_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'instituicao_id' => 6, 'credito_taxas_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'instituicao_id' => 1, 'credito_taxas_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'instituicao_id' => 2, 'credito_taxas_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'instituicao_id' => 3, 'credito_taxas_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'instituicao_id' => 4, 'credito_taxas_id' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 11, 'instituicao_id' => 6, 'credito_taxas_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 12, 'instituicao_id' => 2, 'credito_taxas_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 13, 'instituicao_id' => 3, 'credito_taxas_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 14, 'instituicao_id' => 6, 'credito_taxas_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 15, 'instituicao_id' => 1, 'credito_taxas_id' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 16, 'instituicao_id' => 2, 'credito_taxas_id' => 16, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 17, 'instituicao_id' => 3, 'credito_taxas_id' => 17, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 18, 'instituicao_id' => 4, 'credito_taxas_id' => 18, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 19, 'instituicao_id' => 1, 'credito_taxas_id' => 19, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 20, 'instituicao_id' => 2, 'credito_taxas_id' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 21, 'instituicao_id' => 3, 'credito_taxas_id' => 21, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 22, 'instituicao_id' => 4, 'credito_taxas_id' => 22, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 23, 'instituicao_id' => 6, 'credito_taxas_id' => 23, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}