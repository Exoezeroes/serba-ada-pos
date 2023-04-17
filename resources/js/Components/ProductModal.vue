<script setup>
import { useProductStore } from "@/Stores/product";
import CardBox from "@/Components/CardBox.vue";
import CardBoxModal from "@/Components/CardBoxModal.vue";

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
      <table>
        <thead>
          <th>Barcode</th>
          <th>Quantity</th>
          <th>Price</th>
        </thead>
        <tbody>
          <tr>
            <td data-label="Barcode">
              {{ productStore.productActive.uid }}
            </td>
            <td data-label="Quantity">
              {{ productStore.productActive.quantity }}
            </td>
            <td data-label="Price">
              {{ productStore.productActive.price }}
            </td>
          </tr>
        </tbody>
      </table>
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
