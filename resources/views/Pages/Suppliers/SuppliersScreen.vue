<template>
    <page-layout pageHeading="Manage Suppliers" title="Suppliers">
       <suppliers-table />
    </page-layout>
</template>

<script setup>
import PageLayout from "../PageLayout.vue";
import SuppliersTable from "./widgets/SuppliersTable.vue";

let props = defineProps({
    
});

</script>