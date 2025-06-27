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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('email');
            $table->string('senha');
            $table->string('matricula');
            $table->string('genero')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->timestamp('data_inativacao')->nullable();
            $table->string('nome');
            $table->string('telefone')->nullable();
            $table->string('rg')->nullable();
            $table->string('cpf')->nullable();
            $table->string('rua')->nullable();
            $table->string('numero')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cep')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('tipo_usuario')->nullable();

        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
