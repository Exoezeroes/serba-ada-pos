<script setup>
import SectionFullScreen from "@/Components/SectionFullScreen.vue";
import CardBox from "@/Components/CardBox.vue";
import BaseButton from "@/Components/BaseButton.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import LayoutGuest from "@/Layouts/LayoutGuest.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
  <LayoutGuest>
    <Head title="Error" />
    <SectionFullScreen v-slot="{ cardClass }" bg="pinkRed">
      <CardBox :class="cardClass">
        <div class="space-y-3">
          <h1 class="text-2xl">Unhandled exception</h1>

          <p>An Error Occurred</p>
        </div>

        <template #footer>
          <BaseButtons>
            <BaseButton label="Done" routeName="dashboard" color="danger" />
          </BaseButtons>
        </template>
      </CardBox>
    </SectionFullScreen>
  </LayoutGuest>
</template>
