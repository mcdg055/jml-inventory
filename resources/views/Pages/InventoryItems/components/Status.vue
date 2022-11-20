<template>
    <ui-pill :text="text" :variant="variant" />
</template>

<script setup>
import { UiPill } from "../../../Shared/UI";

let props = defineProps({
    isActive: Boolean,
});

let text = props.isActive ? 'active' : 'inactive';
let variant = props.isActive ? 'success' : 'danger';
</script>