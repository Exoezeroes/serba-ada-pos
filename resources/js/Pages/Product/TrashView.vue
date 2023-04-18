<script setup>
import {
  mdiRecycle,
  mdiTrashCan,
} from "@mdi/js";
import { Head } from "@inertiajs/vue3";
import { useProductStore } from "@/Stores/product";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import SectionMain from "@/Components/SectionMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import ProductCard from "@/Components/ProductCard.vue";
import ProductModal from "@/Components/ProductModal.vue";
import BaseButton from "@/Components/BaseButton.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import NotificationBar from "@/Components/NotificationBar.vue";
import SortButton from "@/Components/SortButton.vue";

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
    <Head title="Trashed Products" />
    <ProductModal />
    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiRecycle" title="Trashed Products" main />
      <NotificationBar
        v-if="message"
        :color="type"
        :icon="icon"
        :key="products.length"
      >
        {{ message }}
      </NotificationBar>
      <BaseButtons>
        <SortButton />
        <BaseButton
          routeName="product.index"
          :icon="mdiTrashCan"
          label="Trashed"
          color="danger"
          outline
          active
        />
      </BaseButtons>
      <div
        class="mt-3 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 md:text-sm text-xs lg:text-base gap-2 lg:grid-cols-5"
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