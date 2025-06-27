<template>
    <MainLayout>
        <div class="container m-auto px-2.5 py-3">
            <div class="bg-gray-50 mt-1.5 px-3.5 py-2 rounded-lg shadow-md">
                <!-- Filtros e Busca -->

                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Paciente
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Data/Horário
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Modalidade
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Grupo Etário
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Encaminhamento
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Pagamento
                                    </th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Ações
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr
                                    v-for="consulta in page.props.consultas"
                                    :key="consulta.id"
                                >
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div
                                                    class="text-sm font-medium text-gray-900"
                                                >
                                                    {{
                                                        consulta.paciente
                                                            ?.nome ||
                                                        "Paciente não encontrado"
                                                    }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ consulta.data }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ consulta.hora }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                            :class="
                                                getModalidadeClass(
                                                    consulta.modalidade_consulta
                                                )
                                            "
                                        >
                                            {{ consulta.modalidade_consulta }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                        >
                                            {{ consulta.paciente.grupo_etario }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                        >
                                            {{
                                                consulta.paciente.encaminhamento
                                            }}
                                        </span>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        <span
                                            :class="
                                                getPagamentoClass(
                                                    consulta.status_pagamento
                                                )
                                            "
                                        >
                                            <i
                                                :class="
                                                    getPagamentoIcon(
                                                        consulta.status_pagamento
                                                    )
                                                "
                                            ></i>
                                            {{
                                                formatPagamento(
                                                    consulta.status_pagamento
                                                )
                                            }}
                                        </span>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                                    >
                                        <Link
                                            :href="`/consulta/${consulta.id}/edit/`"
                                            class="text-blue-600 hover:text-blue-900 mr-3"
                                        >
                                            <i class="fas fa-edit mr-1"></i>
                                            Modificar
                                        </Link>
                                        <button
                                            @click="deleteConsulta(consulta.id)"
                                            class="text-red-600 hover:text-red-900"
                                        >
                                            <i class="fas fa-trash mr-1"></i>
                                            Cancelar
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="page.props.consultas.length === 0">
                                    <td
                                        colspan="6"
                                        class="px-6 py-4 text-center text-sm text-gray-500"
                                    >
                                        Nenhuma consulta encontrada
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginação -->
                    <div
                        class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6"
                    >
                        <div class="flex-1 flex justify-between sm:hidden">
                            <button
                                @click="previousPage"
                                :disabled="currentPage === 1"
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                            >
                                Anterior
                            </button>
                            <button
                                @click="nextPage"
                                :disabled="
                                    currentPage * perPage >=
                                    page.props.consultas.length
                                "
                                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                            >
                                Próxima
                            </button>
                        </div>
                        <div
                            class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between"
                        >
                            <div>
                                <nav
                                    class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                                    aria-label="Pagination"
                                >
                                    <button
                                        @click="previousPage"
                                        :disabled="currentPage === 1"
                                        class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                                    >
                                        <span class="sr-only">Anterior</span>
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <button
                                        v-for="pg in totalPages"
                                        :key="pg"
                                        @click="currentPage = pg"
                                        :class="{
                                            'bg-green-50 border-green-500 text-green-600':
                                                currentPage === pg,
                                            'bg-white border-gray-300 text-gray-500 hover:bg-gray-50':
                                                currentPage !== pg,
                                        }"
                                        class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                                    >
                                        {{ pg }}
                                    </button>
                                    <button
                                        @click="nextPage"
                                        :disabled="
                                            currentPage * perPage >=
                                            page.props.consultas.length
                                        "
                                        class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                                    >
                                        <span class="sr-only">Próxima</span>
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { ref, computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";

const page = usePage();

// Filtros
const searchQuery = ref("");
const statusFilter = ref("");
const dateFilter = ref("");

// Paginação
const currentPage = ref(1);
const perPage = ref(10);

// Modal de exclusão
const showDeleteModal = ref(false);
const consultaToDelete = ref(null);

// Métodos auxiliares

const formatPagamento = (status) => {
    const statusMap = {
        Realizado: "Pago",
        Pendente: "Pendente",
        Isento: "Isento",
    };
    return statusMap[status] || status;
};

const getModalidadeClass = (modalidade) => {
    return {
        "bg-blue-100 text-blue-800": modalidade === "Primeira Consulta",
        "bg-yellow-100 text-yellow-800": modalidade === "Acompanhamento",
        "bg-green-100 text-green-800": modalidade === "Bioimpedância",
    };
};

const getStatusClass = (status) => {
    return {
        "bg-green-100 text-green-800": status === "Realizado",
        "bg-yellow-100 text-yellow-800": status === "Agendado",
        "bg-red-100 text-red-800": status === "Cancelado",
    };
};

const getPagamentoClass = (status) => {
    return {
        "text-green-600": status === "Realizado",
        "text-yellow-600": status === "Pendente",
        "text-gray-500": status === "Isento" || !status,
    };
};

const getPagamentoIcon = (status) => {
    return {
        "fas fa-check-circle mr-1": status === "Realizado",
        "fas fa-exclamation-circle mr-1": status === "Pendente",
        "fas fa-ban mr-1": status === "Isento" || !status,
    };
};

const totalPages = computed(() => {
    return Math.ceil(page.props.consultas.length / perPage.value);
});

// Navegação de páginas
const nextPage = () => {
    if (currentPage.value < totalPages.value) {
        currentPage.value++;
    }
};

const previousPage = () => {
    if (currentPage.value > 1) {
        currentPage.value--;
    }
};

const deleteConsulta = (id) => {
    router.delete(`/consulta/${id}`, {
        onSuccess: () => {
            alert(page.props.message);
            // Você pode adicionar uma notificação de sucesso aqui
        },
        onError: () => {
            // Tratar erro
        },
    });
};
</script>

<style scoped>
/* Estilos adicionais podem ser colocados aqui */
</style>
