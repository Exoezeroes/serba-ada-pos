<script setup>
import { mdiGridLarge } from "@mdi/js";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";
import { useProductStore } from "@/Stores/product";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import SectionMain from "@/Components/SectionMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import CardBox from "@/Components/CardBox.vue";
import CardBoxModal from "@/Components/CardBoxModal.vue";
import ProductCard from "@/Components/ProductCard.vue";

const props = defineProps({
  products: {
    type: Array,
    required: true,
  },
});

const productStore = useProductStore();

const isModalActive = ref(false);

const openModal = (item) => {
  isModalActive.value = true;
  productStore.setData(item);
};
</script>

<template>
  <LayoutAuthenticated>
    <Head title="Products" />
    <CardBoxModal
      button="success"
      button-label="Save"
      hasCancel
      v-model="isModalActive"
      :title="productStore.modalData.title"
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
              <td data-label="Barcode">{{ productStore.modalData.uid }}</td>
              <td data-label="Quantity">
                {{ productStore.modalData.quantity }}
              </td>
              <td data-label="Price">{{ productStore.modalData.price }}</td>
            </tr>
          </tbody>
        </table>
      </CardBox>
    </CardBoxModal>
    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiGridLarge" title="Items" main />
      <div
        class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 text-xs md:text-md lg:text-base gap-2 lg:grid-cols-5"
      >
        <ProductCard
          v-for="(product, index) in products"
          :key="index"
          :product="product"
          @clicked="openModal(product)"
        />
      </div>
    </SectionMain>
  </LayoutAuthenticated>
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
