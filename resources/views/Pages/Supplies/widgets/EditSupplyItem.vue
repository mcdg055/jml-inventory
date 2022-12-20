<template>
    <basic-container :loading="loading">
        <template #heading>
            <div>
                <h4 class="text-lg font-semibold">Update {{ supply_item.inventory_item.name }} quantity</h4>
                <p class="text-sm">Lorem ipsum dolor sit amet consectetur, adipisicing elit. At provident quis omnis
                    molestias! Suscipit, labore!</p>
            </div>

        </template>
        <ui-input v-model="form.quantity" :error="form.errors.quantity" placeholder="quantity" label="Quantity"
            type="number" />
        <template #footer>
            <div class="text-center flex flex-col gap-3">
                <ui-button variant="primary" text="submit" @click="handleSubmitEdit" />
                <ui-button variant="cancel" text="cancel" @click="" />
            </div>
        </template>

    </basic-container>
</template>

<script setup>
import { BasicContainer, UiInput } from 'shared-ui';
import { ref, inject, computed, reactive } from "vue";
import { Inertia } from '@inertiajs/inertia';

const axios = inject('axios');
const notify = inject('notify2');
const emit = defineEmits(['close']);

let props = defineProps({
    supplyId: Number,
    itemId: Number,
});

let loading = ref(false);

let supply_item = ref({});
let form = reactive({
    quantity: 0,
    errors: {
        quantity: null,
    }
})

function loadSupplyItem() {
    loading.value = true;
    axios.get(`/supplies/${props.supplyId}/supply-item/${props.itemId}`)
        .then((response) => {
            supply_item.value = response.data;
            form.quantity = response.data.quantity;
            loading.value = false;
        }, error => {
            notify.alert(error.message, "error");
        });
}

loadSupplyItem();

function handleSubmitEdit() {
    loading.value = true;
    axios.post(`/supplies/${props.supplyId}/supply-item/${props.itemId}/edit`, form).then((response) => {
        Inertia.post(`/supplies/${props.supplyId}`, {
            flash:
                { success: response.data.success }
        });
        emit('close');
    }).catch((errors) => {
        loading.value = false;
        notify.alert(errors.message, "error");
        if (errors = errors.response) {
            form.errors = errors.response.data.errors;
        }
    });
}


</script>