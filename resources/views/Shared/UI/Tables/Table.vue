<template>
    <div class="w-full mx-auto bg-white shadow-lg rounded-2xl border border-gray-200 overflow-hidden">
        <header v-if="title" class="px-5 py-4 border-b border-gray-100 bg-gray-100">
            <h4 class="font-semibold text-gray-800" v-html="title"></h4>
        </header>
        <slot v-if="$slots.headerActions" name="headerActions" />

        <div class="p-3">
            <div class="">
                <table class="table-auto w-full">
                    <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                        <tr>
                            <slot name="tableHeaders" />
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        <tr v-if="loading">
                            <td colspan="100%">
                                <div class="relative min-h-[200px]">
                                    <ui-loading :loading="loading"></ui-loading>
                                </div>
                            </td>
                        </tr>
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
    loading: {
        type: Boolean,
        default() {
            return false;
        }
    }
})

let hasPagination = props.pagination ? true : false;

</script>