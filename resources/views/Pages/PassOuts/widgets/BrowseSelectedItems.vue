<template>
    <ui-table title="Pass Out Items">
        <template #headerActions>
            <div class="flex justify-between items-center p-2">
                <div class="flex gap-2">
                    <ui-link icon="plus" uri="/pass-outs/create" />
                    <ui-button icon="refresh" @click="reload" />
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
            <tr>
                <ui-td> [1]</ui-td>
                <ui-td> [00000001] </ui-td>
                <ui-td> [item name] </ui-td>
                <ui-td> [250] </ui-td>
                <ui-td>
                    [15]
                </ui-td>
                <ui-td> [250]</ui-td>
                <ui-td action>
                    <div class="flex gap-2 justify-end">
                        <button role="button" type="button" @click="handleEditItem" class="btn-bordered">
                            <Icon icon="edit"></Icon>
                        </button>
                        <button role="button" type="button" @click="handleDeleteItem" class="btn-bordered">
                            <Icon icon="times"></Icon>
                        </button>
                    </div>
                </ui-td>
            </tr>
        </template>
    </ui-table>
    <ui-panel v-if="visible" title="Edit Pass Out Item" @close="handlePanelClose">
        <template #heading>
            <h4 class="text-lg font-semibold">Update Item name quantity</h4>
            <p class="text-sm">Lorem ipsum dolor sit amet consectetur, adipisicing elit. At provident quis omnis
                molestias! Suscipit, labore!</p>
        </template>

        <ui-input placeholder="quantity" label="Quantity" type="number" />

        <template #footer>
            <div class="text-center flex flex-col">
                <button>Submit</button>
                <button>Cancel</button>
            </div>
        </template>
    </ui-panel>
</template>

<script setup>
import { SearchInput, CardTable, UiButton, UiInput, UiTextarea, UiPanel } from "../../../Shared/UI";
import InputQuantity from "../components/InputQuantity.vue";
import { ref, watch, inject } from "vue";
import debounce from "lodash/debounce";

let props = defineProps({
    pass_outs: Object,
    filters: {
        type: Object,
    },
})

let visible = ref(false);

const notify2 = inject('notify2');
const axios = inject("axios");

let search = ref(/* props.filters.search */"");

//watch search changes
watch(search, debounce(
    function (value) {
        Inertia.get('/pass-outs', { search: value }, {
            preserveState: true,
            replace: true,
        })
    }, 250));

let handleDeleteItem = () => {
    notify2.delete("/close");
}

let reload = () => {

}

let item = ref([]);

let handleEditItem = () => {
    /* axios.post("/pass-outs/{pass_out}/item/{item}", {pass_out: ""}) */
    visible.value = true;
}

let handlePanelClose = () => {
    visible.value = false;
}
</script>