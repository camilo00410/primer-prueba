import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);

export default new Router({
  mode: "history",
  routes: [
    {
      path: "/",
      alias: "/products",
      name: "products",
      component: () => import("./components/ProductList")
    },
    {
      path: "/product/:id",
      name: "product-details",
      component: () => import("./components/Product")
    },
    {
      path: "/add",
      name: "add",
      component: () => import("./components/AddProduct")
    }
  ]
});