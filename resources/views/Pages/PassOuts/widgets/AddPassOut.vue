<template>
    <page-layout pageHeading="Make a Pass Out" title="Inventory Items">

        <card-table class="border mb-6 max-w-[400px]">
            <template #cardHead>
                <h4 class="font-medium">Pass Out Description</h4>
            </template>
            <div class="flex flex-col gap-3 p-3">
                <ui-input v-model="form.short_description"
                    :error="errors.short_description ? errors.short_description : ''" label="Short Description" />
                <ui-textarea v-model="form.notes" label="Notes" placeholder="Brief note about the pass out" />
            </div>
        </card-table>

        <card-table class="border mb-6 max-w-[400px]">
            <template #cardHead>
                <h4 class="font-medium">Select an item here</h4>
            </template>
            <div class="p-4 min-h-[200px]">

                <div class="flex gap-3 mx-w-sm items-stretch align-center">
                    <div class="relative w-full">
                        <search-input v-model="search" @input="handleSearch(search)" placeholder="searh item here" />
                        <ul v-if="search.length && inventory_items.length && !loading"
                            class="absolute divide-y border rounded shadow-lg divide w-full bg-white overflow-hidden">
                            <li v-for="(item, index) in inventory_items" :key="item.id"
                                class="p-2 truncate transition cursor-pointer nowrap hover:bg-gray-300"
                                @click="handleSelectItem(index)">{{ item.name_with_brand }}</li>
                        </ul>
                        <ul v-else-if="search.length && loading"
                            class="absolute divide-y border rounded shadow-lg divide w-full bg-white overflow-hidden">
                            <li class="p-2 truncate transition cursor-pointer nowrap hover:bg-gray-300">Loading ...
                            </li>
                        </ul>
                        <ul v-else-if="search.length && !inventory_items.length && !loading"
                            class="absolute divide-y border rounded shadow-lg divide w-full bg-white overflow-hidden">
                            <li class="p-2 truncate transition cursor-pointer nowrap hover:bg-gray-300">No item found
                            </li>
                        </ul>
                        <small class="text-red-500">{{ errors.selected_items && form.selected_items.length === 0 ?
                                errors.selected_items[0] : ""
                        }}</small>

                    </div>
                </div>
            </div>
        </card-table>


        <ui-table title="Selected Items">

            <template #tableHeaders>
                <ui-th text="#" />
                <ui-th text="ID#" />
                <ui-th text="Item" />
                <ui-th text="Stock" />
                <ui-th text="Unit Price" />
                <ui-th text="Quantity" />
                <ui-th text="Subtotal" />
                <ui-th text="Actions" action />
            </template>
            <!-- content -->
            <template #tableContent>
                <tr v-for="(item, index) in form.selected_items">
                    <ui-td> {{ index + 1 }} </ui-td>
                    <ui-td> {{ item.number }} </ui-td>
                    <ui-td> {{ item.brand.name + " " + item.name }} </ui-td>
                    <ui-td> {{ item.stock }} </ui-td>
                    <ui-td> {{ item.unit_price }} </ui-td>
                    <ui-td>
                        <input-quantity v-model="item.quantity" :errors="parseError(index)" />
                    </ui-td>
                    <ui-td> {{ subtotal(item) }}</ui-td>
                    <ui-td action>
                        <div class="flex gap-2 justify-end">
                            <button role="button" type="button" @click="handleDeleteItem(index)" :key="item.id"
                                class="btn-bordered">
                                <Icon icon="times"></Icon>
                            </button>
                        </div>
                    </ui-td>
                </tr>

                <tr v-if="form.selected_items.length === 0">
                    <td colspan="8" class="p-4 text-center text-lg font-medium text-gray-500">Selected Items will appear
                        here.</td>
                </tr>
            </template>
        </ui-table>

        <template #footer>
            <div class="flex gap-5 justify-end w-full bg-gray-300 p-2">
                <div class="flex gap-6 items-center">
                    <div class="text-lg font-semibold text-red-600">
                      {{ computedTotal() }}
                    </div>
                    <div class="flex gap-3">
                        <button class="bg-blue-600 text-white py-2 px-5 rounded" @click="handleSubmit">Submit
                            P.O.</button>
                        <button class="bg-gray-400 text-white py-2 px-5 rounded">Cancel</button>
                    </div>
                </div>
            </div>
        </template>
    </page-layout>
</template>

<script>
import PageLayout from "../../PageLayout.vue";
import SelectedItemsTable from "../components/SelectedItemsTable.vue";
import PassOutTotal from "../components/PassOutTotal.vue";

import InputQuantity from "../components/InputQuantity.vue";
import { SearchInput, CardTable, UiButton, UiInput, UiTextarea } from "../../../Shared/Ui";
import { Inertia } from "@inertiajs/inertia";
import debounce from "lodash/debounce";

import axios from 'axios'

export default {
    inject: ['notify', 'axios'],
    components: {
        PageLayout,
        SelectedItemsTable,
        PassOutTotal,
        CardTable,
        SearchInput,
        UiButton,
        InputQuantity,
        UiInput,
        UiTextarea
    },
    data() {
        return {
            search: "",
            inventory_items: [],
            selected_items: [],
            errors: [],
            loading: true,
            form: {
                short_description: "",
                notes: "",
                selected_items: [],
            }
        }
    },
    computed: {

    },
    methods: {
        handleSearch: debounce(function (value) {
            axios.post("/pass-outs/fetch-items", { search: value, selected: this.form.selected_items })
                .then((response) => {
                    this.inventory_items = response.data;

                    /* console.log(this.inventory_items); */
                }).finally(() => {
                    this.loading = false;
                })
        }, 250),
        handleSelectItem(index) {
            this.search = "";
            this.inventory_items[index]['quantity'] = 0;
            this.form.selected_items.push(this.inventory_items[index]);

            this.inventory_items.splice(index, 1);
        },
        handleDeleteItem(index) {
            this.form.selected_items.splice(index, 1);
        },
        handleSubmit: debounce(function (value) {
            axios.post("/pass-outs/store", this.form)
                .then((response) => {
                    if (response.data.error) {
                        this.notify(response.data.error, 'error', 60000);
                    }
                    else {
                        Inertia.visit("/pass-outs/redirect-to-browse", { method: 'post', message: response.data.success })
                    }
                })
                .catch(error => {

                    this.notify(error.response.data.message, 'error');
                    this.errors = error.response.data.errors;

                });
        }, 250),
        parseError(index) {
            var key = `selected_items.${index}.quantity`;

            return this.errors[`selected_items.${index}.quantity`] === undefined ? "" : this.errors[key][0];

        },
        subtotal(item) {
            let subtotal = (item.quantity * item.unit_price).toFixed(2);
            this.form.total += parseFloat(subtotal);
            return "₱ " + subtotal;
        },
        computedTotal() {

            let total = 0;

            let count = this.form.selected_items.length;
          
            if (count > 0) {
                this.form.selected_items.forEach(element => {

                    let quantity = element.quantity ? element.quantity : 0.0;
                    let unit_price = element.unit_price ? element.unit_price : 0.0;

                    total += parseFloat(quantity) * parseFloat(unit_price);
                });
            }
           
            return   `Total: ₱ ${total.toFixed(2)}`;
        }

    },
}

</script>