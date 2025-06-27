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
        Schema::create('evolucoes_adolescentes', function (Blueprint $table) {
            // $table->foreignId('fk_id_evolucoes')->primary();
            $table->decimal('gordura_corporal_bia', 10, 2)->nullable();
            //$table->foreign('fk_id_evolucoes')->references('id')->on('evolucoes')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evolucoes_adolescentes');
    }
};
