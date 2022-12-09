<template>
    <card-table class="border mb-6">
        <template #cardHead>
            <div class="flex w-full items-center">
                <div>
                    <h4 class="font-medium text-xl"> {{ pass_out.name }}</h4>
                    <div class="font-regular">P.O. #{{ pass_out.number }}</div>
                </div>
                <div class="ml-auto">
                    <ui-button variant="bordered" icon="edit" @click="handleEditPassOutDetails" />
                </div>
            </div>

        </template>
        <div class="p-3 text-sm flex flex-col">
            <div class="flex p-2 border-b gap-3">

                <div class="w-4/12 flex">
                    <div class="font-medium w-1/2">
                        Pass Out Name:
                    </div>
                    <div class="w-1/2">
                        {{ pass_out.name }}
                    </div>
                </div>
                <div class="w-4/12 flex">
                    <div class="font-medium w-1/2">
                        Total Items:
                    </div>
                    <div class="w-1/2">
                        {{ pass_out.total_items }}
                    </div>
                </div>
                <div class="w-4/12 flex">
                    <div class="font-medium w-1/2">
                        Total Cost:
                    </div>
                    <div class="w-1/2">
                        ₱ {{ total }}
                    </div>
                </div>
            </div>
            <div class="flex p-2 border-b">
                <div class="w-4/12 flex">
                    <div class="font-medium w-1/2">
                        Pass Out Number:
                    </div>
                    <div class="w-1/2">
                        {{ pass_out.number }}
                    </div>
                </div>
                <div class="w-4/12 flex">
                    <div class="font-medium w-1/2">
                        Date Created:
                    </div>
                    <div class="w-1/2">
                        {{ pass_out.created_at }}
                    </div>
                </div>
                <div class="w-4/12 flex">
                    <div class="font-medium w-1/2">
                        Date Last Updated:
                    </div>
                    <div class="w-1/2">
                        {{ pass_out.updated_at }}
                    </div>
                </div>
            </div>
            <div class="flex p-2 border-b w-full grow-0 shrink-0">
                <div class="w-6/12 flex">
                    <div class="font-medium w-4/12  grow-0 shrink-0">
                        Notes:
                    </div>
                    <div class="w-8/12 grow-0 shrink-0">
                        {{ notes }}
                    </div>
                </div>
            </div>
        </div>
    </card-table>
    <ui-panel v-if="visible" title="Edit Pass Out" @close="handlePanelClose" :loading="loading">
        <template #heading>
            <div>
                <h4 class="text-lg font-semibold">Update {{ pass_out.name }} pass out details</h4>
                <p class="text-sm">Lorem ipsum dolor sit amet consectetur, adipisicing elit. At provident quis omnis
                    molestias! Suscipit, labore!</p>
            </div>
        </template>

        <div class="flex flex-col gap-3">
            <ui-input v-model="form.name" :error="form.errors.name" label="Name" />
            <ui-textarea v-model="form.notes" :error="form.errors.notes" label="Notes" placeholder="Pass out notes" />
        </div>
        <template #footer>
            <div class="text-center flex flex-col gap-3">
                <ui-button variant="primary" text="submit" @click="handleSubmitEdit()" />
                <ui-button variant="cancel" text="cancel" @click="() => visible = false" />
            </div>
        </template>
    </ui-panel>
</template>

<script setup>
import { ref, inject, computed, reactive } from "vue";
import { CardTable } from "../../../Shared/Ui";
import { UiButton, UiInput, UiPanel, UiTextarea } from "../../../Shared/UI";

const notify2 = inject('notify2');
const axios = inject('axios');

let visible = ref(false);
let loading = ref(false);


let props = defineProps({
    item: {
        type: Object,
        required: true
    },
});

let pass_out = ref(props.item);

let form = reactive({
    name: null,
    notes: null,
    errors: {
        name: null,
        notes: null,
    }
});

let notes = computed(() => {
    return pass_out.value.notes ? pass_out.value.notes : "N/A";
})

let total = computed(() => {
    return (props.item.total).toFixed(2);
})

/* TODO: edit pass out details */
let handleEditPassOutDetails = () => {
    loading.value = true;
    visible.value = true;
    axios.post(`/pass-outs/${pass_out.value.id}/edit`).then((response) => {
        form.name = response.data.name;
        form.notes = response.data.notes;
        console.log(form.value);
        loading.value = false;
    }).finally((response) => {
        loading.value = false;
        /*  console.log("ukit"); */
    });
}

let handlePanelClose = () => {
    visible.value = false;
}

let handleSubmitEdit = () => {

    console.log(pass_out);
    loading.value = true;

    axios.post(`/pass-outs/${pass_out.value.id}/update`, form)
        .then((response) => {
            if (response.error) {
                this.notify2.alert(response.data.error, 'error');
            }
            else {
                loading.value = false;
                visible.value = false;
                pass_out.value = response.data;
                notify2.alert("Pass out details successfully updated!");
            }
        }).catch((error) => {
            loading.value = false;
            form.errors = error.response.data.errors;
        })
}
</script>