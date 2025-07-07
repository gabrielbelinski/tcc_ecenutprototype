<template>
    <MainLayout>
        <FormKit type="form" @submit="create" :actions="false">
            <FormKit type="multi-step" tab-style="progress">
                <!-- Passo 1: Identificação -->
                <FormKit type="step" name="identificacao" label="Identificação">
                    <FormKit
                        type="text"
                        v-model="form.nome"
                        label="Nome completo"
                        validation="required"
                    />

                    <FormKit
                        type="date"
                        v-model="form.data_nascimento"
                        label="Data de Nascimento"
                        validation="required"
                    />

                    <FormKit
                        type="select"
                        v-model="form.genero"
                        label="Gênero"
                        :options="[
                            { value: '', label: 'Selecione' },
                            { value: 'Masculino', label: 'Masculino' },
                            { value: 'Feminino', label: 'Feminino' },
                            { value: 'Outro', label: 'Outro' },
                            {
                                value: 'Prefere não informar',
                                label: 'Prefere não informar',
                            },
                        ]"
                    />

                    <FormKit
                        type="text"
                        v-model="form.cpf"
                        label="CPF"
                        placeholder="000.000.000-00"
                        validation="required"
                    />

                    <FormKit
                        type="text"
                        v-model="form.rg"
                        label="RG"
                        placeholder="00.000.000-0"
                    />
                </FormKit>

                <!-- Passo 2: Informações Funcionais -->
                <FormKit
                    type="step"
                    name="informacoes_funcionais"
                    label="Informações Funcionais"
                >
                    <FormKit
                        type="text"
                        v-model="form.matricula"
                        label="Matrícula/Registro Acadêmico"
                        placeholder="RA (estagiário) ou Matrícula (docente/secretário)"
                    />

                    <FormKit
                        type="email"
                        v-model="form.email"
                        label="Email institucional"
                        placeholder="email@unicentro.br"
                        validation="required|email"
                    />

                    <FormKit
                        type="tel"
                        v-model="form.telefone"
                        label="Telefone"
                        placeholder="DDD + Número"
                    />

                    <FormKit
                        type="select"
                        v-model="form.tipo_usuario"
                        label="Tipo de Usuário"
                        :options="[
                            { value: '', label: 'Selecione' },
                            { value: 'Docente', label: 'Docente' },
                            { value: 'Estagiário', label: 'Estagiário' },
                            { value: 'Secretário', label: 'Secretário' },
                        ]"
                        validation="required"
                    />
                </FormKit>

                <!-- Passo 3: Endereço -->
                <FormKit type="step" name="endereco" label="Endereço">
                    <FormKit
                        type="text"
                        v-model="form.rua"
                        label="Logradouro"
                        placeholder="Rua, avenida, alameda"
                    />

                    <FormKit
                        type="text"
                        v-model="form.numero"
                        label="Número"
                        placeholder="Nº"
                    />

                    <FormKit type="text" v-model="form.bairro" label="Bairro" />

                    <FormKit
                        type="text"
                        v-model="form.cep"
                        label="CEP"
                        placeholder="00000-000"
                    />

                    <FormKit type="text" v-model="form.cidade" label="Cidade" />

                    <FormKit
                        type="select"
                        v-model="form.estado"
                        label="Estado"
                        :options="estadosBrasil"
                    />

                    <template #stepNext>
                        <FormKit type="submit" label="Cadastrar"></FormKit>
                    </template>
                </FormKit>
            </FormKit>
        </FormKit>
    </MainLayout>
</template>

<script setup>
import MainLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm, usePage } from "@inertiajs/vue3";
const page = usePage();

const form = useForm({
    email: null,
    matricula: null,
    genero: null,
    data_nascimento: null,
    data_inativacao: null,
    nome: null,
    telefone: null,
    rg: null,
    cpf: null,
    rua: null,
    numero: null,
    bairro: null,
    cep: null,
    cidade: null,
    estado: null,
    tipo_usuario: null,
});

const estadosBrasil = [
    { value: "", label: "Selecione" },
    { value: "AC", label: "Acre" },
    { value: "AL", label: "Alagoas" },
    { value: "AP", label: "Amapá" },
    { value: "AM", label: "Amazonas" },
    { value: "BA", label: "Bahia" },
    { value: "CE", label: "Ceará" },
    { value: "DF", label: "Distrito Federal" },
    { value: "ES", label: "Espírito Santo" },
    { value: "GO", label: "Goiás" },
    { value: "MA", label: "Maranhão" },
    { value: "MT", label: "Mato Grosso" },
    { value: "MS", label: "Mato Grosso do Sul" },
    { value: "MG", label: "Minas Gerais" },
    { value: "PA", label: "Pará" },
    { value: "PB", label: "Paraíba" },
    { value: "PR", label: "Paraná" },
    { value: "PE", label: "Pernambuco" },
    { value: "PI", label: "Piauí" },
    { value: "RJ", label: "Rio de Janeiro" },
    { value: "RN", label: "Rio Grande do Norte" },
    { value: "RS", label: "Rio Grande do Sul" },
    { value: "RO", label: "Rondônia" },
    { value: "RR", label: "Roraima" },
    { value: "SC", label: "Santa Catarina" },
    { value: "SP", label: "São Paulo" },
    { value: "SE", label: "Sergipe" },
    { value: "TO", label: "Tocantins" },
];

const create = () => {
    form.post("/usuario");
};
</script>
