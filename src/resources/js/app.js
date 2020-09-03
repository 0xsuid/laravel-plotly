require('./bootstrap');


import Vue from "vue";
import VueRouter from "vue-router";
import routes from "./routes";
import App from "./components/App";
import { BootstrapVue } from 'bootstrap-vue'


// Install BootstrapVue
Vue.use(BootstrapVue);

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: routes
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});