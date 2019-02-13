
import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Home from './views/Home';
import FAQ from './views/FAQ';

const router = new VueRouter({
    mode: 'history',
    base: '/avairebot-web/public/',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/faq',
            name: 'faq',
            component: FAQ
        },
        {
            path: '/*',
            name: 'not-found',
            redirect: '/',
        },
    ],
});

import App from './views/App';

const app = new Vue({
    el: '#avaire',
    components: {
        App,
    },
    router,
});

document.title = 'Loading...';
