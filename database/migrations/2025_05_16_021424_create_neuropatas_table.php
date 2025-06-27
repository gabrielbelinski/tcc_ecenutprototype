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
        Schema::create('neuropatas', function (Blueprint $table) {
            //$table->foreignId('fk_id_anamneses')->primary();
            $table->char('se_alimenta_sozinho', 1)->nullable();
            $table->char('hipertonicidade_lingua', 1)->nullable();
            $table->char('movimento_temporo_mandibular_lingua', 1)->nullable();
            $table->char('succao', 1)->nullable();
            $table->char('tosse_durante_refeicao', 1)->nullable();
            $table->string('posicao_alimentacao')->nullable();
            $table->string('posicao_dormir')->nullable();
            $table->string('consistencia_alimentos')->nullable();
            $table->char('infeccao_repeticao', 1)->nullable();
            $table->char('infeccoes_vias_aereas', 1)->nullable();
            $table->char('oitites', 1)->nullable();
            $table->char('sinusopatia', 1)->nullable();
            $table->char('broncoespasmo', 1)->nullable();
            $table->char('apneia', 1)->nullable();
            $table->char('saliva', 1)->nullable();
            $table->char('abre_boca_redor_colher', 1)->nullable();
            $table->char('vomitos', 1)->nullable();
            $table->string('periodo_dia_vomitos')->nullable();
            $table->char('broncopneumopatias', 1)->nullable();
            $table->char('insuficiencia_respiratoria', 1)->nullable();
            $table->char('dor_toracica', 1)->nullable();
            $table->char('consegue_mastigar', 1)->nullable();
            $table->char('engasgo_durante_refeicao', 1)->nullable();
            $table->char('fecha_boca_redor_colher', 1)->nullable();
            //$table->foreign('fk_id_anamneses')->references('id')->on('anamneses')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('neuropatas');
    }
};
