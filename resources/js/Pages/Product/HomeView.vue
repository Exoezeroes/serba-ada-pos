<script setup>
import {
  mdiAlertCircleOutline,
  mdiCheckCircleOutline,
  mdiCloseCircleOutline,
  mdiGridLarge,
  mdiPlusCircleOutline,
  mdiTrashCan,
} from "@mdi/js";
import { Head, usePage } from "@inertiajs/vue3";
import { useProductStore } from "@/Stores/product";
import { useRouteStore } from "@/Stores/route";
import { computed } from "vue";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import SectionMain from "@/Components/SectionMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import ProductCard from "@/Components/ProductCard.vue";
import ProductModal from "@/Components/ProductModal.vue";
import BaseButton from "@/Components/BaseButton.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import NotificationBar from "@/Components/NotificationBar.vue";

// props
const props = defineProps({
  products: {
    type: Array,
    required: true,
  },
});

// notifications
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

// product store
const productStore = useProductStore();
productStore.products = props.products;
const product = productStore.productActive;

// route store
const routeStore = useRouteStore();
const processing = computed(() => routeStore.processing);

// options
const deleteProduct = { onSuccess: () => productStore.deleteProduct(product) };
const closeModal = { onSuccess: () => productStore.closeModal() };

// routes
const create = () => routeStore.get("product.create");
const edit = () => routeStore.get("product.edit", product, closeModal);
const trash = () => routeStore.delete("product.trash", product, deleteProduct);
const trashed = () => routeStore.get("product.trashed");
</script>

<template>
  <LayoutAuthenticated>
    <Head title="Products" />
    <ProductModal
      canEdit
      @edit="edit"
      canDelete
      @deletes="trash"
      :disabledButtons="processing"
    />
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
          :icon="mdiPlusCircleOutline"
          label="Add Product"
          color="success"
          outline
          :disabled="processing"
          @click.prevent="create"
        />

        <BaseButton
          :icon="mdiTrashCan"
          label="Trashed"
          color="danger"
          outline
          :disabled="processing"
          @click.prevent="trashed"
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
