<template>
    <button
        class="py-1 px-2 border rounded-md border-gray-400 hover:bg-gray-800 hover:text-white transition ease-in-out">
        <Icon v-if="hasIcon" :icon="icon" />
        {{ text }}
    </button>
</template>

<script setup>
let props = defineProps({
    icon: String,
    text: {
        type: String,
        default() {
            return "";
        }
    }
});

let hasIcon = props.icon ? true : false;
</script>