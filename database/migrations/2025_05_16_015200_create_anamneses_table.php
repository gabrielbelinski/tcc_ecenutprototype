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
        Schema::create('anamneses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_id_consultas')->unique();

            // Dados do paciente
            $table->string('primeira_consulta')->nullable();

            // Patologias e condições de saúde
            $table->boolean('dm')->nullable();
            $table->boolean('has')->nullable();
            $table->boolean('colesterol_elevado')->nullable();
            $table->boolean('tg_elevado')->nullable();
            $table->text('outras_patologias')->nullable();

            // Hábitos e estilo de vida
            $table->text('antecedentes_familiares')->nullable();
            $table->text('medicamentos')->nullable();
            $table->string('tabagismo')->nullable();
            $table->smallInteger('qtd_cigarros')->nullable();

            // Histórico de peso
            $table->boolean('houve_ganho_peso')->nullable();
            $table->decimal('peso_ganho', 10, 2)->nullable();
            $table->boolean('houve_perda_peso')->nullable();
            $table->decimal('peso_perdido', 10, 2)->nullable();
            $table->boolean('tratamento_perda_ganho_peso')->nullable();
            $table->string('tipo_tratamento_perda_ganho_peso')->nullable();
            $table->boolean('houve_acompanhamento')->nullable();
            $table->string('profissional_tratamento')->nullable();

            // Saúde bucal	
            $table->string('mastigacao_degluticao')->nullable();
            $table->boolean('protese_dentaria')->nullable();

            // Sintomas digestivos e intestinais
            $table->boolean('sintomas_digestivos')->nullable();
            $table->string('funcao_intestinal')->nullable();
            $table->smallInteger('vezes_aodia_fcintestinal')->nullable();
            $table->boolean('diarreia')->nullable();
            $table->string('diurese')->nullable();
            $table->string('ingestao_hidrica')->nullable();

            // Atividade física
            $table->string('habitos_atv_fisica')->nullable();
            $table->text('tipo_atv_fisica')->nullable();
            $table->text('duracao_atv_fisica')->nullable();

            // Hábitos alimentares
            $table->boolean('alimentacao_e_suficiente')->nullable();
            $table->string('local_refeicoes')->nullable();
            $table->boolean('come_frente_eletronicos')->nullable();
            $table->boolean('come_com_familia')->nullable();
            $table->string('quem_prepara')->nullable();
            $table->boolean('sente_apetite')->nullable();
            $table->boolean('tem_apetite_intervalos')->nullable();
            $table->string('qual_horario_sente_mais_fome')->nullable();
            $table->text('mudanca_recente')->nullable();
            $table->text('preferencias_alimentares')->nullable();
            $table->text('rejeicoes')->nullable();
            $table->text('intolerancias_alergias')->nullable();
            $table->boolean('emocoes_influenciam_escolhas_alimentares')->nullable();
            $table->text('crencas_etnicas_religiosas_tabus')->nullable();

            // Frequência alimentar específica - infantil
            $table->string('leite_materno_data_inicio_fim')->nullable();
            $table->string('aceitacao_leite_materno')->nullable();
            $table->string('leite_artificial_data_inicio_fim')->nullable();
            $table->string('tipo_leite_artificial')->nullable();
            $table->string('aceitacao_leite_artificial')->nullable();
            $table->string('cha_agua_data_inicio_fim')->nullable();
            $table->string('aceitacao_cha_agua')->nullable();
            $table->string('suco_data_inicio_fim')->nullable();
            $table->string('aceitacao_suco')->nullable();
            $table->string('papa_fruta_data_inicio_fim')->nullable();
            $table->string('tipo_papa_fruta')->nullable();
            $table->string('consistencia_papa_fruta')->nullable();
            $table->string('aceitacao_papa_fruta')->nullable();
            $table->string('papa_salgada_data_inicio_fim')->nullable();
            $table->string('tipo_papa_salgada')->nullable();
            $table->string('consistencia_papa_salgada')->nullable();
            $table->string('aceitacao_papa_salgada')->nullable();

            // Frequência alimentar geral
            $table->smallInteger('qtd_latas_oleo_mes')->nullable();
            $table->smallInteger('qtd_leite_derivados')->nullable();
            $table->string('frequencia_leite_derivados')->nullable();
            $table->smallInteger('qtd_carnes')->nullable();
            $table->string('frequencia_carnes')->nullable();
            $table->smallInteger('qtd_ovos')->nullable();
            $table->string('frequencia_ovos')->nullable();
            $table->smallInteger('qtd_leguminosas')->nullable();
            $table->string('frequencia_leguminosas')->nullable();
            $table->smallInteger('qtd_cereais')->nullable();
            $table->string('frequencia_cereais')->nullable();
            $table->smallInteger('qtd_tuberculos_raizes')->nullable();
            $table->string('frequencia_tuberculos_raizes')->nullable();
            $table->smallInteger('qtd_frutas')->nullable();
            $table->string('frequencia_frutas')->nullable();
            $table->smallInteger('qtd_legumes')->nullable();
            $table->string('frequencia_legumes')->nullable();
            $table->smallInteger('qtd_verduras')->nullable();
            $table->string('frequencia_verduras')->nullable();
            $table->smallInteger('qtd_oleaginosas')->nullable();
            $table->string('frequencia_oleaginosas')->nullable();
            $table->smallInteger('qtd_guloseimas')->nullable();
            $table->string('frequencia_guloseimas')->nullable();
            $table->smallInteger('qtd_embutidos')->nullable();
            $table->string('frequencia_embutidos')->nullable();
            $table->smallInteger('qtd_frituras')->nullable();
            $table->string('frequencia_frituras')->nullable();
            $table->smallInteger('qtd_processados')->nullable();
            $table->string('frequencia_processados')->nullable();
            $table->smallInteger('qtd_ultraprocessados')->nullable();
            $table->string('frequencia_ultraprocessados')->nullable();
            $table->smallInteger('qtd_bebidas_alcoolicas')->nullable();
            $table->string('frequencia_bebidas_alcoolicas')->nullable();
            $table->smallInteger('qtd_refrigerantes')->nullable();
            $table->string('frequencia_refrigerantes')->nullable();
            $table->smallInteger('qtd_sucos_industrializados')->nullable();
            $table->string('frequencia_sucos_industrializados')->nullable();
            $table->smallInteger('qtd_sucos_naturais')->nullable();
            $table->string('frequencia_sucos_naturais')->nullable();

            // Registro alimentar
            $table->string('tipo_registro')->nullable();
            $table->text('cafe_manha')->nullable();
            $table->text('lanche_manha')->nullable();
            $table->text('almoco')->nullable();
            $table->text('lanche_tarde_I')->nullable();
            $table->text('lanche_tarde_II')->nullable();
            $table->text('jantar')->nullable();
            $table->text('ceia')->nullable();
            $table->text('outros_registro_alimentar')->nullable();

            // Campos específicos - anamnese em adolescentes
            $table->string('estadiamento_puberal')->nullable();
            $table->smallInteger('idade_inicio_ciclo_menstrual')->nullable();
            $table->string('tempo_menarca')->nullable();
            $table->boolean('problemas_associados_menarca')->nullable();
            $table->text('tipo_problemas_associados_menarca')->nullable();
            $table->boolean('alteracao_humor_periodo_menstrual')->nullable();
            $table->text('tipo_alteracao_humor_periodo_menstrual')->nullable();

            // Campos específicos - anamnese em crianças
            $table->decimal('peso_nascimento', 10, 2)->nullable();
            $table->decimal('estatura_nascimento', 10, 2)->nullable();
            $table->text('intercorrencias_nascimento')->nullable();
            $table->text('outras_intercorrencias')->nullable();
            $table->string('tipo_parto')->nullable();

            // Campos específicos - anamnese em gestantes
            $table->string('idade_gestacional')->nullable();
            $table->smallInteger('qtd_gestacoes')->nullable();
            $table->smallInteger('abortos')->nullable();
            $table->boolean('morte_perinatal')->nullable();
            $table->text('morte_perinatal_descricao')->nullable();
            $table->text('intervalo_interpartal')->nullable();
            $table->text('num_filhos_idade')->nullable();
            $table->boolean('historico_bebe_peso')->nullable();
            $table->boolean('historico_hipertensao')->nullable();
            $table->smallInteger('paridade')->nullable();
            $table->date('data_ultima_menstruacao')->nullable();
            $table->string('ultima_medida_pa')->nullable();
            $table->text('leite_materno')->nullable();
            $table->text('condicoes_seios')->nullable();
            $table->boolean('uso_suplementos')->nullable();
            $table->text('suplementacao')->nullable();
            $table->string('alteracao_humor')->nullable();
            $table->boolean('edema')->nullable();
            $table->boolean('pica')->nullable();
            $table->text('substancias_pica')->nullable();
            $table->boolean('anemia')->nullable();
            $table->text('descricao_epoca_anemia')->nullable();
            $table->boolean('azia')->nullable();
            $table->text('frequencia_azia')->nullable();
            $table->boolean('nauseas')->nullable();
            $table->text('frequencia_nauseas')->nullable();
            $table->boolean('vomito')->nullable();
            $table->text('frequencia_vomito')->nullable();

            // Campos específicos - anamnese em pessoas com neuropatias
            $table->smallInteger('freq_vomito_neuropata')->nullable();
            $table->string('periodo_dia_vomito_neuropata')->nullable();
            $table->boolean('se_alimenta_sozinho')->nullable();
            $table->boolean('hipertonicidade_lingua')->nullable();
            $table->boolean('movimento_temporo_mandibular_lingua')->nullable();
            $table->boolean('succao')->nullable();
            $table->boolean('tosse_durante_refeicao')->nullable();
            $table->string('posicao_alimentacao')->nullable();
            $table->string('posicao_dormir')->nullable();
            $table->string('consistencia_alimentos')->nullable();
            $table->boolean('infeccao_repeticao')->nullable();
            $table->boolean('infeccoes_vias_aereas')->nullable();
            $table->boolean('oitites')->nullable();
            $table->boolean('sinusopatia')->nullable();
            $table->boolean('broncoespasmo')->nullable();
            $table->boolean('apneia')->nullable();
            $table->boolean('saliva')->nullable();
            $table->boolean('abre_boca_redor_colher')->nullable();
            $table->boolean('broncopneumopatias')->nullable();
            $table->boolean('insuficiencia_respiratoria')->nullable();
            $table->boolean('dor_toracica')->nullable();
            $table->boolean('consegue_mastigar')->nullable();
            $table->boolean('engasgo_durante_refeicao')->nullable();
            $table->boolean('fecha_boca_redor_colher')->nullable();

            // Observações adicionais
            $table->text('obs_adicionais')->nullable();

            // Restrição da chave estrangeira
            $table->foreign('fk_id_consultas')->references('id')->on('consultas')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anamneses');
    }
};
