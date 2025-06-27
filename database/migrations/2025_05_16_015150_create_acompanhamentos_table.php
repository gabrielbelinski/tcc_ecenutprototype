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
        Schema::create('acompanhamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_id_consultas')->unique();
            $table->string('habitos_atv_fisica')->nullable();
            $table->text('duracao_atv_fisica')->nullable();
            $table->text('horario_atv_fisica')->nullable();
            $table->text('tipo_atv_fisica')->nullable();
            $table->text('intensidade_atv_fisica')->nullable();

            $table->text('intercorrencias')->nullable();
            $table->string('habito_intestinal')->nullable();
            $table->string('ingestao_hidrica')->nullable();
            $table->text('mudancas_diagnostico')->nullable();
            $table->text('medicamentos')->nullable();

            $table->string('tipo_registro')->nullable();
            $table->text('cafe_manha')->nullable();
            $table->text('lanche_manha')->nullable();
            $table->text('almoco')->nullable();
            $table->text('lanche_tarde_I')->nullable();
            $table->text('lanche_tarde_II')->nullable();
            $table->text('jantar')->nullable();
            $table->text('ceia')->nullable();
            $table->text('outros_registro_alimentar')->nullable();
            $table->foreign('fk_id_consultas')->references('id')->on('consultas')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acompanhamentos');
    }
};
