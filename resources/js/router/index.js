
import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import routes from './Routes';

const router = new VueRouter({
    mode: 'history',
    routes,
});

import {
    formatMetadata,
    scrollToTop
} from './functions';

router.beforeEach(formatMetadata);
router.beforeEach(scrollToTop);

export default router;
