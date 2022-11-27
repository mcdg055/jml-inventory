<template>
    <ui-table title="Pass Out Items">
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
        <template #tableContent>
            <tr v-for="(item, index) in pass_out_items">
                <ui-td> {{ index }} </ui-td>
                <ui-td> {{ item.inventory_item.number }} </ui-td>
                <ui-td>{{ item.inventory_item.name_with_brand }}</ui-td>
                <ui-td> ₱ {{ item.inventory_item.unit_price }} </ui-td>
                <ui-td>
                    {{ item.quantity }}
                </ui-td>
                <ui-td> ₱ {{ item.subtotal }}</ui-td>
                <ui-td action>
                    <div class="flex gap-2 justify-end">
                        <ui-button variant="bordered" icon="edit" @click="handleEditItem(item.id)">

                        </ui-button>
                        <ui-button variant="bordered" icon="times" @click="handleDeleteItem(item.id)">

                        </ui-button>
                    </div>
                </ui-td>
            </tr>
        </template>
    </ui-table>
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
import { SearchInput, UiButton, UiInput, UiPanel } from "../../../Shared/UI";
import { ref, watch, inject } from "vue";
import debounce from "lodash/debounce";

const notify2 = inject('notify2');
const axios = inject("axios");

let props = defineProps({
    items: Object,
    passOutId: [Number, String],
    filters: {
        type: Object,
    },
})

let visible = ref(false);
let loading = ref(false);
let search = ref(/* props.filters.search */"");
let pass_out_item = ref(null);
let pass_out_items = ref(props.items);
let pass_out_quantity_error = ref(null);

//watch search changes
watch(search, debounce(
    function (value) {
        Inertia.get('/pass-outs', { search: value }, {
            preserveState: true,
            replace: true,
        })
    }, 250));

let handleDeleteItem = (id) => {
    notify2.delete(`/pass-outs/${props.passOutId}/item/${id}/delete`);
}


let reload = () => {

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
            console.log(response);
            if (response.error) {
                this.notify2.alert(response.data.error, 'error', 60000);
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