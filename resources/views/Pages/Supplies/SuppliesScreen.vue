<template>

    <page-layout pageHeading="Receive a Supply" title="Supplies">
        <div class="flex flex-col gap-5">

            <card-table class="border">
                <template #cardHead>
                    <h4 class="font-medium">Select a Supplier</h4>
                </template>
                <div class="flex flex-col gap-3 p-3  max-w-[400px]">
                    <ui-select v-model="form.supplier_id" :options="suppliers" :error="form.errors.supplier"
                        text="Select a supplier" />
                    <ui-textarea v-model="form.notes" placeholder="Notes" :error="form.errors.notes"></ui-textarea>
                </div>
            </card-table>

            <select-inventory-items-table @select-item="HandledSelectItem" :uri-params="uriParams" :key="key" />

            <selected-inventory-items-table :inventory_items="form.items" :errors="form.errors" @computed-total="updateTotal"
                @delete-item="handleDeleteItem" />

        </div>

        <template #footer>
            <div class="flex gap-5 justify-end w-full bg-gray-300 p-2">
                <div class="flex gap-6 items-center">
                    <div class="text-lg font-semibold text-red-600">
                        {{ total }}
                    </div>
                    <div class="flex gap-3">
                        <ui-button variant="primary" text="Receive Supply" @click="handleSubmit" />
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
    UiTextarea
} from "../../Shared/UI";

const notify = inject('notify2');
const axios = inject('axios');

let key = ref(0);

let form = reactive({
    supplier_id: null,
    notes: null,
    items: [],
    errors: {
        supplier: null,
        notes: null,
        items: [],
    }
})

let inventory_items_id = ref([]);

let props = defineProps({
    suppliers: Object
});

let selectedInventoryItems = ref([]);

let uriParams = reactive({
    selected: inventory_items_id,
})

let total = ref("TOTAL: ₱ 0.00")

let HandledSelectItem = (id) => {
    inventory_items_id.value.push(id);
    axios.get(`/inventory-items/${id}/read`).then((response) => {
        let item = Object.assign({ quantity: 0 }, response.data);
        form.items.push(item);
        key.value++;
    });
}

function handleDeleteItem(index) {
    form.items.splice(index, 1);
    inventory_items_id.value.splice(index, 1);
    key.value++;
}

function updateTotal(value) {
    total.value = value;
}

function handleSubmit() {
    axios.post('/supplies/add', form, {
        headers: {
            'Content-Type': 'application/json',
        }
    }).then((response) => {
        console.log(response);
    }, error => {
        form.errors = error.response.data.errors;
        notify.alert(error.response.data.message, 'error');
    }).finally(() => {

    });
}

function handleCancelAction() {
    
}

</script>