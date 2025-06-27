<template>
    <div
        class="bg-gray-200 border-b border-gray-200 w-full h-20 fixed top-0 z-50"
    >
        <div class="flex justify-between items-center h-full px-4">
            <!-- Logo -->
            <div class="flex items-center">
                <Link href="/">
                    <img
                        class="invert h-12 object-contain max-w-[180px]"
                        src="https://www3.unicentro.br/cenut/wp-content/uploads/sites/161/2017/06/logo_Cenut-cabecalho.png"
                    />
                </Link>
            </div>

            <!-- Menu principal -->
            <div class="flex items-center space-x-6">
                <div
                    v-for="section in sections"
                    :key="section.title"
                    class="relative group"
                >
                    <!-- Botão do dropdown -->
                    <button
                        class="flex items-center px-3 py-2 text-gray-600 hover:text-green-700 transition"
                    >
                        <span class="mr-1">{{ section.title }}</span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </button>

                    <!-- Dropdown content -->
                    <div
                        class="absolute right-0 mt-2 w-56 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-opacity duration-200 z-50"
                    >
                        <div class="py-1">
                            <Link
                                v-for="(item, index) in section.items"
                                :href="item.href"
                                :key="index"
                                class="group flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-green-700"
                            >
                                <component
                                    :is="item.icon"
                                    class="h-5 w-5 text-gray-400 group-hover:text-green-700 mr-3"
                                />
                                {{ item.label }}
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";
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

export default {
    components: {
        Link,
    },
    data() {
        return {
            sections: [
                {
                    title: "Início",
                    items: [
                        { href: "/", label: "Página Inicial", icon: HomeIcon },
                    ],
                },
                {
                    title: "Cadastro",
                    items: [
                        {
                            href: "usuario/",
                            label: "Usuários",
                            icon: UserPlusIcon,
                        },
                        {
                            href: "paciente/",
                            label: "Pacientes",
                            icon: UserGroupIcon,
                        },
                    ],
                },
                {
                    title: "Agendamento",
                    items: [
                        {
                            href: "/consulta/create",
                            label: "Nova consulta",
                            icon: ClockIcon,
                        },
                        {
                            href: "/consulta",
                            label: "Ver agenda",
                            icon: CalendarDaysIcon,
                        },
                    ],
                },
                {
                    title: "Atendimento",
                    items: [
                        {
                            href: "/consulta/atendimento",
                            label: "Iniciar",
                            icon: TableCellsIcon,
                        },
                        {
                            href: "/",
                            label: "Prontuários",
                            icon: DocumentMagnifyingGlassIcon,
                        },
                    ],
                },
                {
                    title: "Avaliação",
                    items: [
                        {
                            href: "/",
                            label: "Submissão",
                            icon: DocumentArrowUpIcon,
                        },
                        {
                            href: "/",
                            label: "Correção",
                            icon: DocumentCheckIcon,
                        },
                    ],
                },
                {
                    title: "Sessão",
                    items: [
                        {
                            href: "/",
                            label: "Meu perfil",
                            icon: ArrowPathIcon,
                        },
                        {
                            href: "/",
                            label: "Sair",
                            icon: UserIcon,
                        },
                    ],
                },
            ],
        };
    },
};
</script>
