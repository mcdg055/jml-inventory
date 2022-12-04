<template>
    <form @submit.prevent="submit" class="max-w-md h-full relative flex flex-col gap-3">
        <slot />

        <div class="flex justify-between mt-3">

            <button type="submit" data-mdb-ripple="true" data-mdb-ripple-color="light"
                class="btn-primary"
                :disabled="form.processing" :class="{ 'bg-blue-300 pointer-events-none': form.processing }">
                {{ submitText }}</button>

            <button type="button" role="button" data-mdb-ripple="true" data-mdb-ripple-color="light" class="btn-cancel" 
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