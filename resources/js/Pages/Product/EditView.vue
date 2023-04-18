<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import {
  mdiArrowDownBoldBoxOutline,
  mdiArrowUpBoldBoxOutline,
  mdiBallotOutline,
  mdiBarcode,
  mdiFormatLetterCase,
  mdiNumeric,
} from "@mdi/js";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import SectionMain from "@/Components/SectionMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import CardBox from "@/Components/CardBox.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import BaseButton from "@/Components/BaseButton.vue";
import FormField from "@/Components/FormField.vue";
import FormControl from "@/Components/FormControl.vue";
import FormValidationErrors from "@/Components/FormValidationErrors.vue";

const props = defineProps({
  product: { type: Object, required: true },
});

const form = useForm({
  uid: props.product.uid,
  title: props.product.title,
  quantity: props.product.quantity,
  buy_price: props.product.buy_price,
  sell_price: props.product.sell_price,
});

const submit = () => {
  console.log('hey hey not yet')
};
</script>

<template>
  <LayoutAuthenticated>
    <Head title="Edit Product" />
    <SectionMain>
      <SectionTitleLineWithButton
        :icon="mdiBallotOutline"
        title="Edit Product"
        main
      />
      <CardBox isForm @submit.prevent="submit">
        <FormValidationErrors message="Something went wrong..." />
        <FormField label="UID" :help="`Previously ${props.product.uid}`">
          <FormControl
            v-model="form.uid"
            :icon="mdiBarcode"
            maxlength="13"
            inputmode="numeric"
            placeholder="0000000000000"
            required
          />
        </FormField>
        <FormField label="Title" :help="`Previously ${props.product.title}`">
          <FormControl
            v-model="form.title"
            :icon="mdiFormatLetterCase"
            placeholder="Crunchy Crunch"
            required
          />
        </FormField>
        <FormField
          label="Quantity"
          :help="`Previously ${props.product.quantity}`"
        >
          <FormControl
            v-model="form.quantity"
            :icon="mdiNumeric"
            inputmode="numeric"
            type="number"
            min="1"
            max="4294967295"
            placeholder="Quantity"
            required
          />
        </FormField>
        <FormField
          label="Price"
          :help="`Modifying buy price is not allowed.
          Previous sell price is ${props.product.sell_price}`"
        >
          <FormControl
            v-model="form.buy_price"
            :icon="mdiArrowDownBoldBoxOutline"
            type="number"
            min="1"
            max="4294967295"
            inputmode="numeric"
            placeholder="Buy Price"
            required
            disabled
          />
          <FormControl
            v-model="form.sell_price"
            :icon="mdiArrowUpBoldBoxOutline"
            type="number"
            min="1"
            max="4294967295"
            inputmode="numeric"
            placeholder="Sell Price"
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
              @click.prevent="form.reset()"
            />
          </BaseButtons>
        </template>
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>
