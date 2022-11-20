<template>
    <div class="form-check py-4">
        <input
            class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
            type="checkbox" :id="`checkbox_${inputId}`" :checked="modelValue"
            @change="$emit('update:modelValue', $event.target.checked ? true : false)">
        <label class="form-check-label inline-block text-gray-800" :for="`checkbox_${inputId}`">
            {{ text }}
        </label>
    </div>
</template>

<script setup>
let props = defineProps({
    text: String,
    modelValue: Boolean,
});

let inputId = Math.floor(Math.random() * 10000);

defineEmits(["update:modelValue"]);
</script>