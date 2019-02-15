
require('./bootstrap');

import Vue from 'vue';
import router from './router';

import App from './views/App';

Vue.mixin({
    methods: {
        url(route) {
            return window.baseUrl + route;
        }
    }
});

const app = new Vue({
    el: '#avaire',
    components: {
        App
    },
    router,
});
