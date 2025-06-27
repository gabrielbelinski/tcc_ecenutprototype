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
        Schema::create('evolucoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_id_consultas')->unique();
            $table->string('diagnostico_nutricional')->nullable();
            $table->string('pressao_arterial')->nullable();
            $table->decimal('imc', 10, 2)->nullable();
            $table->decimal('peso', 10, 2)->nullable();
            $table->decimal('estatura', 10, 2)->nullable();
            $table->decimal('circunferencia_braco', 10, 2)->nullable();
            $table->decimal('circunferencia_muscular_braco', 10, 2)->nullable();
            $table->decimal('prega_triciptal_pct', 10, 2)->nullable();
            $table->decimal('prega_subescapular_pcse', 10, 2)->nullable();
            $table->decimal('glicemia', 10, 2)->nullable();
            $table->decimal('colesterol', 10, 2)->nullable();
            $table->decimal('triglicerideos', 10, 2)->nullable();
            $table->decimal('prega_biciptal_pcb', 10, 2)->nullable();
            $table->decimal('prega_supra_iliaca_pcsi', 10, 2)->nullable();
            $table->decimal('gordura_corporal_bia', 10, 2)->nullable();
            $table->decimal('circunferencia_cintura', 10, 2)->nullable();

            // Campos específicos para evoluções de pacientes pediátricos
            $table->string('idade_corrigida')->nullable();
            $table->decimal('gordura_corporal_pregas', 10, 2)->nullable();

            // Campos específicos para evoluções de pacientes gestantes
            $table->decimal('imc_pre_gestacional', 10, 2)->nullable();
            $table->decimal('ganho_peso', 10, 2)->nullable();
            $table->decimal('peso_habitual', 10, 2)->nullable();
            $table->text('suplementacao')->nullable();

            // Campos para avaliação de atletas
            $table->decimal('prega_toracica_ptx', 10, 2)->nullable();
            $table->decimal('prega_coxa_pcx', 10, 2)->nullable();
            $table->decimal('prega_panturrilha_pcp', 10, 2)->nullable();

            $table->text('obs_adicionais')->nullable();
            $table->foreign('fk_id_consultas')->references('id')->on('consultas')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evolucoes');
    }
};
