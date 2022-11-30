<template>
    <ui-api-table title="Pass Out Items" :uri="`/suppliers/browse`" search-input reload>
        <template #headerActions>
            <ui-button variant="link" icon="plus" uri="/pass-outs/create" />
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
                <ui-td>{{ supplier.contact_number }}</ui-td>
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
</template>

<script setup>
import { UiButton, UiInput, UiPanel, UiApiTable, UiPill } from "../../../Shared/UI";
import { ref, inject } from "vue";
import { Inertia } from "@inertiajs/inertia";

const notify2 = inject('notify2');
const axios = inject("axios");

let props = defineProps({});

let loading = ref(true);

let handleAddSupplier = () => {

};

let handleEditSupplier = () => {

};

let handleDeleteSupplier = () => {

};


</script>