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
                        <ui-button tooltip="Remove this item from supply" variant="bordered" icon="times"
                            @click="handleDeleteAction(item.id)" />
                    </div>
                </ui-td>
            </tr>
        </template>
    </ui-table>

</template>

<script setup>
import EditSupplyItem from './EditSupplyItem.vue';

import { Inertia } from '@inertiajs/inertia';
import { UiButton, UiInput, UiApiTable, UiPanel, panelScript } from 'shared-ui';
import { ref, inject, computed, reactive } from "vue";

const axios = inject('axios');
const notify = inject('notify2');
const panel = inject('panel');

const { openPanel, closePanel, visible, loading } = panelScript();

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
    loading.value = false;
}

function handleEditAction(id) {
    panel.open({
        component: EditSupplyItem,
        props: {
            title: 'Edit Supply Item',
            supplyId: props.supplyId,
            itemId: id,
        }
    });
}

function handleSubmitEdit() {
    loading.value = true;
    axios.post(`/supplies/${props.supplyId}/supply-item/${supply_item.id}/edit`, form).then((response) => {
        Inertia.post(`/supplies/${props.supplyId}`, {
            flash:
                { success: response.data.success }
        });
        closePanel();
    }).catch((errors) => {
        loading.value = false;
        notify.alert(errors.message, "error");
        if (errors = errors.response.data.errors) {
            form.errors = errors.response.data.errors;
        }
    });
}

function handleDeleteAction(id) {
    notify.confirm(() => {
        axios.delete(`/supplies/${props.supplyId}/supply-item/${id}/delete`).then((response) => {
            if (response.data.success) {
                Inertia.post(`/supplies/${props.supplyId}`, {
                    flash: {
                        success: response.data.success,
                    }
                });
            } else {
                notify.alert(response.data.error, 'error');
            }
        }, errors => {
            notify.alert(errors.message, "error");
        })
    });
}

</script>