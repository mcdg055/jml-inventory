import { createApp, h, provide } from 'vue'
import { createInertiaApp, Link, Head } from '@inertiajs/inertia-vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import axios from 'axios'
import VueAxios from 'vue-axios'

import {
    Icon,
    UiTable,
    UiTh,
    UiTd,
    UiButton,
    UiLink,
    UiLoading,
    UiToolTip,
} from "../views/Shared/UI";

import Layout from "../views/Shared/DefaultLayout.vue";

import 'tw-elements';

createInertiaApp({
    resolve: async name => {

        let page = resolvePageComponent(
            `../views/Pages/${name}.vue`,
            (await import.meta.glob('../views/Pages/**/*.vue')));

        page.then((module) => {
            if (module.default.layout === undefined) {
                module.default.layout = Layout
            }
        });

        return page;
    },
    setup({ el, App, props, plugin }) {
        const myApp = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(VueSweetalert2)
            .use(VueAxios, axios)
            /* head/title */
            .component('Head', Head)

            /* icon */
            .component('Icon', Icon)

            /* table */
            .component('ui-table', UiTable)
            .component('ui-th', UiTh)
            .component('ui-td', UiTd)

            /**
             * Buttons
             */
            .component('Link', Link)
            .component('UiLink', UiLink)
            .component('UiButton', UiButton)

            /**
             * Spinners
             */
            .component('UiLoading', UiLoading)

            /**
             * Tooltips
             */
            .component('ui-tooltip', UiToolTip)


        myApp.provide('axios', myApp.config.globalProperties.axios);
        myApp.mount(el)
    },
    title: title => `JML - ${title}`,
})