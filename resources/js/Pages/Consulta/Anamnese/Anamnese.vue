<template>
    <MainLayout>
        <FormKit type="form" @submit="create" :actions="false">
            <FormKit type="multi-step" tab-style="progress">
                <FormKit type="step" name="paciente" label="Paciente">
                    <FormKit
                        type="radio"
                        label="Primeira consulta?"
                        v-model="form.primeira_consulta"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />

                    <div
                        v-if="
                            grupo_etario == 'Adulto' || grupo_etario == 'Idoso'
                        "
                    >
                        <FormKit
                            type="radio"
                            label="Escolaridade"
                            v-model="form.escolaridade"
                            :options="
                                [
                                    'Não alfabetizado',
                                    'Ensino Fundamental',
                                    'Ensino Médio',
                                    'Ensino Superior',
                                    'Pós-Graduação',
                                ].map((t) => ({ value: t, label: t }))
                            "
                        />
                    </div>
                    <div v-else>
                        <div v-if="grupo_etario != 'Recém-nascido'">
                            <FormKit
                                type="text"
                                label="Escolaridade"
                                v-model="form.escolaridade"
                                help="Descrever o ano/série"
                            />
                        </div>

                        <FormKit
                            type="radio"
                            label="Turno em que estuda"
                            v-model="form.turno_escolar"
                            :options="
                                [
                                    'Manhã',
                                    'Tarde',
                                    'Noite',
                                    'Integral',
                                    'Não frequenta a escola',
                                ].map((t) => ({ value: t, label: t }))
                            "
                        />

                        <FormKit
                            type="radio"
                            label="Escolaridade do responsável"
                            v-model="form.escolaridade_responsavel"
                            :options="
                                [
                                    'Não alfabetizado',
                                    'Ensino Fundamental',
                                    'Ensino Médio',
                                    'Ensino Superior',
                                    'Pós-Graduação',
                                ].map((t) => ({ value: t, label: t }))
                            "
                        />

                        <FormKit
                            type="text"
                            label="Profissão do responsável"
                            v-model="form.profissao_responsavel"
                            help="Profissão/ocupação"
                        />
                    </div>

                    <FormKit
                        v-if="
                            grupo_etario != 'Recém-nascido' ||
                            grupo_etario != 'Criança'
                        "
                        type="text"
                        label="Profissão"
                        v-model="form.profissao"
                        help="Profissão/ocupação"
                    />

                    <FormKit
                        type="radio"
                        label="Renda Familiar (IBGE)"
                        v-model="form.renda_familiar_ibge"
                        :options="[
                            { value: 'E', label: 'E - Até R$ 1.449,99' },
                            {
                                value: 'D',
                                label: 'D - De R$ 1.450,00 a R$ 2.899,99',
                            },
                            {
                                value: 'C',
                                label: 'C - De R$ 2.900,00 a R$ 7.249,99',
                            },
                            {
                                value: 'B',
                                label: 'B - De R$ 7.250,00 a R$ 14.499,99',
                            },
                            { value: 'A', label: 'A - R$ 14.500 ou mais' },
                            { value: 'Não sabe', label: 'Não sabe informar' },
                        ]"
                    />

                    <FormKit
                        type="number"
                        min="1"
                        label="Número de pessoas no núcleo familiar"
                        v-model="form.num_pessoas_nucleo_familiar"
                        help="Quantas pessoas vivem na residência?"
                    />
                </FormKit>
                <FormKit
                    type="step"
                    name="motivo da procura"
                    label="Motivo da procura"
                >
                    <FormKit
                        type="radio"
                        label="Motivo da procura"
                        v-model="form.motivo_procura"
                        :options="
                            [
                                'Perda de peso',
                                'Ganho de peso',
                                'Alergias ou intolerâncias alimentares',
                                'Doenças',
                                'Reeducação alimentar',
                                'Hipertrofia',
                                'Outro',
                            ].map((t) => ({ value: t, label: t }))
                        "
                    />
                    <FormKit
                        type="radio"
                        label="Portador de condição neurológica?"
                        v-model="form.neuropata"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />
                    <FormKit
                        type="radio"
                        v-if="
                            genero != 'Masculino' &&
                            (grupo_etario != 'Criança' ||
                                grupo_etario != 'Recém-nascido' ||
                                grupo_etario != 'Idoso')
                        "
                        label="Paciente está gestante?"
                        v-model="form.gestante"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />
                </FormKit>
                <FormKit
                    type="step"
                    name="gestante"
                    label="Gestação"
                    v-if="form.gestante == true"
                >
                    <FormKit
                        type="date"
                        label="Data da última menstruação"
                        v-model="form.data_ultima_menstruacao"
                        validation="required_if:form.gestante,true"
                        help="Selecione a data da última menstruação"
                    />
                    <FormKit
                        type="number"
                        label="Idade gestacional atual (semanas)"
                        v-model="form.idade_gestacional"
                        min="1"
                        max="42"
                        validation="required_if:form.gestante,true|number|between:1,42"
                        help="Informe a idade gestacional em semanas completas"
                    />
                    <FormKit
                        type="number"
                        label="Gestações"
                        v-model="form.qtd_gestacoes"
                        min="0"
                        validation="required_if:form.gestante,true|number|min:0"
                        help="Número total de gestações, incluindo a atual"
                    />
                    <FormKit
                        type="number"
                        label="Paridade"
                        v-model="form.paridade"
                        min="0"
                        validation="required_if:form.gestante,true|number|min:0"
                        help="Número de partos"
                    />
                    <FormKit
                        type="number"
                        label="Abortos"
                        v-model="form.abortos"
                        min="0"
                        validation="required_if:form.gestante,true|number|min:0"
                        help="Número de abortos espontâneos ou induzidos"
                    />
                    <FormKit
                        type="radio"
                        label="Houve morte perinatal?"
                        v-model="form.morte_perinatal"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />
                    <FormKit
                        v-if="form.morte_perinatal == true"
                        type="textarea"
                        label="Descrever a situação"
                        v-model="form.morte_perinatal_descricao"
                        rows="2"
                        help="Descreva apenas se houver histórico de morte perinatal"
                    />
                    <FormKit
                        type="text"
                        label="Intervalo interpartal"
                        v-model="form.intervalo_interpartal"
                        validation="required_if:form.gestante,true"
                        help="Tempo entre o último parto e esta gestação (ex: 2 anos)"
                    />
                    <FormKit
                        type="textarea"
                        label="Número de filhos e idade"
                        v-model="form.num_filhos_idade"
                        rows="2"
                        :classes="{
                            input: 'resize-none',
                        }"
                        help="Ex: 2 filhos (5 anos e 2 anos)"
                    />
                    <FormKit
                        type="radio"
                        label="Histórico de bebê com peso menor que 2500g ou maior que
                        4kg"
                        v-model="form.historico_bebe_peso"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />
                    <FormKit
                        type="text"
                        label="Pressão arterial"
                        v-model="form.ultima_medida_pa"
                        help="Registrar a data e o valor da última medição"
                    />
                </FormKit>
                <FormKit
                    type="step"
                    name="históricoclinico"
                    label="Hist. Clinico"
                >
                    <FormKit
                        type="radio"
                        label="Diabetes Mellitus (DM)"
                        v-model="form.dm"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />
                    <FormKit
                        type="radio"
                        label="Hipertensão Arterial Sistêmica (HAS)"
                        v-model="form.has"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />
                    <FormKit
                        type="radio"
                        label="Colesterol elevado"
                        v-model="form.colesterol_elevado"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />
                    <FormKit
                        type="radio"
                        label="Triglicerídeos (TG) elevado"
                        v-model="form.tg_elevado"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />

                    <FormKit
                        type="textarea"
                        label="Outros Diagnósticos"
                        v-model="form.outras_patologias"
                        rows="2"
                        help="Descrever diagnóstico clínico não citado anteriormente"
                    />

                    <FormKit
                        type="textarea"
                        label="Antecedentes familiares"
                        v-model="form.antecedentes_familiares"
                        rows="2"
                        help="Descrever antecedentes familiares"
                    />

                    <FormKit
                        type="textarea"
                        label="Medicamentos em uso"
                        v-model="form.medicamentos"
                        rows="2"
                        help="Descrever o nome dos medicamentos"
                    />
                    <!-- Verificar se o paciente é adulto/idoso -->
                    <div
                        v-if="
                            grupo_etario == 'Adulto' || grupo_etario == 'Idoso'
                        "
                    >
                        <FormKit
                            type="radio"
                            label="Tabagismo"
                            v-model="form.tabagismo"
                            :options="
                                ['Sim', 'Não', 'Ex-Tabagista'].map((t) => ({
                                    value: t,
                                    label: t,
                                }))
                            "
                        />

                        <FormKit
                            v-show="form.tabagismo == 'Sim'"
                            type="number"
                            label="Quantidade de cigarros"
                            v-model="form.qtd_cigarros"
                            min="0"
                            validation="optional|number|min:0"
                            help="Quantidade de cigarros ao dia"
                        />

                        <FormKit
                            type="radio"
                            label="Paciente utiliza prótese dentária?"
                            v-model="form.protese_dentaria"
                            :options="[
                                { label: 'Sim', value: true },
                                { label: 'Não', value: false },
                            ]"
                        />
                    </div>
                    <div v-if="form.gestante">
                        <FormKit
                            type="radio"
                            label="Histórico de hipertensão nas outras gestações"
                            v-model="form.historico_hipertensao"
                            :options="[
                                { label: 'Sim', value: true },
                                { label: 'Não', value: false },
                            ]"
                        />
                        <FormKit
                            type="radio"
                            label="Anemia"
                            v-model="form.anemia"
                            :options="[
                                { label: 'Sim', value: true },
                                { label: 'Não', value: false },
                            ]"
                        />

                        <FormKit
                            v-show="form.anemia"
                            type="textarea"
                            label="Descrição"
                            v-model="form.descricao_epoca_anemia"
                            rows="2"
                            help="Caso tenha apresentado anemia anteriormente a gestação
                        descrever: (por exemplo: época? apresentou
                        hemorragias?)"
                            validation="required_if:form.anemia,true"
                        />

                        <FormKit
                            type="radio"
                            label="Edema"
                            v-model="form.edema"
                            :options="[
                                { label: 'Sim', value: true },
                                { label: 'Não', value: false },
                            ]"
                        />

                        <FormKit
                            type="radio"
                            label="Faz uso de suplementos?"
                            v-model="form.uso_suplementos"
                            :options="[
                                { label: 'Sim', value: true },
                                { label: 'Não', value: false },
                            ]"
                        />

                        <FormKit
                            v-show="form.uso_suplementos"
                            type="textarea"
                            label="Descrever suplementação"
                            v-model="form.suplementacao"
                            rows="2"
                            help="Descrever quais suplementos são utilizados"
                            validation="required_if:form.uso_suplementos,true"
                        />

                        <FormKit
                            type="textarea"
                            label="Cuidado com os seios"
                            v-model="form.condicoes_seios"
                            help="Informe sobre cuidados, dores ou alterações nos seios"
                            rows="2"
                            validation="optional"
                        />

                        <FormKit
                            type="textarea"
                            label="Informações sobre o leite materno"
                            v-model="form.leite_materno"
                            help="Informe sobre quantidade, dificuldades ou características do leite materno"
                            rows="2"
                            validation="optional"
                        />

                        <FormKit
                            type="radio"
                            label="Alterações de humor"
                            v-model="form.alteracao_humor"
                            :options="
                                ['Sim', 'Não', 'Ás vezes'].map((t) => ({
                                    value: t,
                                    label: t,
                                }))
                            "
                        />

                        <FormKit
                            type="radio"
                            label="Azia"
                            v-model="form.azia"
                            :options="[
                                { label: 'Sim', value: true },
                                { label: 'Não', value: false },
                            ]"
                        />

                        <FormKit
                            v-show="form.azia"
                            type="textarea"
                            label="Frequência/Horários"
                            v-model="form.frequencia_azia"
                            help="Com que frequência e em que horários sente azia"
                            rows="2"
                            validation="required_if:form.azia,true"
                        />

                        <FormKit
                            type="radio"
                            label="Náuseas"
                            v-model="form.nauseas"
                            :options="[
                                { label: 'Sim', value: true },
                                { label: 'Não', value: false },
                            ]"
                        />
                        <FormKit
                            v-show="form.nauseas"
                            type="textarea"
                            label="Frequência/Horários"
                            v-model="form.frequencia_nauseas"
                            help="Com que frequência e em que horários sente náuseas"
                            rows="2"
                            validation="required_if:form.nauseas,true"
                        />

                        <FormKit
                            type="radio"
                            label="Vômitos"
                            v-model="form.vomito"
                            :options="[
                                { label: 'Sim', value: true },
                                { label: 'Não', value: false },
                            ]"
                        />

                        <FormKit
                            v-show="form.vomito"
                            type="textarea"
                            label="Frequência/Horários"
                            v-model="form.frequencia_vomito"
                            help="Com que frequência e em que horários ocorre o vômito"
                            rows="2"
                            validation="required_if:form.vomito,true"
                        />
                        <FormKit
                            type="radio"
                            label="Pica"
                            v-model="form.pica"
                            :options="[
                                { label: 'Sim', value: true },
                                { label: 'Não', value: false },
                            ]"
                        />
                        <FormKit
                            v-show="form.pica"
                            type="textarea"
                            label="Substâncias ingeridas"
                            v-model="form.substancias_pica"
                            help="Descrever quais são as substâncias ingeridas"
                            rows="2"
                            validation="required_if:form.pica,true"
                        />
                    </div>
                    <div v-if="form.neuropata">
                        <FormKit
                            type="radio"
                            label="Apresenta vômitos com facilidade?"
                            v-model="form.vomito"
                            :options="[
                                { label: 'Sim', value: true },
                                { label: 'Não', value: false },
                            ]"
                        />

                        <div v-show="form.vomito">
                            <FormKit
                                type="number"
                                label="Número de vezes que vomita ao dia"
                                v-model="form.freq_vomito_neuropata"
                                min="0"
                                validation="required_if:form.vomito,true|number|min:0"
                            />

                            <FormKit
                                type="text"
                                label="Período do dia em que apresenta vômito"
                                v-model="form.periodo_dia_vomito_neuropata"
                                validation="required_if:form.vomito,true"
                            />
                        </div>

                        <FormKit
                            type="radio"
                            label="Apresenta infecção de repetição?"
                            v-model="form.infeccao_repeticao"
                            :options="[
                                { label: 'Sim', value: true },
                                { label: 'Não', value: false },
                            ]"
                        />

                        <FormKit
                            type="radio"
                            label="Infecções de vias aéreas superiores"
                            v-model="form.infeccoes_vias_aereas"
                            :options="[
                                { label: 'Sim', value: true },
                                { label: 'Não', value: false },
                            ]"
                        />

                        <FormKit
                            type="radio"
                            label="Otites"
                            v-model="form.oitites"
                            :options="[
                                { label: 'Sim', value: true },
                                { label: 'Não', value: false },
                            ]"
                        />

                        <FormKit
                            type="radio"
                            label="Sinusopatia"
                            v-model="form.sinusopatia"
                            :options="[
                                { label: 'Sim', value: true },
                                { label: 'Não', value: false },
                            ]"
                        />

                        <FormKit
                            type="radio"
                            label="Broncoespasmo"
                            v-model="form.broncoespasmo"
                            :options="[
                                { label: 'Sim', value: true },
                                { label: 'Não', value: false },
                            ]"
                        />

                        <FormKit
                            type="radio"
                            label="Broncopneumopatias"
                            v-model="form.broncopneumopatias"
                            :options="[
                                { label: 'Sim', value: true },
                                { label: 'Não', value: false },
                            ]"
                        />

                        <FormKit
                            type="radio"
                            label="Insuficiência respiratória"
                            v-model="form.insuficiencia_respiratoria"
                            :options="[
                                { label: 'Sim', value: true },
                                { label: 'Não', value: false },
                            ]"
                        />

                        <FormKit
                            type="radio"
                            label="Dor torácica"
                            v-model="form.dor_toracica"
                            :options="[
                                { label: 'Sim', value: true },
                                { label: 'Não', value: false },
                            ]"
                        />

                        <FormKit
                            type="radio"
                            label="Apneia durante à noite?"
                            v-model="form.apneia"
                            :options="[
                                { label: 'Sim', value: true },
                                { label: 'Não', value: false },
                            ]"
                        />
                    </div>
                </FormKit>

                <FormKit
                    type="step"
                    name="funcaointestinal"
                    label="Fc. intestinal"
                >
                    <FormKit
                        type="radio"
                        label="Sintomas digestivos"
                        v-model="form.sintomas_digestivos"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />
                    <FormKit
                        type="radio"
                        label="Função Intestinal"
                        v-model="form.funcao_intestinal"
                        :options="
                            ['Normal', 'Constipação'].map((t) => ({
                                value: t,
                                label: t,
                            }))
                        "
                    />
                    <FormKit
                        type="textarea"
                        label="Número de vezes (função intestinal)"
                        v-model="form.vezes_aodia_fcintestinal"
                        validation="optional"
                        help="Vezes ao dia ou na semana"
                    />

                    <FormKit
                        type="radio"
                        label="Diarréia"
                        v-model="form.diarreia"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />
                    <FormKit
                        type="radio"
                        label="Ingestão Hídrica"
                        v-model="form.ingestao_hidrica"
                        :options="[
                            { value: '< 150', label: '< 150 mL' },
                            {
                                value: '>= 150 < 500',
                                label: '≥ 150 a < 500 mL',
                            },
                            {
                                value: '>= 500 < 1000',
                                label: '≥ 500 a < 1.000 mL',
                            },
                            {
                                value: '>= 1000  < 2000',
                                label: '≥ 1.000 < 2.000 mL',
                            },
                            { value: '>= 2000', label: '≥ 2000 mL' },
                        ]"
                    />
                    <FormKit
                        type="textarea"
                        label="Diurese"
                        v-model="form.diurese"
                        validation="optional"
                        rows="2"
                        help="Informações sobre a diurese do paciente"
                    />
                </FormKit>
                <FormKit type="step" name="peso" label="Peso">
                    <FormKit
                        type="radio"
                        label="Houve ganho de peso?"
                        v-model="form.houve_ganho_peso"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />
                    <div class="fields" v-show="form.houve_ganho_peso == true">
                        <label>Quanto peso ganhou?</label>
                        <input type="text" v-model="form.peso_ganho" />
                    </div>
                    <FormKit
                        v-show="form.houve_ganho_peso"
                        type="text"
                        label="Quanto peso ganhou?"
                        v-model="form.peso_ganho"
                        validation="required_if:form.houve_ganho_peso,true"
                        help="Peso ganho em kg"
                    />

                    <FormKit
                        type="radio"
                        label="Houve perda de peso?"
                        v-model="form.houve_perda_peso"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />
                    <FormKit
                        v-show="form.houve_perda_peso"
                        type="text"
                        label="Quanto peso perdeu?"
                        v-model="form.peso_perdido"
                        validation="required_if:form.houve_perda_peso,true"
                        help="Peso perdido em kg"
                    />

                    <FormKit
                        type="radio"
                        label="Já fez tratamento para perder ou ganhar
                            peso?"
                        v-model="form.tratamento_perda_ganho_peso"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />
                    <FormKit
                        v-show="form.tratamento_perda_ganho_peso"
                        type="textarea"
                        label="Qual tratamento?"
                        v-model="form.tipo_tratamento_perda_ganho_peso"
                        rows="2"
                        validation="required_if:form.tratamento_perda_ganho_peso,true"
                        help="Descrever qual e como foi o tratamento realizado"
                    />
                    <FormKit
                        type="radio"
                        label="Houve acompanhamento profissional?"
                        v-model="form.houve_acompanhamento"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />
                    <FormKit
                        v-show="form.houve_acompanhamento"
                        type="text"
                        label="De qual profissional?"
                        v-model="form.profissional_tratamento"
                        validation="required_if:form.profissional_tratamento,true"
                        help="Exemplo: médico, nutricionista, personal trainer.."
                    />
                </FormKit>
                <FormKit
                    type="step"
                    name="adolescente"
                    label="Adolescente"
                    v-if="grupo_etario == 'Adolescente'"
                >
                    <FormKit
                        type="checkbox"
                        label="Estadiamento Puberal"
                        v-model="form.estadiamento_puberal"
                        help="Selecione uma opção"
                        :options="getEstadiamentoOptions(genero)"
                        validation="optional|max:1"
                    />

                    <div v-if="genero == 'Feminino'">
                        <FormKit
                            type="text"
                            label="Idade da menarca"
                            v-model="form.idade_inicio_ciclo_menstrual"
                            validation="optional"
                            help="Idade em que iniciou o ciclo menstrual"
                        />
                        <FormKit
                            type="text"
                            label="Tempo da menarca"
                            v-model="form.tempo_menarca"
                            validation="optional"
                            help="Tempo desde a menarca"
                        />
                        <FormKit
                            type="radio"
                            label="Problemas associados a menarca"
                            v-model="form.problemas_associados_menarca"
                            :options="[
                                { label: 'Sim', value: true },
                                { label: 'Não', value: false },
                            ]"
                        />
                        <FormKit
                            v-show="form.problemas_associados_menarca"
                            type="textarea"
                            rows="2"
                            label="Descrever os problemas"
                            v-model="form.tipo_problemas_associados_menarca"
                            validation="required_if:form.problemas_associados_menarca,true"
                            help="Descrever o(s) tipo(s) de problema(s) associado(s)"
                        />
                        <FormKit
                            type="radio"
                            label="Alteração de humor no período de menstruação"
                            v-model="form.alteracao_humor_periodo_menstrual"
                            :options="[
                                { label: 'Sim', value: true },
                                { label: 'Não', value: false },
                            ]"
                        />
                        <FormKit
                            v-show="form.alteracao_humor_periodo_menstrual"
                            type="textarea"
                            rows="2"
                            label="Descrever alterações"
                            v-model="
                                form.tipo_alteracao_humor_periodo_menstrual
                            "
                            validation="required_if:form.problemas_associados_menarca,true"
                            help="Descrever alterações de humor durante o período menstrual"
                        />
                    </div>
                </FormKit>
                <FormKit
                    type="step"
                    name="pediatria"
                    label="Pediatria"
                    v-if="
                        grupo_etario == 'Recém-nascido' ||
                        grupo_etario == 'Criança'
                    "
                >
                    <FormKit
                        type="text"
                        label="Idade Gestacional"
                        v-model="form.idade_gestacional"
                        validation="optional"
                    />

                    <FormKit
                        type="text"
                        label="Peso ao nascer (gramas)"
                        v-model="form.peso_nascimento"
                        validation="optional"
                        help="Informe o peso em gramas"
                    />

                    <FormKit
                        type="text"
                        label="Estatura ao nascer (cm)"
                        v-model="form.estatura_nascimento"
                        validation="optional"
                        help="Informe a estatura em centímetros"
                    />

                    <FormKit
                        type="text"
                        label="Tipo de parto"
                        v-model="form.tipo_parto"
                        validation="optional"
                    />

                    <FormKit
                        type="textarea"
                        label="Intercorrências no nascimento"
                        v-model="form.intercorrencias_nascimento"
                        help="Descrever intercorrências no nascimento"
                        rows="2"
                        validation="optional"
                    />

                    <FormKit
                        type="textarea"
                        label="Outras intercorrências"
                        v-model="form.outras_intercorrencias"
                        help="Descrever demais intercorrências"
                        rows="2"
                        validation="optional"
                    />
                </FormKit>
                <FormKit type="step" name="atividadefisica" label="Atv. Física">
                    <FormKit
                        type="radio"
                        label="Hábitos de atividade física"
                        v-model="form.habitos_atv_fisica"
                        :options="[
                            { value: 'Sedentário', label: 'Sedentário' },
                            {
                                value: '1-2 dias',
                                label: '1 a 2 dias por semana',
                            },
                            {
                                value: '3-4 dias',
                                label: '3 a 4 dias por semana',
                            },
                            {
                                value: '5+ dias',
                                label: '5 ou mais dias por semana',
                            },
                        ]"
                    />
                    <div
                        v-show="
                            form.habitos_atv_fisica != 'Sedentário' &&
                            form.habitos_atv_fisica != null
                        "
                    >
                        <FormKit
                            type="textarea"
                            label="Tipo de atividade física"
                            v-model="form.tipo_atv_fisica"
                            rows="2"
                            validation="optional"
                            help="Descreva os tipos de atividades físicas praticadas"
                        />

                        <FormKit
                            type="textarea"
                            label="Duração da atividade física"
                            v-model="form.duracao_atv_fisica"
                            rows="2"
                            validation="optional"
                            help="Informe a frequência e duração das atividades"
                        />
                        <FormKit
                            type="radio"
                            label="Atleta"
                            v-model="form.atleta"
                            :options="[
                                { label: 'Sim', value: true },
                                { label: 'Não', value: false },
                            ]"
                        />
                    </div>
                </FormKit>
                <FormKit
                    type="step"
                    name="alimentacao"
                    label="Alimentação"
                    v-if="form.neuropata"
                >
                    <FormKit
                        type="radio"
                        label="O paciente é capaz de se alimentar sozinho?"
                        v-model="form.se_alimenta_sozinho"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />

                    <FormKit
                        type="radio"
                        label="O paciente consegue mastigar?"
                        v-model="form.consegue_mastigar"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />

                    <FormKit
                        type="radio"
                        label="A língua tem hipertonicidade?"
                        v-model="form.hipertonicidade_lingua"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />

                    <FormKit
                        type="radio"
                        label="A língua tem movimento temporo-mandibular?"
                        v-model="form.movimento_temporo_mandibular_lingua"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />

                    <FormKit
                        type="radio"
                        label="Apresenta sucção?"
                        v-model="form.succao"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />

                    <FormKit
                        type="radio"
                        label="Saliva muito?"
                        v-model="form.saliva"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />

                    <FormKit
                        type="radio"
                        label="Tosse durante a refeição?"
                        v-model="form.tosse_durante_refeicao"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />

                    <FormKit
                        type="radio"
                        label="Engasga durante a refeição?"
                        v-model="form.engasgo_durante_refeicao"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />

                    <FormKit
                        type="radio"
                        label="Abre a boca ao redor da colher?"
                        v-model="form.abre_boca_redor_colher"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />

                    <FormKit
                        type="radio"
                        label="Fecha a boca ao redor da colher?"
                        v-model="form.fecha_boca_redor_colher"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />
                    <FormKit
                        type="text"
                        label="Posição em que se alimenta"
                        v-model="form.posicao_alimentacao"
                        validation="optional"
                        help="Posição habitual durante as refeições"
                    />

                    <FormKit
                        type="text"
                        label="Posição em que dorme"
                        v-model="form.posicao_dormir"
                        validation="optional"
                        help="Posição habitual durante o sono"
                    />
                    <FormKit
                        type="radio"
                        label="Consistência dos alimentos ingeridos"
                        v-model="form.consistencia_alimentos"
                        :options="
                            ['Líquido', 'Pastoso', 'Sólido'].map((t) => ({
                                value: t,
                                label: t,
                            }))
                        "
                    />
                </FormKit>
                <FormKit
                    type="step"
                    name="hábitos Alimentares"
                    label="Habitos Alimentares"
                >
                    <FormKit
                        type="text"
                        label="Mastigação/Deglutição"
                        v-model="form.mastigacao_degluticao"
                        help="Dificuldades, características ou observações sobre mastigação/deglutição"
                        validation="optional"
                    />
                    <div
                        v-if="
                            grupo_etario == 'Criança' ||
                            grupo_etario == 'Adolescente' ||
                            grupo_etario == 'Recém-nascido' ||
                            form.gestante
                        "
                    >
                        <FormKit
                            type="textarea"
                            label="Antecedentes religiosos, étnicos ou tabus com relação à dieta"
                            v-model="form.crencas_etnicas_religiosas_tabus"
                            rows="2"
                            help="Crenças, restrições ou preferências alimentares de natureza religiosa ou étnica"
                            validation="optional"
                        />
                    </div>

                    <FormKit
                        type="radio"
                        v-if="
                            grupo_etario == 'Criança' ||
                            grupo_etario == 'Adolescente'
                        "
                        label="Você acha que seu filho come o suficiente? "
                        v-model="form.alimentacao_e_suficiente"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />

                    <FormKit
                        type="textarea"
                        label="Preferências Alimentares"
                        v-model="form.preferencias_alimentares"
                        rows="2"
                        help="Alimentos preferidos"
                        validation="optional"
                    />

                    <FormKit
                        type="textarea"
                        label="Rejeições Alimentares"
                        v-model="form.rejeicoes"
                        rows="2"
                        help="Alimentos que o paciente evita"
                        validation="optional"
                    />

                    <FormKit
                        type="textarea"
                        label="Intolerâncias ou Alergias"
                        v-model="form.intolerancias_alergias"
                        rows="2"
                        help="Descrever quais alimentos causam intolerâncias ou alergias"
                        validation="optional"
                    />

                    <FormKit
                        type="textarea"
                        label="Mudança recente no hábito alimentar?"
                        v-model="form.mudanca_recente"
                        rows="2"
                        help="Descreva a mudança e quando ocorreu"
                        validation="optional"
                    />
                    <FormKit
                        type="radio"
                        label="Come em frente a eletrônicos?"
                        v-model="form.come_frente_eletronicos"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />
                    <FormKit
                        type="radio"
                        label="Come com a família?"
                        v-model="form.come_com_familia"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />

                    <FormKit
                        type="text"
                        label="Quem prepara as refeições"
                        v-model="form.quem_prepara"
                        validation="optional"
                    />

                    <FormKit
                        type="radio"
                        label="Sente apetite nas refeições?"
                        v-model="form.sente_apetite"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />

                    <FormKit
                        type="radio"
                        label="Tem apetite nos intervalos?"
                        v-model="form.tem_apetite_intervalos"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />

                    <FormKit
                        type="text"
                        label="Qual horário sente mais fome?"
                        v-model="form.qual_horario_sente_mais_fome"
                        validation="optional"
                    />

                    <FormKit
                        type="radio"
                        label="Emoções influenciam nas escolhas alimentares?"
                        v-model="form.emocoes_influenciam_escolhas_alimentares"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                    />
                </FormKit>
                <FormKit
                    type="step"
                    name="historiaalimentar"
                    label="História Alimentar"
                    v-if="
                        grupo_etario == 'Criança' ||
                        grupo_etario == 'Recém-nascido'
                    "
                >
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <FormKit
                            type="text"
                            label="Leite materno - Data de início/interrupção"
                            v-model="form.leite_materno_data_inicio_fim"
                            placeholder="Ex: 01/2022 a 06/2022"
                            help="Informe o período de aleitamento materno"
                        />

                        <FormKit
                            type="text"
                            label="Aceitação do leite materno"
                            v-model="form.aceitacao_leite_materno"
                            placeholder="Ex: Boa aceitação"
                            help="Descreva como foi a aceitação"
                        />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <FormKit
                            type="text"
                            label="Leite artificial - Data de início/interrupção"
                            v-model="form.leite_artificial_data_inicio_fim"
                            placeholder="Ex: 06/2022 a 12/2022"
                        />

                        <FormKit
                            type="text"
                            label="Tipo de leite artificial"
                            v-model="form.tipo_leite_artificial"
                            placeholder="Ex: Fórmula infantil 1"
                        />

                        <FormKit
                            type="text"
                            label="Aceitação do leite artificial"
                            v-model="form.aceitacao_leite_artificial"
                            placeholder="Ex: Aceitação regular"
                        />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <FormKit
                            type="text"
                            label="Chá/Água - Data de introdução"
                            v-model="form.cha_agua_data_inicio_fim"
                            placeholder="Ex: A partir de 06/2022"
                        />

                        <FormKit
                            type="text"
                            label="Aceitação de chá/água"
                            v-model="form.aceitacao_cha_agua"
                            placeholder="Ex: Boa aceitação"
                        />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <FormKit
                            type="text"
                            label="Suco de fruta - Data de introdução"
                            v-model="form.suco_data_inicio_fim"
                            placeholder="Ex: Introduzido em 08/2022"
                        />

                        <FormKit
                            type="text"
                            label="Aceitação de sucos"
                            v-model="form.aceitacao_suco"
                            placeholder="Ex: Prefere sucos cítricos"
                        />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <FormKit
                            type="text"
                            label="Papa de fruta - Data de introdução"
                            v-model="form.papa_fruta_data_inicio_fim"
                            placeholder="Ex: 07/2022"
                        />

                        <FormKit
                            type="text"
                            label="Tipo de papa de fruta"
                            v-model="form.tipo_papa_fruta"
                            placeholder="Ex: Maçã com banana"
                        />

                        <FormKit
                            type="text"
                            label="Consistência"
                            v-model="form.consistencia_papa_fruta"
                            placeholder="Ex: Purê grosso"
                        />

                        <FormKit
                            type="text"
                            label="Aceitação"
                            v-model="form.aceitacao_papa_fruta"
                            placeholder="Ex: Aceitação inicial difícil"
                        />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <FormKit
                            type="text"
                            label="Papa salgada - Data de introdução"
                            v-model="form.papa_salgada_data_inicio_fim"
                            placeholder="Ex: 09/2022"
                        />

                        <FormKit
                            type="text"
                            label="Tipo de papa salgada"
                            v-model="form.tipo_papa_salgada"
                            placeholder="Ex: Legumes com frango"
                        />

                        <FormKit
                            type="text"
                            label="Consistência"
                            v-model="form.consistencia_papa_salgada"
                            placeholder="Ex: Amassada com garfo"
                        />

                        <FormKit
                            type="text"
                            label="Aceitação"
                            v-model="form.aceitacao_papa_salgada"
                            placeholder="Ex: Boa aceitação"
                        />
                    </div>
                </FormKit>

                <FormKit
                    type="step"
                    name="freqalimentar"
                    label="Freq. Alimentar"
                >
                    <FormKit
                        type="number"
                        min="1"
                        max="10"
                        label="Quantidade de latas de óleo ao mês"
                        v-model="form.qtd_latas_oleo_mes"
                    />
                    <div v-for="alimento in alimentos" :key="alimento.value">
                        <FreqAlimentar
                            :nome="alimento.label"
                            :qtd="form[`qtd_${alimento.value}`]"
                            :frequencia="form[`frequencia_${alimento.value}`]"
                            @update:qtd="
                                (val) => (form[`qtd_${alimento.value}`] = val)
                            "
                            @update:frequencia="
                                (val) =>
                                    (form[`frequencia_${alimento.value}`] = val)
                            "
                        ></FreqAlimentar>
                    </div>
                </FormKit>
                <FormKit
                    type="step"
                    name="registroalimentar"
                    label="Registro alimentar"
                >
                    <RegistroAlimentar v-model="form"></RegistroAlimentar>
                </FormKit>
                <FormKit type="step" name="obs. adicionais" label="Observações">
                    <FormKit
                        type="textarea"
                        label="Observações adicionais"
                        v-model="form.obs_adicionais"
                        validation="optional"
                        rows="2"
                        help="Outras informações importantes"
                    />
                    <template #stepNext
                        ><FormKit type="submit" label="Finalizar"></FormKit>
                    </template>
                </FormKit>
            </FormKit>
        </FormKit>
    </MainLayout>
</template>

<script setup>
import RegistroAlimentar from "@/Components/RegistroAlimentar.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import FreqAlimentar from "./Components/FreqAlimentar.vue";

const page = usePage();
const id_consulta = page.props.id_consulta;
const grupo_etario = page.props.grupo_etario;
const genero = page.props.genero;

const form = useForm({
    fk_id_consultas: id_consulta,
    gestante: null,
    neuropata: null,
    atleta: null,
    escolaridade: null,
    profissao: null,
    renda_familiar_ibge: null,
    num_pessoas_nucleo_familiar: null,
    motivo_procura: null,
    turno_escolar: null,
    profissao_responsavel: null,
    escolaridade_responsavel: null,
    primeira_consulta: null,
    dm: null,
    has: null,
    colesterol_elevado: null,
    tg_elevado: null,
    outras_patologias: null,
    antecedentes_familiares: null,
    medicamentos: null,
    tabagismo: null,
    qtd_cigarros: null,
    houve_ganho_peso: null,
    peso_ganho: null,
    houve_perda_peso: null,
    peso_perdido: null,
    tratamento_perda_ganho_peso: null,
    tipo_tratamento_perda_ganho_peso: null,
    profissional_tratamento: null,
    mastigacao_degluticao: null,
    protese_dentaria: null,
    sintomas_digestivos: null,
    funcao_intestinal: null,
    vezes_aodia_fcintestinal: null,
    diarreia: null,
    diurese: null,
    ingestao_hidrica: null,
    habitos_atv_fisica: null,
    duracao_atv_fisica: null,
    tipo_atv_fisica: null,
    alimentacao_e_suficiente: null,
    local_refeicoes: null,
    come_frente_eletronicos: null,
    come_com_familia: null,
    quem_prepara: null,
    sente_apetite: null,
    tem_apetite_intervalos: null,
    qual_horario_sente_mais_fome: null,
    mudanca_recente: null,
    preferencias_alimentares: null,
    rejeicoes: null,
    intolerancias_alergias: null,
    emocoes_influenciam_escolhas_alimentares: null,
    crencas_etnicas_religiosas_tabus: null,
    leite_materno_data_inicio_fim: null,
    aceitacao_leite_materno: null,
    leite_artificial_data_inicio_fim: null,
    tipo_leite_artificial: null,
    aceitacao_leite_artificial: null,
    cha_agua_data_inicio_fim: null,
    aceitacao_cha_agua: null,
    suco_data_inicio_fim: null,
    aceitacao_suco: null,
    papa_fruta_data_inicio_fim: null,
    tipo_papa_fruta: null,
    consistencia_papa_fruta: null,
    aceitacao_papa_fruta: null,
    papa_salgada_data_inicio_fim: null,
    tipo_papa_salgada: null,
    consistencia_papa_salgada: null,
    aceitacao_papa_salgada: null,
    qtd_latas_oleo_mes: null,
    qtd_leite_derivados: null,
    frequencia_leite_derivados: null,
    qtd_carnes: null,
    frequencia_carnes: null,
    qtd_ovos: null,
    frequencia_ovos: null,
    qtd_leguminosas: null,
    frequencia_leguminosas: null,
    qtd_cereais: null,
    frequencia_cereais: null,
    qtd_tuberculos_raizes: null,
    frequencia_tuberculos_raizes: null,
    qtd_frutas: null,
    frequencia_frutas: null,
    qtd_legumes: null,
    frequencia_legumes: null,
    qtd_verduras: null,
    frequencia_verduras: null,
    qtd_oleaginosas: null,
    frequencia_oleaginosas: null,
    qtd_guloseimas: null,
    frequencia_guloseimas: null,
    qtd_embutidos: null,
    frequencia_embutidos: null,
    qtd_frituras: null,
    frequencia_frituras: null,
    qtd_processados: null,
    frequencia_processados: null,
    qtd_ultraprocessados: null,
    frequencia_ultraprocessados: null,
    qtd_bebidas_alcoolicas: null,
    frequencia_bebidas_alcoolicas: null,
    qtd_refrigerantes: null,
    frequencia_refrigerantes: null,
    qtd_sucos_industrializados: null,
    frequencia_sucos_industrializados: null,
    qtd_sucos_naturais: null,
    frequencia_sucos_naturais: null,
    tipo_registro: null,
    cafe_manha: null,
    lanche_manha: null,
    almoco: null,
    lanche_tarde_I: null,
    lanche_tarde_II: null,
    jantar: null,
    ceia: null,
    outros_registro_alimentar: null,
    estadiamento_puberal: null,
    idade_inicio_ciclo_menstrual: null,
    tempo_menarca: null,
    problemas_associados_menarca: null,
    tipo_problemas_associados_menarca: null,
    alteracao_humor_periodo_menstrual: null,
    tipo_alteracao_humor_periodo_menstrual: null,
    peso_nascimento: null,
    estatura_nascimento: null,
    intercorrencias_nascimento: null,
    outras_intercorrencias: null,
    tipo_parto: null,
    idade_gestacional: null,
    qtd_gestacoes: null,
    abortos: null,
    morte_perinatal: null,
    morte_perinatal_descricao: null,
    intervalo_interpartal: null,
    num_filhos_idade: null,
    historico_bebe_peso: null,
    historico_hipertensao: null,
    paridade: null,
    data_ultima_menstruacao: null,
    ultima_medida_pa: null,
    leite_materno: null,
    condicoes_seios: null,
    suplementacao: null,
    alteracao_humor: null,
    edema: null,
    pica: null,
    substancias_pica: null,
    anemia: null,
    descricao_epoca_anemia: null,
    azia: null,
    frequencia_azia: null,
    nauseas: null,
    frequencia_nauseas: null,
    vomito: null,
    frequencia_vomito: null,
    se_alimenta_sozinho: null,
    hipertonicidade_lingua: null,
    movimento_temporo_mandibular_lingua: null,
    succao: null,
    tosse_durante_refeicao: null,
    posicao_alimentacao: null,
    posicao_dormir: null,
    consistencia_alimentos: null,
    infeccao_repeticao: null,
    infeccoes_vias_aereas: null,
    oitites: null,
    sinusopatia: null,
    broncoespasmo: null,
    apneia: null,
    saliva: null,
    abre_boca_redor_colher: null,
    broncopneumopatias: null,
    insuficiencia_respiratoria: null,
    dor_toracica: null,
    consegue_mastigar: null,
    engasgo_durante_refeicao: null,
    fecha_boca_redor_colher: null,
    obs_adicionais: null,
    freq_vomito_neuropata: null,
    periodo_dia_vomito_neuropata: null,
    houve_acompanhamento: null,
    uso_suplementos: null,
});

const alimentos = [
    { label: "Leite e derivados", value: "leite_derivados" },
    { label: "Carnes", value: "carnes" },
    { label: "Ovos", value: "ovos" },
    { label: "Leguminosas", value: "leguminosas" },
    { label: "Cereais", value: "cereais" },
    { label: "Tubérculos e raízes", value: "tuberculos_raizes" },
    { label: "Frutas", value: "frutas" },
    { label: "Legumes", value: "legumes" },
    { label: "Verduras", value: "verduras" },
    { label: "Oleaginosas", value: "oleaginosas" },
    { label: "Guloseimas", value: "guloseimas" },
    { label: "Embutidos", value: "embutidos" },
    { label: "Frituras", value: "frituras" },
    { label: "Processados", value: "processados" },
    { label: "Ultraprocessados", value: "ultraprocessados" },
    { label: "Bebidas alcoólicas", value: "bebidas_alcoolicas" },
    { label: "Refrigerantes", value: "refrigerantes" },
    { label: "Sucos industrializados", value: "sucos_industrializados" },
    { label: "Sucos naturais", value: "sucos_naturais" },
];

const getEstadiamentoOptions = (gender) => {
    const baseOptions = [
        { value: "", label: "Selecione" },
        { value: "P1", label: "P1" },
        { value: "P2", label: "P2" },
        { value: "P3", label: "P3" },
        { value: "P4", label: "P4" },
        { value: "P5", label: "P5" },
        { value: "P6", label: "P6" },
    ];

    if (gender === "Masculino") {
        baseOptions.push(
            { value: "G1", label: "G1" },
            { value: "G2", label: "G2" },
            { value: "G3", label: "G3" },
            { value: "G4", label: "G4" },
            { value: "G5", label: "G5" }
        );
    } else if (gender === "Feminino") {
        baseOptions.push(
            { value: "M1", label: "M1" },
            { value: "M2", label: "M2" },
            { value: "M3", label: "M3" },
            { value: "M4", label: "M4" },
            { value: "M5", label: "M5" }
        );
    }

    return baseOptions;
};
const create = () => {
    form.post("/consulta/atendimento/anamnese/", {
        onError: (errors) => {
            console.error(errors);
        },
        onSuccess: () => {
            console.log("Formulário enviado com sucesso!");
        },
    });
};
</script>
