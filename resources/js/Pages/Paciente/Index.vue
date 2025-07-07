<template>
    <MainLayout>
        <div class="container m-auto px-2.5 py-3">
            <div class="bg-gray-100 rounded-md p-3">
                <NButton
                    size="small"
                    type="primary"
                    @click="redirectToCreate"
                    class="mb-3"
                >
                    Cadastrar Paciente
                </NButton>
                <n-data-table
                    :columns="columns"
                    :data="page.props.pacientes"
                    :row-key="(row) => row.id"
                    :pagination="false"
                />
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { NButton, NSpace } from "naive-ui";
import { h } from "vue";
import { usePage, router } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/AuthenticatedLayout.vue";

const page = usePage();

const redirectToCreate = () => {
    router.get("/paciente/create");
};

function createColumns() {
    return [
        { title: "ID", key: "id" },
        { title: "Nome completo", key: "nome" },
        { title: "Data de nascimento", key: "data" },
        { title: "Cidade", key: "cidade" },
        { title: "Grupo Etário", key: "grupo_etario" },
        { title: "Encaminhamento", key: "encaminhamento" },
        {
            title: "Ações",
            key: "actions",
            render(row) {
                return h(NSpace, {}, [
                    h(
                        NButton,
                        {
                            size: "small",
                            onClick: () => router.get(`/paciente/${row.id}`),
                        },
                        { default: () => "Ver" }
                    ),
                    h(
                        NButton,
                        {
                            size: "small",
                            onClick: () =>
                                router.get(`/paciente/${row.id}/edit`),
                        },
                        { default: () => "Editar" }
                    ),
                    h(
                        NButton,
                        {
                            size: "small",
                            type: "error",
                            onClick: () => {
                                if (
                                    confirm(
                                        "Tem certeza que deseja excluir este paciente?"
                                    )
                                ) {
                                    router.delete(`/paciente/${row.id}`);
                                }
                            },
                        },
                        { default: () => "Excluir" }
                    ),
                ]);
            },
        },
    ];
}

const columns = createColumns();
</script>

<style scoped>
.n-button {
    margin-right: 8px;
}
</style>
