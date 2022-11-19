<template>
    <td class="p-2" :class="action ? 'text-right' : 'text-left'">
        <slot />
    </td>
</template>

<script setup>
defineProps({
    action: {
        type: Boolean,
        default() {
            return false;
        }
    },
})
</script>