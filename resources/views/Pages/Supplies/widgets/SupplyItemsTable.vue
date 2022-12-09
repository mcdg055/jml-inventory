<template>
    <ui-table title="Selected Items">
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
                <ui-td>{{ item.number }}</ui-td>
                <ui-td>{{ item.name }}</ui-td>
                <ui-td> [₱ 30] </ui-td>
                <ui-td>[50]</ui-td>
                <ui-td> [₱500] </ui-td>
                <ui-td action>
                    <div class="flex gap-2 justify-end">
                        <ui-button tooltip="Remove from this item from selected" variant="bordered" icon="times"
                            @click="() => { }" />
                    </div>
                </ui-td>
            </tr>
        </template>
    </ui-table>
</template>

<script setup>
import { UiButton } from '../../../Shared/UI';
let props = defineProps({
    supplyItems: Object,
});
</script>