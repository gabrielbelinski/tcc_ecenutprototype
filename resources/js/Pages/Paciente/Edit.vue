<template>
    <MainLayout>
        <FormKit type="form" @submit="update" :actions="false">
            <FormKit type="multi-step" tab-style="progress">
                <FormKit type="step" name="identificação" label="Identificação">
                    <FormKit
                        type="text"
                        name="nome"
                        label="Nome completo do paciente"
                        v-model="form.nome"
                        validation="required"
                    />

                    <FormKit
                        type="date"
                        name="data_nascimento"
                        label="Data de Nascimento"
                        v-model="form.data_nascimento"
                        validation="required"
                    />

                    <FormKit
                        type="text"
                        name="cpf"
                        label="CPF"
                        placeholder="000.000.000-00"
                        v-model="form.cpf"
                        validation="required"
                    />

                    <FormKit
                        type="text"
                        name="rg"
                        label="RG"
                        v-model="form.rg"
                        placeholder="00.000.000-0"
                    />

                    <FormKit
                        type="select"
                        name="genero"
                        label="Gênero"
                        v-model="form.genero"
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
                        type="select"
                        name="grupo_etario"
                        label="Grupo Etário"
                        v-model="form.grupo_etario"
                        :options="[
                            { value: '', label: 'Selecione' },
                            { value: 'Recém nascido', label: 'Recém nascido' },
                            { value: 'Criança', label: 'Criança' },
                            { value: 'Adolescente', label: 'Adolescente' },
                            { value: 'Adulto', label: 'Adulto' },
                            { value: 'Idoso', label: 'Idoso' },
                        ]"
                    />

                    <div
                        v-show="
                            [
                                'Recém nascido',
                                'Criança',
                                'Adolescente',
                            ].includes(form.grupo_etario) &&
                            form.grupo_etario != null
                        "
                    >
                        <FormKit
                            type="text"
                            label="Nome do responsável"
                            v-model="form.nome_responsavel"
                        />

                        <FormKit
                            type="radio"
                            label="Grau de parentesco"
                            v-model="form.parentesco_responsavel"
                            :options="
                                [
                                    'Pai/Mãe',
                                    'Avó/Avô',
                                    'Tio/Tia',
                                    'Irmão/Irmã',
                                    'Outro',
                                ].map((t) => ({ value: t, label: t }))
                            "
                        />
                    </div>
                </FormKit>

                <FormKit
                    type="step"
                    name="encaminhamento"
                    label="Encaminhamento"
                >
                    <FormKit
                        type="select"
                        name="aluno_unicentro"
                        label="É aluno da Unicentro?"
                        v-model="form.aluno_unicentro"
                        :options="[
                            { value: '', label: 'Selecione' },
                            { value: true, label: 'Sim' },
                            { value: false, label: 'Não' },
                        ]"
                    />

                    <FormKit
                        type="select"
                        name="encaminhamento"
                        v-model="form.encaminhamento"
                        label="Encaminhamento"
                        :options="[
                            { value: '', label: 'Selecione' },
                            { value: 'Particular', label: 'Particular' },
                            {
                                value: 'Médico',
                                label: 'Médico Clínico Geral/Especialista',
                            },
                            {
                                value: 'SUS',
                                label: 'Sistema Único de Saúde (SUS)',
                            },
                            {
                                value: 'UBS',
                                label: 'Unidade Básica de Saúde (UBS)',
                            },
                            { value: 'Escola', label: 'Escola' },
                            { value: 'CEFISIO', label: 'CEFISIO' },
                            { value: 'CAEEF', label: 'CAEEF' },
                            {
                                value: 'Personal Trainer',
                                label: 'Personal Trainer',
                            },
                            { value: 'Outro', label: 'Outro' },
                        ]"
                    />
                </FormKit>

                <FormKit type="step" name="endereço" label="Endereco">
                    <FormKit
                        type="text"
                        name="rua"
                        label="Rua"
                        v-model="form.rua"
                    />

                    <FormKit
                        type="text"
                        name="numero"
                        label="Número"
                        v-model="form.numero"
                    />

                    <FormKit
                        type="text"
                        name="bairro"
                        label="Bairro"
                        v-model="form.bairro"
                    />

                    <FormKit
                        type="text"
                        name="cep"
                        label="CEP"
                        placeholder="00000-000"
                        v-model="form.cep"
                    />

                    <FormKit
                        type="text"
                        name="cidade"
                        label="Cidade"
                        v-model="form.cidade"
                    />

                    <FormKit
                        type="select"
                        name="estado"
                        label="Estado"
                        v-model="form.estado"
                        :options="estadosBrasil"
                    />
                </FormKit>

                <FormKit type="step" name="contato" label="Contato">
                    <FormKit
                        type="tel"
                        name="telefone"
                        label="Telefone"
                        v-model="form.telefone"
                        placeholder="(00) 00000-0000"
                    />

                    <FormKit
                        type="email"
                        name="email"
                        label="E-mail"
                        v-model="form.email"
                    />

                    <template #stepNext>
                        <FormKit type="submit" label="Atualizar"></FormKit>
                    </template>
                </FormKit>
            </FormKit>
        </FormKit>
    </MainLayout>
</template>

<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { useForm, usePage } from "@inertiajs/vue3";

const page = usePage();

const form = useForm({
    id: page.props.paciente.id,
    nome: page.props.paciente.nome,
    data_nascimento: page.props.paciente.data_nascimento,
    cpf: page.props.paciente.cpf,
    rg: page.props.paciente.rg,
    encaminhamento: page.props.paciente.encaminhamento,
    telefone: page.props.paciente.telefone,
    email: page.props.paciente.email,
    aluno_unicentro: page.props.paciente.aluno_unicentro,
    genero: page.props.paciente.genero,
    grupo_etario: page.props.paciente.grupo_etario,
    rua: page.props.paciente.rua,
    numero: page.props.paciente.numero,
    bairro: page.props.paciente.bairro,
    cep: page.props.paciente.cep,
    cidade: page.props.paciente.cidade,
    estado: page.props.paciente.estado,
    nome_responsavel: page.props.paciente.nome_responsavel,
    parentesco_responsavel: page.props.paciente.parentesco_responsavel,
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

const update = () => {
    form.put(`/paciente/${page.props.paciente.id}`, {
        onError: (errors) => {
            console.error(errors);
        },
        onSuccess: () => {
            console.log("Formulário enviado com sucesso!");
        },
    });
};
</script>
