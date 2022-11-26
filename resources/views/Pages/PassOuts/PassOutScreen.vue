<template>
    <page-layout pageHeading="Pass Out Details" title="Inventory Items">

        <card-table class="border mb-6">
            <template #cardHead>
                <h4 class="font-medium text-xl">Pass Name</h4>
                <div class="font-regular">P.O. # 000001</div>
            </template>
            <div class="p-3 text-sm flex flex-col">
                <div class="flex p-2 border-b">
                    <div class="w-4/12 flex">
                        <div class="font-medium w-1/2">
                            Pass Out Name:
                        </div>
                        <div class="w-1/2">
                            [Value]
                        </div>
                    </div>
                    <div class="w-4/12 flex">
                        <div class="font-medium w-1/2">
                            Total Items:
                        </div>
                        <div class="w-1/2">
                            [Value]
                        </div>
                    </div>
                    <div class="w-4/12 flex">
                        <div class="font-medium w-1/2">
                            Total Cost:
                        </div>
                        <div class="w-1/2">
                            [Value]
                        </div>
                    </div>
                </div>
                <div class="flex p-2 border-b">
                    <div class="w-4/12 flex">
                        <div class="font-medium w-1/2">
                            Pass Out Number:
                        </div>
                        <div class="w-1/2">
                            [00000001]
                        </div>
                    </div>
                    <div class="w-4/12 flex">
                        <div class="font-medium w-1/2">
                            Date Created:
                        </div>
                        <div class="w-1/2">
                            [Value]
                        </div>
                    </div>
                </div>
                <div class="flex p-2 border-b">
                    <div class="w-6/12 flex">
                        <div class="font-medium w-4/12">
                            Notes:
                        </div>
                        <div class="w-8/12">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Libero rerum ipsa, quos molestias
                            tenetur autem vero obcaecati, ipsum ad eum esse earum sunt cupiditate nihil nisi! In dolorum
                            adipisci veritatis modi, recusandae nam praesentium tenetur necessitatibus animi
                            voluptatibus quisquam at deleniti alias iusto nemo neque laboriosam ex sit consequuntur!
                            Incidunt!
                        </div>
                    </div>
                </div>
            </div>
        </card-table>

        <browse-selected-items />

    </page-layout>
</template>

<script setup>
import PageLayout from "../PageLayout.vue";
import BrowseSelectedItems from "./widgets/BrowseSelectedItems.vue"

import { CardTable } from "../../Shared/Ui";

let props = defineProps({});


</script>