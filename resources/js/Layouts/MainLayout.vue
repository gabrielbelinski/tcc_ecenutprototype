<template>
    <div class="relative flex min-h-screen flex-col bg-fundo-cenut">
        <Header class="z-20" />

        <!-- Conteúdo principal com padding-top para evitar sobreposição -->
        <div class="relative z-10 flex flex-1 flex-col pt-16 backdrop-blur-sm">
            <!-- Ajuste o pt-16 conforme a altura do seu header -->
            <main class="flex flex-1 justify-center p-4">
                <div class="container mx-auto px-4 py-6 max-w-6xl">
                    <!-- Container fixo com largura máxima -->
                    <div class="bg-gray-200 rounded-lg shadow-md p-6">
                        <slot />
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>

<script setup>
import Header from "./Header.vue";
</script>
