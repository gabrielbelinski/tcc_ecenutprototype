<template>
    <MainLayout>
        <div class="container m-auto px-2.5 py-3">
            <div class="bg-gray-50 mt-1.5 px-3.5 py-2 rounded-lg shadow-md">
                <!-- Filtros e Busca -->

                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="relative overflow-x-auto">
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
                                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                                    >
                                        <div
                                            class="relative inline-block text-left"
                                        >
                                            <div>
                                                <button
                                                    @click="
                                                        toggleActionsDropdown(
                                                            consulta.id,
                                                            $event
                                                        )
                                                    "
                                                    type="button"
                                                    class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none"
                                                    id="options-menu"
                                                    aria-haspopup="true"
                                                    :aria-expanded="
                                                        openDropdownId ===
                                                        consulta.id
                                                    "
                                                >
                                                    Atendimento
                                                    <svg
                                                        class="-mr-1 ml-2 h-5 w-5"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20"
                                                        fill="currentColor"
                                                        aria-hidden="true"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd"
                                                        />
                                                    </svg>
                                                </button>
                                            </div>

                                            <!-- Dropdown menu -->
                                            <div
                                                v-show="
                                                    openDropdownId ===
                                                    consulta.id
                                                "
                                                class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50"
                                                style="position: fixed"
                                                :style="{
                                                    top:
                                                        dropdownPosition.y +
                                                        'px',
                                                    left:
                                                        dropdownPosition.x +
                                                        'px',
                                                }"
                                            >
                                                <div
                                                    class="py-1"
                                                    role="menu"
                                                    aria-orientation="vertical"
                                                    aria-labelledby="options-menu"
                                                >
                                                    <Link
                                                        :href="`/consulta/atendimento/anamnese/${consulta.id}`"
                                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                                        role="menuitem"
                                                    >
                                                        <i
                                                            class="fas fa-file-medical mr-2"
                                                        ></i>
                                                        Cadastrar Anamnese
                                                    </Link>
                                                    <Link
                                                        :href="`/consulta/atendimento/acompanhamento/${consulta.id}`"
                                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                                        role="menuitem"
                                                    >
                                                        <i
                                                            class="fas fa-user-clock mr-2"
                                                        ></i>
                                                        Cadastrar Acompanhamento
                                                    </Link>
                                                    <Link
                                                        :href="`/consulta/atendimento/evolucao/${consulta.id}`"
                                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                                        role="menuitem"
                                                    >
                                                        <i
                                                            class="fas fa-chart-line mr-2"
                                                        ></i>
                                                        Cadastrar Evolução
                                                    </Link>
                                                    <div
                                                        class="border-t border-gray-100"
                                                    ></div>
                                                </div>
                                            </div>
                                        </div>
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
const currentPage = ref(1);
const perPage = ref(10);

const getModalidadeClass = (modalidade) => {
    return {
        "bg-blue-100 text-blue-800": modalidade === "Primeira Consulta",
        "bg-yellow-100 text-yellow-800": modalidade === "Acompanhamento",
        "bg-green-100 text-green-800": modalidade === "Bioimpedância",
    };
};

const totalPages = computed(() => {
    return Math.ceil(page.props.consultas.length / perPage.value);
});

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

const openDropdownId = ref(null);

const dropdownPosition = ref({ x: 0, y: 0 });

const toggleActionsDropdown = (id, event) => {
    if (openDropdownId.value === id) {
        openDropdownId.value = null;
    } else {
        const buttonRect = event.currentTarget.getBoundingClientRect();
        dropdownPosition.value = {
            x: buttonRect.left + window.scrollX,
            y: buttonRect.bottom + window.scrollY,
        };
        openDropdownId.value = id;
    }
};

const closeDropdown = () => {
    openDropdownId.value = null;
};

document.addEventListener("click", (e) => {
    if (!e.target.closest(".relative.inline-block.text-left")) {
        closeDropdown();
    }
});

const deleteConsulta = (id) => {
    router.delete(`/consulta/${id}`, {
        onSuccess: () => {
            alert(page.props.message);
        },
        onError: () => {},
    });
};
</script>

<style scoped>
/* Estilos adicionais podem ser colocados aqui */
</style>
