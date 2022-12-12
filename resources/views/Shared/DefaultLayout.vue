<template>

    <Head title="Inventory" />
    <div class="h-full flex items-stretch">
        <div class="w-2/12 bg-primary flex flex-col pt-3 gap-5 jusitfy-between">
            <ui-brand />
            <Nav />

            <div class="mt-auto">
                <Link method="POST" href="/logout" as="button" class="w-full
                    text-left
                    text-white
                    px-5 p-2
                    mb-3
                    hover:bg-red-400
                    transition-all
                    ease-in-out
                    rounded-tl-2xl 
                    rounded-bl-2xl
                    block">
                <Icon icon="right-from-bracket" />
                Logout
                </Link>
            </div>
        </div>
        <div class="grow-0 shrink-0 w-10/12">
            <slot></slot>
        </div>
    </div>

    <ui-panel v-if="visible" title="Edit Supply Item" @close="closePanel" :loading="loading">
        <Component :is="component.value" v-bind="props"></Component>
    </ui-panel>

    <ui-alert />
</template>

<script setup>
import Nav from "./Navigation/Nav.vue";
import { UiBrand, UiAlert, UiPanel, panelScript } from "./UI";

import { provide } from 'vue';
import { notify, notify2, confirm } from "./UI/Alerts/notify";

const { visible, loading, closePanel, component, panel, props } = panelScript();

provide('notify', notify);
provide('confirm', confirm);
provide('notify2', notify2);
provide('panel', panel);

</script>