<template>
    <th class="p-2 whitespace-nowrap font-semibold" v-html="text" :class="action ? 'text-right' : 'text-left'"></th>
</template>

<script setup>
defineProps({
    text: String,
    action: {
        type: Boolean,
        default() {
            return false;
        }
    },
})
</script>