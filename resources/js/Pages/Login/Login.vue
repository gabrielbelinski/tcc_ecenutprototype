<script setup>
import { useForm } from "@inertiajs/vue3";
import LoginLayout from "@/Layouts/LoginLayout.vue";

const data = useForm({
    email: null,
    senha: null,
});
const login = () => {
    data.post("/login", {
        onError: (errors) => {
            const errorMessages = Object.values(errors);
            alert(errorMessages);
        },
        onSuccess: () => {
            console.log("Formulário enviado com sucesso!");
        },
    });
};
</script>

<template>
    <LoginLayout>
        <div class="relative z-10 w-full backdrop-blur-xs">
            <div class="flex justify-center py-3 px-3 space-x-6">
                <div
                    class="bg-gray-100 rounded-lg shadow-md p-8 max-w-sm w-full"
                >
                    <img
                        class="invert mx-auto"
                        src="https://www3.unicentro.br/cenut/wp-content/uploads/sites/161/2017/06/logo_Cenut-cabecalho.png"
                    />
                    <h1
                        class="text-lg font-bold mt-3 mb-3 text-center text-gray-800"
                    >
                        Identifique-se para continuar
                    </h1>
                    <form @submit.prevent="login">
                        <FormKit
                            type="text"
                            label="Email"
                            v-model="data.email"
                        ></FormKit>
                        <FormKit
                            type="password"
                            label="Senha"
                            v-model="data.senha"
                        ></FormKit>
                        <div class="mt-7">
                            <FormKit
                                type="submit"
                                label="Entrar"
                                outer-class="mx-auto max-w-xs"
                                input-class="w-full flex justify-center items-center"
                                wrapper-class="flex justify-center"
                            />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </LoginLayout>
</template>
