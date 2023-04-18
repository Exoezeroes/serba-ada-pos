<script setup>
import { useProductStore } from "@/Stores/product";
import { mdiDelete, mdiPencil } from "@mdi/js";
import BaseButtons from "./BaseButtons.vue";
import LinkButton from "./LinkButton.vue";
import CardBox from "@/Components/CardBox.vue";
import CardBoxModal from "@/Components/CardBoxModal.vue";
import ProductModalTable from "./ProductModalTable.vue";

const productStore = useProductStore();
const closeModal = () => (productStore.modalActive = false);
const deleteProduct = () => {
  productStore.deleteProduct(productStore.productActive);
  closeModal();
};
</script>

<template>
  <CardBoxModal
    v-model="productStore.modalActive"
    :title="productStore.productActive.title"
  >
    <BaseButtons type="justify-between">
      <LinkButton
        :icon="mdiPencil"
        color="warning"
        outline
        :href="route('product.edit', productStore.productActive)"
        as="button"
        @click.prevent="closeModal"
      />
      <LinkButton
        :icon="mdiDelete"
        color="danger"
        outline
        :href="route('product.destroy', productStore.productActive)"
        as="button"
        method="delete"
        @click.prevent="deleteProduct"
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
