<template>
    <FormKit type="step" name="antropometria" stepName="Antropometria">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                label="Pressão arterial"
                v-model="modelValue.pressao_arterial"
            />

            <FormKit
                type="text"
                label="IMC"
                placeholder="kg/m²"
                v-model="modelValue.imc"
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
                label="Circunferência da cintura"
                placeholder="cm"
                v-model="modelValue.circunferencia_cintura"
                validation="number"
            />

            <FormKit
                type="text"
                label="Gordura corporal da BIA bipolar"
                placeholder="%"
                v-model="modelValue.gordura_corporal_bia"
                validation="number|between:0,100"
            />
        </div>
    </FormKit>

    <!-- Step 2: Pregas Cutâneas -->
    <FormKit type="step" name="pregas cutâneas" stepName="PregasCutaneas">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <FormKit
                type="text"
                label="Prega cutânea triciptal (PCT)"
                placeholder="mm"
                v-model="modelValue.prega_triciptal_pct"
                validation="number"
            />

            <FormKit
                type="text"
                label="Prega cutânea biciptal (PCB)"
                placeholder="mm"
                v-model="modelValue.prega_biciptal_pcb"
                validation="number"
            />

            <FormKit
                type="text"
                label="Prega cutânea subescapular (PCSe)"
                placeholder="mm"
                v-model="modelValue.prega_subescapular_pcse"
                validation="number"
            />

            <FormKit
                type="text"
                label="Prega cutânea suprailíaca (PCSi)"
                placeholder="mm"
                v-model="modelValue.prega_supra_iliaca_pcsi"
                validation="number"
            />

            <FormKit
                type="text"
                label="Prega cutânea torácica (PTx)"
                placeholder="mm"
                v-model="modelValue.prega_toracica_ptx"
                validation="number"
            />

            <FormKit
                type="text"
                label="Prega cutânea da coxa (PCX)"
                placeholder="mm"
                v-model="modelValue.prega_coxa_pcx"
                validation="number"
            />

            <FormKit
                type="text"
                label="Prega cutânea da panturrilha (PCP)"
                placeholder="mm"
                v-model="modelValue.prega_panturrilha_pcp"
                validation="number"
            />
        </div>
    </FormKit>

    <!-- Step 3: Exame sanguíneo -->
    <FormKit type="step" name="exame sanguíneo" stepName="ExameSanguineo">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
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
