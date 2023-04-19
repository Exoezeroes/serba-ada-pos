<script setup>
import { useProductStore } from "@/Stores/product";
import { mdiDelete, mdiPencil } from "@mdi/js";
import BaseButton from "./BaseButton.vue";
import BaseButtons from "./BaseButtons.vue";
import CardBox from "@/Components/CardBox.vue";
import CardBoxModal from "@/Components/CardBoxModal.vue";
import ProductModalTable from "./ProductModalTable.vue";

const props = defineProps({
  canEdit: Boolean,
  canDelete: Boolean,
  button: {
    type: String,
    default: "info",
  },
  buttonLabel: {
    type: String,
    default: "Done",
  },
  hasCancel: Boolean,
});

const emit = defineEmits(["confirm", "edit", "deletes"]);

const editable = props.canEdit ? true : false;
const deletable = props.canDelete ? true : false;

const productStore = useProductStore();

const ActiveProduct = productStore.productActive;

const editDelete = (event) => {
  productStore.closeModal();
  emit(event);
};

const edit = () => {
  editDelete("edit");
};
const deletes = () => {
  editDelete("deletes");
};
</script>

<template>
  <CardBoxModal
    v-model="productStore.modalActive"
    :title="ActiveProduct.title"
    :button="button"
    :buttonLabel="buttonLabel"
    :hasCancel="hasCancel"
    @confirm="emit('confirm')"
  >
    <BaseButtons type="justify-between">
      <BaseButton
        v-if="editable"
        :icon="mdiPencil"
        color="warning"
        outline
        @click.prevent="edit"
      />
      <BaseButton
        v-if="deletable"
        :icon="mdiDelete"
        color="danger"
        outline
        @click.prevent="deletes"
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
