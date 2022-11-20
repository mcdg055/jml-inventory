<template>
    <page-layout pageHeading="Update Stock" title="Manage Inventory Item" class="bg-gray-200">
        <card-layout>
            <ui-form :uri="`inventory-items/${item.id}/add-stock`" :form="form" @cancel="onCancel">
                <div class="border p-2 rounded-lg border-gray-300">
                    <div class="flex w-full">
                        <div class="w-2/6">Item name:</div>
                        <div class="font-bold">{{ item.name }}</div>
                    </div>
                    <div class="flex w-full">
                        <div class="w-2/6">Brand:</div>
                        <div class="font-bold">{{ item.brand.name }}</div>
                    </div>
                    <div class="flex w-full">
                        <div class="w-2/6">Stocks left:</div>
                        <div class="font-bold">{{ item.stock }} pcs.</div>
                    </div>
                    <div class="flex w-full">
                        <div class="w-2/6">Critical level:</div>
                        <div class="font-bold">{{ item.critical_level }} pcs.</div>
                    </div>
                </div>
                <div class="mt-3">
                    Add more stock
                </div>
                <ui-input v-model="form.stock" label="Quantity" :error="form.errors.stock" />
            </ui-form>
        </card-layout>
    </page-layout>
</template>

<script setup>
import PageLayout from "../../PageLayout.vue";

import { CardLayout, UiForm, UiInput } from "../../../Shared/UI";
import { useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

defineProps({
    item: Object
})

let form = useForm({
    stock: null,
});

let onCancel = () => {
    Inertia.visit("/inventory-items", {
        replace: true,
    })
}

</script>
