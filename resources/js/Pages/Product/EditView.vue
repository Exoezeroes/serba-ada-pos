<script setup>
import {
  mdiArrowULeftBottomBold,
  mdiArrowDownBoldBoxOutline,
  mdiArrowUpBoldBoxOutline,
  mdiBallotOutline,
  mdiBarcode,
  mdiFormatLetterCase,
  mdiNumeric,
  mdiReloadAlert,
  mdiSend,
} from "@mdi/js";
import { Head, useForm } from "@inertiajs/vue3";
import { computed } from "vue";
import { useRouteStore } from "@/Stores/route";
import { useModalStore } from "@/Stores/modal";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import SectionMain from "@/Components/SectionMain.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import CardBox from "@/Components/CardBox.vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import BaseButton from "@/Components/BaseButton.vue";
import BaseDivider from "@/Components/BaseDivider.vue";
import FormField from "@/Components/FormField.vue";
import FormControl from "@/Components/FormControl.vue";
import FormValidationErrors from "@/Components/FormValidationErrors.vue";

// props
const props = defineProps({
  product: { type: Object, required: true },
});

// modal store
const modalStore = useModalStore();

const confirm = () => {
  modalStore.activate();
};

// form
const form = useForm({
  uid: props.product.uid,
  title: props.product.title,
  quantity: props.product.quantity,
  buy_price: props.product.buy_price,
  sell_price: props.product.sell_price,
});

const submit = () => (form.sell_price < form.buy_price ? confirm() : post());

const post = () => {
  form.reset("buy_price");
  form.patch(route("product.update", props.product));
};

// route store
const routeStore = useRouteStore();
const processing = computed(() => routeStore.processing || form.processing);

// routes
const index = () => routeStore.get("product.index");
</script>

<template>
  <LayoutAuthenticated>
    <Head title="Edit Product" />
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
        title="Edit Product"
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

        <BaseDivider />

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
              @click.prevent="form.reset()"
            />
          </BaseButtons>
        </template>
      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>
