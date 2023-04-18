<script setup>
import { useProductStore } from "@/Stores/product";
import { mdiDelete, mdiPencil } from "@mdi/js";
import BaseButton from "./BaseButton.vue";
import BaseButtons from "./BaseButtons.vue";
import CardBox from "@/Components/CardBox.vue";
import CardBoxModal from "@/Components/CardBoxModal.vue";
import ProductModalTable from "./ProductModalTable.vue";

const productStore = useProductStore();
</script>

<template>
  <CardBoxModal
    v-model="productStore.modalActive"
    :title="productStore.productActive.title"
  >
    <BaseButtons type="justify-between">
      <BaseButton
        :icon="mdiPencil"
        color="warning"
        outline
      />
      <BaseButton
        :icon="mdiDelete"
        color="danger"
        outline
      />
    </BaseButtons>
    <CardBox has-table>
      <ProductModalTable :product="productStore.productActive" />
    </CardBox>
  </CardBoxModal>
</template>

<style>
th:not(:first-child),
td:not(:first-child) {
  text-align: center;
}
th:last-child,
td:last-child {
  text-align: right;
}
</style>
