<script setup>
import { useProductStore } from "@/Stores/product";
import { mdiDelete, mdiPencil } from "@mdi/js";
import BaseButtons from "./BaseButtons.vue";
import LinkButton from "./LinkButton.vue";
import CardBox from "@/Components/CardBox.vue";
import CardBoxModal from "@/Components/CardBoxModal.vue";
import ProductModalTable from "./ProductModalTable.vue";

const productStore = useProductStore();

const ActiveProduct = productStore.productActive
</script>

<template>
  <CardBoxModal
    v-model="productStore.modalActive"
    :title="ActiveProduct.title"
  >
    <BaseButtons type="justify-between">
      <LinkButton
        :icon="mdiPencil"
        color="warning"
        outline
        :href="route('product.edit', ActiveProduct)"
        as="button"
        @click.prevent="productStore.closeModal"
      />
      <LinkButton
        :icon="mdiDelete"
        color="danger"
        outline
        :href="route('product.destroy', ActiveProduct)"
        as="button"
        method="delete"
        @click.prevent="productStore.deleteProduct(ActiveProduct)"
      />
    </BaseButtons>
    <CardBox has-table>
      <ProductModalTable :product="ActiveProduct" />
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
