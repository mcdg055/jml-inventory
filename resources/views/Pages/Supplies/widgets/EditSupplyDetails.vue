<template>
    <basic-container>

        <div class="flex gap-6 flex-col">
            <card-layout class="shadow-sm">
                <template #cardHead>
                    <h4 class="text-lg font-medium">{{ supply.supplier.name }}</h4>
                    <p>Supply #: {{ supply.number }}</p>
                </template>
                <div>
                    <div class="flex w-full py-2 px-5">
                        <div class="w-2/6">Supplier:</div>
                        <div class="font-bold">{{ supply.supplier.name }}</div>
                    </div>
                    <div class="flex w-full py-2 px-5 border-t">
                        <div class="w-2/6">Supply #:</div>
                        <div class="font-bold">{{ supply.number }}</div>
                    </div>
                    <div class="flex w-full py-2 px-5 border-t">
                        <div class="w-2/6">Date Received:</div>
                        <div class="font-bold">{{ supply.created_at }}</div>
                    </div>

                    <div class="flex w-full py-2 px-5 border-t">
                        <div class="w-2/6">Total Items:</div>
                        <div class="font-bold"> {{ computedTotalItems }} </div>
                    </div>
                    <div class="flex w-full py-2 px-5 border-t">
                        <div class="w-2/6">Total Cost:</div>
                        <div class="font-bold">{{ calculatedTotal }}</div>
                    </div>
                </div>
            </card-layout>

            <ui-textarea v-model="form.notes" :errors="form.errors.notes" label="Notes" placeholder="Notes" />
        </div>
        <template #footer>
            <div class="text-center flex flex-col gap-3">
                <ui-button variant="primary" text="submit" @click="handleSubmitEdit" />
                <ui-button variant="cancel" text="cancel" @click="handleCancel" />
            </div>
        </template>
    </basic-container>
</template>

<script setup>
import { CardLayout, UiTextarea, BasicContainer } from "shared-ui";
import { reactive, inject, computed } from "vue";
import { Inertia } from "@inertiajs/inertia";

const axios = inject('axios');
const notify = inject('notify2');
const emit = defineEmits(['close']);

let props = defineProps({
    supply: {
        type: Object,
        required: true,
    }
});

const form = reactive({
    notes: props.supply.notes,
    errors: {
        notes: null,
    },
    success: () => {
        console.log("Hello world");
    }
})

let calculatedTotal = computed(() => {
    let total = 0;
    props.supply.supply_items.forEach(element => {
        total += element.quantity * element.unit_price;
    });
    return `₱ ${(total).toFixed(2)}`;
})

let computedTotalItems = computed(() => {
    let total = 0;
    props.supply.supply_items.forEach(element => {
        total += element.quantity;
    });
    return total;
})

function handleSubmitEdit() {
    axios.post(`/supplies/${props.supply.id}/update`, form)
        .then((response) => {
            if (response.data) {
                Inertia.post(`/supplies/${props.supply.id}`, {
                    flash:
                        { success: "Supply was updated successfully!" }
                });
                emit('close');
            }
        }, errors => {
            console.log(errors);
        })
}

function handleCancel() {

}
</script>