<template>
    <ui-button :text="text" :icon="icon" type="button" data-bs-toggle="offcanvas" :data-bs-target="'#'+panelId"
        aria-controls="offcanvasRight" />
</template>

<script setup>
import UiButton from "./Button.vue";

let props = defineProps({
    icon: String,
    text: String,
    panelId: {
        type: String,
        required: true,
    }
});
</script>