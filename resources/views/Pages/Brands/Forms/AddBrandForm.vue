<template>
    <page-layout title="Brands" page-heading="Add New Brand" class="bg-gray-100">
        <card-layout>
            <ui-form uri="/brands/store" :form="form" @on-success="onSuccess" @onError="onError">
                <ui-input v-model="form.name" name="name" label="Name" type="text" :error="form.errors.name" />
            </ui-form>
        </card-layout>
    </page-layout>
</template>

<script setup>
import { UiInput, UiForm, CardLayout } from "../../../Shared/UI";
import PageLayout from "../../PageLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { inject } from "vue";

const notify = inject('notify');

let form = useForm({
    name: "",
});

let onSuccess = () => {
    notify.open("Brand has saved successfully!");
    form.name = "";
}

let onError = () => {
    if (form.errors.name) {
        return;
    }
    notify.open(JSON.stringify(form.errors), "error");
}

</script>

<style scoped>
body {
    background-color: lightgray;
}
</style>