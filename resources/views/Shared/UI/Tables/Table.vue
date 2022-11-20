<template>
    <div class="w-full mx-auto bg-white shadow-lg rounded-2xl border border-gray-200 overflow-hidden">
        <header class="px-5 py-4 border-b border-gray-100 bg-gray-100">
            <h2 class="font-semibold text-gray-800" v-html="title"></h2>
        </header>
        <slot name="headerActions" />

        <div class="p-3">
            <div class="overflow-x-auto ">
                <table class="table-auto w-full">
                    <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                        <tr>
                            <slot name="tableHeaders" />
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        <slot name="tableContent" />
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- pagination -->
    <div v-if="hasPagination" class="flex justify-center mt-3">
        <ui-pagination :links="pagination" />
    </div>
</template>

<script setup>
import UiPagination from "../Pagination.vue";

let props = defineProps({
    title: String,
    pagination: Object,
})

let hasPagination = props.pagination ? true : false;

</script>