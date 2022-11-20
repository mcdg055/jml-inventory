<template>
    <form @submit.prevent="submit" class="max-w-md h-full relative flex flex-col gap-3">
        <slot />

        <div class="flex justify-between mt-3">

            <button type="submit" data-mdb-ripple="true" data-mdb-ripple-color="light"
                class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                :disabled="form.processing" :class="{ 'bg-blue-300 pointer-events-none': form.processing }">
                {{ submitText }}</button>

            <button type="button" role="button" data-mdb-ripple="true" data-mdb-ripple-color="light" class="inline-block
                px-6 
                py-2.5
                bg-gray-100 
                text-gray-400 
                font-medium 
                text-xs 
                leading-tight 
                uppercase 
                rounded 
                shadow-md 
                hover:bg-gray-400 
                hover:text-white 
                hover:shadow-lg 
                focus:bg-gray-400 
                focus:shadow-lg 
                focus:outline-none 
                focus:ring-0 
                active:bg-gray-600 
                active:shadow-lg 
                transition 
                duration-150 
                ease-in-out" 
                :disabled="form.processing"
                :class="{ 'bg-gray-100 pointer-events-none': form.processing }" @click="$emit('cancel')">
                Cancel</button>

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
        flash: Object,
    },
    setup(props) {
        let submit = () => {
            props.form.post(props.uri);
        };

        return { submit }
    }
}
</script>