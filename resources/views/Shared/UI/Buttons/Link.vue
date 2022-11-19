<template>
    <Link :href="uri"
        class="py-1 px-2 border rounded-md border-gray-400 hover:bg-gray-800 hover:text-white transition ease-in-out">
    <Icon v-if="hasIcon" :icon="icon"></Icon> <span>{{ text }}</span>
    </Link>
</template>

<script setup>
let props = defineProps({
    text: {
        type: String,
        default() {
            return "";
        }
    },
    icon: String,
    uri: String,
})

let hasIcon = props.icon ? true : false;
</script>