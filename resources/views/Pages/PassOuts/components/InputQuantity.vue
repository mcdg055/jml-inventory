<template>
  <input type="number" class="
          form-control
          block
          w-full
          max-w-[120px]

          px-3
          py-1.5

          text-base
          font-normal
          text-gray-700

          bg-white 
          bg-clip-padding

          border 
          border-solid 
          border-gray-300
          rounded

          transition
          ease-in-out
          m-0

          focus:text-gray-700
          focus:bg-white
          focus:border-blue-600 
          focus:outline-none

        " 
        :class="errorClass"
        placeholder="Quantity"
        min="1"
        max="100"
        @input="$emit('update:modelValue', $event.target.value)"
        
        />
  <small v-if="errors" class="text-red-500 font-medium">{{ errors }}</small>
</template>

<script setup>
let props = defineProps({
  modelValue: [Number, String],
  errors: [Object, String],
});

let errorClass = () => {

  console.log(2);
  return errors !== undefined ? 'border-red-400' : "border-gray-300";
}

defineEmits(['update:modelValue'])
</script>