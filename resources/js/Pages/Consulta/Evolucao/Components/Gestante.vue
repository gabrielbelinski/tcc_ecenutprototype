<template>
    <FormKit type="step" name="antropometria" stepName="Antropometria">
        <div class="formkit-grid">
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
                label="Circunferência do Braço"
                placeholder="cm"
                v-model="modelValue.circunferencia_braco"
                validation="number"
            />

            <FormKit
                type="text"
                label="Circunferência Muscular do Braço"
                placeholder="cm"
                v-model="modelValue.circunferencia_muscular_braco"
                validation="number"
            />

            <FormKit
                type="text"
                label="IMC"
                placeholder="Kg/m²"
                v-model="modelValue.imc"
                validation="number"
            />
        </div>
    </FormKit>

    <!-- Step 2: Gestante -->
    <FormKit type="step" name="gestante" stepName="Gestante">
        <div class="formkit-grid">
            <FormKit
                type="text"
                label="IMC pré-gestacional"
                v-model="modelValue.imc_pre_gestacional"
                validation="number"
            />

            <FormKit
                type="text"
                label="Peso habitual (dois meses antes de engravidar)"
                placeholder="kg"
                v-model="modelValue.peso_habitual"
                validation="number"
            />

            <FormKit
                type="text"
                label="Ganho de peso até o momento"
                placeholder="kg"
                v-model="modelValue.ganho_peso"
                validation="number"
            />

            <FormKit
                type="textarea"
                label="Suplementação"
                v-model="modelValue.suplementacao"
                rows="3"
                help="Liste os suplementos utilizados"
            />
        </div>
    </FormKit>

    <!-- Step 3: Pregas Cutâneas -->
    <FormKit type="step" name="pregas cutâneas" stepName="PregasCutaneas">
        <div class="formkit-grid">
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
        </div>
    </FormKit>

    <!-- Step 4: Exame sanguíneo -->
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
import { FormWizard, TabContent } from "vue3-form-wizard";
defineProps({
    modelValue: {
        type: Object,
        required: true,
    },
});

defineEmits(["update:modelValue"]);
</script>
