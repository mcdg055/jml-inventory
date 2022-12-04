<template>
    <div class="w-full mx-auto bg-white shadow-lg rounded-2xl border border-gray-200 overflow-hidden">
        <header v-if="title" class="px-5 py-4 border-b border-gray-100 bg-gray-100">
            <h4 class="font-semibold text-gray-800" v-html="title"></h4>
        </header>
        <div class="flex justify-between items-center p-2">
            <div class="flex gap-2">
                <slot v-if="$slots.headerActions" name="headerActions" />
                <ui-button tooltip="Reload table" v-if="reload" variant="bordered" icon="refresh" @click="loadData()" />
            </div>
            <div>
                <!-- search -->
                <search-input v-if="searchInput" v-model="search" />
            </div>
        </div>

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
                                <div class="relative min-h-[100px]">
                                    <ui-loading :loading="loading"></ui-loading>
                                </div>
                            </td>
                        </tr>
                        <slot :data="data" />
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
import { ref, watch, inject, onMounted, reactive } from "vue";
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
    uriParams: {
        type: Object,
        required: false,
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

let data = ref(null);
let loading = ref(false);
let search = ref("");

let loadData = debounce(function (value = "") {
    let params = Object.assign({ search: value }, props.uriParams);
    data.value = null;
    loading.value = true;
    axios.post(props.uri, params).then((response) => {
        data.value = response.data;
    }).finally(() => {
        loading.value = false;
    })
}, 200)

onMounted(() => {
    loadData();
})

//watch search changes
watch(search, loadData);

let hasPagination = props.pagination ? true : false;

</script>