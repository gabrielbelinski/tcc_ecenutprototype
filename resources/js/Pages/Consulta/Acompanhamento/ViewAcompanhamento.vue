<template>
    <MainLayout>
        <FormKit type="multi-step" tab-style="progress">
            <FormKit
                type="step"
                name="acompanhamentogeral"
                label="Acompanhamento Geral"
            >
                <div class="formkit-grid">
                    <FormKit
                        type="textarea"
                        label="Mudanças no diagnóstico"
                        v-model="page.props.acompanhamento.mudancas_diagnostico"
                        rows="4"
                        disabled
                    />

                    <FormKit
                        type="textarea"
                        label="Medicamentos em uso"
                        v-model="page.props.acompanhamento.medicamentos"
                        rows="4"
                        placeholder="Descrever nome dos medicamentos"
                        disabled
                    />

                    <FormKit
                        type="radio"
                        label="Função Intestinal"
                        v-model="page.props.acompanhamento.habito_intestinal"
                        :options="
                            ['Normal', 'Constipação'].map((t) => ({
                                value: t,
                                label: t,
                            }))
                        "
                        disabled
                    />

                    <FormKit
                        type="radio"
                        label="Ingestão Hídrica"
                        v-model="page.props.acompanhamento.ingestao_hidrica"
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
                                value: '>= 1000 < 2000',
                                label: '≥ 1.000 < 2.000 mL',
                            },
                            { value: '>= 2000', label: '≥ 2000 mL' },
                        ]"
                        disabled
                    />

                    <FormKit
                        type="textarea"
                        label="Intercorrências no mês e outras informações importantes"
                        v-model="page.props.acompanhamento.intercorrencias"
                        rows="4"
                        disabled
                    />
                </div>
            </FormKit>

            <FormKit
                type="step"
                name="atividadefisica"
                label="Atividade Física"
            >
                <FormKit
                    type="radio"
                    label="Hábitos de atividade física"
                    v-model="page.props.acompanhamento.habitos_atv_fisica"
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
                    v-if="
                        page.props.acompanhamento.habitos_atv_fisica !=
                            'Sedentário' &&
                        page.props.acompanhamento.habitos_atv_fisica != null
                    "
                >
                    <FormKit
                        type="textarea"
                        label="Tipo"
                        v-model="page.props.acompanhamento.tipo_atv_fisica"
                        rows="3"
                        placeholder="Tipo(s) de atividade física"
                        disabled
                    />

                    <FormKit
                        type="textarea"
                        label="Duração"
                        v-model="page.props.acompanhamento.duracao_atv_fisica"
                        rows="3"
                        placeholder="Duração da atividade física (horas)"
                        disabled
                    />

                    <FormKit
                        type="textarea"
                        label="Horário"
                        v-model="page.props.acompanhamento.horario_atv_fisica"
                        rows="3"
                        placeholder="Horário em que pratica cada atividade descrita"
                        disabled
                    />

                    <FormKit
                        type="radio"
                        label="Intensidade da atividade física"
                        v-model="
                            page.props.acompanhamento.intensidade_atv_fisica
                        "
                        :options="
                            ['Leve', 'Moderada', 'Vigorosa'].map((t) => ({
                                value: t,
                                label: t,
                            }))
                        "
                        disabled
                    />
                </div>
            </FormKit>

            <!-- Step 3: Registro Alimentar -->
            <FormKit
                type="step"
                name="registroalimentar"
                label="Registro Alimentar"
            >
                <RegistroAlimentar v-model="page.props.acompanhamento" />
                <template #stepNext>
                    <FormKit
                        type="button"
                        label="Lista de prontuários"
                        @click="goToList"
                    />
                </template>
            </FormKit>
        </FormKit>
    </MainLayout>
</template>

<script setup>
import RegistroAlimentar from "@/Components/RegistroAlimentar.vue";
import MainLayout from "@/Layouts/AuthenticatedLayout.vue";
import { usePage, router } from "@inertiajs/vue3";
const page = usePage();
const goToList = () => {
    router.get("/consulta/atendimento/prontuarios");
};
</script>
