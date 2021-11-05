require('./bootstrap');
import Vue from 'vue';
import app from "./vue/app";

const App = new Vue({
    el: '#app',
    components: {app}
});
