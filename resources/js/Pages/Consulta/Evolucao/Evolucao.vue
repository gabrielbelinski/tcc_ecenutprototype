<template>
    <MainLayout>
        <FormKit type="form" @submit="create" :actions="false">
            <FormKit type="multi-step" tab-style="progress">
                <div v-if="gestante">
                    <Gestante :modelValue="form"></Gestante>
                </div>
                <div v-else-if="atleta">
                    <Atleta :modelValue="form"></Atleta>
                </div>
                <div v-else>
                    <div v-if="grupo_etario == 'Adolescente'">
                        <Adolescente :modelValue="form"></Adolescente>
                    </div>
                    <div
                        v-else-if="
                            grupo_etario == 'Adulto' || grupo_etario == 'Idoso'
                        "
                    >
                        <Adulto :modelValue="form"></Adulto>
                    </div>
                    <div
                        v-else-if="
                            grupo_etario == 'Criança' ||
                            grupo_etario == 'Recém-nascido'
                        "
                    >
                        <Pediatria :modelValue="form"></Pediatria>
                    </div>
                </div>
                <FormKit
                    type="step"
                    name="infadicionais"
                    label="Infos. adicionais"
                >
                    <FormKit
                        type="textarea"
                        label="Descrever informações adicionais"
                        v-model="form.obs_adicionais"
                        rows="3"
                    />
                    <template #stepNext
                        ><FormKit type="submit" label="Finalizar"></FormKit>
                    </template>
                </FormKit>
            </FormKit> </FormKit
    ></MainLayout>
</template>

<script setup>
import MainLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import Adolescente from "./Components/Adolescente.vue";
import Atleta from "./Components/Atleta.vue";
import Adulto from "./Components/Adulto.vue";
import Pediatria from "./Components/Pediatria.vue";
import Gestante from "./Components/Gestante.vue";
const page = usePage();
const grupo_etario = page.props.grupo_etario;
const gestante = page.props.gestante;
const atleta = page.props.atleta;
const id_consultas = page.props.id_consulta;

const form = useForm({
    fk_id_consultas: id_consultas,
    diagnostico_nutricional: null,
    pressao_arterial: null,
    imc: null,
    peso: null,
    estatura: null,
    circunferencia_braco: null,
    circunferencia_muscular_braco: null,
    prega_triciptal_pct: null,
    prega_subescapular_pcse: null,
    glicemia: null,
    colesterol: null,
    triglicerideos: null,
    prega_biciptal_pcb: null,
    prega_supra_iliaca_pcsi: null,
    gordura_corporal_bia: null,
    circunferencia_cintura: null,
    idade_corrigida: null,
    gordura_corporal_pregas: null,
    imc_pre_gestacional: null,
    ganho_peso: null,
    peso_habitual: null,
    suplementacao: null,
    prega_toracica_ptx: null,
    prega_coxa_pcx: null,
    prega_panturrilha_pcp: null,
    obs_adicionais: null,
});

const create = () => {
    form.post("/consulta/atendimento/evolucao/", {
        onError: (errors) => {
            console.error(errors);
        },
        onSuccess: () => {
            alert("Evolução registrada com sucesso!");
        },
    });
};
</script>
