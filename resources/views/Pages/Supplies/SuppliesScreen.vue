<template>
    <page-layout pageHeading="Manage Supplies" title="Supplies">
        <ui-api-table title="Supplies" uri="/supplies/browse" search-input reload :key=key>
            <template #headerActions>
                <ui-button tooltip="Add new supply" variant="link" icon="plus" uri="/supplies/add" />
            </template>
            <template #tableHeaders>
                <ui-th text="#" />
                <ui-th text="Supply #" />
                <ui-th text="Supplier" />
                <ui-th text="Total" />
                <ui-th text="Date Received" />
                <ui-th text="Actions" action />
            </template>
            <template v-slot="{ data }">
                <tr v-for="(supply, index) in data">
                    <ui-td class="text-gray-400"> {{ index + 1 }} </ui-td>
                    <ui-td> {{ supply.number }} </ui-td>
                    <ui-td> {{ supply.supplier.name }} </ui-td>
                    <ui-td> {{ calculateTotal(supply.items) }} </ui-td>
                    <ui-td> {{ supply.created_at }} </ui-td>

                    <ui-td action>
                        <div class="flex gap-2 justify-end">
                            <ui-button tooltip="View Details" variant="link" :uri="`/supplies/${supply.id}`" icon="eye" />
                            <ui-button tooltip="Delete Record" variant="bordered" icon="trash"
                                @click="handleDelete(supplier.id)" />
                        </div>
                    </ui-td>
                </tr>
            </template>
        </ui-api-table>
    </page-layout>
</template>

<script setup>
import PageLayout from "../PageLayout.vue";
import { UiApiTable } from "../../Shared/UI";

import { inject, reactive, computed, ref } from "vue";

const notify = inject('notify2');
const axios = inject('axios');

let key = ref(0);

let props = defineProps({
    suppliers: Object
});

function handleDelete(index) {

}

function calculateTotal(items) {
    let total = 0;
    items.forEach(element => {
        total += element.pivot.quantity * element.pivot.unit_price;
    });
    return `₱ ${(total).toFixed(2)}`;
}

</script>