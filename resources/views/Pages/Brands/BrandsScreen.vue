<template>
    <page-layout pageHeading="Manage Brands" title="Brands">
        <!-- table -->
        <ui-table title="Brands" :pagination="brands.links">
            <!-- header actions -->
            <template #headerActions>
                <div class="flex justify-between items-center p-2">
                    <div class="flex gap-2">
                        <!-- actions -->
                        <!--  <panel-button icon="plus" :panel-id="ADD_BRAND_FORM_PANEL_ID" /> -->
                        <ui-link icon="plus" uri="/brands/create" />
                        <ui-button icon="refresh" @click="reload" />
                    </div>
                    <div>
                        <!-- search -->
                        <search-input v-model="search" />
                    </div>
                </div>
            </template>
            <!-- header -->
            <template #tableHeaders>
                <ui-th text="Name" />
                <ui-th text="Actions" action />
            </template>
            <!-- content -->
            <template #tableContent>
                <tr v-for="brand in brands.data" :key="brand.id">
                    <ui-td>
                        {{ brand.name }}
                    </ui-td>
                    <ui-td action>
                        <div class="flex gap-2 justify-end">
                            <ui-link icon="edit" :uri="`/brands/${brand.id}/edit`" />
                            <ui-button icon="trash" @click="handleDelete(brand)" />
                        </div>
                    </ui-td>
                </tr>
            </template>
        </ui-table>
    </page-layout>
</template>

<script>
import PageLayout from "../PageLayout.vue";
import AddBrandForm from "./forms/AddBrandForm.vue";
import EditBrandForm from "./forms/EditBrandForm.vue";
import { SearchInput, PanelButton } from "../../Shared/Ui";
import { ref, watch, inject } from "vue";
import { Inertia } from "@inertiajs/inertia";
import debounce from "lodash/debounce";

export default {
    props: {
        brands: {
            type: Object,
            required: true,
        },
        filters: {
            type: Object,
        },
        success: Object,
        flash: Object,
    },
    components: {
        PageLayout,
        AddBrandForm,
        SearchInput,
        PanelButton,
        EditBrandForm
    },
    setup(props) {
        const notify = inject('notify');
        const confirm = inject('confirm');
        let search = ref(props.filters.search);

        //watch search changes
        watch(search, debounce(
            function (value) {
                Inertia.get('/brands', { search: value }, {
                    preserveState: true,
                    replace: true,
                })
            }, 250));

        /* watch(props.flash) */

        //reload the content
        let reload = debounce(function () {

            //reset search filter
            props.filters.search = "";

            //perform http request to the server
            Inertia.get('/brands', {
                preserveState: true,
                replace: true,
            });
        }, 300);

        let handleDelete = (brand) => {
            confirm(`/brands/${brand.id}/delete`, '', `Are you sure you want to delete <b>${brand.name}</b> brand?`);
        }

        return { reload, search, handleDelete }
    },
}
</script>