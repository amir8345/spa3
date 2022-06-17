import './bootstrap';

import { createApp } from "vue";
import { createPinia } from "pinia";
import { routes } from "./routes";

import App from "./App.vue";
import { createRouter, createWebHistory } from 'vue-router';



const router = createRouter({
    history: createWebHistory(),
    routes
})
  

const app = createApp(App);
app.use(createPinia());
app.use(router);
app.mount('#app');