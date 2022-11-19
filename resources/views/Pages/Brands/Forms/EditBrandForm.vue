<template>
    <page-layout title="Brands" page-heading="Edit Brand Details" class="bg-gray-100">
        <card-layout>
            <ui-form :uri="`/brands/${brand.id}/update`" :form="form" @on-success="onSuccess" @onError="onError"
                @cancel="onCancel">
                <ui-input v-model="form.name" name="name" label="Name" type="text" :error="form.errors.name" />
            </ui-form>
        </card-layout>
    </page-layout>
</template>

<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { inject } from "vue";

import PageLayout from "../../PageLayout.vue";
import { UiInput, UiForm, CardLayout } from "../../../Shared/UI";

const notify = inject('notify');

let props = defineProps({
    brand: Object,
    visible: Boolean,
    default() {
        return false;
    }
});

let form = useForm({
    name: props.brand.name,
});

let onSuccess = () => {
    notify.open("Brand has saved successfully!");
    form.id = "";
    form.name = "";
}

let onError = () => {
    if (form.name) {
        return;
    }
    notify.open(JSON.stringify(props.form.errors), "error");
}

let onCancel = () => {
    Inertia.visit("/brands", {
        replace: true,
    })
}

</script>
