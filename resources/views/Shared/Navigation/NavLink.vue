<template>
    <Link :href="item.path" :method="method" class="nav__nav-item" :class="{ 'nav__nav-item--active': active }">
    <icon :icon="item.icon"></icon> <span class="pl-3">{{ item.label }}</span> </Link>
</template>

<script>
import Icon from '../UI/Icon.vue';

export default {
    components: {
        Icon
    },
    props: {
        item: {
            type: Object,
            required: true,
        },
        active: Boolean,
    },
    computed: {
        method() {
            return this.item.method ? this.item.method : "GET";
        },
    }

}

</script>