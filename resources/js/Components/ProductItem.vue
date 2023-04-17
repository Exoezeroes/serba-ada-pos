<script setup>
const props = defineProps({
  uid: { type: String },
  title: { type: String },
  quantity: { type: Number },
  price: { type: Number },
});
</script>

<template>
  <div class="flex flex-col place-items-center">
    <div class="line-clamp-1">{{ uid }}</div>
    <div class="line-clamp-1">{{ title }}</div>
    <div class="line-clamp-1">{{ quantity }}</div>
    <div class="line clamp-1">{{ price }}</div>
  </div>
</template>
