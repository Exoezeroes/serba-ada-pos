<script setup>
import { mdiGridLarge } from "@mdi/js";
import { Head } from "@inertiajs/vue3";
import { useProductStore } from "@/Stores/product";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import SectionMain from "@/Components/SectionMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import ProductCard from "@/Components/ProductCard.vue";
import ProductModal from "@/Components/ProductModal.vue";
import BaseButton from "@/Components/BaseButton.vue";

const props = defineProps({
  products: {
    type: Array,
    required: true,
  },
});

const productStore = useProductStore();

productStore.products = props.products;
</script>

<template>
  <LayoutAuthenticated>
    <Head title="Products" />
    <ProductModal />
    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiGridLarge" title="Items" main />
      <BaseButton
        routeName="product.create"
        label="Add Product"
        color="success"
        outline
        rounded-full
      />
      <div
        class="mt-3 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 text-xs md:text-md lg:text-base gap-2 lg:grid-cols-5"
      >
        <ProductCard
          v-for="(product, index) in productStore.products"
          :key="index"
          :product="product"
          @clicked="productStore.openModal(product)"
        />
      </div>
    </SectionMain>
  </LayoutAuthenticated>
</template>
