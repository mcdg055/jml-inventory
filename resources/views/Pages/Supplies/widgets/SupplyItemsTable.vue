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
                        <ui-button tooltip="Edit this item" variant="bordered" icon="edit" @click="handleEditAction" />
                        <ui-button tooltip="Remove this item from supply" variant="bordered" icon="times"
                            @click="" />
                    </div>
                </ui-td>
            </tr>
        </template>
    </ui-table>

    <ui-panel v-if="visible" title="Edit Supply Item" @close="handlePanelClose" :loading="loading">
        <template #heading>
            <div>
                <h4 class="text-lg font-semibold">Update [item] quantity</h4>
                <p class="text-sm">Lorem ipsum dolor sit amet consectetur, adipisicing elit. At provident quis omnis
                    molestias! Suscipit, labore!</p>
            </div>

        </template>
        <ui-input placeholder="quantity" label="Quantity" type="number" />
        <template #footer>
            <div class="text-center flex flex-col gap-3">
                <ui-button variant="primary" text="submit" @click="handleSubmitEdit(pass_out_item.id)" />
                <ui-button variant="cancel" text="cancel" @click="() => visible = false" />
            </div>
        </template>
    </ui-panel>
</template>

<script setup>
import { UiButton, UiInput, UiApiTable, UiPanel } from 'shared-ui';
import { ref, inject } from "vue";
let visible = ref(false);
let loading = ref(true);

let props = defineProps({
    supplyItems: Object,
});

function handlePanelClose() {
    visible.value = false;
}

function handleEditAction() {
    loading.value = false;
    visible.value = true;
}

function handleSubmitEdit() {

}

</script>