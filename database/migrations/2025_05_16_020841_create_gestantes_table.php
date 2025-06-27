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
        Schema::create('gestantes', function (Blueprint $table) {
            // $table->foreignId('fk_id_anamneses')->primary();
            $table->decimal('idade_gestacional', 10, 2)->nullable();
            $table->smallInteger('qtd_gestacoes')->nullable();
            $table->smallInteger('abortos')->nullable();
            $table->char('houve_morte_perinatal', 1)->nullable();
            $table->string('intervalo_interpartal')->nullable();
            $table->string('num_filhos_idade')->nullable();
            $table->char('historico_bebe_peso', 1)->nullable();
            $table->char('historico_hipertensao', 1)->nullable();
            $table->smallInteger('paridade')->nullable();
            $table->date('dum')->nullable();
            $table->string('ultima_medida_pa')->nullable();
            $table->string('leite_materno')->nullable();
            $table->string('condicoes_seios')->nullable();
            $table->string('suplementacao')->nullable();
            $table->string('alteracao_humor')->nullable();
            $table->char('edema', 1)->nullable();
            $table->char('nauseas', 1)->nullable();
            $table->char('pica', 1)->nullable();
            $table->char('anemia', 1)->nullable();
            $table->string('descricao_epoca_anemia')->nullable();
            $table->string('substancias_pica')->nullable();
            $table->char('azia', 1)->nullable();
            $table->string('frequencia_azia')->nullable();
            $table->string('frequencia_nauseas')->nullable();
            $table->char('vomito', 1)->nullable();
            $table->string('frequencia_vomito')->nullable();

            //$table->foreign('fk_id_anamneses')->references('id')->on('anamneses')->onDelete('restrict'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gestantes');
    }
};
