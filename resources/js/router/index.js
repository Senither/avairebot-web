
import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import formatMetadata from './FormatMetadata';
import routes from './Routes';

const router = new VueRouter({
    mode: 'history',
    routes,
});

router.beforeEach(formatMetadata);

export default router;
