import { createApp } from "vue";
import { createWebHistory, createRouter } from "vue-router";
import VueTheMask from "vue-the-mask";
import "./style.css";

import App from "@/App.vue";

import Index from "@/views/Index.vue";

const routes = [
  {
    path: "/",
    component: Index,
  },
  { path: "/:pathMatch(.*)*", redirect: "/" },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

createApp(App).use(router).use(VueTheMask).mount("#app");
