<template>
    <div class="offcanvas offcanvas-end fixed bottom-0 flex flex-col max-w-full bg-white bg-clip-padding shadow-sm outline-none transition duration-300 ease-in-out text-gray-700 top-0 right-0 border-none w-96 show"
        tabindex="-1">
        <div class="offcanvas-header flex items-center justify-between p-4 bg-primary text-white">
            <h5 class="offcanvas-title mb-0 leading-normal font-semibold" v-html="title"></h5>
            <button type="button" @click="handlePanelClose"
                class="box-content w-4 h-4 p-2 -my-5 -mr-2 text-white border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-white hover:opacity-75 hover:no-underline">
                <icon icon="times" />
            </button>

        </div>

        <div class="offcanvas-body flex-grow p-4 overflow-y-auto text-gray-900">
            <div>
                <slot />
            </div>
        </div>
    </div>
    <div class="offcanvas-backdrop fade show" @click="handlePanelClose"></div>
</template>

<script>

export default {
    props: {
        title: String,
    },
    setup(props, context) {

        const handlePanelClose = () => {
            context.emit('close')
        }

        return { handlePanelClose };
    }
}
</script>