<template>
    <MainLayout>
        <FormKit
            type="multi-step"
            tab-style="progress"
            :classes="{
                outer: 'max-w-[1200px], min-w-[1200px]',
            }"
        >
            <FormKit type="step" name="agendamento" label="Agendamento"
                ><div class="grid grid-cols-2 gap-3">
                    <FormKit
                        type="text"
                        :value="page.props.consulta.paciente.nome"
                        label="Nome do paciente"
                        disabled
                        :outer-class="{
                            'data-[disabled]:opacity-50': false,
                        }"
                    ></FormKit>

                    <FormKit
                        type="date"
                        label="Data do atendimento"
                        :value="page.props.consulta.data_consulta"
                        disabled
                        :outer-class="{
                            'data-[disabled]:opacity-50': false,
                        }"
                    />

                    <FormKit
                        type="time"
                        label="Horário"
                        :value="page.props.consulta.hora_consulta"
                        disabled
                        :outer-class="{
                            'data-[disabled]:opacity-50': false,
                        }"
                    />
                </div>

                <FormKit
                    type="text"
                    label="Modalidade de consulta"
                    :value="page.props.consulta.modalidade_consulta"
                    disabled
                    :outer-class="{ 'data-[disabled]:opacity-50': false }"
            /></FormKit>
            <FormKit type="step" name="pagamento" label="Pagamento">
                <FormKit
                    type="text"
                    label="Forma de Pagamento"
                    :value="page.props.consulta.forma_pagamento"
                    disabled
                    :outer-class="{ 'data-[disabled]:opacity-50': false }"
            /></FormKit>
            <FormKit type="step" name="observacoes" label="Observações"
                ><FormKit
                    label="Observações"
                    type="textarea"
                    :value="page.props.consulta.observacoes_consulta"
                    rows="3"
                    disabled
                    :outer-class="{ 'data-[disabled]:opacity-50': false }" />
                <template #stepNext>
                    <FormKit
                        type="button"
                        label="Lista de consultas"
                        @click="goToList"
                    /> </template
            ></FormKit>
        </FormKit>
    </MainLayout>
</template>

<script setup>
import { usePage, router } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/AuthenticatedLayout.vue";
const page = usePage();

const goToList = () => {
    router.get("/consulta");
};
</script>
