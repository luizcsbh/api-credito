<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModeloSeeder extends Seeder
{
    public function run()
    {
        // Inserir Instituições
        DB::table('instituicoes')->insert([
            ['id' => 1, 'codigo' => '336', 'nome' => 'BCO C6 S.A', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'codigo' => '077', 'nome' => 'BANCO INTER', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'codigo' => '104', 'nome' => 'CAIXA ECONOMICA FEDERAL', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'codigo' => '341', 'nome' => 'ITAÚ UNIBANCO HOLDING S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'codigo' => '394', 'nome' => 'BCO BRADESCO FINANC. S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'codigo' => '237', 'nome' => 'BCO BRADESCO S.A.', 'created_at' => now(), 'updated_at' => now()],
        ]);

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

         // Inserir Clientes
         DB::table('clientes')->insert([
            ['id' => 1, 'nome' => 'José da Silva', 'cpf'=>'11111111111','created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nome' => 'Maria Santos', 'cpf'=>'12312312312','created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nome' => 'Joaquim Bezerra', 'cpf'=>'22222222222', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('cliente_modalidade')->insert([
            ['cliente_id' => 1, 'instituicao_id' => 1, 'modalidade_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['cliente_id' => 1, 'instituicao_id' => 2, 'modalidade_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['cliente_id' => 1, 'instituicao_id' => 3, 'modalidade_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['cliente_id' => 2, 'instituicao_id' => 3, 'modalidade_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['cliente_id' => 3, 'instituicao_id' => 4, 'modalidade_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['cliente_id' => 3, 'instituicao_id' => 5, 'modalidade_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);

        
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