<template>
    <div class="block 
        rounded-lg 
        shadow-lg 
        bg-white 
        max-w-sm 
        overflow-hidden">

        <div v-if="$slots.cardHead" class="p-3 bg-gray-300">
            <slot name="cardHead" />
        </div>
        <div>
            <slot />
        </div>
    </div>
</template>

<script setup>
let props = defineProps({
    title: {
        type: String
    }
});
</script>