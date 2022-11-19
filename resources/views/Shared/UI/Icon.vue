<template>
    <i v-if="icon" :class="parseIcon(icon)"> </i>
</template>

<script>

export default {
    props: {
        icon: String,
    },
    methods: {
        parseIcon(icon) {
            return "fa-solid fa-" + icon;
        }
    }
}

</script>