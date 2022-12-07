<template>
    <div class="flex justify-center">
        <div class="w-full">
            <select class="form-select form-select-lg appearance-none
      block
      w-full
      px-3
      py-4
      text-base
      font-normal
      text-gray-700
      bg-white bg-clip-padding bg-no-repeat
      border border-solid border-gray-300
      rounded
      transition
      ease-in-out
      m-0

      focus:text-gray-700 
      focus:bg-white 
      focus:border-blue-600 
      focus:outline-none"

      @change="$emit('update:modelValue', $event.target.value)"
      >
                <option value=null selected>{{ text }}</option>
                <option v-for="option in options" :value="option.id" :selected="option.id===modelValue">{{ option.name }}</option>
            </select>
            <small v-if="error" v-html="error" class="text-red-500"></small>
        </div>
    </div>
</template>

<script setup>
defineProps({
    modelValue: [String, Number],
    options: Object,
    text: {
        type: String,
        defautlt() {
            return "Select an option";
        }
    },
    error: [String, Array]
});

defineEmits(["update:modelValue"]);
</script>