<script setup>
import { Head } from "@inertiajs/vue3";
import { useProductStore } from "@/Stores/product";
import CardBox from "@/Components/CardBox.vue";
import LayoutSales from "@/Layouts/LayoutSales.vue";
import ProductCard from "@/Components/ProductCard.vue";
import { useCartStore } from "@/Stores/cart";

// props
const props = defineProps({
  products: {
    type: Array,
    required: true,
  },
});

const tableContent = [
  { plu: "23105", item: "This is an item", qty: 2, price: 20000 },
  { plu: "23331", item: "Item 2", qty: 3, price: 1000 },
];

// product store
const productStore = useProductStore();
productStore.products = props.products;
console.log(productStore.products);

// cart store
const cartStore = useCartStore();
</script>

<template>
  <LayoutSales>
    <Head title="Sales" />
    <div class="grid grid-cols-2 gap-4 p-2">
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
            <tr v-for="(product, index) in cartStore.cart" :key="index + 1">
              <td data-label="No">{{ index + 1 }}</td>
              <td data-label="PLU">{{ product.uid }}</td>
              <td data-label="Item">{{ product.title }}</td>
              <td data-label="Qty">{{ product.quantity }}</td>
              <td data-label="Price">{{ product.sell_price }}</td>
              <td data-label="Total">{{ product.quantity * product.sell_price }}</td>
            </tr>
          </tbody>
        </table>
      </CardBox>
      <CardBox>
        <div class="grid grid-cols-4 gap-4">
          <ProductCard
            v-for="(product, index) in productStore.products"
            :key="index"
            :product="product"
            @clicked="cartStore.addProduct(product)"
          />
        </div>
      </CardBox>
    </div>
  </LayoutSales>
</template>
