<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome');
            $table->date('data_nascimento')->nullable();
            $table->string('cpf')->unique();
            $table->string('rg')->unique();
            $table->string('encaminhamento')->nullable();
            $table->string('telefone');
            $table->string('email')->nullable();
            $table->boolean('aluno_unicentro')->nullable();
            $table->boolean('gestante')->nullable();
            $table->boolean('neuropata')->nullable();
            $table->boolean('atleta')->nullable();
            $table->string('genero');
            $table->string('grupo_etario');
            $table->string('rua')->nullable();
            $table->string('numero')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cep')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('escolaridade')->nullable();
            $table->string('profissao')->nullable();
            $table->string('renda_familiar_ibge')->nullable();
            $table->smallInteger('num_pessoas_nucleo_familiar')->nullable();
            $table->string('motivo_procura')->nullable();
            $table->string('turno_escolar')->nullable();
            $table->string('nome_responsavel')->nullable();
            $table->string('parentesco_responsavel')->nullable();
            $table->string('profissao_responsavel')->nullable();
            $table->string('escolaridade_responsavel')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
