<script setup>
import {
  mdiAlertCircleOutline,
  mdiCheckCircleOutline,
  mdiCloseCircleOutline,
  mdiRecycle,
  mdiTrashCan,
} from "@mdi/js";
import { Head, usePage, router } from "@inertiajs/vue3";
import { useProductStore } from "@/Stores/product";
import { useModalStore } from "@/Stores/modal";
import { computed, ref } from "vue";
import BaseButton from "@/Components/BaseButton.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import NotificationBar from "@/Components/NotificationBar.vue";
import ProductCard from "@/Components/ProductCard.vue";
import ProductModal from "@/Components/ProductModal.vue";
import SectionMain from "@/Components/SectionMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import SortButton from "@/Components/SortButton.vue";

const props = defineProps({
  products: {
    type: Array,
    required: true,
  },
});

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

const productStore = useProductStore();
const ActiveProduct = productStore.productActive;

productStore.products = props.products;

const modalStore = useModalStore();

const deletes = () => {
  modalStore.activate();
};

const processing = ref(false);

const restore = () => {
  router.visit(route("product.restore", ActiveProduct.id), {
    method: "post",
    onBefore: () => (processing.value = true),
    onSuccess: () => productStore.deleteProduct(ActiveProduct),
    onFinish: () => (processing.value = false),
  });
};

const confirmed = () => {
  router.delete(route("product.destroy", ActiveProduct.id), {
    onBefore: () => (processing.value = true),
    onSuccess: () => productStore.deleteProduct(ActiveProduct),
    onFinish: () => (processing.value = false),
  });
};

const productIndex = () => {
  router.visit(route("product.index"), {
    onBefore: () => (processing.value = true),
    onFinish: () => (processing.value = false),
  })
}
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
      @confirm="confirmed"
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
          :icon="mdiTrashCan"
          label="Trashed"
          color="danger"
          outline
          active
          :disabled="processing"
          @click.prevent="productIndex"
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
