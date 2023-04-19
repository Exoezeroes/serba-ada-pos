<script setup>
import {
  mdiAlertCircleOutline,
  mdiCheckCircleOutline,
  mdiCloseCircleOutline,
  mdiGridLarge,
  mdiPlusCircleOutline,
  mdiTrashCan,
} from "@mdi/js";
import { Head, usePage, router } from "@inertiajs/vue3";
import { useProductStore } from "@/Stores/product";
import { computed } from "vue";
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

const notificationType = computed(() => usePage().props.response.type);
const notificationMessage = computed(() => usePage().props.response.message);
const notificationIcon = computed(() => {
  if (notificationType.value === "success") {
    return mdiCheckCircleOutline;
  }
  if (notificationType.value === "danger") {
    return mdiCloseCircleOutline;
  }
  return mdiAlertCircleOutline;
});

const productStore = useProductStore();
productStore.products = props.products;

const ActiveProduct = productStore.productActive;

const edit = () => router.get(route("product.edit", ActiveProduct));
const trash = () => {
  productStore.deleteProduct(ActiveProduct);
  router.delete(route("product.trash", ActiveProduct));
};
</script>

<template>
  <LayoutAuthenticated>
    <Head title="Products" />
    <ProductModal canEdit @edit="edit" canDelete @deletes="trash" />
    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiGridLarge" title="Products" main />
      <NotificationBar
        v-if="notificationMessage"
        :color="notificationType"
        :icon="notificationIcon"
        :key="products.length"
      >
        {{ notificationMessage }}
      </NotificationBar>
      <BaseButtons>
        <BaseButton
          routeName="product.create"
          :icon="mdiPlusCircleOutline"
          label="Add Product"
          color="success"
          outline
        />
        <SortButton />
        <BaseButton
          routeName="product.trashed"
          :icon="mdiTrashCan"
          label="Trashed"
          color="danger"
          outline
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
