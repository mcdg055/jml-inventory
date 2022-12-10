<template>
    <card-table>
        <template #cardHead>
            <div class="flex w-full items-center">
                <div>
                    <h4 class="font-medium text-xl"> {{ supply.supplier.name }}</h4>
                    <div class="font-regular">#{{ supply.number }}</div>
                </div>
                <div class="ml-auto">
                    <ui-button variant="bordered" icon="edit" @click="handleEditAction" />
                </div>
            </div>
        </template>
        <div class="p-3 text-sm flex flex-col divide-y">
            <div class="flex p-2 gap-3">
                <div class="w-4/12 flex">
                    <div class="font-medium w-1/2">
                        Supplier:
                    </div>
                    <div class="w-1/2">
                        {{ supply.supplier.name }}
                    </div>
                </div>
                <div class="w-4/12 flex">
                    <div class="font-medium w-1/2">
                        Total Items:
                    </div>
                    <div class="w-1/2">
                        {{ computedTotalItems }}
                    </div>
                </div>
                <div class="w-4/12 flex">
                    <div class="font-medium w-1/2">
                        Total Cost:
                    </div>
                    <div class="w-1/2">
                        {{ calculatedTotal }}
                    </div>
                </div>
            </div>
            <div class="flex p-2  gap-3">
                <div class="w-4/12 flex">
                    <div class="font-medium w-1/2">
                        Supply #:
                    </div>
                    <div class="w-1/2">
                        {{ supply.number }}
                    </div>
                </div>
                <div class="w-4/12 flex">
                    <div class="font-medium w-1/2">
                        Date Received:
                    </div>
                    <div class="w-1/2">
                        {{ supply.created_at }}
                    </div>
                </div>
                <div class="w-4/12 flex">
                    <div class="font-medium w-1/2">
                        Date Last Updated:
                    </div>
                    <div class="w-1/2">
                        {{ supply.updated_at }}
                    </div>
                </div>
            </div>
            <div class="flex p-2 w-full grow-0 shrink-0">
                <div class="w-6/12 flex">
                    <div class="font-medium w-4/12  grow-0 shrink-0">
                        Notes:
                    </div>
                    <div class="w-8/12 grow-0 shrink-0">
                        {{ supply.notes ?? "N/A" }}
                    </div>
                </div>
            </div>
        </div>
    </card-table>

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
import {UiInput, UiPanel} from "shared-ui";
import { CardTable } from '../../../Shared/UI';
import { computed, ref } from 'vue';

let visible = ref(false);
let loading = ref(true);

let props = defineProps({
    supply: Object,
});

let calculatedTotal = computed(() => {
    let total = 0;
    props.supply.items.forEach(element => {
        total += element.pivot.quantity * element.pivot.unit_price;
    });
    return `₱ ${(total).toFixed(2)}`;
})

let computedTotalItems = computed(() => {
    let total = 0;
    props.supply.items.forEach(element => {
        total += element.pivot.quantity;
    });
    return total;
})

function handleEditAction() {
    loading.value = false;
    visible.value = true;
}

function handlePanelClose() {
    visible.value = false;
}

function handleSubmitEdit() {

}

</script>