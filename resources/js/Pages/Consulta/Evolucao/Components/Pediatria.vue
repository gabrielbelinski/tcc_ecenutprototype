<template>
    <FormKit type="step" name="antropometria" stepName="Antropometria">
        <div class="formkit-grid">
            <FormKit
                type="text"
                label="Idade corrigida (anos e meses)"
                v-model="modelValue.idade_corrigida"
                help="Exemplo: 5 anos e 3 meses"
            />

            <FormKit
                type="text"
                label="Peso"
                placeholder="kg"
                v-model="modelValue.peso"
                validation="number"
            />

            <FormKit
                type="text"
                label="Estatura"
                placeholder="m"
                v-model="modelValue.estatura"
                validation="number"
            />

            <FormKit
                type="text"
                label="Circunferência do braço"
                placeholder="cm"
                v-model="modelValue.circunferencia_braco"
                validation="number"
            />

            <FormKit
                type="text"
                label="Gordura corporal da BIA (%) (> 8 anos)"
                placeholder="%"
                v-model="modelValue.gordura_corporal_bia"
                validation="number|between:0,100"
            />
        </div>
    </FormKit>

    <!-- Step 2: Pregas Cutâneas -->
    <FormKit type="step" name="pregas cutâneas" stepName="PregasCutaneas">
        <div class="formkit-grid">
            <FormKit
                type="text"
                label="Gordura corporal pregas (%) (> 8 anos)"
                placeholder="%"
                v-model="modelValue.gordura_corporal_pregas"
                validation="number|between:0,100"
            />

            <FormKit
                type="text"
                label="Prega cutânea triciptal - PCB (>8 anos)"
                placeholder="mm"
                v-model="modelValue.prega_triciptal_pct"
                validation="number"
            />

            <FormKit
                type="text"
                label="Prega cutânea subescapular - PCSe (>8 anos)"
                placeholder="mm"
                v-model="modelValue.prega_subescapular_pcse"
                validation="number"
            />
        </div>
    </FormKit>

    <FormKit type="step" name="exame sanguíneo" stepName="ExameSanguineo">
        <div class="formkit-grid">
            <FormKit
                type="text"
                label="Colesterol"
                placeholder="mg/dL"
                v-model="modelValue.colesterol"
                validation="number"
            />

            <FormKit
                type="text"
                label="Glicemia"
                placeholder="mg/dL"
                v-model="modelValue.glicemia"
                validation="number"
            />

            <FormKit
                type="text"
                label="Triglicerídeos"
                placeholder="mg/dL"
                v-model="modelValue.triglicerideos"
                validation="number"
            />
        </div>
    </FormKit>
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
