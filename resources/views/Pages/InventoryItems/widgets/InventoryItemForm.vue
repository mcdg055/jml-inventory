<template>
    <ui-form :uri=uri :form="form" @cancel="onCancel">
        <ui-input v-model="form.name" label="Name" type="text" :error="form.errors.name" />
        <ui-select v-model="form.brand_id" :options="$page.props.brands" text="Select brand"
            :error="form.errors.brand_id" />
        <ui-input v-model="form.unit_price" label="Unit price" :error="form.errors.unit_price" />
        <ui-input v-if="initialStock" v-model="form.stock" label="Initial Stock" :error="form.errors.stock" />
        <ui-input v-model="form.critical_level" label="Critical Level" :error="form.errors.critical_level" />
        <ui-checkbox v-model="form.is_active" text="Is active" checked />
    </ui-form>
</template>

<script setup>
import { UiInput, UiSelect, UiForm, UiCheckbox } from "../../../Shared/UI";
import { Inertia } from "@inertiajs/inertia";

let props = defineProps({
    uri: {
        type: String,
        required: true,
    },
    form: {
        type: Object,
        required: true,
    },
    initialStock: {
        type: Boolean,
        default() {
            return false;
        }
    }
});

let onCancel = () => {
    Inertia.visit("/inventory-items", {
        replace: true,
    })
}

</script>