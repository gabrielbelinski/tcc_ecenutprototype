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
        Schema::create('anamneses_adultos_idosos', function (Blueprint $table) {
            //$table->foreignId('fk_id_anamneses')->primary();
            $table->string('tabagismo')->nullable();
            $table->smallInteger('qtd_cigarros')->nullable();
            $table->char('protese_dentaria', 1)->nullable();
            $table->char('deseja_hipertrofia', 1)->nullable();
            //$table->foreign('fk_id_anamneses')->references('id')->on('anamneses')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anamneses_adultos_idosos');
    }
};
