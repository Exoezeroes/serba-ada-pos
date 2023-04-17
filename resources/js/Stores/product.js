import { defineStore } from "pinia";

export const useProductStore = defineStore("product", {
  state: () => ({
    modalData: {
      uid: "",
      title: "",
      quantity: 0,
      price: 0,
    },
  }),
  actions: {
    setData(data) {
      const modalData = this.modalData
      Object.keys(modalData).forEach(function(key) {
        modalData[key] = data[key];
      });
    }
  }
})