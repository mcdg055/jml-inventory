<template>
    <span
        class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold text-white rounded-full"
        :class="{
            'bg-blue-600': variant === 'primary',
            'bg-purple-600': variant === 'secondary',
            'bg-green-700': variant === 'success',
            'bg-red-600': variant === 'danger',
        }"> {{ text }} </span>
</template>

<script setup>
let props = defineProps({
    text: String,
    variant: String,
});
</script>