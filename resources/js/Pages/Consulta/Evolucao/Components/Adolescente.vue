<template>
    <FormKit type="step" name="antropometria" stepName="Antropometria">
        <FormKit
            type="text"
            label="Peso"
            placeholder="kg"
            v-model="modelValue.peso"
            validation="optional|number"
        />

        <FormKit
            type="text"
            label="Estatura"
            placeholder="m"
            v-model="modelValue.estatura"
            validation="optional|number"
        />

        <FormKit
            type="text"
            label="Circunferência do Braço"
            placeholder="cm"
            v-model="modelValue.circunferencia_braco"
            validation="optional|number"
        />

        <FormKit
            type="text"
            label="Gordura corporal da BIA (%)"
            placeholder="%"
            v-model="modelValue.gordura_corporal_bia"
            validation="optional|number|between:0,100"
        />
    </FormKit>

    <!-- Step 2: Pregas Cutâneas -->
    <FormKit type="step" name="pregas cutâneas" stepName="PregasCutaneas">
        <FormKit
            type="text"
            label="Prega cutânea triciptal - PCT"
            placeholder="mm"
            v-model="modelValue.prega_triciptal_pct"
            validation="optional|number"
        />

        <FormKit
            type="text"
            label="Prega cutânea subescapular - PCSe"
            placeholder="mm"
            v-model="modelValue.prega_subescapular_pcse"
            validation="optional|number"
        />
    </FormKit>

    <!-- Step 3: Exame sanguíneo -->
    <FormKit type="step" name="exame sanguíneo" stepName="ExameSanguineo">
        <FormKit
            type="text"
            label="Colesterol"
            placeholder="mg/dL"
            v-model="modelValue.colesterol"
            validation="optional|number"
        />

        <FormKit
            type="text"
            label="Glicemia"
            placeholder="mg/dL"
            v-model="modelValue.glicemia"
            validation="optional|number"
        />

        <FormKit
            type="text"
            label="Triglicerídeos"
            placeholder="mg/dL"
            v-model="modelValue.triglicerideos"
            validation="optional|number"
        />
    </FormKit>
</template>

<script setup>
defineProps({
    modelValue: {
        type: Object,
        optional: true,
    },
});

defineEmits(["update:modelValue"]);
</script>
