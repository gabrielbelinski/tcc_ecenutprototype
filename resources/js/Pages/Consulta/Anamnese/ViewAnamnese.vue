<template>
    <MainLayout>
        <FormKit type="multi-step" tab-style="progress">
            <FormKit type="step" name="paciente" label="Paciente">
                <FormKit
                    type="radio"
                    label="Primeira consulta?"
                    v-model="page.props.anamnese.primeira_consulta"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />

                <div
                    v-if="
                        page.props.paciente.grupo_etario == 'Adulto' ||
                        page.props.paciente.grupo_etario == 'Idoso'
                    "
                >
                    <FormKit
                        type="radio"
                        label="Escolaridade"
                        v-model="page.props.paciente.escolaridade"
                        :options="
                            [
                                'Não alfabetizado',
                                'Ensino Fundamental',
                                'Ensino Médio',
                                'Ensino Superior',
                                'Pós-Graduação',
                            ].map((t) => ({ value: t, label: t }))
                        "
                        disabled
                    />
                </div>
                <div v-else>
                    <div
                        v-if="
                            page.props.paciente.grupo_etario != 'Recém-nascido'
                        "
                    >
                        <FormKit
                            type="text"
                            label="Escolaridade"
                            v-model="page.props.paciente.escolaridade"
                            help="Descrever o ano/série"
                            disabled
                        />
                    </div>

                    <FormKit
                        type="radio"
                        label="Turno em que estuda"
                        v-model="page.props.paciente.turno_escolar"
                        :options="
                            [
                                'Manhã',
                                'Tarde',
                                'Noite',
                                'Integral',
                                'Não frequenta a escola',
                            ].map((t) => ({ value: t, label: t }))
                        "
                        disabled
                    />

                    <FormKit
                        type="radio"
                        label="Escolaridade do responsável"
                        v-model="page.props.paciente.escolaridade_responsavel"
                        :options="
                            [
                                'Não alfabetizado',
                                'Ensino Fundamental',
                                'Ensino Médio',
                                'Ensino Superior',
                                'Pós-Graduação',
                            ].map((t) => ({ value: t, label: t }))
                        "
                        disabled
                    />

                    <FormKit
                        type="text"
                        label="Profissão do responsável"
                        v-model="page.props.paciente.profissao_responsavel"
                        help="Profissão/ocupação"
                        disabled
                    />
                </div>

                <FormKit
                    v-if="
                        page.props.paciente.grupo_etario != 'Recém-nascido' ||
                        page.props.paciente.grupo_etario != 'Criança'
                    "
                    type="text"
                    label="Profissão"
                    v-model="page.props.anamnese.profissao"
                    help="Profissão/ocupação"
                    disabled
                />

                <FormKit
                    type="radio"
                    label="Renda Familiar (IBGE)"
                    v-model="page.props.paciente.renda_familiar_ibge"
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
                        {
                            value: 'Não sabe',
                            label: 'Não sabe informar',
                        },
                    ]"
                    disabled
                />

                <FormKit
                    type="number"
                    min="1"
                    label="Número de pessoas no núcleo familiar"
                    v-model="page.props.paciente.num_pessoas_nucleo_familiar"
                    help="Quantas pessoas vivem na residência?"
                    disabled
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
                    v-model="page.props.paciente.motivo_procura"
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
                    disabled
                />
                <FormKit
                    type="radio"
                    label="Portador de condição neurológica?"
                    v-model="page.props.paciente.neuropata"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />
                <FormKit
                    type="radio"
                    v-if="
                        page.props.paciente.genero != 'Masculino' &&
                        (page.props.paciente.grupo_etario != 'Criança' ||
                            page.props.paciente.grupo_etario !=
                                'Recém-nascido' ||
                            page.props.paciente.grupo_etario != 'Idoso')
                    "
                    label="Paciente está gestante?"
                    v-model="page.props.paciente.gestante"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />
            </FormKit>
            <FormKit
                type="step"
                name="gestante"
                label="Gestação"
                v-if="page.props.paciente.gestante == true"
            >
                <FormKit
                    type="date"
                    label="Data da última menstruação"
                    v-model="page.props.anamnese.data_ultima_menstruacao"
                    help="Selecione a data da última menstruação"
                    disabled
                />
                <FormKit
                    type="number"
                    label="Idade gestacional atual (semanas)"
                    v-model="page.props.anamnese.idade_gestacional"
                    min="1"
                    max="42"
                    help="Informe a idade gestacional em semanas completas"
                    disabled
                />
                <FormKit
                    type="number"
                    label="Gestações"
                    v-model="page.props.anamnese.qtd_gestacoes"
                    min="0"
                    help="Número total de gestações, incluindo a atual"
                    disabled
                />
                <FormKit
                    type="number"
                    label="Paridade"
                    v-model="page.props.anamnese.paridade"
                    min="0"
                    help="Número de partos"
                    disabled
                />
                <FormKit
                    type="number"
                    label="Abortos"
                    v-model="page.props.anamnese.abortos"
                    min="0"
                    help="Número de abortos espontâneos ou induzidos"
                    disabled
                />
                <FormKit
                    type="radio"
                    label="Houve morte perinatal?"
                    v-model="page.props.anamnese.morte_perinatal"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />
                <FormKit
                    v-if="page.props.anamnese.morte_perinatal == true"
                    type="textarea"
                    label="Descrever a situação"
                    v-model="page.props.anamnese.morte_perinatal_descricao"
                    rows="2"
                    help="Descreva apenas se houver histórico de morte perinatal"
                    disabled
                />
                <FormKit
                    type="text"
                    label="Intervalo interpartal"
                    v-model="page.props.anamnese.intervalo_interpartal"
                    help="Tempo entre o último parto e esta gestação (ex: 2 anos)"
                    disabled
                />
                <FormKit
                    type="textarea"
                    label="Número de filhos e idade"
                    v-model="page.props.anamnese.num_filhos_idade"
                    rows="2"
                    :classes="{
                        input: 'resize-none',
                    }"
                    help="Ex: 2 filhos (5 anos e 2 anos)"
                    disabled
                />
                <FormKit
                    type="radio"
                    label="Histórico de bebê com peso menor que 2500g ou maior que
                        4kg"
                    v-model="page.props.anamnese.historico_bebe_peso"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />
                <FormKit
                    type="text"
                    label="Pressão arterial"
                    v-model="page.props.anamnese.ultima_medida_pa"
                    help="Registrar a data e o valor da última medição"
                    disabled
                />
            </FormKit>
            <FormKit type="step" name="históricoclinico" label="Hist. Clinico">
                <FormKit
                    type="radio"
                    label="Diabetes Mellitus (DM)"
                    v-model="page.props.anamnese.dm"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />
                <FormKit
                    type="radio"
                    label="Hipertensão Arterial Sistêmica (HAS)"
                    v-model="page.props.anamnese.has"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />
                <FormKit
                    type="radio"
                    label="Colesterol elevado"
                    v-model="page.props.anamnese.colesterol_elevado"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />
                <FormKit
                    type="radio"
                    label="Triglicerídeos (TG) elevado"
                    v-model="page.props.anamnese.tg_elevado"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />

                <FormKit
                    type="textarea"
                    label="Outros Diagnósticos"
                    v-model="page.props.anamnese.outras_patologias"
                    rows="2"
                    help="Descrever diagnóstico clínico não citado anteriormente"
                    disabled
                />

                <FormKit
                    type="textarea"
                    label="Antecedentes familiares"
                    v-model="page.props.anamnese.antecedentes_familiares"
                    rows="2"
                    help="Descrever antecedentes familiares"
                    disabled
                />

                <FormKit
                    type="textarea"
                    label="Medicamentos em uso"
                    v-model="page.props.anamnese.medicamentos"
                    rows="2"
                    help="Descrever o nome dos medicamentos"
                    disabled
                />
                <!-- Verificar se o paciente é adulto/idoso -->
                <div
                    v-if="
                        page.props.paciente.grupo_etario == 'Adulto' ||
                        page.props.paciente.grupo_etario == 'Idoso'
                    "
                >
                    <FormKit
                        type="radio"
                        label="Tabagismo"
                        v-model="page.props.anamnese.tabagismo"
                        :options="
                            ['Sim', 'Não', 'Ex-Tabagista'].map((t) => ({
                                value: t,
                                label: t,
                            }))
                        "
                        disabled
                    />

                    <FormKit
                        v-show="page.props.anamnese.tabagismo == 'Sim'"
                        type="number"
                        label="Quantidade de cigarros"
                        v-model="page.props.anamnese.qtd_cigarros"
                        min="0"
                        help="Quantidade de cigarros ao dia"
                        disabled
                    />

                    <FormKit
                        type="radio"
                        label="Paciente utiliza prótese dentária?"
                        v-model="page.props.anamnese.protese_dentaria"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                        disabled
                    />
                </div>
                <div v-if="page.props.anamnese.gestante">
                    <FormKit
                        type="radio"
                        label="Histórico de hipertensão nas outras gestações"
                        v-model="page.props.anamnese.historico_hipertensao"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                        disabled
                    />
                    <FormKit
                        type="radio"
                        label="Anemia"
                        v-model="page.props.anamnese.anemia"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                        disabled
                    />

                    <FormKit
                        v-show="page.props.anamnese.anemia"
                        type="textarea"
                        label="Descrição"
                        v-model="page.props.anamnese.descricao_epoca_anemia"
                        rows="2"
                        help="Caso tenha apresentado anemia anteriormente a gestação
                        descrever: (por exemplo: época? apresentou
                        hemorragias?)"
                        disabled
                    />

                    <FormKit
                        type="radio"
                        label="Edema"
                        v-model="page.props.anamnese.edema"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                        disabled
                    />

                    <FormKit
                        type="radio"
                        label="Faz uso de suplementos?"
                        v-model="page.props.anamnese.uso_suplementos"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                        disabled
                    />

                    <FormKit
                        v-show="page.props.anamnese.uso_suplementos"
                        type="textarea"
                        label="Descrever suplementação"
                        v-model="page.props.anamnese.suplementacao"
                        rows="2"
                        help="Descrever quais suplementos são utilizados"
                        disabled
                    />

                    <FormKit
                        type="textarea"
                        label="Cuidado com os seios"
                        v-model="page.props.anamnese.condicoes_seios"
                        help="Informe sobre cuidados, dores ou alterações nos seios"
                        rows="2"
                        disabled
                    />

                    <FormKit
                        type="textarea"
                        label="Informações sobre o leite materno"
                        v-model="page.props.anamnese.leite_materno"
                        help="Informe sobre quantidade, dificuldades ou características do leite materno"
                        rows="2"
                        disabled
                    />

                    <FormKit
                        type="radio"
                        label="Alterações de humor"
                        v-model="page.props.anamnese.alteracao_humor"
                        :options="
                            ['Sim', 'Não', 'Ás vezes'].map((t) => ({
                                value: t,
                                label: t,
                            }))
                        "
                        disabled
                    />

                    <FormKit
                        type="radio"
                        label="Azia"
                        v-model="page.props.anamnese.azia"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                        disabled
                    />

                    <FormKit
                        v-show="page.props.anamnese.azia"
                        type="textarea"
                        label="Frequência/Horários"
                        v-model="page.props.anamnese.frequencia_azia"
                        help="Com que frequência e em que horários sente azia"
                        rows="2"
                        disabled
                    />

                    <FormKit
                        type="radio"
                        label="Náuseas"
                        v-model="page.props.anamnese.nauseas"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                        disabled
                    />
                    <FormKit
                        v-show="page.props.anamnese.nauseas"
                        type="textarea"
                        label="Frequência/Horários"
                        v-model="page.props.anamnese.frequencia_nauseas"
                        help="Com que frequência e em que horários sente náuseas"
                        rows="2"
                        disabled
                    />

                    <FormKit
                        type="radio"
                        label="Vômitos"
                        v-model="page.props.anamnese.vomito"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                        disabled
                    />

                    <FormKit
                        v-show="page.props.anamnese.vomito"
                        type="textarea"
                        label="Frequência/Horários"
                        v-model="page.props.anamnese.frequencia_vomito"
                        help="Com que frequência e em que horários ocorre o vômito"
                        rows="2"
                        disabled
                    />
                    <FormKit
                        type="radio"
                        label="Pica"
                        v-model="page.props.anamnese.pica"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                        disabled
                    />
                    <FormKit
                        v-show="page.props.anamnese.pica"
                        type="textarea"
                        label="Substâncias ingeridas"
                        v-model="page.props.anamnese.substancias_pica"
                        help="Descrever quais são as substâncias ingeridas"
                        rows="2"
                        disabled
                    />
                </div>
                <div v-if="page.props.anamnese.neuropata">
                    <FormKit
                        type="radio"
                        label="Apresenta vômitos com facilidade?"
                        v-model="page.props.anamnese.vomito"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                        disabled
                    />

                    <div v-show="page.props.anamnese.vomito">
                        <FormKit
                            type="number"
                            label="Número de vezes que vomita ao dia"
                            v-model="page.props.anamnese.freq_vomito_neuropata"
                            min="0"
                            disabled
                        />

                        <FormKit
                            type="text"
                            label="Período do dia em que apresenta vômito"
                            v-model="
                                page.props.anamnese.periodo_dia_vomito_neuropata
                            "
                            disabled
                        />
                    </div>

                    <FormKit
                        type="radio"
                        label="Apresenta infecção de repetição?"
                        v-model="page.props.anamnese.infeccao_repeticao"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                        disabled
                    />

                    <FormKit
                        type="radio"
                        label="Infecções de vias aéreas superiores"
                        v-model="page.props.anamnese.infeccoes_vias_aereas"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                        disabled
                    />

                    <FormKit
                        type="radio"
                        label="Otites"
                        v-model="page.props.anamnese.oitites"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                        disabled
                    />

                    <FormKit
                        type="radio"
                        label="Sinusopatia"
                        v-model="page.props.anamnese.sinusopatia"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                        disabled
                    />

                    <FormKit
                        type="radio"
                        label="Broncoespasmo"
                        v-model="page.props.anamnese.broncoespasmo"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                        disabled
                    />

                    <FormKit
                        type="radio"
                        label="Broncopneumopatias"
                        v-model="page.props.anamnese.broncopneumopatias"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                        disabled
                    />

                    <FormKit
                        type="radio"
                        label="Insuficiência respiratória"
                        v-model="page.props.anamnese.insuficiencia_respiratoria"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                        disabled
                    />

                    <FormKit
                        type="radio"
                        label="Dor torácica"
                        v-model="page.props.anamnese.dor_toracica"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                        disabled
                    />

                    <FormKit
                        type="radio"
                        label="Apneia durante à noite?"
                        v-model="page.props.anamnese.apneia"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                        disabled
                    />
                </div>
            </FormKit>

            <FormKit type="step" name="funcaointestinal" label="Fc. intestinal">
                <FormKit
                    type="radio"
                    label="Sintomas digestivos"
                    v-model="page.props.anamnese.sintomas_digestivos"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />
                <FormKit
                    type="radio"
                    label="Função Intestinal"
                    v-model="page.props.anamnese.funcao_intestinal"
                    :options="
                        ['Normal', 'Constipação'].map((t) => ({
                            value: t,
                            label: t,
                        }))
                    "
                    disabled
                />
                <FormKit
                    type="textarea"
                    label="Número de vezes (função intestinal)"
                    v-model="page.props.anamnese.vezes_aodia_fcintestinal"
                    help="Vezes ao dia ou na semana"
                    disabled
                />

                <FormKit
                    type="radio"
                    label="Diarréia"
                    v-model="page.props.anamnese.diarreia"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />
                <FormKit
                    type="radio"
                    label="Ingestão Hídrica"
                    v-model="page.props.anamnese.ingestao_hidrica"
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
                    disabled
                />
                <FormKit
                    type="textarea"
                    label="Diurese"
                    v-model="page.props.anamnese.diurese"
                    rows="2"
                    help="Informações sobre a diurese do paciente"
                    disabled
                />
            </FormKit>
            <FormKit type="step" name="peso" label="Peso">
                <FormKit
                    type="radio"
                    label="Houve ganho de peso?"
                    v-model="page.props.anamnese.houve_ganho_peso"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />
                <div
                    class="fields"
                    v-show="page.props.anamnese.houve_ganho_peso == true"
                >
                    <label>Quanto peso ganhou?</label>
                    <input
                        type="text"
                        v-model="page.props.anamnese.peso_ganho"
                        disabled
                    />
                </div>
                <FormKit
                    v-show="page.props.anamnese.houve_ganho_peso"
                    type="text"
                    label="Quanto peso ganhou?"
                    v-model="page.props.anamnese.peso_ganho"
                    help="Peso ganho em kg"
                    disabled
                />

                <FormKit
                    type="radio"
                    label="Houve perda de peso?"
                    v-model="page.props.anamnese.houve_perda_peso"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />
                <FormKit
                    v-show="page.props.anamnese.houve_perda_peso"
                    type="text"
                    label="Quanto peso perdeu?"
                    v-model="page.props.anamnese.peso_perdido"
                    help="Peso perdido em kg"
                    disabled
                />

                <FormKit
                    type="radio"
                    label="Já fez tratamento para perder ou ganhar
                            peso?"
                    v-model="page.props.anamnese.tratamento_perda_ganho_peso"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />
                <FormKit
                    v-show="page.props.anamnese.tratamento_perda_ganho_peso"
                    type="textarea"
                    label="Qual tratamento?"
                    v-model="
                        page.props.anamnese.tipo_tratamento_perda_ganho_peso
                    "
                    rows="2"
                    help="Descrever qual e como foi o tratamento realizado"
                    disabled
                />
                <FormKit
                    type="radio"
                    label="Houve acompanhamento profissional?"
                    v-model="page.props.anamnese.houve_acompanhamento"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />
                <FormKit
                    v-show="page.props.anamnese.houve_acompanhamento"
                    type="text"
                    label="De qual profissional?"
                    v-model="page.props.anamnese.profissional_tratamento"
                    help="Exemplo: médico, nutricionista, personal trainer.."
                    disabled
                />
            </FormKit>
            <FormKit
                type="step"
                name="adolescente"
                label="Adolescente"
                v-if="page.props.paciente.grupo_etario == 'Adolescente'"
            >
                <FormKit
                    type="checkbox"
                    label="Estadiamento Puberal"
                    v-model="page.props.anamnese.estadiamento_puberal"
                    help="Selecione uma opção"
                    :options="
                        getEstadiamentoOptions(page.props.anamnese.genero)
                    "
                    disabled
                />

                <div v-if="page.props.anamnese.genero == 'Feminino'">
                    <FormKit
                        type="text"
                        label="Idade da menarca"
                        v-model="
                            page.props.anamnese.idade_inicio_ciclo_menstrual
                        "
                        help="Idade em que iniciou o ciclo menstrual"
                        disabled
                    />
                    <FormKit
                        type="text"
                        label="Tempo da menarca"
                        v-model="page.props.anamnese.tempo_menarca"
                        help="Tempo desde a menarca"
                        disabled
                    />
                    <FormKit
                        type="radio"
                        label="Problemas associados a menarca"
                        v-model="
                            page.props.anamnese.problemas_associados_menarca
                        "
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                        disabled
                    />
                    <FormKit
                        v-show="
                            page.props.anamnese.problemas_associados_menarca
                        "
                        type="textarea"
                        rows="2"
                        label="Descrever os problemas"
                        v-model="
                            page.props.anamnese
                                .tipo_problemas_associados_menarca
                        "
                        help="Descrever o(s) tipo(s) de problema(s) associado(s)"
                        disabled
                    />
                    <FormKit
                        type="radio"
                        label="Alteração de humor no período de menstruação"
                        v-model="
                            page.props.anamnese
                                .alteracao_humor_periodo_menstrual
                        "
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                        disabled
                    />
                    <FormKit
                        v-show="
                            page.props.anamnese
                                .alteracao_humor_periodo_menstrual
                        "
                        type="textarea"
                        rows="2"
                        label="Descrever alterações"
                        v-model="
                            page.props.anamnese
                                .tipo_alteracao_humor_periodo_menstrual
                        "
                        help="Descrever alterações de humor durante o período menstrual"
                        disabled
                    />
                </div>
            </FormKit>
            <FormKit
                type="step"
                name="pediatria"
                label="Pediatria"
                v-if="
                    page.props.paciente.grupo_etario == 'Recém-nascido' ||
                    page.props.paciente.grupo_etario == 'Criança'
                "
            >
                <FormKit
                    type="text"
                    label="Idade Gestacional"
                    v-model="page.props.anamnese.idade_gestacional"
                    disabled
                />

                <FormKit
                    type="text"
                    label="Peso ao nascer (gramas)"
                    v-model="page.props.anamnese.peso_nascimento"
                    help="Informe o peso em gramas"
                    disabled
                />

                <FormKit
                    type="text"
                    label="Estatura ao nascer (cm)"
                    v-model="page.props.anamnese.estatura_nascimento"
                    help="Informe a estatura em centímetros"
                    disabled
                />

                <FormKit
                    type="text"
                    label="Tipo de parto"
                    v-model="page.props.anamnese.tipo_parto"
                    disabled
                />

                <FormKit
                    type="textarea"
                    label="Intercorrências no nascimento"
                    v-model="page.props.anamnese.intercorrencias_nascimento"
                    help="Descrever intercorrências no nascimento"
                    rows="2"
                    disabled
                />

                <FormKit
                    type="textarea"
                    label="Outras intercorrências"
                    v-model="page.props.anamnese.outras_intercorrencias"
                    help="Descrever demais intercorrências"
                    rows="2"
                    disabled
                />
            </FormKit>
            <FormKit type="step" name="atividadefisica" label="Atv. Física">
                <FormKit
                    type="radio"
                    label="Hábitos de atividade física"
                    v-model="page.props.anamnese.habitos_atv_fisica"
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
                    disabled
                />
                <div
                    v-show="
                        page.props.anamnese.habitos_atv_fisica !=
                            'Sedentário' &&
                        page.props.anamnese.habitos_atv_fisica != null
                    "
                    class="animate-fade-in-up"
                >
                    <FormKit
                        type="textarea"
                        label="Tipo de atividade física"
                        v-model="page.props.anamnese.tipo_atv_fisica"
                        rows="2"
                        help="Descreva os tipos de atividades físicas praticadas"
                        disabled
                    />

                    <FormKit
                        type="textarea"
                        label="Duração da atividade física"
                        v-model="page.props.anamnese.duracao_atv_fisica"
                        rows="2"
                        help="Informe a frequência e duração das atividades"
                        disabled
                    />
                    <FormKit
                        type="radio"
                        label="Atleta"
                        v-model="page.props.anamnese.atleta"
                        :options="[
                            { label: 'Sim', value: true },
                            { label: 'Não', value: false },
                        ]"
                        disabled
                    />
                </div>
            </FormKit>
            <FormKit
                type="step"
                name="alimentacao"
                label="Alimentação"
                v-if="page.props.anamnese.neuropata"
            >
                <FormKit
                    type="radio"
                    label="O paciente é capaz de se alimentar sozinho?"
                    v-model="page.props.anamnese.se_alimenta_sozinho"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />

                <FormKit
                    type="radio"
                    label="O paciente consegue mastigar?"
                    v-model="page.props.anamnese.consegue_mastigar"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />

                <FormKit
                    type="radio"
                    label="A língua tem hipertonicidade?"
                    v-model="page.props.anamnese.hipertonicidade_lingua"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />

                <FormKit
                    type="radio"
                    label="A língua tem movimento temporo-mandibular?"
                    v-model="
                        page.props.anamnese.movimento_temporo_mandibular_lingua
                    "
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />

                <FormKit
                    type="radio"
                    label="Apresenta sucção?"
                    v-model="page.props.anamnese.succao"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />

                <FormKit
                    type="radio"
                    label="Saliva muito?"
                    v-model="page.props.anamnese.saliva"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />

                <FormKit
                    type="radio"
                    label="Tosse durante a refeição?"
                    v-model="page.props.anamnese.tosse_durante_refeicao"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />

                <FormKit
                    type="radio"
                    label="Engasga durante a refeição?"
                    v-model="page.props.anamnese.engasgo_durante_refeicao"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />

                <FormKit
                    type="radio"
                    label="Abre a boca ao redor da colher?"
                    v-model="page.props.anamnese.abre_boca_redor_colher"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />

                <FormKit
                    type="radio"
                    label="Fecha a boca ao redor da colher?"
                    v-model="page.props.anamnese.fecha_boca_redor_colher"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />
                <FormKit
                    type="text"
                    label="Posição em que se alimenta"
                    v-model="page.props.anamnese.posicao_alimentacao"
                    help="Posição habitual durante as refeições"
                    disabled
                />

                <FormKit
                    type="text"
                    label="Posição em que dorme"
                    v-model="page.props.anamnese.posicao_dormir"
                    help="Posição habitual durante o sono"
                    disabled
                />
                <FormKit
                    type="radio"
                    label="Consistência dos alimentos ingeridos"
                    v-model="page.props.anamnese.consistencia_alimentos"
                    :options="
                        ['Líquido', 'Pastoso', 'Sólido'].map((t) => ({
                            value: t,
                            label: t,
                        }))
                    "
                    disabled
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
                    v-model="page.props.anamnese.mastigacao_degluticao"
                    help="Dificuldades, características ou observações sobre mastigação/deglutição"
                    disabled
                />
                <div
                    v-if="
                        page.props.paciente.grupo_etario == 'Criança' ||
                        page.props.paciente.grupo_etario == 'Adolescente' ||
                        page.props.paciente.grupo_etario == 'Recém-nascido' ||
                        page.props.anamnese.gestante
                    "
                >
                    <FormKit
                        type="textarea"
                        label="Antecedentes religiosos, étnicos ou tabus com relação à dieta"
                        v-model="
                            page.props.anamnese.crencas_etnicas_religiosas_tabus
                        "
                        rows="2"
                        help="Crenças, restrições ou preferências alimentares de natureza religiosa ou étnica"
                        disabled
                    />
                </div>

                <FormKit
                    type="radio"
                    v-if="
                        page.props.paciente.grupo_etario == 'Criança' ||
                        page.props.paciente.grupo_etario == 'Adolescente'
                    "
                    label="Você acha que seu filho come o suficiente? "
                    v-model="page.props.anamnese.alimentacao_e_suficiente"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />

                <FormKit
                    type="textarea"
                    label="Preferências Alimentares"
                    v-model="page.props.anamnese.preferencias_alimentares"
                    rows="2"
                    help="Alimentos preferidos"
                    disabled
                />

                <FormKit
                    type="textarea"
                    label="Rejeições Alimentares"
                    v-model="page.props.anamnese.rejeicoes"
                    rows="2"
                    help="Alimentos que o paciente evita"
                    disabled
                />

                <FormKit
                    type="textarea"
                    label="Intolerâncias ou Alergias"
                    v-model="page.props.anamnese.intolerancias_alergias"
                    rows="2"
                    help="Descrever quais alimentos causam intolerâncias ou alergias"
                    disabled
                />

                <FormKit
                    type="textarea"
                    label="Mudança recente no hábito alimentar?"
                    v-model="page.props.anamnese.mudanca_recente"
                    rows="2"
                    help="Descreva a mudança e quando ocorreu"
                    disabled
                />
                <FormKit
                    type="radio"
                    label="Come em frente a eletrônicos?"
                    v-model="page.props.anamnese.come_frente_eletronicos"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />
                <FormKit
                    type="radio"
                    label="Come com a família?"
                    v-model="page.props.anamnese.come_com_familia"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />

                <FormKit
                    type="text"
                    label="Quem prepara as refeições"
                    v-model="page.props.anamnese.quem_prepara"
                    disabled
                />

                <FormKit
                    type="radio"
                    label="Sente apetite nas refeições?"
                    v-model="page.props.anamnese.sente_apetite"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />

                <FormKit
                    type="radio"
                    label="Tem apetite nos intervalos?"
                    v-model="page.props.anamnese.tem_apetite_intervalos"
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />

                <FormKit
                    type="text"
                    label="Qual horário sente mais fome?"
                    v-model="page.props.anamnese.qual_horario_sente_mais_fome"
                    disabled
                />

                <FormKit
                    type="radio"
                    label="Emoções influenciam nas escolhas alimentares?"
                    v-model="
                        page.props.anamnese
                            .emocoes_influenciam_escolhas_alimentares
                    "
                    :options="[
                        { label: 'Sim', value: true },
                        { label: 'Não', value: false },
                    ]"
                    disabled
                />
            </FormKit>
            <FormKit
                type="step"
                name="historiaalimentar"
                label="História Alimentar"
                v-if="
                    page.props.paciente.grupo_etario == 'Criança' ||
                    page.props.paciente.grupo_etario == 'Recém-nascido'
                "
            >
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <FormKit
                        type="text"
                        label="Leite materno - Data de início/interrupção"
                        v-model="
                            page.props.anamnese.leite_materno_data_inicio_fim
                        "
                        placeholder="Ex: 01/2022 a 06/2022"
                        help="Informe o período de aleitamento materno"
                        disabled
                    />

                    <FormKit
                        type="text"
                        label="Aceitação do leite materno"
                        v-model="page.props.anamnese.aceitacao_leite_materno"
                        placeholder="Ex: Boa aceitação"
                        help="Descreva como foi a aceitação"
                        disabled
                    />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <FormKit
                        type="text"
                        label="Leite artificial - Data de início/interrupção"
                        v-model="
                            page.props.anamnese.leite_artificial_data_inicio_fim
                        "
                        placeholder="Ex: 06/2022 a 12/2022"
                        disabled
                    />

                    <FormKit
                        type="text"
                        label="Tipo de leite artificial"
                        v-model="page.props.anamnese.tipo_leite_artificial"
                        placeholder="Ex: Fórmula infantil 1"
                        disabled
                    />

                    <FormKit
                        type="text"
                        label="Aceitação do leite artificial"
                        v-model="page.props.anamnese.aceitacao_leite_artificial"
                        placeholder="Ex: Aceitação regular"
                        disabled
                    />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <FormKit
                        type="text"
                        label="Chá/Água - Data de introdução"
                        v-model="page.props.anamnese.cha_agua_data_inicio_fim"
                        placeholder="Ex: A partir de 06/2022"
                        disabled
                    />

                    <FormKit
                        type="text"
                        label="Aceitação de chá/água"
                        v-model="page.props.anamnese.aceitacao_cha_agua"
                        placeholder="Ex: Boa aceitação"
                        disabled
                    />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <FormKit
                        type="text"
                        label="Suco de fruta - Data de introdução"
                        v-model="page.props.anamnese.suco_data_inicio_fim"
                        placeholder="Ex: Introduzido em 08/2022"
                        disabled
                    />

                    <FormKit
                        type="text"
                        label="Aceitação de sucos"
                        v-model="page.props.anamnese.aceitacao_suco"
                        placeholder="Ex: Prefere sucos cítricos"
                        disabled
                    />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <FormKit
                        type="text"
                        label="Papa de fruta - Data de introdução"
                        v-model="page.props.anamnese.papa_fruta_data_inicio_fim"
                        placeholder="Ex: 07/2022"
                        disabled
                    />

                    <FormKit
                        type="text"
                        label="Tipo de papa de fruta"
                        v-model="page.props.anamnese.tipo_papa_fruta"
                        placeholder="Ex: Maçã com banana"
                        disabled
                    />

                    <FormKit
                        type="text"
                        label="Consistência"
                        v-model="page.props.anamnese.consistencia_papa_fruta"
                        placeholder="Ex: Purê grosso"
                        disabled
                    />

                    <FormKit
                        type="text"
                        label="Aceitação"
                        v-model="page.props.anamnese.aceitacao_papa_fruta"
                        placeholder="Ex: Aceitação inicial difícil"
                        disabled
                    />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <FormKit
                        type="text"
                        label="Papa salgada - Data de introdução"
                        v-model="
                            page.props.anamnese.papa_salgada_data_inicio_fim
                        "
                        placeholder="Ex: 09/2022"
                        disabled
                    />

                    <FormKit
                        type="text"
                        label="Tipo de papa salgada"
                        v-model="page.props.anamnese.tipo_papa_salgada"
                        placeholder="Ex: Legumes com frango"
                        disabled
                    />

                    <FormKit
                        type="text"
                        label="Consistência"
                        v-model="page.props.anamnese.consistencia_papa_salgada"
                        placeholder="Ex: Amassada com garfo"
                        disabled
                    />

                    <FormKit
                        type="text"
                        label="Aceitação"
                        v-model="page.props.anamnese.aceitacao_papa_salgada"
                        placeholder="Ex: Boa aceitação"
                        disabled
                    />
                </div>
            </FormKit>

            <FormKit type="step" name="freqalimentar" label="Freq. Alimentar">
                <FormKit
                    type="number"
                    min="1"
                    max="10"
                    label="Quantidade de latas de óleo ao mês"
                    v-model="page.props.anamnese.qtd_latas_oleo_mes"
                    disabled
                />
                <div v-for="alimento in alimentos" :key="alimento.value">
                    <FreqAlimentar
                        :nome="alimento.label"
                        :qtd="page.props.anamnese[`qtd_${alimento.value}`]"
                        :frequencia="
                            page.props.anamnese[`frequencia_${alimento.value}`]
                        "
                        @update:qtd="
                            (val) =>
                                (page.props.anamnese[`qtd_${alimento.value}`] =
                                    val)
                        "
                        @update:frequencia="
                            (val) =>
                                (form[`frequencia_${alimento.value}`] = val)
                        "
                        disabled
                    ></FreqAlimentar>
                </div>
            </FormKit>
            <FormKit
                type="step"
                name="registroalimentar"
                label="Registro alimentar"
            >
                <RegistroAlimentar
                    v-model="page.props.anamnese"
                    disabled
                ></RegistroAlimentar>
            </FormKit>
            <FormKit type="step" name="obs. adicionais" label="Observações">
                <FormKit
                    type="textarea"
                    label="Observações adicionais"
                    v-model="page.props.anamnese.obs_adicionais"
                    rows="2"
                    help="Outras informações importantes"
                    disabled
                />
                <template #stepNext
                    ><FormKit
                        type="submit"
                        label="Finalizar"
                        disabled
                    ></FormKit>
                </template>
            </FormKit>
        </FormKit>
    </MainLayout>
</template>

<script setup>
import RegistroAlimentar from "@/Components/RegistroAlimentar.vue";
import { usePage } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/AuthenticatedLayout.vue";
import FreqAlimentar from "./Components/FreqAlimentar.vue";

const page = usePage();

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
</script>
