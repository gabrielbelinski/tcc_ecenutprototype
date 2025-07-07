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
                    Cadastrar Usuário
                </NButton>
                <n-data-table
                    :columns="columns"
                    :data="page.props.usuarios"
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
    router.get("/usuario/create");
};

function createColumns() {
    return [
        { title: "ID", key: "id" },
        { title: "Nome completo", key: "nome" },
        { title: "Tipo", key: "tipo_usuario" },
        { title: "E-mail", key: "email" },
        { title: "Matrícula/RA", key: "matricula" },
        {
            title: "Ações",
            key: "actions",
            render(row) {
                return h(NSpace, {}, [
                    h(
                        NButton,
                        {
                            size: "small",
                            onClick: () => router.get(`/usuario/${row.id}`),
                        },
                        { default: () => "Ver cadastro" }
                    ),
                    h(
                        NButton,
                        {
                            size: "small",
                            onClick: () =>
                                router.get(`/usuario/${row.id}/edit`),
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
                                        "Tem certeza que deseja excluir este usuário?"
                                    )
                                ) {
                                    router.delete(`/usuario/${row.id}`);
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
