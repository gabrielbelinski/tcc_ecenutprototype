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
        Schema::create('atvs_fisicas', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('fk_id_anamneses')->nullable()->unique();
            //$table->foreignId('fk_id_acompanhamentos')->nullable()->unique();
            $table->string('duracao_atv_fisica')->nullable();
            $table->string('horario_atv_fisica')->nullable();
            $table->string('tipo_atv_fisica')->nullable();
            $table->string('intensidade_atv_fisica')->nullable();
            //$table->foreign('fk_id_anamneses')->references('id')->on('anamneses')->onDelete('restrict');
            //$table->foreign('fk_id_acompanhamentos')->references('id')->on('acompanhamentos')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atvs_fisicas');
    }
};
