<script setup>
import { useProductStore } from "@/Stores/product";
import CardBox from "@/Components/CardBox.vue";
import CardBoxModal from "@/Components/CardBoxModal.vue";
import ProductModalTable from "./ProductModalTable.vue";

const productStore = useProductStore();
</script>

<template>
  <CardBoxModal
    button="success"
    button-label="Save"
    hasCancel
    v-model="productStore.modalActive"
    :title="productStore.productActive.title"
  >
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
