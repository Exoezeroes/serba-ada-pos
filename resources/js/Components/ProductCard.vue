<script setup>
import CardBox from "@/Components/CardBox.vue";
import ProductItem from "@/Components/ProductItem.vue";

const props = defineProps({
  product: {
    type: Object,
    required: true,
  },
});

const emit = defineEmits(["clicked"]);
</script>

<template>
  <CardBox
    is-hoverable
    class="cursor-pointer"
    @click="emit('clicked', product)"
  >
    <ProductItem
      :product="product"
    />
  </CardBox>
</template>
