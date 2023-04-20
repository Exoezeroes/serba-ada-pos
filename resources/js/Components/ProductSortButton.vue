<script setup>
import { mdiSort } from "@mdi/js";
import { computed, ref, reactive } from "vue";
import { useProductStore } from "@/Stores/product";
import BaseButton from "./BaseButton.vue";
import CardBox from "./CardBox.vue";
import CardBoxModal from "@/Components/CardBoxModal.vue";
import FormField from "./FormField.vue";
import FormControl from "./FormControl.vue";

// props
const props = defineProps({
  options: {
    type: Object,
    required: true,
  },
});

const sortModalActive = ref(false);

// sort order
const orderOptions = [
  { id: 1, label: "Ascending" },
  { id: 2, label: "Descending" },
];

// product store
const productStore = useProductStore();

// form
const form = reactive({
  sortType: props.options[0],
  sortOrder: orderOptions[0],
});

const sortDescending = computed(() => {return form.sortOrder.id === 2})

const sort = () => productStore.sort(form.sortType.label, sortDescending.value);
// ;
</script>

<template>
  <div>
    <CardBoxModal
      v-model="sortModalActive"
      title="Sort by"
      @confirm="sort"
    >
      <CardBox isForm>
        <FormField label="Type" help="Sort it by ...">
          <FormControl v-model="form.sortType" :options="options" />
        </FormField>
        <FormField label="Ordering" help="Order it ...">
          <FormControl v-model="form.sortOrder" :options="orderOptions" />
        </FormField>
      </CardBox>
    </CardBoxModal>
    <BaseButton
      :icon="mdiSort"
      label="Sort"
      color="info"
      outline
      @click="sortModalActive = true"
    />
  </div>
</template>
