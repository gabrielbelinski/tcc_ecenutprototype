<script setup>
import MainLayout from "@/Layouts/AuthenticatedLayout.vue";
</script>

<template>
    <MainLayout>
        <div class="flex flex-1 items-center justify-center p-4">
            <div
                class="welcome-container bg-gray-100 p-8 rounded-lg shadow-md max-w-2xl w-full text-center items-center"
            >
                <img
                    src="https://www3.unicentro.br/cenut/wp-content/uploads/sites/161/2017/06/Clinica-Escola-Nutricao-01.png"
                    alt="Logo eCENUT"
                    class="animate-fade-in-up mx-auto"
                    style="width: 300px; height: auto"
                />
                <h1
                    class="text-3xl font-bold text-gray-700 mb-4 animate-fade-in-up"
                >
                    Seja bem-vindo(a) ao eCenut!
                </h1>
                <p
                    class="text-lg text-gray-700 animate-fade-in-up animation-delay-300"
                >
                    Sistema de apoio à gestão da Clínica Escola de Nutrição
                    (CENUT) da Unicentro
                </p>
            </div>
        </div>
    </MainLayout>
</template>
