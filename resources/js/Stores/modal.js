import { defineStore } from "pinia";

export const useModalStore = defineStore("modal", {
  state: () => ({
    active: false
  }),
  actions: {
    activate() {
      this.active = true;
    },
    deactivate() {
      this.active = false;
    },
  },
});