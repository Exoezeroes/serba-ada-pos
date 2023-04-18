<script setup>
import BaseButton from "./BaseButton.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  label: {
    type: [String, Number],
    default: null,
  },
  icon: {
    type: String,
    default: null,
  },
  iconSize: {
    type: [String, Number],
    default: null,
  },
  href: {
    type: String,
    default: null,
  },
  target: {
    type: String,
    default: null,
  },
  type: {
    type: String,
    default: null,
  },
  color: {
    type: String,
    default: "white",
  },
  as: {
    type: String,
    default: null,
  },
  method: {
    type: String,
    default: "get",
  },
  small: Boolean,
  outline: Boolean,
  active: Boolean,
  disabled: Boolean,
  roundedFull: Boolean,
  small: Boolean,
  outline: Boolean,
  active: Boolean,
  disabled: Boolean,
  roundedFull: Boolean,
});
</script>

<template>
  <Link :href="href" :method="method" :as="as">
    <BaseButton
      :label="label"
      :icon="icon"
      :iconSize="iconSize"
      :target="target"
      :type="type"
      :color="color"
      :small="small"
      :outline="outline"
      :active="active"
      :disabled="disabled"
      :roundedFull="roundedFull"
    />
  </Link>
</template>
