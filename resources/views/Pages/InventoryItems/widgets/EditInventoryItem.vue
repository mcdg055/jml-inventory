<template>
    <page-layout pageHeading="Edit Inventory Item" title="Manage Inventory Item" class="bg-gray-200">
        <card-layout>
            <template #cardHead>
                <h4 class="text-lg font-medium">{{item.name}}</h4>
            </template>
            <inventory-item-form :uri="`/inventory-items/${item.id}/update`" :form="form" />
        </card-layout>
    </page-layout>
</template>

<script setup>
import PageLayout from "../../PageLayout.vue";
import { CardLayout } from "../../../Shared/UI";
import InventoryItemForm from "./InventoryItemForm.vue";
import { useForm } from "@inertiajs/inertia-vue3";

let props = defineProps({
    item: Object
})

let form = useForm({
    name: props.item.name,
    brand_id: props.item.brand_id,
    unit_price: props.item.unit_price,
    critical_level: props.item.critical_level,
    stock: props.item.stock,
    is_active: props.item.is_active,
});

</script>