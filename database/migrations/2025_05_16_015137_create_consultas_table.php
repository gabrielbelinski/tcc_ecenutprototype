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
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('fk_id_pacientes');
            $table->foreignId('fk_id_usuarios')->nullable();

            // Campos referentes ao agendamento
            $table->date('data_consulta')->nullable();
            $table->time('hora_consulta')->nullable();
            $table->string('modalidade_consulta')->nullable();
            $table->string('status_consulta')->default(value: 'Pendente');
            $table->string('status_pagamento')->nullable();
            $table->string('forma_pagamento')->nullable();
            $table->string('comprovante_pagamento_url')->nullable();
            $table->decimal('valor_total_consulta', 10, 2)->nullable();
            $table->text('observacoes_consulta')->nullable();

            // Caso a modalidade de atendimento seja bioimpedância, armazena a URL do relatório gerado
            $table->string('bioimpedancia_url')->nullable();

            // Campos referentes à avaliação dos estagiários
            $table->boolean('gera_avaliacao')->default(True);
            $table->string('nome_professor_responsavel_dia')->nullable();
            $table->string('nome_professor_avaliador')->nullable();
            $table->date('data_criacao_avaliacao')->nullable();
            $table->string('status_plano_alimentar')->default('Pendente/Não se aplica');
            $table->string('status_conduta_nutricional')->default('Pendente/Não se aplica');
            $table->string('status_acompanhamento_nutricional')->default('Pendente/Não se aplica');
            $table->string('plano_alimentar_url')->nullable();
            $table->string('conduta_nutricional_url')->nullable();
            $table->string('acompanhamento_nutricional_url')->nullable();

            $table->boolean('avaliacao_finalizada')->default(False);
            $table->text('observacoes_docente')->nullable();
            $table->foreign('fk_id_pacientes')->references('id')->on('pacientes')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('fk_id_usuarios')->references('id')->on('usuarios')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
