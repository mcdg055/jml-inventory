<template>
    <div class="w-full h-full relative flex flex-col gap-3">

        <Head :title="title"></Head>
        <!-- heading -->
        <section class="flex justify-between items-center border-b px-6">
            <h1 class="text-3xl font-bold py-6 text-left" v-text="pageHeading"></h1>
            <div class="px-4 py-2">
                Hi, <span class="font-semibold">{{ username }}</span>!
            </div>
        </section>
        <!-- body -->
        <section class="overflow-auto" :class="{ 'mb-3': !$slots.footer }">
            <div class="m-6">
                <slot />

            </div>
        </section>

        <!-- footer -->
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