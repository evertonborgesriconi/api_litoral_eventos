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
            $table->id('evento_id');
            $table->foreignId('criador_id');
            $table->string('titulo_evento');
            $table->string('imagem_evento');
            $table->text('decricao_evento');
            $table->foreignId('categoria_id');
            $table->foreignId('assunto_id');
            $table->date('data_inicio');
            $table->time('hora_inicio');
            $table->date('data_termino');
            $table->time('hora_termino');
            $table->string('cep');
            $table->string('logradouro');
            $table->string('bairro');
            $table->string('numero');
            $table->string('cidade');
            $table->string('uf');
            $table->float('lat',10,6);
            $table->float('lng',10,6);
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
