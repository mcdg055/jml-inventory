<template>
    <nav aria-label="Page navigation">
        <ul class="flex list-style-none">
            <template v-for="link in links">
                <li class="page-item" :class="{ 'disabled': !link.url }">
                    <Component :is="link.url ? 'Link' : 'span'"
                        class="page-link relative block py-1.5 px-3 rounded border-0 outline-none transition-all duration-300 rounded focus:shadow-none"
                        :href="link.url" v-html="link.label" :class="classNames(link)" />
                </li>
            </template>
        </ul>
    </nav>
</template>

<script>
export default {
    props: {
        links: {
            type: Array,
            required: true,
        }
    },
    methods: {
        classNames(link) {
            let classNames = link.active ? ' bg-gray-200 hover:text-white hover:bg-gray-600' : ' hover:text-gray-800 hover:bg-gray-200';

            classNames += link.url ? ' text-gray-500' : ' text-gray-300 pointer-events-none';

            return classNames;
        }
    }

}

</script>