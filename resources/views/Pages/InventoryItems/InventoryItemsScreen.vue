<template>
    <page-layout pageHeading="Manage Inventory Items" title="Inventory Items">
        <ui-table title="Brands" :pagination="inventory_items.links">
            <!-- header actions -->
            <template #headerActions>
                <div class="flex justify-between items-center p-2">
                    <div class="flex gap-2">
                        <ui-link icon="plus" uri="/inventory-items/create" />
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
                <ui-th text="Name" />
                <ui-th text="Brand" />
                <ui-th text="Unit Price" />
                <ui-th text="Stock" />
                <ui-th text="Status" />
                <ui-th text="Actions" action />
            </template>
            <!-- content -->
            <template #tableContent>
                <tr v-for="item in inventory_items.data" :key="item.id">
                    <ui-td :class="{ 'text-danger font-medium': item.stock < item.critical_level }" > {{ item.name }} </ui-td>
                    <ui-td> {{ item.brand.name }} </ui-td>
                    <ui-td> {{ item.unit_price }} </ui-td>
                    <ui-td :class="{ 'text-danger font-medium': item.stock < item.critical_level }"> {{ item.stock }} </ui-td>
                    <ui-td>
                        <ui-pill :text="item.is_active ? 'active' : 'inactive'"
                            :variant="item.is_active ? 'success' : 'danger'" />
                    </ui-td>
                    <ui-td action>
                        <div class="flex gap-2 justify-end">
                            <ui-link icon="eye" :uri="`/inventory-items/${item.id}`" />
                            <ui-link icon="edit" :uri="`/inventory-items/${item.id}/edit`" />
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
let search = ref(props.filters.search);

//watch search changes
watch(search, debounce(
    function (value) {
        Inertia.get('/inventory-items', { search: value }, {
            preserveState: true,
            replace: true,
        })
    }, 250));

//reload the content
let reload = debounce(function () {
    Inertia.get('/inventory-items');
}, 300);

let handleDelete = (inventory_item) => {
    confirm(`/inventory-items/${inventory_item.id}/delete`, '', `Are you sure you want to delete <b>${inventory_item.name}</b>?`);
}

</script>