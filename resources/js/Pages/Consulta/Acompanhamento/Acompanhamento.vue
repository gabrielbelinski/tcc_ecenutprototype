<template>
    <MainLayout>
        <FormKit type="form" @submit="create" :actions="false">
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
                            v-model="form.mudancas_diagnostico"
                            rows="4"
                            placeholder="Descrever mudanças no diagnóstico"
                        />

                        <FormKit
                            type="textarea"
                            label="Medicamentos em uso"
                            v-model="form.medicamentos"
                            rows="4"
                            placeholder="Descrever nome dos medicamentos"
                        />

                        <FormKit
                            type="radio"
                            label="Função Intestinal"
                            v-model="form.habito_intestinal"
                            :options="
                                ['Normal', 'Constipação'].map((t) => ({
                                    value: t,
                                    label: t,
                                }))
                            "
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
                                    value: '>= 1000 < 2000',
                                    label: '≥ 1.000 < 2.000 mL',
                                },
                                { value: '>= 2000', label: '≥ 2000 mL' },
                            ]"
                        />

                        <FormKit
                            type="textarea"
                            label="Intercorrências no mês e outras informações importantes"
                            v-model="form.intercorrencias"
                            rows="4"
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
                        v-if="
                            form.habitos_atv_fisica != 'Sedentário' &&
                            form.habitos_atv_fisica != null
                        "
                    >
                        <FormKit
                            type="textarea"
                            label="Tipo"
                            v-model="form.tipo_atv_fisica"
                            rows="3"
                            placeholder="Tipo(s) de atividade física"
                        />

                        <FormKit
                            type="textarea"
                            label="Duração"
                            v-model="form.duracao_atv_fisica"
                            rows="3"
                            placeholder="Duração da atividade física (horas)"
                        />

                        <FormKit
                            type="textarea"
                            label="Horário"
                            v-model="form.horario_atv_fisica"
                            rows="3"
                            placeholder="Horário em que pratica cada atividade descrita"
                        />

                        <FormKit
                            type="radio"
                            label="Intensidade da atividade física"
                            v-model="form.intensidade_atv_fisica"
                            :options="
                                ['Leve', 'Moderada', 'Vigorosa'].map((t) => ({
                                    value: t,
                                    label: t,
                                }))
                            "
                        />
                    </div>
                </FormKit>

                <!-- Step 3: Registro Alimentar -->
                <FormKit
                    type="step"
                    name="registroalimentar"
                    label="Registro Alimentar"
                >
                    <RegistroAlimentar v-model="form" />
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
import MainLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
const page = usePage();
const id_consulta = page.props.id_consulta;

const form = useForm({
    fk_id_consultas: id_consulta,
    habitos_atv_fisica: null,
    duracao_atv_fisica: null,
    horario_atv_fisica: null,
    tipo_atv_fisica: null,
    intensidade_atv_fisica: null,
    intercorrencias: null,
    habito_intestinal: null,
    ingestao_hidrica: null,
    mudancas_diagnostico: null,
    medicamentos: null,
    tipo_registro: null,
    cafe_manha: null,
    lanche_manha: null,
    almoco: null,
    lanche_tarde_I: null,
    lanche_tarde_II: null,
    jantar: null,
    ceia: null,
    outros_registro_alimentar: null,
});

const create = () => {
    form.post("/consulta/atendimento/acompanhamento/", {
        onError: (errors) => {
            console.error(errors);
        },
        onSuccess: () => {
            alert("Acompanhamento registrado com sucesso!");
        },
    });
};
</script>
