import { defineStore } from "pinia";

export const useProductStore = defineStore("product", {
  state: () => ({
    productActive: {
      uid: "",
      title: "",
      quantity: 0,
      price: 0,
    },
    modalActive: false,
  }),
  actions: {
    setProduct(product) {
      const productActive = this.productActive
      Object.keys(productActive).forEach(function(key) {
        productActive[key] = product[key];
      });
    },
    openModal(product) {
      this.modalActive = true;
      this.setProduct(product);
    }
  }
})