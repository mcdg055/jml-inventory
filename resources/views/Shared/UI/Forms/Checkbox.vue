<template>
    <ui-tooltip :content="tooltip">
        <div class="form-check py-4" :class="wrapperClass">
            <input :class="inputClass"
                class="form-check-input appearance-none h-4 w-4 border border-gray-500 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                type="checkbox" :id="`checkbox_${inputId}`" :checked="modelValue"
                @change="$emit('update:modelValue', $event.target.checked ? true : false)" tooltip="add this item">
            <label class="form-check-label inline-block text-gray-800" :for="`checkbox_${inputId}`" :class="labelClass">
                {{ text }}
            </label>
        </div>
    </ui-tooltip>
</template>

<script setup>


let props = defineProps({
    text: String,
    modelValue: Boolean,
    inputClass: {
        type: String,
        default() {
            return "";
        }
    },
    labelClass: {
        type: String,
        default() {
            return "";
        }
    },
    wrapperClass: {
        type: String,
        default() {
            return "";
        }
    },
    tooltip: String,
});

let inputId = Math.floor(Math.random() * 10000);

defineEmits(["update:modelValue"]);
</script>