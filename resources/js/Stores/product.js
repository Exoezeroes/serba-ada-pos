import { defineStore } from "pinia";

function checkString(variable, varName = "variable") {
  if (typeof variable !== "string" || !variable instanceof String)
    throw `error: ${varName} must be a string!`;
}

function sortNumber(arr, key) {
  if (key === null) throw "error: key must not be null";
  checkString(key, "key");

  arr.sort((a, b) => a[key] - b[key]);
}

function sortString(arr, key) {
  if (key === null) throw "error: key must not be null";
  checkString(key, "key");

  arr.sort((a, b) => {
    const fa = a[key].toLowerCase(),
      fb = b[key].toLowerCase();
    if (fa < fb) return -1;
    if (fa > fb) return 1;
    return 0;
  });
}

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
    sortOptions: [
      { id: 1, label: "UID" },
      { id: 2, label: "Title" },
      { id: 3, label: "Quantity" },
      { id: 4, label: "Buy Price" },
      { id: 5, label: "Sell Price" },
    ],
  }),
  actions: {
    setActiveProduct(product) {
      const productActive = this.productActive;
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

      const filteredProducts = this.products.filter(
        (el) => el.id !== product.id
      );
      this.products = filteredProducts;

      this.closeModal();
    },
    sort(by, descending = false) {
      if (by === null) throw "error: by must not be null";
      checkString(by, "by");

      switch (by.toLowerCase()) {
        case "uid":
          sortString(this.products, "uid");
          break;
        case "title":
          sortString(this.products, "title");
          break;
        case "quantity":
          sortNumber(this.products, "quantity");
          break;
        case "buy price":
          sortNumber(this.products, "buy_price");
          break;
        case "sell price":
          sortNumber(this.products, "sell_price");
          break;
      }

      if (descending) this.products.reverse();
    },
  },
});
