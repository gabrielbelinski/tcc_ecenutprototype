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
        Schema::create('evolucoes_atletas', function (Blueprint $table) {
            //  $table->foreignId('fk_id_evolucoes')->primary();
            $table->string('pressao_arterial')->nullable();
            $table->decimal('imc', 10, 2)->nullable();
            $table->decimal('prega_biciptal_pcb', 10, 2)->nullable();
            $table->decimal('prega_supra_iliaca_pcsi', 10, 2)->nullable();
            $table->decimal('prega_toracica_ptx', 10, 2)->nullable();
            $table->decimal('prega_coxa_pcx', 10, 2)->nullable();
            $table->decimal('prega_panturrilha_pcp', 10, 2)->nullable();
            $table->decimal('circunferencia_cintura', 10, 2)->nullable();
            $table->decimal('gordura_corporal_bia', 10, 2)->nullable();
            // $table->foreign('fk_id_evolucoes')->references('id')->on('evolucoes')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evolucoes_atletas');
    }
};
