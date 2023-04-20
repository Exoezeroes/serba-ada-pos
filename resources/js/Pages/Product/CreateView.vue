<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import { computed } from "vue";
import { useRouteStore } from "@/Stores/route";
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
import { useModalStore } from "@/Stores/modal";
import CardBox from "@/Components/CardBox.vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import BaseButton from "@/Components/BaseButton.vue";
import BaseDivider from "@/Components/BaseDivider.vue";
import FormField from "@/Components/FormField.vue";
import FormControl from "@/Components/FormControl.vue";
import FormValidationErrors from "@/Components/FormValidationErrors.vue";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import SectionMain from "@/Components/SectionMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";

// modal store
const modalStore = useModalStore();

const confirm = () => {
  modalStore.activate();
};

// form
const form = useForm({
  uid: "",
  title: "",
  quantity: "",
  buy_price: "",
  sell_price: "",
});

const submit = () => (form.sell_price < form.buy_price ? confirm() : post());

const post = () => {
  form.post(route("product.store"));
};

// route store
const routeStore = useRouteStore();
const processing = computed(() => routeStore.processing || form.processing);

// routes
const index = () => routeStore.get("product.index");
</script>

<template>
  <LayoutAuthenticated>
    <Head title="Add Product" />
    <ConfirmationModal
      button="warning"
      buttonLabel="Confirm"
      hasCancel
      title="Are you sure?"
      @confirm="post"
    >
      The sell price entered is lower than the buy price!
    </ConfirmationModal>
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
        :disabled="processing"
        class="mb-4"
        outline
        @click.prevent="index"
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
              :disabled="processing"
            />
            <BaseButton
              type="reset"
              color="danger"
              outline
              label="Reset"
              :icon="mdiReloadAlert"
              :disabled="processing"
            />
          </BaseButtons>
        </template>
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>
