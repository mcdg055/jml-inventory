<template>
    <Popper :content="tooltip" class="ui-tooltip tooltip--dark" hover openDelay="300" closeDelay="100">

        <slot />
    </Popper>
</template>

<script setup>
import Popper from "vue3-popper";
let props = defineProps({
    tooltip: String,
});
</script>