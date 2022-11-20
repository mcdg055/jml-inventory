<template>
    <div>
        <div class="text-gray-400 border-b border-gray-500 mx-2 mb-3">
            <small>Navigation</small>
        </div>
        <ul class="flex flex-col gap-1">
            <li v-for="(item, key) in navigation" :key="key">
                <nav-link :item="item" :active="$page.component === getComponent(item)"></nav-link>
            </li>
        </ul>
    </div>
</template>

<script>
import NavLink from './NavLink.vue';

export default {

    components: {
        NavLink
    },
    data() {
        return {
            navigation: [
                {
                    label: "Home",
                    path: "/",
                    icon: "house",
                },
                {
                    label: "Inventory Items",
                    path: "/inventory-items",
                    component: "InventoryItems/InventoryItemsScreen",
                    icon: "boxes-stacked",
                },
                {
                    label: "Supplies",
                    path: "/supplies",
                    icon: "truck-ramp-box",
                },
                {
                    label: "Suppliers",
                    path: "/suppliers",
                    icon: "truck",
                },
                {
                    label: "Brands",
                    path: "/brands",
                    component: "Brands/BrandsScreen",
                    icon: "tag",
                },
                {
                    label: "Pass Out",
                    path: "/pass-outs",
                    component: "PassOuts/PassOutsScreen",
                    icon: "ticket-simple",
                },
            ]
        }
    },
    methods: {
        getComponent(item) {
            return item.component ? item.component : item.label;
        }
    }
}

</script>