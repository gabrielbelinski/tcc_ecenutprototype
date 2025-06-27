<script setup></script>

<template>
    <div class="relative flex min-h-screen overflow-hidden">
        <div
            class="absolute inset-0 bg-cover bg-center"
            style="
                background-image: url('https://www3.unicentro.br/noticias/wp-content/uploads/sites/3/2024/06/WhatsApp-Image-2024-06-17-at-11.04.55.jpeg');
            "
        ></div>

        <div class="relative z-10 w-full backdrop-blur-xs">
            <div class="flex justify-center py-10 px-10 space-x-6">
                <div
                    class="bg-gray-200 rounded-lg shadow-md p-8 max-w-sm w-full"
                >
                    <img
                        class="invert mx-auto"
                        src="https://www3.unicentro.br/cenut/wp-content/uploads/sites/161/2017/06/logo_Cenut-cabecalho.png"
                    />
                    <h1
                        class="text-2xl font-bold mt-3 mb-3 text-center text-gray-800"
                    >
                        Bem-vindo(a)!
                    </h1>
                    <form @submit.prevent="login">
                        <div class="fields mb-3">
                            <label for="email">E-mail</label>
                            <input
                                v-model="email"
                                type="email"
                                id="email"
                                required
                                placeholder="email@unicentro.br"
                            />
                        </div>
                        <div class="fields mb-5">
                            <label for="password">Senha</label>
                            <input
                                v-model="password"
                                type="password"
                                id="password"
                                required
                                placeholder="********"
                            />
                        </div>
                        <button
                            type="submit"
                            class="w-full bg-green-600 text-white py-2 rounded-md font-semibold hover:bg-green-800 transition-colors duration-300"
                        >
                            Entrar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
