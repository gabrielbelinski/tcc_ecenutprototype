<template>
    <MainLayout>
        <FormKit type="form" @submit="create" :actions="false">
            <FormKit type="multi-step" tab-style="progress">
                <FormKit type="step" name="agendamento" label="Agendamento">
                    <div>
                        <label
                            class="block text-neutral-700 text-base font-bold dark:text-neutral-300 mb-1.5 formkit-label"
                            >Nome ou CPF do paciente</label
                        >
                        <Combobox v-model="selected" nullable>
                            <div class="relative">
                                <ComboboxInput
                                    class="text-lg flex items-center w-full py-2.5 px-3.5 mb-3 rounded-full border border-neutral-400 bg-white focus-within:ring-1 focus-within:!ring-green-500 focus-within:!border-green-500 group-data-[invalid]:border-red-500 group-data-[invalid]:ring-1 group-data-[invalid]:ring-red-500 group-data-[disabled]:bg-neutral-100 group-data-[disabled]:!cursor-not-allowed shadow group-[]/repeater:shadow-none group-[]/multistep:shadow-none dark:bg-transparent dark:border-neutral-500 dark:group-data-[disabled]:bg-neutral-800/5 dark:group-data-[invalid]:border-red-500 dark:group-data-[invalid]:ring-red-500 formkit-inner"
                                    :displayValue="(paciente) => paciente?.nome"
                                    @change="query = $event.target.value"
                                    placeholder="Buscar por nome ou CPF"
                                />
                                <ComboboxOptions
                                    class="absolute z-10 w-full mt-1 bg-white border rounded-md shadow-lg max-h-60 overflow-auto"
                                >
                                    <ComboboxOption
                                        v-for="paciente in filteredPacientes"
                                        :key="paciente.id"
                                        :value="paciente"
                                        v-slot="{ active, selected }"
                                    >
                                        <li
                                            :class="[
                                                'px-4 py-2 cursor-pointer',
                                                active
                                                    ? 'bg-green-100'
                                                    : 'bg-white',
                                            ]"
                                        >
                                            <div class="flex justify-between">
                                                <span>{{ paciente.nome }}</span>
                                                <span
                                                    class="text-gray-500 text-sm"
                                                    >{{ paciente.cpf }}</span
                                                >
                                            </div>
                                            <div
                                                v-if="selected"
                                                class="text-green-600 text-xs"
                                            >
                                                Selecionado
                                            </div>
                                        </li>
                                    </ComboboxOption>
                                </ComboboxOptions>
                            </div>
                        </Combobox>
                    </div>
                    <FormKit
                        type="date"
                        label="Data do atendimento"
                        v-model="form.data_consulta"
                        validation="required"
                    />

                    <FormKit
                        type="time"
                        label="Horário"
                        v-model="form.hora_consulta"
                        validation="required"
                    />

                    <FormKit
                        type="radio"
                        label="Modalidade de consulta"
                        v-model="form.modalidade_consulta"
                        :options="[
                            {
                                value: 'Primeira Consulta',
                                label: 'Primeira Consulta',
                            },
                            {
                                value: 'Acompanhamento',
                                label: 'Acompanhamento',
                            },
                            { value: 'Bioimpedância', label: 'Bioimpedância' },
                        ]"
                        validation="required"
                    />
                </FormKit>
                <FormKit type="step" name="pagamento" label="Pagamento">
                    <FormKit
                        type="select"
                        label="Forma de Pagamento"
                        v-model="form.forma_pagamento"
                        :options="[
                            { value: '', label: 'Selecione' },
                            { value: 'Dinheiro', label: 'Dinheiro' },
                            { value: 'Pix', label: 'Pix' },
                            {
                                value: 'Cartão de Crédito',
                                label: 'Cartão de Crédito',
                            },
                            {
                                value: 'Cartão de Débito',
                                label: 'Cartão de Débito',
                            },
                            {
                                value: 'Isento',
                                label: 'Isento',
                            },
                        ]"
                        validation="required"
                    />

                    <FormKit
                        v-show="form.forma_pagamento == 'Pix'"
                        type="file"
                        label="Comprovante de Pix"
                        accept=".pdf,.jpg,.jpeg,.png"
                        help="Anexar o comprovante de Pix"
                    />
                </FormKit>
                <FormKit type="step" name="observacoes" label="Observações">
                    <FormKit
                        label="Observações"
                        type="textarea"
                        v-model="form.observacoes_consulta"
                        rows="3"
                    />

                    <template #stepNext>
                        <FormKit type="submit" label="Finalizar"></FormKit>
                    </template>
                </FormKit>
            </FormKit>
        </FormKit>
    </MainLayout>
</template>

<script setup>
import MainLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { ref, computed, watch } from "vue";
import axios from "axios";
import { debounce } from "lodash";

import {
    Combobox,
    ComboboxInput,
    ComboboxOptions,
    ComboboxOption,
} from "@headlessui/vue";

const form = useForm({
    fk_id_pacientes: null,
    data_consulta: null,
    hora_consulta: null,
    modalidade_consulta: null,
    status_pagamento: null,
    forma_pagamento: null,
    comprovante_pagamento_url: null,
    valor_total_consulta: null,
    observacoes_consulta: null,
});

const create = () => {
    form.post("/consulta", {
        onError: (errors) => {
            console.error(errors);
        },
        onSuccess: () => {
            console.log("Formulário enviado com sucesso!");
        },
    });
};

const query = ref("");
const pacientes = ref([]);
const selected = ref(null);

watch(selected, (newValue) => {
    if (newValue) {
        form.fk_id_pacientes = newValue.id;
    }
});

// Busca pacientes com debounce
const searchPacientes = debounce(async () => {
    if (query.value.length < 2) {
        pacientes.value = [];
        return;
    }

    try {
        const response = await axios.get("/consulta/searchPaciente", {
            params: { search: query.value },
        });
        pacientes.value = response.data;
    } catch (error) {
        console.error("Erro na busca de pacientes:", error);
        pacientes.value = [];
    }
}, 300);

// Filtra pacientes baseado na query
const filteredPacientes = computed(() => {
    if (query.value === "") {
        return pacientes.value;
    }
    return pacientes.value.filter((paciente) => {
        return (
            paciente.nome.toLowerCase().includes(query.value.toLowerCase()) ||
            paciente.cpf.includes(query.value)
        );
    });
});

// Dispara a busca quando a query muda
watch(query, searchPacientes);
</script>
