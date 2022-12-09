<template>
    <page-layout pageHeading="Supply Details" title="Supplies">
        <div class="flex gap-5 flex-col">
            <supply-details :supply="supply" />
            <supply-items-table :supply-items="supply.items" />
        </div>
    </page-layout>
</template>

<script setup>
import PageLayout from "../PageLayout.vue";
import SupplyDetails from "./components/SupplyDetails.vue";
import SupplyItemsTable from "./widgets/SupplyItemsTable.vue";

let props = defineProps({
    supply: Object
});

</script>