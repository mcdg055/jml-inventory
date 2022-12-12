<template>
    <div class="flex flex-col h-full relative">
        <div v-if="!loading" class="h-full flex flex-col">
            <!-- heading -->
            <div v-if="$slots.heading" class="mb-3">
                <slot name="heading" />
            </div>
            <!-- body -->
            <div>
                <slot />
            </div>
            <!-- footer -->
            <div v-if="$slots.footer" class="mt-auto">
                <slot name="footer" />
            </div>
        </div>
        <ui-loading :loading="loading" />
    </div>
</template>

<script setup>
import { UiLoading } from '..';
let props = defineProps({
    loading: {
        type: Boolean,
        default() {
            return false;
        }
    }
});
</script>