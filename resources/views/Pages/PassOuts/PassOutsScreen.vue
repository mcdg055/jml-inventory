<template>
    <page-layout pageHeading="Manage Pass Outs" title="Inventory Items">
        <ui-table title="Pass outs">
            <!-- header actions -->
            <template #headerActions>
                <div class="flex justify-between items-center p-2">
                    <div class="flex gap-2">
                        <ui-link icon="plus" uri="/pass-outs/create" />
                        <ui-button icon="refresh" @click="reload" />
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
                <ui-th text="Cost" />
                <ui-th text="Actions" action />
            </template>
            <!-- content -->
            <template #tableContent>
                <tr>
                    <ui-td>00001</ui-td>
                    <ui-td>Invitation</ui-td>
                    <ui-td>10/27/2000</ui-td>
                    <ui-td>₱ 567.00</ui-td>
                    <ui-td action>
                        <div class="flex gap-2 justify-end">
                            <ui-link icon="eye" :uri="`/pass-outs/`" />
                            <ui-link icon="edit" :uri="`/pass-outs/edit`" />
                            <ui-button icon="trash" @click="handleDelete(item)" />
                        </div>
                    </ui-td>
                </tr>
            </template>
        </ui-table>
    </page-layout>
</template>

<script setup>
import PageLayout from "../PageLayout.vue";
import { SearchInput, UiPill } from "../../Shared/Ui";
import { ref, watch, inject } from "vue";
import { Inertia } from "@inertiajs/inertia";
import debounce from "lodash/debounce";

let props = defineProps({
    inventory_items: {
        type: Object,
        required: true,
    },
    filters: {
        type: Object,
    },
})

const confirm = inject('confirm');

let search = /* ref(props.filters.search) */ null;

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

let handleDelete = (inventory_item) => {
    confirm(`/pass-outs/${inventory_item.id}/delete`, '', `Are you sure you want to delete <b>${inventory_item.name}</b>?`);
}

</script>