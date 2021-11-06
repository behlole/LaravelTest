import app from "./vue/app";
import Vue from 'vue'
import router from "./router";
import Toaster from 'v-toaster';
import 'v-toaster/dist/v-toaster.css';

Vue.component('pagination', require('laravel-vue-pagination'));
Vue.use(Toaster, {timeout: 5000})
require('./bootstrap');
const App = new Vue({
    el: '#app',
    router,
    components: {
        app
    },
});
