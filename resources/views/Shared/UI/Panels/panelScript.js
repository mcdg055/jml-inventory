import { ref } from "vue";

export default function panelScript() {
    const visible = ref(false);
    const loading = ref(false);

    function openPanel() {
        loading.value = false;
        visible.value = true;
    }

    function closePanel() {
        visible.value = false;
    }

    return { closePanel, openPanel, visible, loading }
}