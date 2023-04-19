<script setup>
import {
  mdiAlertCircleOutline,
  mdiArrowULeftBottomBold,
  mdiCheckCircleOutline,
  mdiCloseCircleOutline,
  mdiRecycle,
} from "@mdi/js";
import { Head, usePage } from "@inertiajs/vue3";
import { useProductStore } from "@/Stores/product";
import { useModalStore } from "@/Stores/modal";
import { useRouteStore } from "@/Stores/route";
import { computed } from "vue";
import BaseButton from "@/Components/BaseButton.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import NotificationBar from "@/Components/NotificationBar.vue";
import ProductCard from "@/Components/ProductCard.vue";
import ProductModal from "@/Components/ProductModal.vue";
import SectionMain from "@/Components/SectionMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";

// props
const props = defineProps({
  products: {
    type: Array,
    required: true,
  },
});

// notifications
const type = computed(() => usePage().props.response.type);
const message = computed(() => usePage().props.response.message);
const icon = computed(() => {
  if (type.value === "success") {
    return mdiCheckCircleOutline;
  }
  if (type.value === "danger") {
    return mdiCloseCircleOutline;
  }
  return mdiAlertCircleOutline;
});

// product store
const productStore = useProductStore();
const product = productStore.productActive;
productStore.products = props.products;

// modal store
const modalStore = useModalStore();

const deletes = () => {
  modalStore.activate();
};

// route store
const routeStore = useRouteStore();
const processing = computed(() => routeStore.processing);

// options
const deleteProduct = { onSuccess: () => productStore.deleteProduct(product) };

// params
const id = product.id;

// routes
const restore = () => routeStore.post("product.restore", id, deleteProduct);
const destroy = () => routeStore.delete("product.destroy", id, deleteProduct);
const index = () => routeStore.get("product.index");
</script>

<template>
  <LayoutAuthenticated>
    <Head title="Trashed Products" />
    <ProductModal
      buttonLabel="Restore"
      hasCancel
      canDelete
      @deletes="deletes"
      @confirm="restore"
      :disabledButtons="processing"
    />
    <ConfirmationModal
      button="danger"
      buttonLabel="Delete"
      hasCancel
      buttonCancel="success"
      title="Are you sure?"
      @confirm="destroy"
    >
      This action is unrecoverable!
    </ConfirmationModal>
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiRecycle"
        title="Trashed Products"
        main
      />
      <NotificationBar
        v-if="message"
        :color="type"
        :icon="icon"
        :key="products.length"
      >
        {{ message }}
      </NotificationBar>
      <BaseButtons>
        <BaseButton
          :icon="mdiArrowULeftBottomBold"
          label="Return"
          color="info"
          outline
          :disabled="processing"
          @click.prevent="index"
        />
      </BaseButtons>
      <div
        class="mt-3 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 md:text-sm text-xs lg:text-base gap-2 lg:grid-cols-5"
      >
        <ProductCard
          v-for="(product, index) in productStore.products"
          :key="index"
          :product="product"
          class="text-red-500/75"
          @clicked="productStore.openModal(product)"
        />
      </div>
    </SectionMain>
  </LayoutAuthenticated>
</template>
