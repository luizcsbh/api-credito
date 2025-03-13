<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ofertas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('modalidade_id');
            $table->decimal('valor_min', 10, 2);
            $table->decimal('valor_max', 10, 2);
            $table->integer('qnt_parcela_min');
            $table->integer('qnt_parcela_max');
            $table->timestamps();
            $table->foreign('modalidade_id')->references('id')->on('modalidades')->onDelete('cascade');
            $table->index(['id','created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ofertas');
    }
};
