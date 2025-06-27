<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('anamneses_pediatricas', function (Blueprint $table) {
            //$table->foreignId('fk_id_anamneses')->primary();
            $table->string('nome_responsavel')->nullable();
            $table->string('escolaridade_responsavel')->nullable();
            $table->string('profissao_responsavel')->nullable();
            $table->decimal('idade_gestacional', 10, 2)->nullable();
            $table->decimal('peso_nascimento', 10, 2)->nullable();
            $table->decimal('estatura_nascimento', 10, 2)->nullable();
            $table->text('intercorrencias_nascimento')->nullable();
            $table->string('alimentacao_e_suficiente')->nullable();
            $table->string('tipo_parto')->nullable();
            $table->string('parentesco_responsavel')->nullable();
            $table->string('turno_escolar')->nullable();
            $table->text('outras_intercorrencias')->nullable();
            //$table->foreign('fk_id_anamneses')->references('id')->on('anamneses')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anamneses_pediatricas');
    }
};
