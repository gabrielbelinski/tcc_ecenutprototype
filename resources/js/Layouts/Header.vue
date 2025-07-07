<template>
    <n-layout-header
        class="flex justify-between items-center px-6 py-2 bg-gray-100 shadow"
        bordered
    >
        <img
            src="https://www3.unicentro.br/cenut/wp-content/uploads/sites/161/2017/06/logo_Cenut-cabecalho.png"
            alt="Logo"
            class="h-8 invert"
        />
        <!-- Logo -->

        <!-- Menus agrupados -->
        <div class="flex items-center gap-6">
            <n-dropdown
                v-for="section in filteredSections"
                :key="section.title"
                trigger="hover"
                :options="getDropdownOptions(section.items)"
            >
                <n-button text>{{ section.title }}</n-button>
            </n-dropdown>
        </div>

        <!-- Sessão: Perfil e Sair -->
        <div class="flex items-center gap-2">
            <div class="text-right">
                <p class="text-xs font-medium">{{ props.auth.user.nome }}</p>
                <p class="text-xs text-gray-500 capitalize">{{ userType }}</p>
            </div>
            <n-dropdown :options="getDropdownOptions(sessionSection.items)">
                <n-button quaternary circle>
                    <UserIcon class="w-5 h-5" />
                </n-button>
            </n-dropdown>
        </div>
    </n-layout-header>
</template>

<script setup>
import { h, computed } from "vue";
import { router } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
const { props } = usePage();
const userType = props.auth.user.tipo_usuario;

import {
    UserGroupIcon,
    UserPlusIcon,
    HomeIcon,
    ClockIcon,
    CalendarDaysIcon,
    TableCellsIcon,
    DocumentMagnifyingGlassIcon,
    DocumentCheckIcon,
    DocumentArrowUpIcon,
    ArrowPathIcon,
    UserIcon,
} from "@heroicons/vue/24/solid";
import {
    NLayout,
    NLayoutHeader,
    NLayoutContent,
    NButton,
    NDropdown,
} from "naive-ui";

// Todos os menus disponíveis
const allSections = [
    {
        title: "Início",
        items: [{ href: "/", label: "Página Inicial", icon: HomeIcon }],
        allowed: ["Docente", "Estagiário", "Secretário"], // Todos podem ver
    },
    {
        title: "Cadastro",
        items: [
            { href: "/usuario", label: "Usuários", icon: UserPlusIcon },
            { href: "/paciente", label: "Pacientes", icon: UserGroupIcon },
        ],
        allowed: ["Secretário"],
    },
    {
        title: "Agendamento",
        items: [
            {
                href: "/consulta/create",
                label: "Nova consulta",
                icon: ClockIcon,
            },
            { href: "/consulta", label: "Ver agenda", icon: CalendarDaysIcon },
        ],
        allowed: ["Docente", "Secretário"],
    },
    {
        title: "Atendimento",
        items: [
            {
                href: "/consulta/atendimento",
                label: "Atendimentos",
                icon: TableCellsIcon,
            },
            {
                href: "/consulta/atendimento/prontuarios",
                label: "Prontuários",
                icon: DocumentMagnifyingGlassIcon,
            },
        ],
        allowed: ["Docente", "Estagiário"],
    },
    {
        title: "Avaliação",
        items: [
            { href: "/", label: "Submissão", icon: DocumentArrowUpIcon },
            { href: "/", label: "Correção", icon: DocumentCheckIcon },
        ],
        allowed: ["Docente", "Estagiário"],
    },
];

// Filtra as seções baseadas no tipo de usuário
const filteredSections = computed(() => {
    return allSections.filter(
        (section) =>
            section.allowed.includes(userType) || section.allowed.length === 0
    );
});

// Sessão separada (direita)
const sessionSection = {
    items: [{ label: "Sair", icon: UserIcon, action: "logout" }],
};

// Função para montar os itens dropdown
function getDropdownOptions(items) {
    return items.map((item) => ({
        label: item.label,
        key: item.href || item.action,
        icon: () => h(item.icon, { class: "w-5 h-5" }),
        props: {
            onClick: () => {
                if (item.action === "logout") {
                    router.post("/logout");
                } else {
                    window.location.href = item.href;
                }
            },
        },
    }));
}
</script>

<style scoped>
.n-layout-header {
    height: 64px;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 50;
}
</style>
