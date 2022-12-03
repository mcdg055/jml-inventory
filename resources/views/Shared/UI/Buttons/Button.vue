<template>
    <ui-tooltip :content="tooltip">
        <Component :is="variant === 'link' ? 'Link' : 'button'" type="submit" :href="uri" data-mdb-ripple="true"
            data-mdb-ripple-color="light" :class="'btn-' + variant">
            <icon v-if="icon" :icon="icon" />
            {{ text }}
        </Component>
    </ui-tooltip>
</template>

<script setup>
import { Icon } from "../../UI"
import { computed } from "vue";
import Popper from "vue3-popper";

let props = defineProps({
    icon: String,
    text: {
        type: String,
        default() {
            return "";
        }
    },
    variant: String,
    default() {
        return "primary";
    },
    uri: String,
    tooltip: String,
});
</script>