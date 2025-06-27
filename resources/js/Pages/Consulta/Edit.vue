<template>
    <MainLayout>
        <FormKit type="form" @submit="update" :actions="false">
            <FormKit type="multi-step" tab-style="progress">
                <FormKit type="step" name="agendamento" label="Agendamento">
                    <div class="grid grid-cols-2 gap-3">
                        <FormKit
                            label="Nome do paciente"
                            type="text"
                            :value="page.props.consulta.paciente.nome"
                            disabled
                        />
                        <FormKit
                            type="date"
                            label="Data do atendimento"
                            v-model="form.data_consulta"
                            validation="required"
                        />

                        <FormKit
                            type="time"
                            label="Horário"
                            v-model="form.hora_consulta"
                            validation="required"
                        />
                    </div>

                    <FormKit
                        type="radio"
                        label="Modalidade de consulta"
                        v-model="form.modalidade_consulta"
                        :options="[
                            {
                                value: 'Primeira Consulta',
                                label: 'Primeira Consulta',
                            },
                            {
                                value: 'Acompanhamento',
                                label: 'Acompanhamento',
                            },
                            { value: 'Bioimpedância', label: 'Bioimpedância' },
                        ]"
                        validation="required"
                    />
                </FormKit>
                <FormKit type="step" name="pagamento" label="Pagamento">
                    <FormKit
                        type="select"
                        label="Forma de Pagamento"
                        v-model="form.forma_pagamento"
                        :options="[
                            { value: '', label: 'Selecione' },
                            { value: 'Dinheiro', label: 'Dinheiro' },
                            { value: 'Pix', label: 'Pix' },
                            {
                                value: 'Cartão de Crédito',
                                label: 'Cartão de Crédito',
                            },
                            {
                                value: 'Cartão de Débito',
                                label: 'Cartão de Débito',
                            },
                            {
                                value: 'Isento',
                                label: 'Isento',
                            },
                        ]"
                        validation="required"
                    />

                    <FormKit
                        v-show="form.forma_pagamento == 'Pix'"
                        type="file"
                        label="Comprovante de Pix"
                        accept=".pdf,.jpg,.jpeg,.png"
                        help="Anexar o comprovante de Pix"
                    />
                </FormKit>
                <FormKit type="step" name="observacoes" label="Observações">
                    <FormKit
                        label="Observações"
                        type="textarea"
                        v-model="form.observacoes_consulta"
                        rows="3"
                    />

                    <template #stepNext>
                        <FormKit type="submit" label="Finalizar"></FormKit>
                    </template>
                </FormKit>
            </FormKit>
        </FormKit>
    </MainLayout>
</template>

<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { useForm, usePage } from "@inertiajs/vue3";

const page = usePage();
const form = useForm({
    data_consulta: page.props.consulta.data_consulta,
    hora_consulta: page.props.consulta.hora_consulta,
    modalidade_consulta: page.props.consulta.modalidade_consulta,
    status_pagamento: page.props.consulta.status_pagamento,
    forma_pagamento: page.props.consulta.forma_pagamento,
    comprovante_pagamento_url: page.props.consulta.comprovante_pagamento_url,
    valor_total_consulta: page.props.consulta.valor_total_consulta,
    observacoes_consulta: page.props.consulta.observacoes_consulta,
});

const update = () => {
    form.put(`/consulta/${page.props.consulta.id}/update`, {
        onError: (errors) => {
            console.error(errors);
        },
        onSuccess: () => {
            console.log("Formulário enviado com sucesso!");
        },
    });
};
</script>
