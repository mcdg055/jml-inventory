<template>
    <ui-api-table 
        title="Select Items" 
        uri="/inventory-items/get-inventory-items" 
        :uri-params="uriParams" 
        search-input
        reload
    >
        <template #headerActions>
            <ui-button tooltip="Create new item" variant="bordered" icon="plus" @click="handleAddInventoryItem" />
        </template>
        <template #tableHeaders>
            <ui-th text="#" />
            <ui-th text="ID #" />
            <ui-th text="Item" />
            <ui-th text="Stock" />
            <ui-th text="Unit Price" />
            <ui-th text="Actions" action />
        </template>
        <!-- content -->
        <template v-slot="{ data }">
            <tr v-for="(item, index) in data">
                <ui-td> {{ index }} </ui-td>
                <ui-td> {{ item.number }} </ui-td>
                <ui-td> {{ item.name }} </ui-td>
                <ui-td> {{ item.stock }}</ui-td>
                <ui-td> {{ item.unit_price }} </ui-td>

                <ui-td action>
                    <div class="flex gap-2 justify-end">
                        <ui-checkbox v-model="item.selected" @change="handleSelectInventoryItem(item.id)"
                            tooltip="Select" wrapper-class="!py-0" :key="item.id" />
                    </div>
                </ui-td>
            </tr>
        </template>
    </ui-api-table>
</template>

<script setup>
import { reactive, ref } from "vue";
import {
    UiButton,
    UiApiTable,
    UiCheckbox
} from "../../../Shared/Ui";

let props = defineProps({
    suppliers: Object,
    uriParams: {
        type: Object,
        requried: true,
    }
});

let uriParams = reactive(props.uriParams)

const emit = defineEmits(['selectItem'])

let handleEditSupplier = () => {

}
let handleDeleteSupplier = () => {

}

function handleSelectInventoryItem(id) {
    emit('selectItem', id);
}

let handleAddInventoryItem = () => {

}
</script>