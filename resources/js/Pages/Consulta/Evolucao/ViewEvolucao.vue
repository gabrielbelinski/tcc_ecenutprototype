<template>
    <MainLayout>
        <FormKit type="multi-step" tab-style="progress">
            <div v-if="gestante">
                <Gestante :modelValue="page.props.evolucao"></Gestante>
            </div>
            <div v-else-if="atleta">
                <Atleta :modelValue="page.props.evolucao"></Atleta>
            </div>
            <div v-else>
                <div v-if="grupo_etario == 'Adolescente'">
                    <Adolescente
                        :modelValue="page.props.evolucao"
                    ></Adolescente>
                </div>
                <div
                    v-else-if="
                        grupo_etario == 'Adulto' || grupo_etario == 'Idoso'
                    "
                >
                    <Adulto :modelValue="page.props.evolucao"></Adulto>
                </div>
                <div
                    v-else-if="
                        grupo_etario == 'Criança' ||
                        grupo_etario == 'Recém-nascido'
                    "
                >
                    <Pediatria :modelValue="page.props.evolucao"></Pediatria>
                </div>
            </div>
            <FormKit type="step" name="infadicionais" label="Infos. adicionais">
                <FormKit
                    type="textarea"
                    label="Descrever informações adicionais"
                    v-model="page.props.evolucao.obs_adicionais"
                    rows="3"
                />
                <template #stepNext>
                    <FormKit
                        type="button"
                        label="Lista de prontuários"
                        @click="goToList"
                    />
                </template>
            </FormKit> </FormKit
    ></MainLayout>
</template>

<script setup>
import MainLayout from "@/Layouts/AuthenticatedLayout.vue";
import { usePage, router } from "@inertiajs/vue3";
import Adolescente from "./Components/Adolescente.vue";
import Atleta from "./Components/Atleta.vue";
import Adulto from "./Components/Adulto.vue";
import Pediatria from "./Components/Pediatria.vue";
import Gestante from "./Components/Gestante.vue";
const page = usePage();
const grupo_etario = page.props.paciente.grupo_etario;
const gestante = page.props.paciente.gestante;
const atleta = page.props.paciente.atleta;

const goToList = () => {
    router.get("/consulta/atendimento/prontuarios");
};
</script>
