<template>
    <ui-api-table title="Suppliers" :uri="`/suppliers/browse`" search-input reload :key=key>
        <template #headerActions>
            <ui-button variant="bordered" icon="plus" @click="handleAddSupplier" />
        </template>
        <template #tableHeaders>
            <ui-th text="#" />
            <ui-th text="ID#" />
            <ui-th text="Name" />
            <ui-th text="Contact Number" />
            <ui-th text="Contact Person" />
            <ui-th text="Status" />
            <ui-th text="Actions" action />
        </template>
        <!-- content -->
        <template v-slot="{ data }">
            <tr v-for="(supplier, index) in data">
                <ui-td> {{ index }} </ui-td>
                <ui-td> {{ supplier.number }} </ui-td>
                <ui-td> {{ supplier.name }} </ui-td>
                <ui-td> {{ supplier.contact_number }}</ui-td>
                <ui-td> {{ supplier.contact_person }} </ui-td>
                <ui-td>
                    <ui-pill :text="supplier.is_active ? 'active' : 'inactive'"
                        :variant="supplier.is_active ? 'success' : 'danger'" />
                </ui-td>
                <ui-td action>
                    <div class="flex gap-2 justify-end">
                        <ui-button variant="bordered" icon="edit" @click="handleEditSupplier(supplier.id)" />
                        <ui-button variant="bordered" icon="times" @click="handleDeleteSupplier(supplier.id)" />
                    </div>
                </ui-td>
            </tr>
        </template>
    </ui-api-table>

    <ui-panel v-if="visible" title="Manage Suppliers" @close="handlePanelClose" :loading="loading">
        <template #heading>
            <div>
                <h4 class="text-lg font-semibold">Add New Supplier</h4>
                <p class="text-sm">Lorem ipsum dolor sit amet consectetur, adipisicing elit. At provident quis omnis
                    molestias! Suscipit, labore!</p>
            </div>
        </template>
        <supplier-inputs :form="form" />
        <template #footer>
            <div class="text-center flex flex-col gap-3">
                <ui-button variant="primary" text="submit" @click="handleSubmitAddSupplier()" />
                <ui-button variant="cancel" text="cancel" @click="handlePanelClose" />
            </div>
        </template>
    </ui-panel>
</template>

<script setup>
import SupplierInputs from "../components/SupplierInputs.vue";
import { UiButton, UiInput, UiPanel, UiApiTable, UiPill } from "../../../Shared/UI";
import { ref, inject, reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";

const notify2 = inject('notify2');
const axios = inject("axios");

let props = defineProps({});
let key = ref(0);
let visible = ref(false);
let loading = ref(true);

let errors_init_val = {
    name: null,
    contact_number: null,
    contact_person: null,
    is_active: null,
};

let form = reactive({
    name: null,
    contact_number: null,
    contact_person: null,
    is_active: true,
    errors: errors_init_val
});

let handleAddSupplier = () => {
    visible.value = true;
    loading.value = false;
};

let handleEditSupplier = (id) => {
    visible.value = true;
    loading.value = true;
    axios.post(`suppliers/${id}/show`).then(function (response) {
        form = response.data;
        form = Object.assign({ errors: errors_init_val }, form);
        loading.value = false;
    });
};

let handleDeleteSupplier = (id) => {
    notify2.confirm(() => {
        axios.delete(`suppliers/${id}/delete`).then((response) => {
            if (response.data.success) {
                notify2.alert(response.data.success);
                key.value++;
            } else {
                notify2.alert(response.data.error, 'error');
            }
        })
    });
};

let handlePanelClose = () => {
    notify2.alert("closed");
    form = reactive({
        name: null,
        contact_number: null,
        contact_person: null,
        is_active: true,
        errors: errors_init_val
    });
    visible.value = false;
}

let handleSubmitAddSupplier = () => {
    loading.value = true;

    let uri = form.id ? `/suppliers/${form.id}/update` : 'suppliers/add';
    axios.post(uri, form).then((response) => {
        if (response.data.success) {
            loading.value = false;
            visible.value = false;
            notify2.alert(response.data.success);
            key.value++;
        }
        else {
            this.notify2.alert(response.data.error, 'error');
        }
    }).catch((error) => {
        if (error.response !== undefined) {
            form.errors = error.response.data.errors;
        }
        loading.value = false;
    })
};



</script>