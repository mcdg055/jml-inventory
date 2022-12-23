import { markRaw, ref } from "vue";

export default function panelScript() {
    const visible = ref(false);
    const loading = ref(false);
    const component = markRaw({});
    const props = ref({});
    const title = ref('');

    function openPanel(params = {}) {
        component.value = params.component ?? {};

        loading.value = false;
        visible.value = true;
    }

    function closePanel() {
        visible.value = false;
    }

    const panel = {
        open: (params = {}) => {
            component.value = params.component ?? {};
            title.value = params.title ?? "";
            props.value = params.props ?? {};
            loading.value = false;
            visible.value = true;
        },
    }

    return { closePanel, openPanel, visible, loading, component, title, props, panel }
}