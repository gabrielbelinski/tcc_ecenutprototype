<template>
    <div class="relative flex min-h-screen flex-col bg-fundo-cenut">
        <Header />

        <!-- Conteúdo principal com padding-top para evitar sobreposição -->
        <div class="relative z-10 flex flex-1 flex-col pt-16 backdrop-blur-sm">
            <main class="p-4 justify-items-center">
                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import Header from "@/Layouts/Header.vue";
</script>
