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
        Schema::create('historias_alimentares', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('fk_id_anamneses_pediatricas');
            $table->string('nome')->nullable();
            $table->text('descricao')->nullable();
            // $table->foreign('fk_id_anamneses_pediatricas')->references('fk_id_anamneses')->on('anamneses_pediatricas')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historias_alimentares');
    }
};
