<template>
    <page-layout pageHeading="Supply Details" title="Supplies">
        <div class="flex gap-5 flex-col">
            <supply-details :supply="supply" @edit="handleEdit" />
            <supply-items-table :supply-id="supply.id" :supply-items="supply.supply_items" />
        </div>
    </page-layout>
</template>

<script setup>
import PageLayout from "../PageLayout.vue";
import SupplyDetails from "./components/SupplyDetails.vue";
import SupplyItemsTable from "./widgets/SupplyItemsTable.vue";
import EditSupplyDetails from "./widgets/EditSupplyDetails.vue";
import { inject } from "vue";

const panel = inject('panel');

let props = defineProps({
    supply: Object
});

function handleEdit() {
    panel.open({
        component: EditSupplyDetails,
        title: "Edit Supply Details",
        props: {
            supply: props.supply
        }
    })
}

</script>