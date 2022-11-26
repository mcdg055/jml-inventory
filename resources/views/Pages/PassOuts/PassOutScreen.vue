<template>
    <page-layout pageHeading="Pass Out Details" title="Inventory Items">
        <pass-out-details :item="item" />
        <browse-selected-items />
    </page-layout>
</template>

<script setup>
import PageLayout from "../PageLayout.vue";
import BrowseSelectedItems from "./widgets/BrowseSelectedItems.vue";
import PassOutDetails from "./widgets/PassOutDetails.vue";

let props = defineProps({
    item: {
        type: Object,
        required: true
    },
});

</script>