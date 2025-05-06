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
        Schema::create('avaliacao', function (Blueprint $table) {
            $table->increments('id_avaliacao');
            $table->string('observacoes_docente');
            $table->string('status_plano_alimentar')->nullable();
            $table->string('status_conduta_nutricional')->nullable();
            $table->string('status_acompanhamento')->nullable();
            $table->timestampTz('data_criacao');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaliacao');
    }
};
