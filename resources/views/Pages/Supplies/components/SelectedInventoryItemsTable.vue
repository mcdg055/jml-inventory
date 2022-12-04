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
                    <ui-td>{{ inventory_item.unit_price }}</ui-td>
                    <ui-td>{{ '[0]' }}</ui-td>
                    <ui-td>  ₱ [500]</ui-td>
                    <ui-td action>
                        <div class="flex gap-2 justify-end">
                            <ui-button tooltip="Remove from selected items" variant="bordered" icon="times" @click="handleDelete(pass_out)" />
                        </div>
                    </ui-td>
                </tr>
        </template>
    </ui-table>
</template>

<script setup>

let props = defineProps({
    inventory_items: [Array, Object],
});
</script>