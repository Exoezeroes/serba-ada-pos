<script setup>
import { computed } from "vue";
import { mdiClose } from "@mdi/js";
import { useStyleStore } from "@/Stores/style";
import BaseButton from "@/Components/BaseButton.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import CardBox from "@/Components/CardBox.vue";
import OverlayLayer from "@/Components/OverlayLayer.vue";
import CardBoxComponentTitle from "@/Components/CardBoxComponentTitle.vue";

const props = defineProps({
  title: {
    type: String,
    required: true,
  },
  button: {
    type: String,
    default: "info",
  },
  buttonLabel: {
    type: String,
    default: "Done",
  },
  hasCancel: Boolean,
  buttonCancel: {
    type: String,
    default: "danger",
  },
  modelValue: {
    type: [String, Number, Boolean],
    default: null,
  },
  disabled: Boolean,
});

const emit = defineEmits(["update:modelValue", "cancel", "confirm"]);

const value = computed({
  get: () => props.modelValue,
  set: (value) => emit("update:modelValue", value),
});

const confirmCancel = (mode) => {
  value.value = false;
  emit(mode);
};

const confirm = () => confirmCancel("confirm");

const cancel = () => confirmCancel("cancel");

window.addEventListener("keydown", (e) => {
  if (e.key === "Escape" && value.value) {
    cancel();
  }
});

const styleStore = useStyleStore();
</script>

<template>
  <OverlayLayer v-show="value" @overlay-click="cancel">
    <CardBox
      v-show="value"
      :class="styleStore.asideScrollbarsStyle"
      class="shadow-lg max-h-modal w-11/12 md:w-3/5 lg:w-2/5 xl:w-4/12 z-50 overflow-y-auto"
      is-modal
    >
      <CardBoxComponentTitle :title="title">
        <BaseButton
          v-if="hasCancel"
          :icon="mdiClose"
          color="whiteDark"
          small
          rounded-full
          @click.prevent="cancel"
        />
      </CardBoxComponentTitle>

      <div class="space-y-3">
        <slot />
      </div>

      <template #footer>
        <BaseButtons>
          <BaseButton :label="buttonLabel" :color="button" @click="confirm" :disabled="disabled" />
          <BaseButton
            v-if="hasCancel"
            label="Cancel"
            :color="buttonCancel"
            outline
            @click="cancel"
            :disabled="disabled"
          />
        </BaseButtons>
      </template>
    </CardBox>
  </OverlayLayer>
</template>
