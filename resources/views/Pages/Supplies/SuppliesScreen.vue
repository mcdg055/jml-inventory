<template>

    <page-layout pageHeading="Receive a Supply" title="Supplies">
        <div class="flex flex-col gap-5">

            <card-table class="border">
                <template #cardHead>
                    <h4 class="font-medium">Select a Supplier</h4>
                </template>
                <div class="flex flex-col gap-3 p-3  max-w-[400px]">
                    <ui-select :options="suppliers" text="Select a supplier" />
                </div>
            </card-table>

            <select-inventory-items-table @select-item="HandledSelectItem" :uri-params="uriParams" :key="key" />

            <selected-inventory-items-table :inventory_items="selectedInventoryItems" />

        </div>

        <template #footer>
            <div class="flex gap-5 justify-end w-full bg-gray-300 p-2">
                <div class="flex gap-6 items-center">
                    <div class="text-lg font-semibold text-red-600">
                        {{ computedTotal }}
                    </div>
                    <div class="flex gap-3">
                        <ui-button variant="primary" text="Submit P.O." @click="handleSubmit" />
                        <ui-button variant="cancel" text="Cancel" @click="handleCancelAction" />
                    </div>
                </div>
            </div>
        </template>
    </page-layout>
</template>

<script setup>
import PageLayout from "../PageLayout.vue";
import SelectInventoryItemsTable from "./widgets/SelectInventoryItemsTable.vue";
import SelectedInventoryItemsTable from "./components/SelectedInventoryItemsTable.vue";
import { inject, reactive, computed, ref } from "vue";
import {
    CardTable,
    UiSelect,
} from "../../Shared/UI";

const notify = inject('notify2');
const axios = inject('axios');

let key = ref(0);

let inventory_items_id = ref([]);

let props = defineProps({
    suppliers: Object
});

let selectedInventoryItems = ref([]);

let uriParams = reactive({
    selected: inventory_items_id,
})

let HandledSelectItem = (id) => {
    inventory_items_id.value.push(id);
    axios.get(`/inventory-items/${id}/read`).then((response) => {
        let item = Object.assign({ quantity: 0 }, response.data);
        selectedInventoryItems.value.push(item);
        key.value++;
    });

}

let handleEditSupplier = () => {

}
let handleDeleteSupplier = () => {

}

let handleSubmit = () => {

}

let handleCancelAction = () => {

}

let computedTotal = computed(() => {

    let total = 0;

    /* let count = this.form.selected_items.length;
    
    if (count > 0) {
        this.form.selected_items.forEach(element => {
    
            let quantity = element.quantity ? element.quantity : 0.0;
            let unit_price = element.unit_price ? element.unit_price : 0.0;
    
            total += parseFloat(quantity) * parseFloat(unit_price);
        });
    }
     */
    return `Total: ₱ ${total.toFixed(2)}`;
});

</script>