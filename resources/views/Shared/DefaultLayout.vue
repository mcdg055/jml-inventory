<template>

    <Head title="Inventory" />
    <div class="h-full flex items-stretch">
        <div class="2xl:w-3/12 xl:w-4/12 bg-primary flex flex-col pt-3 gap-5 jusitfy-between">
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
        <div class="grow">
            <slot></slot>
        </div>
    </div>

    <ui-alert />
</template>

<script>
import Nav from "./Navigation/Nav.vue";
import { UiBrand, UiAlert } from "./UI";
import { provide } from 'vue';
import { notify, notify2, confirm } from "./UI/Alerts/notify";
export default {
    components: {
        Nav, UiBrand, UiAlert
    },
    setup() {
        provide('notify', notify);
        provide('confirm', confirm);
        provide('notify2', notify2);
    }
}

</script>