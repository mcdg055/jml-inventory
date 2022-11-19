<template>
    <page-layout pageHeading="Manage Inventory Item" title="Add Inventory Item">
        <form @submit.prevent="submit" class="max-w-md">
            <ui-input v-model="form.name" name="name" label="Name" type="text" :error="form.errors.name" />
            <ui-input v-model="form.email" name="email" label="Email" type="email" :error="form.errors.email" />
            <ui-input v-model="form.password" name="password" label="Password" type="password"
                :error="form.errors.password" />

            <div class="flex space-x-2">
                <button type="submit" data-mdb-ripple="true" data-mdb-ripple-color="light"
                    class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                    :disabled="form.processing" :class="{ 'bg-blue-300 pointer-events-none': form.processing }">
                    Submit</button>
            </div>
        </form>
    </page-layout>
</template>

<script setup>
import PageLayout from "../../PageLayout.vue";
import { UiInput } from "../../../Shared/UI";
import { useForm } from "@inertiajs/inertia-vue3";

let form = useForm({
    name: "",
    email: "",
    password: "",
});

let submit = () => {
    form.post('/inventory-items');
};

</script>
