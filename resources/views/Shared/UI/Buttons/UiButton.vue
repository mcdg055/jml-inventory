<template>
    <Component :is="variant === 'link' ? 'Link' : 'button'" type="submit" data-mdb-ripple="true"
        data-mdb-ripple-color="light" :class="btnVariant()">
        <icon v-if="icon" :icon="icon" />
        {{ text }}
    </Component>
</template>

<script setup>
import { Icon } from "../../UI"

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
    }
});

let btnVariant = () => {
    switch (props.variant) {
        case "primary":
            return "btn-primary"
            break;
        case "link":
            return "btn-link";
            break
        case "bordered":
            return "btn-bordered";
            break;
        default:
            break;
    }
}
</script>