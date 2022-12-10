<template>
    <ui-table title="Supply Items">
        <!-- header -->
        <template #tableHeaders>
            <ui-th text="#" />
            <ui-th text="ID #" />
            <ui-th text="Item" />
            <ui-th text="Unit Cost" />
            <ui-th text="Quantity" />
            <ui-th text="Subtotal" />
            <ui-th text="Actions" action />
        </template>
        <!-- content -->
        <template #tableContent>
            <tr v-for="(item, index) in supplyItems" :key="index">
                <ui-td>{{ index }}</ui-td>
                <ui-td>{{ item.inventory_item.number }}</ui-td>
                <ui-td>{{ item.inventory_item.name }}</ui-td>
                <ui-td> ₱ {{ item.unit_price }} </ui-td>
                <ui-td>{{ item.quantity }}</ui-td>
                <ui-td> ₱ {{ calculateSubtotal(item) }} </ui-td>
                <ui-td action>
                    <div class="flex gap-2 justify-end">
                        <ui-button tooltip="Edit this item" variant="bordered" icon="edit"
                            @click="handleEditAction(item.id)" />
                        <ui-button tooltip="Remove this item from supply" variant="bordered" icon="times" @click="" />
                    </div>
                </ui-td>
            </tr>
        </template>
    </ui-table>

    <ui-panel v-if="visible" title="Edit Supply Item" @close="handlePanelClose" :loading="loading">
        <template #heading>
            <div>
                <h4 class="text-lg font-semibold">Update {{ supply_item.inventory_item.name }} quantity</h4>
                <p class="text-sm">Lorem ipsum dolor sit amet consectetur, adipisicing elit. At provident quis omnis
                    molestias! Suscipit, labore!</p>
            </div>

        </template>
        <ui-input v-model="form.quantity" :error="form.errors.quantity" placeholder="quantity" label="Quantity"
            type="number" />
        <template #footer>
            <div class="text-center flex flex-col gap-3">
                <ui-button variant="primary" text="submit" @click="handleSubmitEdit()" />
                <ui-button variant="cancel" text="cancel" @click="() => visible = false" />
            </div>
        </template>
    </ui-panel>
</template>

<script setup>
import { Inertia } from '@inertiajs/inertia';
import { UiButton, UiInput, UiApiTable, UiPanel, panelScript } from 'shared-ui';
import { ref, inject, computed, reactive } from "vue";

const axios = inject('axios');
const notify = inject('notify2');

const { visible, loading } = panelScript();

let props = defineProps({
    supplyItems: Object,
    supplyId: Number,
});

let supply_item = reactive([]);
let form = reactive({
    quantity: 0,
    errors: {
        quantity: null,
    }
})

function calculateSubtotal(item) {
    return (item.unit_price * item.quantity).toFixed(2);
}

function handlePanelClose() {
    visible.value = false;

}

function handleEditAction(id) {
    loading.value = true;
    visible.value = true;

    axios.get(`/supplies/${props.supplyId}/supply-item/${id}`).then((response) => {
        supply_item = response.data;
        form.quantity = response.data.quantity;
        loading.value = false;
    }, error => {
        notify.alert(error.message, "error");
    });
}

function handleSubmitEdit() {
    loading.value = true;
    axios.post(`/supplies/${props.supplyId}/supply-item/${supply_item.id}/edit`, form).then((response) => {
        Inertia.post(`/supplies/${props.supplyId}`, {
            flash:
                { success: "Supply was recorded successfully!" }
        });
        visible.value = false;
    }, errors => {
        notify.alert(errors.message, "error");
        form.errors = errors.response.data.errors;
        loading.value = false;
    });
}

</script>