<template>
    <div class="w-full mx-auto bg-white shadow-lg rounded-2xl border border-gray-200 overflow-hidden">
        <header v-if="title" class="px-5 py-4 border-b border-gray-100 bg-gray-100">
            <h4 class="font-semibold text-gray-800" v-html="title"></h4>
        </header>

        <slot v-if="$slots.headerActions" name="headerActions" :reload="loadPassOutItems" />
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

const axios = inject("axios");

let props = defineProps({
    title: String,
    pagination: Object,
    search: String,
    uri: {
        type: String,
        required: true,
    },
})

let pass_out_items = ref(null);
let loading = ref(false);
let search = ref(props.search);

let loadPassOutItems = debounce(function () {
    pass_out_items.value = null;
    loading.value = true;
    axios.post(props.uri).then((response) => {
        pass_out_items.value = response.data;
    }).finally(() => {
        loading.value = false;
    })
}, 200)

onMounted(() => {
    loadPassOutItems();
})

//watch search changes
watch(() => props.search, debounce(
    function (value) {

        axios.post(props.uri, { search: value }).then((response) => {
            pass_out_items.value = response.data;
        }).finally(() => {
            loading.value = false;
        })
    }, 250));

let hasPagination = props.pagination ? true : false;

</script>