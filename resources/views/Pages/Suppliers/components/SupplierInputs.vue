<template>
    <div class="flex flex-col gap-3">
        <ui-input v-model="form.name" label="Supplier Name" :error="form.errors.name" type="text" />
        <ui-input v-model="form.contact_number" label="Contact Number" :error="form.errors.contact_number" type="tel" />
        <ui-input v-model="form.contact_person" label="Contact Person" :error="form.errors.contact_person" type="text" />
        <ui-checkbox v-model="form.is_active" text="Is active" checked />
    </div>
</template>

<script setup>
import { UiInput, UiCheckbox } from "../../../Shared/UI";

let props = defineProps({
    form: {
        type: Object,
        required: true,
    }
});
</script>