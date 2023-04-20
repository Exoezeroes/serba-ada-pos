<script setup>
import { useModalStore } from "@/Stores/modal";
import CardBoxModal from "./CardBoxModal.vue";

const props = defineProps({
  title: { type: String, required: true },
  button: String,
  buttonLabel: String,
  hasCancel: Boolean,
  buttonCancel: String,
});

const emit = defineEmits(["confirm", "cancel"]);

const modalStore = useModalStore();
</script>

<template>
  <CardBoxModal
    v-model="modalStore.active"
    :title="title"
    :button="button"
    :buttonLabel="buttonLabel"
    :hasCancel="hasCancel"
    :buttonCancel="buttonCancel"
    @confirm="emit('confirm')"
    @cancel="emit('cancel')"
  >
    <slot />
  </CardBoxModal>
</template>
