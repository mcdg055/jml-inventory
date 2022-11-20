<template>
    <div class="form-floating w-full">
        <input :type="type" class="form-control
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

            focus:text-gray-700
            focus:bg-white
            focus:border-blue-600
            focus:outline-none" :id="name" :placeholder="placeholder ? placeholder : label" :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)">
        <label :for="name" class="text-gray-700" v-html="label"></label>
        <small v-if="error" v-html="error" class="text-red-500"></small>
    </div>

</template>

<script setup>
let props = defineProps({
    name: String,
    label: String,
    placeholder: String,
    type: { type: String, default() { return "text" } },
    modelValue: [String, Number],
    error: [Object, String],
})

defineEmits(['update:modelValue'])

</script>