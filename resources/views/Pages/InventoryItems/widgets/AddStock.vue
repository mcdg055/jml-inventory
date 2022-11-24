<template>
    <page-layout :pageHeading="item.name" title="Manage Inventory Item" class="bg-gray-200">
        <div class="flex flex-col gap-8">
            <card-layout>
                <template #cardHead>
                    <h4 class="text-lg font-medium">Item Details</h4>
                </template>
                <div>
                    <div class="flex w-full py-2 px-5">
                        <div class="w-2/6">Item name:</div>
                        <div class="font-bold">{{ item.name }}</div>
                    </div>
                    <div class="flex w-full py-2 px-5 border-t">
                        <div class="w-2/6">Brand:</div>
                        <div class="font-bold">{{ item.brand.name }}</div>
                    </div>
                    <div class="flex w-full py-2 px-5 border-t">
                        <div class="w-2/6">Stocks left:</div>
                        <div class="font-bold" :class="{ 'text-red-500': item.stock < item.critical_level }">{{ item.stock }}
                            pcs.</div>
                    </div>
                    <div class="flex w-full py-2 px-5 border-t">
                        <div class="w-2/6">Critical level:</div>
                        <div class="font-bold">{{ item.critical_level }} pcs.</div>
                    </div>
                    <div class="flex w-full py-2 px-5 border-t">
                        <div class="w-2/6">Status:</div>
                        <div class="font-bold">
                            <status :is-active="item.is_active" />
                        </div>
                    </div>
                </div>
            </card-layout>

            <card-layout title="Add Stock">
                <template #cardHead>
                    <h4 class="text-lg font-medium">Add more stock</h4>
                </template>
                <div class="p-4">
                    <ui-form :uri="`/inventory-items/${item.id}/add-stock`" :form="form" @cancel="onCancel">
                        <ui-input v-model="form.stock" label="Quantity" :error="form.errors.stock" />
                    </ui-form>
                </div>
            </card-layout>
        </div>
    </page-layout>
</template>

<script setup>
import PageLayout from "../../PageLayout.vue";
import Status from "../components/Status.vue";
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
