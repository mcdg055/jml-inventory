<template>
    <page-layout pageHeading="Manage Pass Outs" title="Inventory Items">
        <ui-table title="Pass outs" :pagination="pass_outs.links">
            <!-- header actions -->
            <template #headerActions>
                <div class="flex justify-between items-center p-2">
                    <div class="flex gap-2">
                        <ui-button variant="link" icon="plus" uri="/pass-outs/create" />
                        <ui-button variant="bordered" icon="refresh" @click="reload" />
                    </div>
                    <div>
                        <!-- search -->
                        <search-input v-model="search" />
                    </div>
                </div>
            </template>
            <!-- header -->
            <template #tableHeaders>
                <ui-th text="P.O. #" />
                <ui-th text="Name" />
                <ui-th text="Date" />
                <ui-th text="Total Cost" />
                <ui-th text="Actions" action />
            </template>
            <!-- content -->
            <template #tableContent>
                <tr v-for="(pass_out, index) in pass_outs.data">
                    <ui-td>{{ pass_out.number }}</ui-td>
                    <ui-td>{{ pass_out.name }}</ui-td>
                    <ui-td>{{ pass_out.created_at }}</ui-td>
                    <ui-td> ₱ {{ (pass_out.total).toFixed(2) }}</ui-td>
                    <ui-td action>
                        <div class="flex gap-2 justify-end">
                            <ui-button variant="link" icon="eye" :uri="`/pass-outs/${pass_out.id}`" />
                            <ui-button variant="bordered" icon="trash" @click="handleDelete(pass_out)" />
                        </div>
                    </ui-td>
                </tr>
            </template>
        </ui-table>
    </page-layout>
</template>

<script setup>
import PageLayout from "../PageLayout.vue";
import { SearchInput } from "../../Shared/Ui";
import { ref, watch, inject } from "vue";
import { Inertia } from "@inertiajs/inertia";
import debounce from "lodash/debounce";

let props = defineProps({
    pass_outs: Object,
    filters: {
        type: Object,
    },
})

const confirm = inject('confirm');

let search = ref(props.filters.search);

//watch search changes
watch(search, debounce(
    function (value) {
        Inertia.get('/pass-outs', { search: value }, {
            preserveState: true,
            replace: true,
        })
    }, 250));

//reload the content
let reload = debounce(function () {
    Inertia.get('/pass-outs');
}, 300);

let handleDelete = (pass_out) => {
    confirm(`/pass-outs/${pass_out.id}/delete`, '', `Are you sure you want to delete <b>${pass_out.name}</b>?`);
}

</script>