<script setup>
import { mdiGridLarge } from "@mdi/js";
import { Head } from "@inertiajs/vue3";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import SectionMain from "@/Components/SectionMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import CardBox from "@/Components/CardBox.vue";

const props = defineProps({
  products: {
    type: Array,
    required: true,
  },
});
</script>

<template>
  <LayoutAuthenticated>
    <Head title="Products" />
    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiGridLarge" title="Items" main />
      <div
        class="grid grid-cols-3 md:grid-cols-4 text-xs md:text-md lg:text-base gap-2 lg:grid-cols-5"
      >
        <CardBox v-for="(product, index) in products" :key="index">
          <div class="flex flex-col place-items-center">
            <div class="line-clamp-1">{{ product.uid }}</div>
            <div class="line-clamp-1">{{ product.title }}</div>
            <div class="line-clamp-1">{{ product.quantity }}</div>
          </div>
        </CardBox>
      </div>
    </SectionMain>
  </LayoutAuthenticated>
</template>
