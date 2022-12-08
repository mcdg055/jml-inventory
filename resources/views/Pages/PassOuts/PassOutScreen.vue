<template>
    <page-layout pageHeading="Pass Out Details" title="Pass Outs">
        <pass-out-details :item="pass_out" />
        <browse-selected-items :passOutId="pass_out.id" />
    </page-layout>
</template>

<script setup>
import PageLayout from "../PageLayout.vue";
import BrowseSelectedItems from "./widgets/BrowseSelectedItems.vue";
import PassOutDetails from "./widgets/PassOutDetails.vue";

let props = defineProps({
    pass_out: {
        type: Object,
        required: true
    },
});

</script>