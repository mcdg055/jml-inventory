<template>
    <ui-table title="Selected items">
        <template #tableHeaders>
            <ui-th text="ID #" />
            <ui-th text="Item" />
            <ui-th text="Price" />
            <ui-th text="Quantity" />
            <ui-th text="Total Cost" />
            <ui-th text="Actions" action />
        </template>

        <template #tableContent>
            <tr v-if="form.length === 0">
                <td colspan="6" class="text-center py-8 text-gray-500 text-lg font-medium"> No items selected</td>
            </tr>
            <tr v-for="(item, index) in form.items" :key="index">

                <ui-td>{{ item.id }}</ui-td>
                <ui-td>{{ item.name }}</ui-td>
                <ui-td>₱ {{ item.unit_price }}</ui-td>
                <ui-td>
                    <input v-model="form.items[index].quantity" type="text" class="
          form-control
          block
          w-full
          px-3
          py-1.5
          text-base
          font-normal
          text-gray-700
          bg-white bg-clip-padding
          border border-solid border-gray-300
          rounded
          transition
          ease-in-out
          m-0
          max-w-[100px]
          block
          focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
        " id="exampleFormControlInput3" placeholder="Quantity" />
                    <!--   <small v-if="form.errors.items[index].quantity" class="text-red-500 text-sm">{{ form.errors.items[index].quantity }}</small> -->
                </ui-td>
                <ui-td>[₱ 125]</ui-td>
                <ui-td action>
                    <div class="flex gap-2 justify-end">
                        <ui-button class="bg-danger" variant="link" icon="times" @click="handleRemoveItem(index)" />
                    </div>
                </ui-td>
            </tr>
        </template>
    </ui-table>
</template>

<script setup>

const emits = defineEmits(['removeItem']);

let props = defineProps({
    form: Object
});

let handleRemoveItem = (index) => {
    emits('removeItem', index);
}
</script>