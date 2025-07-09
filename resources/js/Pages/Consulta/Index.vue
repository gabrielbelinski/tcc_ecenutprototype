<template>
    <MainLayout>
        <div class="container m-auto px-2.5 py-3">
            <div class="bg-gray-100 rounded-md p-3">
                <CalendarView
                    :items="calendarItems"
                    :show-date="showDate"
                    class="theme-default"
                    style="height: 800px; background-color: white"
                    @setShowDate="setShowDate"
                    @click-item="openConsultaMenu"
                >
                    <template #header="{ headerProps }">
                        <CalendarViewHeader
                            :header-props="headerProps"
                            @input="setShowDate"
                        />
                    </template>
                </CalendarView>

                <!-- Modal/Dialog para as ações -->
                <div
                    v-if="selectedConsulta"
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
                >
                    <div class="bg-white rounded-lg shadow-xl p-4 w-55">
                        <h3 class="text-lg font-medium mb-3 text-center">
                            Ações
                        </h3>

                        <div class="place-items-center">
                            <NButton
                                size="small"
                                type="primary"
                                @click="visualizarConsulta"
                                class="me-5"
                            >
                                Visualizar consulta
                            </NButton>

                            <NButton
                                size="small"
                                type="primary"
                                @click="reagendarConsulta"
                                class="me-5"
                            >
                                Reagendar consulta
                            </NButton>

                            <NButton
                                size="small"
                                type="error"
                                @click="excluirConsulta"
                            >
                                Cancelar consulta
                            </NButton>

                            <div class="mt-4 pt-4 border-t">
                                <NButton
                                    size="small"
                                    @click="selectedConsulta = null"
                                    class="mb-3"
                                >
                                    Cancelar
                                </NButton>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { ref, computed } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import { CalendarView, CalendarViewHeader } from "vue-simple-calendar";
import { NButton } from "naive-ui";
import "vue-simple-calendar/dist/vue-simple-calendar.css";
import "vue-simple-calendar/dist/css/default.css";
import "vue-simple-calendar/dist/css/holidays-us.css";
import MainLayout from "@/Layouts/AuthenticatedLayout.vue";

const page = usePage();
const showDate = ref(new Date());
const selectedConsulta = ref(null);

const setShowDate = (date) => {
    showDate.value = date;
};

const calendarItems = computed(() => {
    return page.props.consultas.map((consulta) => {
        const dataConsulta = new Date(
            consulta.data_iso || consulta.data_consulta
        );
        const adjustedDate = new Date(
            dataConsulta.getTime() + dataConsulta.getTimezoneOffset() * 60000
        );

        return {
            id: consulta.id,
            startDate: adjustedDate,
            endDate: new Date(adjustedDate.getTime() + 60 * 60 * 1000),
            title: `${consulta.hora} - ${consulta.paciente.nome}`,
            originalItem: consulta,
            startsBeforeThisDay: false,
            endsAfterThisDay: false,
            clickable: true,
            selectable: true,
        };
    });
});
const openConsultaMenu = (item) => {
    selectedConsulta.value = item.originalItem || item;
};

const visualizarConsulta = () => {
    if (selectedConsulta.value) {
        router.get(`/consulta/${selectedConsulta.value.id}`);
    }
};

const reagendarConsulta = () => {
    if (selectedConsulta.value) {
        router.get(`/consulta/${selectedConsulta.value.id}/edit`);
    }
};

const excluirConsulta = () => {
    if (
        selectedConsulta.value &&
        confirm("Tem certeza de que deseja cancelar esta consulta?")
    ) {
        router.delete(`/consulta/${selectedConsulta.value.id}`, {
            onSuccess: () => {
                selectedConsulta.value = null;
            },
        });
    }
};
</script>

<style scoped>
.fixed {
    position: fixed;
}
.inset-0 {
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
}
.bg-opacity-50 {
    background-color: rgba(0, 0, 0, 0.5);
}
.z-50 {
    z-index: 50;
}
</style>
