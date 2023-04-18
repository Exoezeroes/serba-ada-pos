import { defineStore } from "pinia";

export const useProductStore = defineStore("product", {
  state: () => ({
    products: [],
    productActive: {
      id: "",
      uid: "",
      title: "",
      quantity: 0,
      buy_price: 0,
      sell_price: 0,
    },
    modalActive: false,
  }),
  actions: {
    setActiveProduct(product) {
      const productActive = this.productActive
      Object.keys(productActive).forEach(function (key) {
        productActive[key] = product[key];
      });
    },
    openModal(product) {
      this.modalActive = true;
      this.setActiveProduct(product);
    },
    closeModal() {
      this.modalActive = false;
    },
    deleteProduct(product) {
      if (!product.id) throw "The passed product does not have an id!";

      const filteredProducts = this.products.filter(el => el.id !== product.id)
      this.products = filteredProducts;

      this.closeModal();
    }
  }
})