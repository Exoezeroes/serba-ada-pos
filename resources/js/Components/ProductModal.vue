<script setup>
import { useProductStore } from "@/Stores/product";
import { mdiDelete, mdiPencil } from "@mdi/js";
import BaseButtons from "./BaseButtons.vue";
import LinkButton from "./LinkButton.vue";
import CardBox from "@/Components/CardBox.vue";
import CardBoxModal from "@/Components/CardBoxModal.vue";
import ProductModalTable from "./ProductModalTable.vue";

const props = defineProps({
  canEdit: Boolean,
  canDelete: Boolean,
})

props.canEdit = props.canEdit ? true : false;
props.canDelete = props.canDelete ? true : false;

const productStore = useProductStore();

const ActiveProduct = productStore.productActive;
</script>

<template>
  <CardBoxModal
    v-model="productStore.modalActive"
    :title="ActiveProduct.title"
  >
    <BaseButtons type="justify-between">
      <LinkButton
        v-if="canEdit"
        :href="route('product.edit', ActiveProduct)"
        :icon="mdiPencil"
        color="warning"
        as="button"
        outline
        @click.prevent="productStore.closeModal"
      />
      <LinkButton
        v-if="canDelete"
        :href="route('product.destroy', ActiveProduct)"
        method="delete"
        :icon="mdiDelete"
        color="danger"
        as="button"
        outline
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
