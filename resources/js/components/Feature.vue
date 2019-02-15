<template>
    <div class="column">
        <a v-if="this.hasIcon" :href="getUrl()">
            <i class="fas is-primary" :class="icon"></i>
        </a>

        <a :href="getUrl()">
            <h4>{{ title }}</h4>
            <p>{{ body }}</p>
        </a>
    </div>
</template>

<script>
    export default {
        props: {
            title: String,
            body: String,
            icon: String,
            to: String,
        },
        methods: {
            hasIcon() {
                return this.icon != undefined;
            },
            getUrl() {
                if (this.to == undefined) {
                    return '#';
                }
                return this.url(this.to);
            }
        }
    }
</script>

<style type="text/css" scoped>
    i {
        font-size: 2.5em;
        padding-bottom: 1.85vh;
    }
</style>
