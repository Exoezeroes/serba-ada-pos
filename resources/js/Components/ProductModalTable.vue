<script setup>
const props = defineProps({
  product: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <table>
    <thead>
      <th>Barcode</th>
      <th>Quantity</th>
      <th>Price</th>
    </thead>
    <tbody>
      <tr>
        <td data-label="Barcode">
          {{ product.uid }}
        </td>
        <td data-label="Quantity">
          {{ product.quantity }}
        </td>
        <td data-label="Price">
          {{ product.price }}
        </td>
      </tr>
    </tbody>
  </table>
</template>
