<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RedisCacheTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function deve_salvar_e_recuperar_um_valor_no_redis()
    {
        Cache::store('redis')->put('teste_chave', 'Valor Redis', now()->addMinutes(10));

        $valor = Cache::store('redis')->get('teste_chave');

        $this->assertEquals('Valor Redis', $valor);
    }

    /** @test */
    public function deve_excluir_um_valor_do_redis()
    {
        Cache::store('redis')->put('teste_chave', 'Valor Redis', now()->addMinutes(10));

        Cache::store('redis')->forget('teste_chave');

        $valor = Cache::store('redis')->get('teste_chave');

        $this->assertNull($valor);
    }

    /** @test */
    public function deve_limpar_todo_o_cache_do_redis()
    {
        Cache::store('redis')->put('chave1', 'Valor 1', now()->addMinutes(10));
        Cache::store('redis')->put('chave2', 'Valor 2', now()->addMinutes(10));

        Cache::store('redis')->flush();

        $this->assertNull(Cache::store('redis')->get('chave1'));
        $this->assertNull(Cache::store('redis')->get('chave2'));
    }
}
