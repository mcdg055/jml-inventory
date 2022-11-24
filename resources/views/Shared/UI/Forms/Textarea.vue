<template>

    <div class="mb-3 w-full">
        <label for="exampleFormControlTextarea1" class="form-label inline-block mb-2 text-gray-700">{{ label }}</label>
        <textarea class="
        form-control
        block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
        " rows="3" @input="$emit('update:modelValue', $event.target.value)" :placeholder="placeholder"></textarea>
    </div>

</template>

<script setup>
let props = defineProps({
    modelValue: String,
    placeholder: String,
    label: String,
});

defineEmits(['update:modelValue'])

</script>