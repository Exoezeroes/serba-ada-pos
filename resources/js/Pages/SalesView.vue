<script setup>
import { Head } from "@inertiajs/vue3";
import LayoutSales from "@/Layouts/LayoutSales.vue";
import CardBox from "@/Components/CardBox.vue";

const tableContent = [
  { plu: "23105", item: "This is an item", qty: 2, price: 20000 },
  { plu: "23331", item: "Item 2", qty: 3, price: 1000 },
];
</script>

<template>
  <LayoutSales>
    <Head title="Sales" />
    <CardBox has-table>
      <table class="whitespace-nowrap">
        <thead>
          <th>No</th>
          <th>PLU</th>
          <th>Item</th>
          <th>Qty</th>
          <th>Price</th>
          <th>Total</th>
        </thead>
        <tbody>
          <tr v-for="(product, index) in tableContent" :key="index + 1">
            <td data-label="No">{{ index + 1 }}</td>
            <td data-label="PLU">{{ product.plu }}</td>
            <td data-label="Item">{{ product.item }}</td>
            <td data-label="Qty">{{ product.qty }}</td>
            <td data-label="Price">{{ product.price }}</td>
            <td data-label="Total">{{ product.qty * product.price }}</td>
          </tr>
        </tbody>
      </table>
    </CardBox>
  </LayoutSales>
</template>
