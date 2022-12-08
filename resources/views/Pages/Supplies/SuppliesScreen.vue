<template>
    <page-layout pageHeading="Manage Supplies" title="Supplies">
        <ui-api-table>
            
        </ui-api-table>
    </page-layout>
</template>

<script setup>
import PageLayout from "../PageLayout.vue";
import { UiApiTable } from "../../Shared/UI";

import { inject, reactive, computed, ref } from "vue";
import { Inertia } from "@inertiajs/inertia";

const notify = inject('notify2');
const axios = inject('axios');

let key = ref(0);

let inventory_items_id = ref([]);

let props = defineProps({
    suppliers: Object
});

let uriParams = reactive({
    selected: inventory_items_id,
})

function handleDelete(index) {
 
}

</script>