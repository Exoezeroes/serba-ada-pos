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
    <div v-if="product.uid" class="line-clamp-1">uid: {{ product.uid }}</div>
    <div v-if="product.title" class="line-clamp-1">title: {{ product.title }}</div>
    <div v-if="product.quantity" class="line-clamp-1">qty: {{ product.quantity }}</div>
    <div v-if="product.buy_price" class="line clamp-1">buy: {{ product.buy_price }}</div>
    <div v-if="product.sell_price" class="line clamp-1">sell: {{ product.sell_price }}</div>
  </div>
</template>
