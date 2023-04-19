<script setup>
import { Head, useForm, router } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import {
  mdiArrowULeftBottomBold,
  mdiArrowUpBoldBoxOutline,
  mdiArrowDownBoldBoxOutline,
  mdiBallotOutline,
  mdiBarcode,
  mdiFormatLetterCase,
  mdiNumeric,
  mdiReloadAlert,
  mdiSend,
} from "@mdi/js";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import SectionMain from "@/Components/SectionMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import CardBox from "@/Components/CardBox.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import BaseButton from "@/Components/BaseButton.vue";
import BaseDivider from "@/Components/BaseDivider.vue";
import FormField from "@/Components/FormField.vue";
import FormControl from "@/Components/FormControl.vue";
import FormValidationErrors from "@/Components/FormValidationErrors.vue";

const form = useForm({
  uid: "",
  title: "",
  quantity: "",
  buy_price: "",
  sell_price: "",
});

const submit = () => {
  form.post(route("product.store"));
};

const processing = ref(false);
const isProcessing = computed(() => processing.value || form.processing);

const productIndex = () => {
  router.visit(route("product.index"), {
    onBefore: () => (processing.value = true),
    onFinish: () => (processing.value = false),
  })
}
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
      <BaseButton
        color="warning"
        label="Return"
        :icon="mdiArrowULeftBottomBold"
        :disabled="isProcessing"
        class="mb-4"
        outline
        @click.prevent="productIndex"
      />
      <CardBox isForm @submit.prevent="submit">
        <FormValidationErrors message="Something went wrong..." />
        <FormField label="UID" help="EAN-8 or EAN-13">
          <FormControl
            v-model="form.uid"
            :icon="mdiBarcode"
            maxlength="13"
            inputmode="numeric"
            placeholder="0000000000000"
            required
          />
        </FormField>

        <FormField label="Title">
          <FormControl
            v-model="form.title"
            :icon="mdiFormatLetterCase"
            placeholder="Crunchy Crunch"
            required
          />
        </FormField>

        <FormField label="Quantity" help="Positive number up to 4,294,967,295">
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

        <BaseDivider />

        <FormField
          label="Buy / Sell Price"
          help="Full price per unit, e.g. 125,000"
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
              :icon="mdiSend"
              :disabled="isProcessing"
            />
            <BaseButton
              type="reset"
              color="danger"
              outline
              label="Reset"
              :icon="mdiReloadAlert"
              :disabled="isProcessing"
            />
          </BaseButtons>
        </template>
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>
