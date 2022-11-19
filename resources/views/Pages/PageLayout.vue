<template>
    <div class="w-full h-full">
        <Head :title="title"></Head>
        <section class="flex justify-between items-center">
            <ui-page-heading :title="pageHeading" />
            <div class="px-4 py-2">
                Hi, <span class="font-semibold">{{ username }}</span>!
            </div>
        </section>
        <section class="h-[calc(100vh-100px)] overflow-auto">
            <slot />
        </section>
    </div>
</template>


<script setup>
defineProps({
    title: String,
    pageHeading: String,
})

</script>

<script>
export default {

    computed: {
        username() {
            return this.$page.props.auth.user.username;
        }
    }
}
</script>