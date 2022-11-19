<template>
    <form @submit.prevent="submit" class="max-w-md h-full relative">
        <slot />

        <div class="flex space-x-2">
            <button type="submit" data-mdb-ripple="true" data-mdb-ripple-color="light"
                class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                :disabled="form.processing" :class="{ 'bg-blue-300 pointer-events-none': form.processing }">
                {{ submitText }}</button>
        </div>
        <ui-loading :loading="form.processing" />
    </form>
</template>

<script>

export default {
    props: {
        form: {
            type: Object,
            required: true,
        },
        uri: {
            type: String,
            required: true,
        },
        submitText: {
            type: String,
            default() {
                return "Save";
            }
        },
    },
    setup(props, context) {
        console.log(props.uri);
        let submit = () => {
            props.form.post(props.uri);
        };

        return { submit }
    }
}
</script>