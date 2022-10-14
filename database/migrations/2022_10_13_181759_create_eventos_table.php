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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id('id_evento');
            $table->integer('id_criador');
            $table->string('titulo_evento');
            $table->string('imagem_evento');
            $table->text('decricao_evento');
            $table->integer('categoria');
            $table->integer('assunto');
            $table->date('data_inicio');
            $table->time('hora_inicio');
            $table->date('data_termino');
            $table->time('hora_termino');
            $table->string('cep');
            $table->string('logradouro');
            $table->string('bairro');
            $table->integer('numero');
            $table->string('cidade');
            $table->string('uf');
            $table->integer('lat');
            $table->integer('lng');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventos');
    }
};
