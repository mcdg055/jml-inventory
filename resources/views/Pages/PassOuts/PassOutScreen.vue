<template>
    <div class="container mx-auto">

        <card-table class="border mb-6 max-w-[400px]">
            <template #cardHead>
                <h4 class="font-medium">Pass Out Description</h4>
            </template>
            <div class="flex flex-col gap-3 p-3">
                <div>

                </div>
            </div>
        </card-table>
    </div>
</template>

<script setup>
import { SearchInput, CardTable, UiButton, UiInput, UiTextarea } from "../../Shared/Ui";

let props = defineProps({});
</script>