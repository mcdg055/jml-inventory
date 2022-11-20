<template>
    <page-layout pageHeading="Add Inventory Item" title="Manage Inventory Item" class="bg-gray-200">
        <card-layout>
            <template #cardHead>
                <h4 class="text-lg font-medium">Add New Item</h4>
            </template>
            <inventory-item-form  uri="/inventory-items/store" :form="form" initial-stock />
        </card-layout>
    </page-layout>
</template>

<script setup>
import PageLayout from "../../PageLayout.vue";
import InventoryItemForm from "./InventoryItemForm.vue";

import { CardLayout } from "../../../Shared/UI";
import { useForm } from "@inertiajs/inertia-vue3";

let form = useForm({
    name: null,
    brand_id: null,
    unit_price: null,
    critical_level: null,
    stock:null,
    is_active: true,
});

</script>
