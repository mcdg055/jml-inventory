<template>
    <h1 class="text-3xl font-bold py-6 text-left" v-text="title"></h1>
</template>

<script setup>
defineProps({ title: String })
</script>