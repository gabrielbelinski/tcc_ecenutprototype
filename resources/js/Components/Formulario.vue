<template>
    <FormKit
        v-if="props.op == 'C'"
        type="form"
        @submit="create"
        :actions="false"
        :classes="{
            form: 'w-full max-w-none',
            wrapper: 'w-full',
        }"
    >
        <FormKit type="multi-step" tab-style="progress">
            <slot></slot>
        </FormKit>
    </FormKit>
    <FormKit
        v-else-if="props.op == 'E'"
        type="form"
        @submit="update"
        :actions="false"
        :classes="{
            form: 'w-full max-w-none',
            wrapper: 'w-full',
        }"
    >
        <FormKit type="multi-step" tab-style="progress">
            <slot></slot>
        </FormKit>
    </FormKit>
    <FormKit v-else-if="props.op == 'R'" type="multi-step" tab-style="progress">
        <slot></slot>
    </FormKit>
</template>

<script setup>
const props = defineProps({
    entityRoute: String,
    forml: Object,
    op: String,
});

const create = () => {
    props.forml.post(props.entityRoute, {
        onError: (errors) => {
            console.error(errors);
        },
        onSuccess: () => {
            console.log("Formulário enviado com sucesso!");
        },
    });
};

const update = () => {
    props.forml.put(`${props.entityRoute}/${props.forml.id}/update`, {
        onError: (errors) => {
            console.error(errors);
        },
        onSuccess: () => {
            console.log("Formulário enviado com sucesso!");
        },
    });
};
</script>
