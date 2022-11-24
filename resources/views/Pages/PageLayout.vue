<template>
    <div class="w-full h-full relative flex flex-col gap-3">

        <Head :title="title"></Head>
        <section class="flex justify-between items-center">
            <ui-page-heading :title="pageHeading" />
            <div class="px-4 py-2">
                Hi, <span class="font-semibold">{{ username }}</span>!
            </div>
        </section>
        <section class="overflow-auto" :class="{ 'mb-3': !$slots.footer }">
            <slot />
        </section>

        <div v-if="$slots.footer" class="w-full bottom-0 mt-auto">
            <slot name="footer" />
        </div>
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