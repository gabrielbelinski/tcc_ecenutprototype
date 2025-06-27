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
        Schema::create('frequencias_alimentares', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('fk_id_anamneses');
            $table->string('nome')->nullable();
            $table->integer('qtd')->nullable();
            $table->string('frequencia')->nullable();
            //$table->foreign('fk_id_anamneses')->references('id')->on('anamneses')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frequencias_alimentares');
    }
};
