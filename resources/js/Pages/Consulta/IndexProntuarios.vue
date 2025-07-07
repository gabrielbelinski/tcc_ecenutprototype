<template>
    <MainLayout>
        <div class="container m-auto px-2.5 py-3">
            <div class="bg-gray-100 rounded-md p-3">
                <n-data-table
                    :columns="columns"
                    :data="paginatedConsultas"
                    :pagination="false"
                    :row-key="(row) => row.id"
                    class="rounded-lg shadow"
                />

                <div
                    class="flex justify-between mt-4 rounded-lg shadow bg-white"
                >
                    <n-button
                        @click="previousPage"
                        :disabled="currentPage === 1"
                    >
                        Anterior
                    </n-button>
                    <span class="mt-2"
                        >Página {{ currentPage }} de {{ totalPages }}</span
                    >
                    <n-button
                        @click="nextPage"
                        :disabled="currentPage >= totalPages"
                    >
                        Próxima
                    </n-button>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { h, ref, computed } from "vue";
import { NButton, NTag, NDropdown } from "naive-ui";
import { router, usePage, Link } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/AuthenticatedLayout.vue";

const page = usePage();
const currentPage = ref(1);
const perPage = ref(10);

const totalPages = computed(() =>
    Math.ceil(page.props.consultas.length / perPage.value)
);

const paginatedConsultas = computed(() =>
    page.props.consultas.slice(
        (currentPage.value - 1) * perPage.value,
        currentPage.value * perPage.value
    )
);

const nextPage = () => {
    if (currentPage.value < totalPages.value) currentPage.value++;
};

const previousPage = () => {
    if (currentPage.value > 1) currentPage.value--;
};

const columns = [
    {
        title: "Paciente",
        key: "paciente",
        render: (row) => row.paciente?.nome || "Paciente não encontrado",
    },
    {
        title: "Data/Horário",
        key: "data_hora",
        render: (row) =>
            h("div", [
                h("div", row.data),
                h("div", { class: "text-gray-500 text-xs" }, row.hora),
            ]),
    },
    {
        title: "Modalidade",
        key: "modalidade_consulta",
        render: (row) => row.modalidade_consulta,
    },
    {
        title: "Grupo Etário",
        key: "grupo_etario",
        render: (row) => row.paciente?.grupo_etario || "-",
    },
    {
        title: "Encaminhamento",
        key: "encaminhamento",
        render: (row) => row.paciente?.encaminhamento || "-",
    },
    {
        title: "Ações",
        key: "acoes",
        render: (row) =>
            h(
                NDropdown,
                {
                    options: [
                        {
                            label: "Ver anamnese",
                            key: "anamnese",
                            disabled: !row.anamnese, // Desabilita se não existir anamnese
                        },
                        {
                            label: "Ver acompanhamento",
                            key: "acompanhamento",
                            disabled: !row.acompanhamento, // Desabilita se não existir acompanhamento
                        },
                        {
                            label: "Ver evolução",
                            key: "evolucao",
                            disabled: !row.evolucao, // Desabilita se não existir evolução
                        },
                    ],
                    onSelect: (key) => {
                        // Obtém o ID correto baseado no tipo selecionado
                        const idMap = {
                            anamnese: row.anamnese?.id,
                            acompanhamento: row.acompanhamento?.id,
                            evolução: row.evolucao?.id,
                        };

                        const recordId = idMap[key];

                        if (recordId) {
                            router.visit(
                                `/consulta/atendimento/prontuarios/${key}/${recordId}`
                            );
                        }
                    },
                },
                // Trigger do dropdown (pode ser um botão ou ícone)
                h(NButton, { size: "small" }, () => "Ações")
            ),
    },
];
</script>
