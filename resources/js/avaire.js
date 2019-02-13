
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
            meta: {
                title: 'Home - AvaIre Discord Bot',
                metaTags: [
                    {
                        name: 'description',
                        content: 'Lorem ipsum'
                    },
                ],
            },
        },
        {
            path: '/faq',
            name: 'faq',
            component: FAQ,
            meta: {
                title: 'FAQ - AvaIre Discord Bot',
                metaTags: [
                    {
                        name: 'description',
                        content: 'Lorem ipsum'
                    },
                ],
            },
        },
        {
            path: '/*',
            name: 'not-found',
            redirect: '/',
        },
    ],
});

import formatMetadata from './router/FormatMetadata';
router.beforeEach(formatMetadata);

import App from './views/App';

const app = new Vue({
    el: '#avaire',
    components: {
        App,
    },
    router,
});
