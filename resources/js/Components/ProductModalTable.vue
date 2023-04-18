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
      <th>Buy Price</th>
      <th>Sell Price</th>
    </thead>
    <tbody>
      <tr>
        <td data-label="Barcode">
          {{ product.uid }}
        </td>
        <td data-label="Quantity">
          {{ product.quantity }}
        </td>
        <td data-label="Buy Price">
          {{ product.buy_price }}
        </td>
        <td data-label="Sell Price">
          {{ product.sell_price }}
        </td>
      </tr>
    </tbody>
  </table>
</template>
