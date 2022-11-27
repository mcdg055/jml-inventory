<template>
    <div class="offcanvas offcanvas-end fixed bottom-0 flex flex-col max-w-full bg-white bg-clip-padding shadow-sm outline-none transition duration-300 ease-in-out text-gray-700 top-0 right-0 border-none w-96 show"
        tabindex="-1">
        <div class="offcanvas-header flex items-center justify-between p-4 bg-primary text-white">
            <h4 class="offcanvas-title mb-0 text-xl leading-normal font-semibold" v-html="title"></h4>
            <button type="button" @click="handlePanelClose"
                class="box-content w-4 h-4 p-2 -my-5 -mr-2 text-white border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-white hover:opacity-75 hover:no-underline">
                <icon icon="times" />
            </button>

        </div>

        <div class="offcanvas-body flex-grow p-4 overflow-y-auto text-gray-900 flex flex-col">
            <div class="flex flex-col h-full relative">
                <div v-if="!loading" class="h-full flex flex-col">
                    <!-- panel heading -->
                    <div v-if="$slots.heading" class="mb-3">
                        <slot name="heading" />
                    </div>
                    <!-- panel body -->
                    <div>
                        <slot />
                    </div>
                    <!-- panel footer -->
                    <div v-if="$slots.footer" class="mt-auto">
                        <slot name="footer" />
                    </div>
                </div>
                <ui-loading :loading="loading" />
            </div>
        </div>
    </div>
    <div class="offcanvas-backdrop fade show" @click="handlePanelClose"></div>
</template>

<script setup>

const emits = defineEmits(["close"])

defineProps({
    title: String,
    loading: Boolean,
})

const handlePanelClose = () => {
    emits('close');
}
</script>