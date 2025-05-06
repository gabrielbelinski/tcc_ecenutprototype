<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('paciente', function (Blueprint $table) {
            $table->increments('id_paciente');
            $table->string('nome');
            $table->date('data_nascimento');
            $table->string('cpf');
            $table->string('rg');
            $table->boolean('encaminhamento')->default(false);
            $table->string('origem_encaminhamento')->nullable();
            $table->string('telefone');
            $table->string('email')->nullable();
            $table->string('genero');
            $table->date('data_cadastro');
            $table->string('tipo_paciente');
            $table->string(column: 'rua');
            $table->string(column: 'numero');
            $table->string(column: 'bairro');
            $table->string(column: 'cep');
            $table->string(column: 'cidade');
            $table->string(column: 'estado');
            $table->string(column: 'escolaridade');
            $table->string(column: 'profissao');
            $table->double(column: 'renda_familiar_ibge');
            $table->integer(column: 'num_pessoas_nucleo_familiar');
            $table->string(column: 'motivo_procura');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paciente');
    }
};
