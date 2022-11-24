<template>
    <label class="border-gray-300 border rounded-md p-2 flex items-center w-full">
        <Icon icon="search" class="text-gray-300 mr-2" />
        <input type="text" :value="modelValue" :placeholder="placeholder" class="focus:outline-none w-full"
            @input="$emit('update:modelValue', $event.target.value)">
    </label>
</template>

<script setup>
defineProps({
    modelValue: String,
    placeholder: {
        type: String,
        default() {
            return "search";
        }
    }
});

defineEmits(['update:modelValue'])
</script>