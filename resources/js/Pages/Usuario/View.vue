<template>
    <MainLayout>
        <FormKit type="multi-step" tab-style="progress">
            <FormKit type="step" name="identificacao" label="Identificação">
                <FormKit
                    type="text"
                    :value="page.props.usuario.nome"
                    label="Nome completo"
                    disabled
                    :outer-class="{ 'data-[disabled]:opacity-50': false }"
                />

                <FormKit
                    type="date"
                    :value="page.props.usuario.data_nascimento"
                    label="Data de Nascimento"
                    disabled
                    :outer-class="{ 'data-[disabled]:opacity-50': false }"
                />

                <FormKit
                    type="text"
                    :value="page.props.usuario.genero"
                    label="Gênero"
                    disabled
                    :outer-class="{ 'data-[disabled]:opacity-50': false }"
                />

                <FormKit
                    type="text"
                    :value="page.props.usuario.cpf"
                    label="CPF"
                    disabled
                    :outer-class="{ 'data-[disabled]:opacity-50': false }"
                />

                <FormKit
                    type="text"
                    :value="page.props.usuario.rg"
                    label="RG"
                    disabled
                    :outer-class="{ 'data-[disabled]:opacity-50': false }"
                />
            </FormKit>

            <FormKit
                type="step"
                name="informacoes_funcionais"
                label="Informações Funcionais"
            >
                <FormKit
                    type="text"
                    :value="page.props.usuario.matricula"
                    label="Matrícula/Registro Acadêmico"
                    disabled
                    :outer-class="{ 'data-[disabled]:opacity-50': false }"
                />

                <FormKit
                    type="email"
                    :value="page.props.usuario.email"
                    label="Email institucional"
                    disabled
                    :outer-class="{ 'data-[disabled]:opacity-50': false }"
                />

                <FormKit
                    type="tel"
                    :value="page.props.usuario.telefone"
                    label="Telefone"
                    disabled
                    :outer-class="{ 'data-[disabled]:opacity-50': false }"
                />

                <FormKit
                    type="text"
                    :value="page.props.usuario.tipo_usuario"
                    label="Tipo de Usuário"
                    disabled
                    :outer-class="{ 'data-[disabled]:opacity-50': false }"
                />
            </FormKit>

            <FormKit type="step" name="endereco" label="Endereço">
                <FormKit
                    type="text"
                    :value="page.props.usuario.rua"
                    label="Logradouro"
                    disabled
                    :outer-class="{ 'data-[disabled]:opacity-50': false }"
                />

                <FormKit
                    type="text"
                    :value="page.props.usuario.numero"
                    label="Número"
                    disabled
                    :outer-class="{ 'data-[disabled]:opacity-50': false }"
                />

                <FormKit
                    type="text"
                    :value="page.props.usuario.bairro"
                    label="Bairro"
                    disabled
                    :outer-class="{ 'data-[disabled]:opacity-50': false }"
                />

                <FormKit
                    type="text"
                    :value="page.props.usuario.cep"
                    label="CEP"
                    disabled
                    :outer-class="{ 'data-[disabled]:opacity-50': false }"
                />

                <FormKit
                    type="text"
                    :value="page.props.usuario.cidade"
                    label="Cidade"
                    disabled
                    :outer-class="{ 'data-[disabled]:opacity-50': false }"
                />

                <FormKit
                    type="text"
                    :value="page.props.usuario.estado"
                    label="Estado"
                    disabled
                    :outer-class="{ 'data-[disabled]:opacity-50': false }"
                />

                <template #stepNext>
                    <FormKit
                        type="button"
                        label="Lista de usuários"
                        @click="goToList"
                    />
                </template>
            </FormKit>
        </FormKit>
    </MainLayout>
</template>

<script setup>
import MainLayout from "@/Layouts/AuthenticatedLayout.vue";
import { usePage } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";

const page = usePage();

const goToList = () => {
    router.visit("/usuario");
};
</script>
