import { defineStore } from "pinia";
import { router } from "@inertiajs/core";

export const useRouteStore = defineStore('route', {
  state: () => ({
    processing: false,
  }),
  actions: {
    get(routeName, params = null, options = null) {
      this.visit(routeName, params, "get", options);
    },
    post(routeName, params = null, options = null) {
      this.visit(routeName, params, "post", options);
    },
    put(routeName, params = null, options = null) {
      this.visit(routeName, params, "put", options)
    },
    patch(routeName, params = null, options = null) {
      this.visit(routeName, params, "patch", options)
    },
    delete(routeName, params = null, options = null) {
      this.visit(routeName, params, "delete", options);
    },
    visit(routeName, params = null, method = "get", options = null) {
      if (!routeName) {
        throw "error: routeName is missing!"
      };
      // if routeName type isn't a string or routeName isn't an instance of String
      if (typeof routeName !== 'string' || !routeName instanceof String) {
        throw "error: routeName must be a string!"
      };
      // if options type isn't an object or object is an array
      if (!typeof options === 'object' || Array.isArray(options)) {
        throw "error: options must be an object but not an array!"
      };

      const get = (option) => {
        if (!options || !options[option]) return null;
        return options[option]();
      }

      router.visit(route(routeName, params), {
        method: method,
        onBefore: () => get("onBefore"),
        onStart: () => { this.processing = true; get("OnStart") },
        onProgress: () => get("OnProgress"),
        onFinish: () => { this.processing = false; get("onFinish") },
        onSuccess: () => get("onSuccess"),
      });
    },
  },
});