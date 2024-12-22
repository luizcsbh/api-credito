<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientesSeeder extends Seeder
{
    public function run()
    {
         // Inserir Clientes
         DB::table('clientes')->insert([
            ['id' => 1, 'nome' => 'José da Silva', 'cpf'=>'11111111111','created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nome' => 'Maria Santos', 'cpf'=>'12312312312','created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nome' => 'Joaquim Bezerra', 'cpf'=>'22222222222', 'created_at' => now(), 'updated_at' => now()],
        ]); 
    }
}