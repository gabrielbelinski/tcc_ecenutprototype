<template>
    <MainLayout>
        <div class="container m-auto px-2.5 py-3">
            <div class="bg-gray-100 rounded-md p-3">
                <h1>Página em construção!</h1>
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
                            label: "Anamnese",
                            key: "anamnese",
                        },
                        {
                            label: "Acompanhamento",
                            key: "acompanhamento",
                        },
                        {
                            label: "Evolução",
                            key: "evolucao",
                        },
                        {
                            label: "Concluir",
                            key: "concluir",
                        },
                    ],
                    onSelect: (key) => {
                        if (key == "concluir") {
                            if (
                                confirm(
                                    "Tem certeza que deseja finalizar o atendimento? Esta ação não pode ser revertida!"
                                )
                            ) {
                                router.visit(
                                    `/consulta/atendimento/concluir/${row.id}`
                                );
                            }
                        } else {
                            router.visit(
                                `/consulta/atendimento/${key}/${row.id}`
                            );
                        }
                    },
                },
                {
                    default: () =>
                        h(
                            NButton,
                            { type: "primary", size: "small", tertiary: true },
                            { default: () => "Registrar atendimento" }
                        ),
                }
            ),
    },
];
</script>
