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
        Schema::create('anamneses_adolescentes', function (Blueprint $table) {
            //$table->foreignId('fk_id_anamneses')->primary();
            $table->string('turno_escolar')->nullable();
            $table->string('escolaridade_responsavel')->nullable();
            $table->string('profissao_responsavel')->nullable();
            $table->string('estadiamento_puberal')->nullable();
            $table->integer('idade_inicio_ciclo_menstrual')->nullable();
            $table->string('tempo_menarca')->nullable();
            $table->char('problemas_associados_menarca', 1)->nullable();
            $table->char('alteracao_humor_periodo_menstrual', 1)->nullable();
            $table->string('tipo_alteracao_humor_periodo_menstrual')->nullable();
            $table->char('alimentacao_e_suficiente', 1)->nullable();
            $table->string('nome_responsavel')->nullable();
            $table->string('parentesco_responsavel')->nullable();
            $table->string('profissional_tratamento')->nullable();
            $table->string('tipo_problemas_associados_menarca')->nullable();
            // $table->foreign('fk_id_anamneses')->references('id')->on('anamneses')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anamneses_adolescentes');
    }
};
