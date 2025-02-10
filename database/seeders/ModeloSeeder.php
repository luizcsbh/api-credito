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
            ['id' => 1, 'nome' => 'BCO C6 S.A', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nome' => 'BANCO INTER', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nome' => 'CAIXA ECONOMICA FEDERAL', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'nome' => 'ITAÚ UNIBANCO HOLDING S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'nome' => 'BCO BRADESCO FINANC. S.A.', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'nome' => 'BCO BRADESCO S.A.', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Inserir Modalidades
        DB::table('modalidades')->insert([
            ['id' => 1, 'instituicao_id' => 1, 'nome' => 'Crédito pessoal não-consignado', 'cod' => '3', 'taxa_juros' => '2.21', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'instituicao_id' => 2, 'nome' => 'Crédito pessoal não-consignado', 'cod' => '3', 'taxa_juros' => '1.71', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'instituicao_id' => 3, 'nome' => 'Crédito pessoal não-consignado', 'cod' => '3', 'taxa_juros' => '2.44', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'instituicao_id' => 4, 'nome' => 'Crédito pessoal não-consignado', 'cod' => '3', 'taxa_juros' => '1.58', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'instituicao_id' => 5, 'nome' => 'Crédito pessoal não-consignado', 'cod' => '3', 'taxa_juros' => '2.77', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'instituicao_id' => 6, 'nome' => 'Crédito pessoal não-consignado', 'cod' => '3', 'taxa_juros' => '6.09', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'instituicao_id' => 1, 'nome' => 'Cartão de crédito - parcelado', 'cod' => '28', 'taxa_juros' => '6.32', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'instituicao_id' => 2, 'nome' => 'Cartão de crédito - parcelado', 'cod' => '28', 'taxa_juros' => '10.74', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'instituicao_id' => 3, 'nome' => 'Cartão de crédito - parcelado', 'cod' => '28', 'taxa_juros' => '8.50', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'instituicao_id' => 4, 'nome' => 'Cartão de crédito - parcelado', 'cod' => '28', 'taxa_juros' => '9.79', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 11, 'instituicao_id' => 6, 'nome' => 'Cartão de crédito - parcelado', 'cod' => '28', 'taxa_juros' => '4.51', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 12, 'instituicao_id' => 2, 'nome' => 'Crédito pessoal consignado privado', 'cod' => '15', 'taxa_juros' => '2.06', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 13, 'instituicao_id' => 3, 'nome' => 'Crédito pessoal consignado privado', 'cod' => '15', 'taxa_juros' => '2.08', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 14, 'instituicao_id' => 6, 'nome' => 'Crédito pessoal consignado privado', 'cod' => '15', 'taxa_juros' => '2.72', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 15, 'instituicao_id' => 1, 'nome' => 'Cheque especial', 'cod' => '7', 'taxa_juros' => '8.27', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 16, 'instituicao_id' => 2, 'nome' => 'Cheque especial', 'cod' => '7', 'taxa_juros' => '7.98', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 17, 'instituicao_id' => 3, 'nome' => 'Cheque especial', 'cod' => '7', 'taxa_juros' => '8.00', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 18, 'instituicao_id' => 4, 'nome' => 'Cheque especial', 'cod' => '7', 'taxa_juros' => '8.19', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 19, 'instituicao_id' => 1, 'nome' => 'Antecipação saque-aniversário FGTS', 'cod' => '44', 'taxa_juros' => '1.99', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 20, 'instituicao_id' => 2, 'nome' => 'Antecipação saque-aniversário FGTS', 'cod' => '44', 'taxa_juros' => '2.05', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 21, 'instituicao_id' => 3, 'nome' => 'Antecipação saque-aniversário FGTS', 'cod' => '44', 'taxa_juros' => '1.79', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 22, 'instituicao_id' => 4, 'nome' => 'Antecipação saque-aniversário FGTS', 'cod' => '44', 'taxa_juros' => '1.59', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 23, 'instituicao_id' => 6, 'nome' => 'Antecipação saque-aniversário FGTS', 'cod' => '44', 'taxa_juros' => '1.48', 'created_at' => now(), 'updated_at' => now()],

        ]);

         // Inserir Clientes
         DB::table('clientes')->insert([
            ['id' => 1, 'nome' => 'José da Silva', 'cpf'=>'11111111111','created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nome' => 'Maria Santos', 'cpf'=>'12312312312','created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nome' => 'Joaquim Bezerra', 'cpf'=>'22222222222', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('cliente_modalidade')->insert([
            [
                'cliente_id' => 1,
                'instituicao_id' => 1,
                'modalidade_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cliente_id' => 1,
                'instituicao_id' => 2,
                'modalidade_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cliente_id' => 1,
                'instituicao_id' => 3,
                'modalidade_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cliente_id' => 2,
                'instituicao_id' => 3,
                'modalidade_id' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cliente_id' => 3,
                'instituicao_id' => 4,
                'modalidade_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cliente_id' => 3,
                'instituicao_id' => 5,
                'modalidade_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        
        // Inserir Ofertas
        DB::table('ofertas')->insert([
            [
                'instituicao_id' => 1,
                'modalidade_id' => 1,
                'qnt_parcela_min' => 12,
                'qnt_parcela_max' => 48,
                'valor_min' => 3000,
                'valor_max' => 7000,
                'juros_mes' => DB::table('modalidades')->where('id', 1)->value('taxa_juros'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'instituicao_id' => 2,
                'modalidade_id' => 2,
                'qnt_parcela_min' => 6,
                'qnt_parcela_max' => 36,
                'valor_min' => 2000,
                'valor_max' => 5000,
                'juros_mes' => DB::table('modalidades')->where('id', 7)->value('taxa_juros'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'instituicao_id' => 2,
                'modalidade_id' => 3,
                'qnt_parcela_min' => 24,
                'qnt_parcela_max' => 60,
                'valor_min' => 5000,
                'valor_max' => 15000,
                'juros_mes' => DB::table('modalidades')->where('id', 3)->value('taxa_juros'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'instituicao_id' => 3,
                'modalidade_id' => 9,
                'qnt_parcela_min' => 10,
                'qnt_parcela_max' => 24,
                'valor_min' => 3000,
                'valor_max' => 7000,
                'juros_mes' => DB::table('modalidades')->where('id', 9)->value('taxa_juros'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        
    }
}