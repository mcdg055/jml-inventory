<template>
    <page-layout title="Brands" page-heading="Add New Brand" class="bg-gray-100">
        <card-layout>
            <ui-form uri="/brands/store" :form="form" @cancel="onCancel">
                <ui-input v-model="form.name" name="name" label="Name" type="text" :error="form.errors.name" />
            </ui-form>
        </card-layout>
    </page-layout>
</template>

<script setup>
import { UiInput, UiForm, CardLayout } from "../../../Shared/UI";
import PageLayout from "../../PageLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { inject } from "vue";

const notify = inject('notify');

let props = defineProps({ flash: Object });

let form = useForm({
    name: "",
});

let onCancel = () => {
    Inertia.visit("/brands", {
        replace: true,
    })
}
</script>

<style scoped>
body {
    background-color: lightgray;
}
</style>