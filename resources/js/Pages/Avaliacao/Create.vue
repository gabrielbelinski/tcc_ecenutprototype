<template>
    <MainLayout>
        <FormKit type="multi-step" tab-style="progress">
            <FormKit type="step" name="arquivos" label="Submissão de arquivos">
                <FormKit
                    type="file"
                    label="Plano de conduta nutricional"
                    accept=".pdf,.jpg,.jpeg,.png"
                    help="Anexar o plano de conduta nutricional"
                />
                <FormKit
                    type="file"
                    label="Plano de acompanhamento nutricional"
                    accept=".pdf,.jpg,.jpeg,.png"
                    help="Anexar o plano de acompanhamento nutricional"
                />
                <FormKit
                    type="file"
                    label="Plano alimentar"
                    accept=".pdf,.jpg,.jpeg,.png"
                    help="Anexar o plano alimentar elaborado"
                />
            </FormKit>

            <FormKit type="step" name="submissao" label="Submissão">
                <FormKit
                    type="text"
                    label="Nome do professor responsável"
                    help="Informar o nome do professor responsável pelos atendimentos do dia"
                />
                <FormKit
                    type="text"
                    label="Nome do paciente"
                    help="Informar o nome do paciente atendido"
                />

                <template #stepNext
                    ><FormKit type="submit" label="Finalizar"></FormKit>
                </template>
            </FormKit>
        </FormKit>
    </MainLayout>
</template>

<script setup>
import MainLayout from "@/Layouts/AuthenticatedLayout.vue";
import { usePage } from "@inertiajs/vue3";
const page = usePage();
</script>
