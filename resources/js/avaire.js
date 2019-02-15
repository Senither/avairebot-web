
require('./bootstrap');

import Vue from 'vue';
import router from './router';

import App from './views/App';

Vue.mixin({
    data() {
        return {
            stats: null,
            loadingStats: false,
        };
    },
    methods: {
        url(route) {
            return window.baseUrl + route;
        },
        getStats(property = null) {
            if (this.stats == null) {
                this.refreshStats();
            }

            if (property == null) {
                return this.stats;
            }

            if (this.stats == null) {
                return 'Loading...';
            }

            let statsCopy = this.stats;
            for (let key of property.split('.')) {
                if (statsCopy.hasOwnProperty(key)) {
                    statsCopy = statsCopy[key];
                }
            }

            if (isNaN(statsCopy)) {
                return statsCopy;
            }
            return statsCopy.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        },
        refreshStats() {
            if (this.loadingStats) {
                return;
            }

            this.loadingStats = true;
            axios('https://api.avairebot.com/v1/stats').then(response => {
                this.loadingStats = false;
                if (response.status == 200) {
                    this.stats = response.data;
                }
            }).catch(error => {
                this.loadingStats = false;
            });
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
