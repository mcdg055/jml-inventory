<template>
    <div class="w-full mx-auto bg-white shadow-lg rounded-2xl border border-gray-200 overflow-hidden">
        <header v-if="title" class="px-5 py-4 border-b border-gray-100 bg-gray-100">
            <h4 class="font-semibold text-gray-800" v-html="title"></h4>
        </header>
        <div class="flex justify-between items-center p-2">
            <div class="flex gap-2">
                <slot v-if="$slots.headerActions" name="headerActions" />
                <ui-button v-if="reload" variant="bordered" icon="refresh" @click="reload" />
            </div>
            <div>
                <!-- search -->
                <search-input v-if="searchInput" t v-model="search" />
            </div>
        </div>

        <div class="p-3">
            <div class="overflow-x-auto ">
                <table class="table-auto w-full">
                    <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                        <tr>
                            <slot name="tableHeaders" />
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        <tr v-if="loading">
                            <td colspan="100%">
                                <div class="relative min-h-[100px]">
                                    <ui-loading :loading="loading"></ui-loading>
                                </div>
                            </td>
                        </tr>
                        <slot :data="pass_out_items" />
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
import { ref, watch, inject, onMounted } from "vue";
import debounce from "lodash/debounce";
import { SearchInput, UiButton, UiInput, UiPanel, UiApiTable } from "../../../Shared/UI";

const axios = inject("axios");

let props = defineProps({
    title: String,
    pagination: Object,
    uri: {
        type: String,
        required: true,
    },
    searchInput: {
        type: Boolean,
        default() {
            return false;
        }
    },
    reload: {
        type: Boolean,
        default() {
            return false;
        }
    },
})

let pass_out_items = ref(null);
let loading = ref(false);
let search = ref("");

let loadPassOutItems = debounce(function (value = "") {
    pass_out_items.value = null;
    loading.value = true;
    axios.post(props.uri, { search: value }).then((response) => {
        pass_out_items.value = response.data;
    }).finally(() => {
        loading.value = false;
    })
}, 200)

onMounted(() => {
    loadPassOutItems();
})

//watch search changes
watch(search, loadPassOutItems);

let hasPagination = props.pagination ? true : false;

</script>