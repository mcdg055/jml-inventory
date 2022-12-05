<template>
    <ui-table title="Selected Items">
        <!-- header -->
        <template #tableHeaders>
            <ui-th text="#" />
            <ui-th text="ID #" />
            <ui-th text="Item" />
            <ui-th text="Unit Cost" />
            <ui-th text="Quantity" />
            <ui-th text="Total Cost" />
            <ui-th text="Actions" action />
        </template>
        <!-- content -->
        <template #tableContent>
            <tr v-for="(inventory_item, index) in inventory_items" :key="index">
                <ui-td>{{ index }}</ui-td>
                <ui-td>{{ inventory_item.number }}</ui-td>
                <ui-td>{{ inventory_item.name }}</ui-td>
                <ui-td> ₱ {{ inventory_item.unit_price }}</ui-td>
                <ui-td><input-quantity v-model="inventory_item.quantity" /></ui-td>
                <ui-td> ₱ {{ calculateSubtotal(inventory_item.quantity, inventory_item.unit_price) }}</ui-td>
                <ui-td action>
                    <div class="flex gap-2 justify-end">
                        <ui-button tooltip="Remove from this item from selected" variant="bordered" icon="times"
                            @click="handleDelete(index)" />
                    </div>
                </ui-td>
            </tr>
        </template>
    </ui-table>
</template>

<script setup>
import InputQuantity from "./InputQuantity.vue";
let props = defineProps({
    inventory_items: [Array, Object],
});

const emits = defineEmits(['computedTotal', 'deleteItem']);

function calculateSubtotal(quantity, unit_price) {

    let total = quantity * unit_price;

    calculateTotal();

    return total.toFixed(2);
}

function calculateTotal() {
    let total = 0;

    let count = props.inventory_items.length;

    if (count > 0) {
        props.inventory_items.forEach(item => {

            let quantity = item.quantity ? item.quantity : 0.0;
            let unit_price = item.unit_price ? item.unit_price : 0.0;

            total += parseFloat(quantity) * parseFloat(unit_price);
        });
    }

    emits('computedTotal', `Total: ₱ ${total.toFixed(2)}`);
}

function handleDelete(index) {
    emits('deleteItem', index);
}

</script>