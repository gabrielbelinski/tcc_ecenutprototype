<template>
    <MainLayout>
        <FormKit type="form" :actions="false">
            <FormKit type="multi-step" tab-style="progress">
                <FormKit type="step" name="identificação" label="Identificação">
                    <FormKit
                        type="text"
                        name="nome"
                        label="Nome completo do paciente"
                        :value="page.props.paciente.nome"
                        disabled
                        :outer-class="{ 'data-[disabled]:opacity-50': false }"
                    />

                    <FormKit
                        type="date"
                        name="data_nascimento"
                        label="Data de Nascimento"
                        :value="page.props.paciente.data_nascimento"
                        disabled
                        :outer-class="{ 'data-[disabled]:opacity-50': false }"
                    />

                    <FormKit
                        type="text"
                        name="cpf"
                        label="CPF"
                        :value="page.props.paciente.cpf"
                        disabled
                        :outer-class="{ 'data-[disabled]:opacity-50': false }"
                    />

                    <FormKit
                        type="text"
                        name="rg"
                        label="RG"
                        :value="page.props.paciente.rg"
                        disabled
                        :outer-class="{ 'data-[disabled]:opacity-50': false }"
                    />

                    <FormKit
                        type="text"
                        name="genero"
                        label="Gênero"
                        :value="page.props.paciente.genero"
                        disabled
                        :outer-class="{ 'data-[disabled]:opacity-50': false }"
                    />

                    <FormKit
                        type="text"
                        name="grupo_etario"
                        label="Grupo Etário"
                        :value="page.props.paciente.grupo_etario"
                        disabled
                        :outer-class="{ 'data-[disabled]:opacity-50': false }"
                    />

                    <div
                        v-if="
                            !['Adulto', 'Idoso'].includes(
                                page.props.paciente.grupo_etario
                            )
                        "
                    >
                        <FormKit
                            type="text"
                            label="Nome do responsável"
                            :value="page.props.paciente.nome_responsavel"
                            disabled
                            :outer-class="{
                                'data-[disabled]:opacity-50': false,
                            }"
                        />

                        <FormKit
                            type="radio"
                            label="Grau de parentesco"
                            :value="page.props.paciente.parentesco_responsavel"
                            :options="
                                [
                                    'Pai/Mãe',
                                    'Avó/Avô',
                                    'Tio/Tia',
                                    'Irmão/Irmã',
                                    'Outro',
                                ].map((t) => ({ value: t, label: t }))
                            "
                            disabled
                            :outer-class="{
                                'data-[disabled]:opacity-50': false,
                            }"
                        />
                    </div>
                </FormKit>

                <FormKit
                    type="step"
                    name="encaminhamento"
                    label="Encaminhamento"
                >
                    <FormKit
                        type="text"
                        name="aluno_unicentro"
                        label="É aluno da Unicentro?"
                        :value="
                            page.props.paciente.aluno_unicentro ? 'Sim' : 'Não'
                        "
                        disabled
                        :outer-class="{ 'data-[disabled]:opacity-50': false }"
                    />

                    <FormKit
                        type="text"
                        name="encaminhamento"
                        :value="page.props.paciente.encaminhamento"
                        label="Encaminhamento"
                        disabled
                        :outer-class="{ 'data-[disabled]:opacity-50': false }"
                    />
                </FormKit>

                <FormKit type="step" name="endereço" label="Endereco">
                    <FormKit
                        type="text"
                        name="rua"
                        label="Rua"
                        :value="page.props.paciente.rua"
                        disabled
                        :outer-class="{ 'data-[disabled]:opacity-50': false }"
                    />

                    <FormKit
                        type="text"
                        name="numero"
                        label="Número"
                        :value="page.props.paciente.numero"
                        disabled
                        :outer-class="{ 'data-[disabled]:opacity-50': false }"
                    />

                    <FormKit
                        type="text"
                        name="bairro"
                        label="Bairro"
                        :value="page.props.paciente.bairro"
                        disabled
                        :outer-class="{ 'data-[disabled]:opacity-50': false }"
                    />

                    <FormKit
                        type="text"
                        name="cep"
                        label="CEP"
                        :value="page.props.paciente.cep"
                        disabled
                        :outer-class="{ 'data-[disabled]:opacity-50': false }"
                    />

                    <FormKit
                        type="text"
                        name="cidade"
                        label="Cidade"
                        :value="page.props.paciente.cidade"
                        disabled
                        :outer-class="{ 'data-[disabled]:opacity-50': false }"
                    />

                    <FormKit
                        type="text"
                        name="estado"
                        label="Estado"
                        :value="page.props.paciente.estado"
                        disabled
                        :outer-class="{ 'data-[disabled]:opacity-50': false }"
                    />
                </FormKit>

                <FormKit type="step" name="contato" label="Contato">
                    <FormKit
                        type="tel"
                        name="telefone"
                        label="Telefone"
                        :value="page.props.paciente.telefone"
                        disabled
                        :outer-class="{ 'data-[disabled]:opacity-50': false }"
                    />

                    <FormKit
                        type="email"
                        name="email"
                        label="E-mail"
                        :value="page.props.paciente.email"
                        disabled
                        :outer-class="{ 'data-[disabled]:opacity-50': false }"
                    />

                    <template #stepNext>
                        <FormKit
                            type="button"
                            label="Lista de pacientes"
                            @click="goToList"
                        />
                    </template>
                </FormKit>
            </FormKit>
        </FormKit>
    </MainLayout>
</template>

<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { usePage } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";

const page = usePage();

const goToList = () => {
    router.visit("/paciente");
};
</script>
