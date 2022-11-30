<template>
    <ui-api-table title="Pass Out Items" :uri="`/pass-outs/${props.passOutId}/items/browse`" search-input reload>
        <template #headerActions>
            <!-- <ui-button variant="link" icon="plus" uri="/pass-outs/create" /> -->
        </template>
        <template #tableHeaders>
            <ui-th text="#" />
            <ui-th text="ID#" />
            <ui-th text="Item Name" />
            <ui-th text="Unit Price" />
            <ui-th text="Quantity" />
            <ui-th text="Subtotal" />
            <ui-th text="Actions" action />
        </template>
        <!-- content -->
        <template v-slot="{ data }">
            <tr v-for="(item, index) in data">
                <ui-td> {{ index }} </ui-td>
                <ui-td> {{ item.inventory_item.number }} </ui-td>
                <ui-td>{{ item.inventory_item.name_with_brand }}</ui-td>
                <ui-td> ₱ {{ item.inventory_item.unit_price }} </ui-td>
                <ui-td>{{ item.quantity }} </ui-td>
                <ui-td> ₱ {{ item.subtotal }}</ui-td>
                <ui-td action>
                    <div class="flex gap-2 justify-end">
                        <ui-button variant="bordered" icon="edit" @click="handleEditItem(item.id)" />
                        <ui-button variant="bordered" icon="times" @click="handleDeleteItem(item.id)" />
                    </div>
                </ui-td>
            </tr>
        </template>
    </ui-api-table>
    <ui-panel v-if="visible" title="Edit Pass Out Item" @close="handlePanelClose" :loading="loading">
        <template #heading>
            <div>
                <h4 class="text-lg font-semibold">Update {{ pass_out_item.inventory_item.name }} quantity</h4>
                <p class="text-sm">Lorem ipsum dolor sit amet consectetur, adipisicing elit. At provident quis omnis
                    molestias! Suscipit, labore!</p>
            </div>

        </template>
        <ui-input v-model="pass_out_item.quantity" :error="pass_out_quantity_error" placeholder="quantity"
            label="Quantity" type="number" />
        <template #footer>
            <div class="text-center flex flex-col gap-3">
                <ui-button variant="primary" text="submit" @click="handleSubmitEdit(pass_out_item.id)" />
                <ui-button variant="cancel" text="cancel" @click="() => visible = false" />
            </div>
        </template>
    </ui-panel>
</template>

<script setup>
import { UiButton, UiInput, UiPanel, UiApiTable } from "../../../Shared/UI";
import { ref, inject } from "vue";
import { Inertia } from "@inertiajs/inertia";

const notify2 = inject('notify2');
const axios = inject("axios");

let props = defineProps({
    passOutId: [Number, String],
    filters: {
        type: Object,
    },
})

let visible = ref(false);
let loading = ref(true);
let pass_out_item = ref(null);

let pass_out_quantity_error = ref(null);

let handleDeleteItem = (id) => {
    notify2.confirm(() => {
        axios.delete(`/pass-outs/item/${id}/delete`).then((response) => {
            if (response.data.success) {
                Inertia.visit(`/pass-outs/${props.passOutId}`, { success: "Pass out item was successfully deleted!" });
            } else {
                notify2.alert(response.data.error, 'error');
            }
        })
    });
}

let handleEditItem = (id) => {
    loading.value = true;
    visible.value = true;
    axios.post(`/pass-outs/item/${id}`).then((response) => {
        pass_out_item.value = response.data;
    }).finally(() => {
        loading.value = false;
    })
}

let handlePanelClose = () => {
    visible.value = false;
}

let handleSubmitEdit = (id) => {
    loading.value = true;

    axios.post(`/pass-outs/${props.passOutId}/item/${id}/edit`, pass_out_item.value)
        .then((response) => {
            if (response.error) {
                this.notify2.alert(response.data.error, 'error');
            }
            else {
                loading.value = false;
                visible.value = false;
                pass_out_items.value = response.data;
                notify2.alert("Item updated successfully");
            }
        }).catch((error) => {
            loading.value = false;
            pass_out_quantity_error.value = error.response.data.errors.quantity[0];
        })
}

</script>