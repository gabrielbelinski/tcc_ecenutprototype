<template>
    <FormKit
        type="radio"
        label="Tipo de registro"
        v-model="modelValue.tipo_registro"
        :options="
            ['Últimas 24h', 'Dia habitual'].map((t) => ({ value: t, label: t }))
        "
    />

    <FormKit
        type="textarea"
        label="Café da Manhã"
        v-model="modelValue.cafe_manha"
        rows="4"
    />

    <FormKit
        type="textarea"
        label="Lanche da Manhã"
        v-model="modelValue.lanche_manha"
        rows="4"
    />

    <FormKit
        type="textarea"
        label="Almoço"
        v-model="modelValue.almoco"
        rows="4"
    />

    <FormKit
        type="textarea"
        label="Lanche da Tarde I"
        v-model="modelValue.lanche_tarde_I"
        rows="4"
    />

    <FormKit
        type="textarea"
        label="Lanche da Tarde II"
        v-model="modelValue.lanche_tarde_II"
        rows="4"
    />

    <FormKit
        type="textarea"
        label="Jantar"
        v-model="modelValue.jantar"
        rows="4"
    />

    <FormKit type="textarea" label="Ceia" v-model="modelValue.ceia" rows="4" />

    <FormKit
        type="textarea"
        label="Outras refeições"
        v-model="modelValue.outros_registro_alimentar"
        rows="4"
    />
</template>

<script setup>
defineProps({
    modelValue: {
        type: Object,
        required: true,
    },
});

defineEmits(["update:modelValue"]);
</script>
