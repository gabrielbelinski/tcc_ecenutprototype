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
        //
        Schema::dropIfExists('atvs_fisicas');
        Schema::dropIfExists('anamneses_adultos_idosos');
        Schema::dropIfExists('anamneses_adolescentes');
        Schema::dropIfExists('anamneses_pediatricas');
        Schema::dropIfExists('historias_alimentares');
        Schema::dropIfExists('gestantes');
        Schema::dropIfExists('neuropatas');
        Schema::dropIfExists('evolucoes_adultos_idosos');
        Schema::dropIfExists('evolucoes_adolescentes');
        Schema::dropIfExists('evolucoes_pediatricas');
        Schema::dropIfExists('evolucoes_gestantes');
        Schema::dropIfExists('evolucoes_atletas');
        Schema::dropIfExists('frequencias_alimentares');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
