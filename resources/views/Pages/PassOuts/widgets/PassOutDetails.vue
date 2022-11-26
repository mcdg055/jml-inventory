<template>
    <card-table class="border mb-6">
        <template #cardHead>
            <h4 class="font-medium text-xl"> {{ item.name }}</h4>
            <div class="font-regular">P.O. #{{ item.number }}</div>
        </template>
        <div class="p-3 text-sm flex flex-col">
            <div class="flex p-2 border-b gap-3">
 
                <div class="w-4/12 flex">
                    <div class="font-medium w-1/2">
                        Pass Out Name:
                    </div>
                    <div class="w-1/2">
                        {{ item.name }}
                    </div>
                </div>
                <div class="w-4/12 flex">
                    <div class="font-medium w-1/2">
                        Total Items:
                    </div>
                    <div class="w-1/2">
                        {{item.total_items}}
                    </div>
                </div>
                <div class="w-4/12 flex">
                    <div class="font-medium w-1/2">
                        Total Cost:
                    </div>
                    <div class="w-1/2">
                        {{item.total}}
                    </div>
                </div>
            </div>
            <div class="flex p-2 border-b">
                <div class="w-4/12 flex">
                    <div class="font-medium w-1/2">
                        Pass Out Number:
                    </div>
                    <div class="w-1/2">
                        #{{ item.number }}
                    </div>
                </div>
                <div class="w-4/12 flex">
                    <div class="font-medium w-1/2">
                        Date Created:
                    </div>
                    <div class="w-1/2">
                        {{item.created_at}}
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
</template>

<script setup>
import { ref, watch, inject, computed } from "vue";
import { CardTable } from "../../../Shared/Ui";


let props = defineProps({
    item: {
        type: Object,
        required: true
    },
});

let notes = computed(() => {
    return props.item.notes ? props.item.notes : "N/A";
})

</script>