<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import {
  mdiBallotOutline,
  mdiBarcode,
  mdiFormatLetterCase,
  mdiNumeric,
  mdiCash,
} from "@mdi/js";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import SectionMain from "@/Components/SectionMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import CardBox from "@/Components/CardBox.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import BaseButton from "@/Components/BaseButton.vue";
import FormField from "@/Components/FormField.vue";
import FormControl from "@/Components/FormControl.vue";

const form = useForm({
  uid: "",
  title: "",
  quantity: "",
  price: "",
});

const submit = () => {
  form.post("");
};
</script>

<template>
  <LayoutAuthenticated>
    <Head title="Add Product" />
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiBallotOutline"
        title="Add Product"
        main
      />
      <CardBox isForm @submit.prevent="submit">
        <FormField label="UID" help="EAN-8 or EAN-13.">
          <FormControl
            v-model="form.uid"
            :icon="mdiBarcode"
            maxlength="13"
            inputmode="numeric"
            placeholder="0000000000000"
            required
          />
        </FormField>
        <FormField label="Name">
          <FormControl
            v-model="form.title"
            :icon="mdiFormatLetterCase"
            placeholder="Crunchy Crunch"
            required
          />
        </FormField>
        <FormField label="Stock">
          <FormControl
            v-model="form.quantity"
            :icon="mdiNumeric"
            inputmode="numeric"
            type="number"
            min="1"
            placeholder="1"
            required
          />
        </FormField>
        <FormField label="Price" help="Full price, e.g. 125000">
          <FormControl
            v-model="form.price"
            :icon="mdiCash"
            type="number"
            inputmode="numeric"
            placeholder="1000"
            required
          />
        </FormField>
        <template #footer>
          <BaseButtons>
            <BaseButton
              type="submit"
              color="success"
              label="Submit"
              :disabled="form.processing"
            />
            <BaseButton
              type="reset"
              color="danger"
              outline
              label="Reset"
              :disabled="form.processing"
            />
          </BaseButtons>
        </template>
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>
