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
        Schema::create('evolucoes_pediatricas', function (Blueprint $table) {
            //  $table->foreignId('fk_id_evolucoes')->primary();
            $table->smallInteger('idade_corrigida')->nullable();
            $table->decimal('gordura_corporal_pregas', 10, 2)->nullable();
            $table->decimal('gordura_corporal_bia', 10, 2)->nullable();
            $table->string('nome_responsavel')->nullable();
            $table->string('parentesco_responsavel')->nullable();
            // $table->foreign('fk_id_evolucoes')->references('id')->on('evolucoes')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evolucoes_pediatricas');
    }
};
