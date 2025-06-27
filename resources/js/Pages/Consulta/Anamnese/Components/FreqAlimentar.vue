<template>
    <div class="mb-4">
        <FormKit
            type="number"
            min="0"
            max="10"
            :label="nome + ' - Quantidade'"
            :value="qtd"
            @input="$emit('update:qtd', $event)"
        />
        <FormKit
            type="select"
            label="Frequência"
            v-model="frequenciaProxy"
            :options="
                ['Dia', 'Semana', 'Mês', 'Ano', 'Não consome'].map((t) => ({
                    value: t,
                    label: t,
                }))
            "
        />
    </div>
</template>

<script setup>
const props = defineProps({
    nome: String,
    qtd: [Number, null],
    frequencia: String,
});

const emit = defineEmits(["update:qtd", "update:frequencia"]);

import { computed } from "vue";

const frequenciaProxy = computed({
    get: () => props.frequencia,
    set: (val) => emit("update:frequencia", val),
});
</script>
