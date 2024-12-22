<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(InstituicoesSeeder::class);
        $this->call(ClientesSeeder::class);
        $this->call(CreditoSeeder::class);
        $this->call(TaxasSeeder::class);
        $this->call(CreditoTaxasSeeder::class);
        $this->call(ClienteInstituicoesSeeder::class);
        $this->call(ModalidadesSeeder::class);
        $this->call(ClienteModalidadesSeeder::class);
        $this->call(OfertasSeeder::class);
    }
}
