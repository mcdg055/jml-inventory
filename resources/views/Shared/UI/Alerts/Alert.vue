<template>
    <div>
        <div v-if="$page.props.flash.error">
            {{ notifyError($page.props.flash.error) }}
        </div>
        <div v-else-if="$page.props.flash.success">
            {{ notifySuccess($page.props.flash.success) }}
        </div>
    </div>
</template>

<script setup>
import {inject } from 'vue';

const notify = inject('notify');

let notifyError = (text = "Cannot perform operation") => {
    notify(text, "error");
}
let notifySuccess = (text = "Action performed successfully") => {
    notify(text);
}

</script>