<template>
    <page-layout pageHeading="Manage Inventory Item" title="Inventory Item">
        <!-- table -->
        <ui-table title="Inventory Items" :pagination="users.links">
            <!-- header actions -->
            <template #headerActions>
                <div class="flex justify-between items-center p-2">
                    <div class="flex gap-2">
                        <!-- actions -->
                        <ui-link uri="inventory-items/create" icon="plus" />
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
                <ui-th text="Actions" action />
            </template>
            <!-- content -->
            <template #tableContent>
                <tr v-for="user in users.data" :key="user.id">
                    <ui-td>
                        {{ user.name }}
                    </ui-td>
                    <ui-td action>
                        <Link v-if="user.can.edit" href="inventory-items/{inventory_item}/edit">Edit</Link>
                    </ui-td>
                </tr>
            </template>
        </ui-table>

    </page-layout>
</template>

<script setup>
import PageLayout from "../PageLayout.vue";
import { SearchInput } from "../../Shared/Forms";
import { ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";
import debounce from "lodash/debounce";

let props = defineProps({
    users: {
        type: Object,
        required: true,
    },
    filters: {
        type: Object,
    },
    can: Object,
});

let search = ref(props.filters.search);

watch(search, debounce(
    function (value) {
        Inertia.get('/inventory-items', { search: value }, {
            preserveState: true,
            replace: true,
        })
    }, 250));

let reload = debounce(function () {
    props.filters.search = "";
    Inertia.get('/inventory-items', {
        preserveState: true,
        replace: true,
    });
}, 300);

</script>