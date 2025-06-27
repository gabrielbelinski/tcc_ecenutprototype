<template>
    <MainLayout>
        <div class="container m-auto px-2.5 py-3">
            <div class="bg-gray-50 mt-1.5 px-3.5 py-2 rounded-lg shadow-md">
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Nome completo
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Data de nascimento
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Tipo de usuário
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
                                    v-for="usuario in page.props.usuarios"
                                    :key="usuario.id"
                                >
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div
                                                    class="text-sm font-medium text-gray-900"
                                                >
                                                    {{
                                                        usuario?.nome ||
                                                        "Usuário não encontrado"
                                                    }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ usuario.data }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                        >
                                            {{ usuario.tipo_usuario }}
                                        </span>
                                    </td>

                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                                    >
                                        <Link
                                            :href="`/usuario/${usuario.id}/edit/`"
                                            class="text-blue-600 hover:text-blue-900 mr-3"
                                        >
                                            <i class="fas fa-edit mr-1"></i>
                                            Modificar
                                        </Link>
                                        <button
                                            @click="deleteUsuario(usuario.id)"
                                            class="text-red-600 hover:text-red-900"
                                        >
                                            <i class="fas fa-trash mr-1"></i>
                                            Cancelar
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="page.props.usuarios.length === 0">
                                    <td
                                        colspan="6"
                                        class="px-6 py-4 text-center text-sm text-gray-500"
                                    >
                                        Nenhum usuário encontrado
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
                                    page.props.usuarios.length
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
                                            page.props.usuarios.length
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

// Paginação
const currentPage = ref(1);
const perPage = ref(10);

const totalPages = computed(() => {
    return Math.ceil(page.props.usuarios.length / perPage.value);
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

const deletePaciente = (id) => {
    router.delete(`/usuario/${id}`, {
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
