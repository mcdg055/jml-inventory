<template>

    <Head title="Login" />
    <section class="h-screen">
        <div class="container px-6 py-12 h-full">
            <div class="flex justify-center items-center flex-wrap h-full g-6 text-gray-800">
                <div class="md:w-8/12 lg:w-6/12 mb-12 md:mb-0">
                    <img src="../../../assets/Images/draw2.svg" class="w-full" alt="Phone image" />
                </div>
                <div class="md:w-8/12 lg:w-3/12 lg:ml-20">
                    <div>
                        <h1 class="text-4xl font-semibold mb-8 text-center">
                            Login
                        </h1>
                    </div>
                    <div v-if="form.errors.invalid">
                        <div class="bg-red-100 rounded-lg py-5 px-6 mb-3 text-base text-red-700 inline-flex items-center w-full"
                            role="alert">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times-circle"
                                class="w-4 h-4 mr-2 fill-current" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512">
                                <path fill="currentColor"
                                    d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z">
                                </path>
                            </svg>
                            {{ form.errors.invalid }}
                        </div>
                    </div>
                    <form @submit.prevent="submit">
                        <div class="flex flex-col w-100 gap-3 mb-3">
                            <ui-input v-model="form.email" :error="form.errors.password" name="email"
                                label="Email Address" type="email" />
                            <ui-input v-model="form.password" :error="form.errors.password" name="password"
                                label="Password" type="password" />
                        </div>
                        <!-- Submit button -->
                        <button type="submit" class="inline-block
                            px-7 py-3 
                            bg-blue-600 
                            text-white 
                            font-medium 
                            text-sm 
                            leading-snug 
                            uppercase 
                            rounded 
                            shadow-md 
                            hover:bg-blue-700 
                            hover:shadow-lg 
                            focus:bg-blue-700 
                            focus:shadow-lg 
                            focus:outline-none 
                            focus:ring-0 
                            active:bg-blue-800 
                            active:shadow-lg 
                            transition 
                            duration-150 
                            ease-in-out 
                            w-full" data-mdb-ripple="true" data-mdb-ripple-color="light"
                            :disabled="form.processing"
                            >
                            Sign in
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    layout: null,
}
</script>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { UiInput } from "../../Shared/UI";

let form = useForm({
    email: "",
    password: "",
});

let submit = () => {
    form.post('/login');
};


</script>