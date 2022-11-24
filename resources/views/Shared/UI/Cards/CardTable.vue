<template>
    <div class="block 
        rounded-lg 
        shadow-lg 
        bg-white 
        w-full">

        <div v-if="$slots.cardHead" class="p-3 bg-gray-100 rounded-t-lg">
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