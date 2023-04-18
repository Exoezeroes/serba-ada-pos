<script setup>
const props = defineProps({
  product: {
    type: Object,
    required: true,
  }
});
</script>

<template>
  <div class="flex flex-col place-items-center">
    <div class="line-clamp-1">uid: {{ product.uid }}</div>
    <div class="line-clamp-1">title: {{ product.title }}</div>
    <div class="line-clamp-1">qty: {{ product.quantity }}</div>
    <div class="line clamp-1">buy: {{ product.buy_price }}</div>
    <div class="line clamp-1">sell: {{ product.sell_price }}</div>
  </div>
</template>
