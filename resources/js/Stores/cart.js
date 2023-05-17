import { defineStore } from "pinia";

export const useCartStore = defineStore("cart", {
  state: () => ({
    cart: [],
  }),
  actions: {
    addProduct(product) {
      // setup product
      const container = {
        id: "",
        uid: "",
        title: "",
        sell_price: 0,
      };

      // assign product
      Object.keys(container).forEach(function (key) {
        container[key] = product[key];
      });

      // default to 1
      container.quantity = 1;

      // throw if error
      if (!container.id) throw "Error: product needs an id.";

      // check for exist
      let exist = false;
      for (let item of this.cart) {
        if (item.id === container.id) {
          exist = true;
          break;
        }
      }

      // add
      if (!exist) {
        this.cart.push(container);
      } else {
        for (let item of this.cart) {
          if (item.id === container.id) {
            item.quantity += 1;
          }
        }
      }
      console.log(this.cart);
    },
  },
});
