<template>
    <div class="block 
        p-6 
        rounded-lg 
        shadow-lg 
        bg-white 
        max-w-sm 
        border 
        border-gray-100"
    >
        <div class="form-group mb-6">
            <slot />
        </div>
    </div>
</template>

<script setup>
let props = defineProps({});
</script>