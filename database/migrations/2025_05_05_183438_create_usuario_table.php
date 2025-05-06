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
        Schema::create('usuario', function (Blueprint $table) {
            $table->increments('id_usuario');
            $table->string('email')->unique();
            $table->string('senha')->unique();
            $table->string('matricula')->unique();
            $table->string('genero');
            $table->date('data_nascimento');
            $table->timestampTz('data_cadastro');
            $table->timestampTz('data_inativacao');
            $table->string(column: 'nome');
            $table->string('telefone');
            $table->string('rg')->unique();
            $table->string(column: 'cpf')->unique();
            $table->string(column: 'rua');
            $table->string(column: 'numero');
            $table->string(column: 'bairro');
            $table->string(column: 'cep');
            $table->string(column: 'cidade');
            $table->string(column: 'estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
