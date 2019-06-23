<template>
    <div class="column">
        <router-link :to="{ name: 'commands', hash: this.to }">
            <i class="fas is-primary" :class="icon"></i>
        </router-link>

        <router-link :to="{ name: 'commands', hash: this.to }">
            <h4>{{ title }}</h4>
            <p>{{ body }}</p>
        </router-link>
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
        }
    }
</script>

<style type="text/css" scoped>
    i {
        font-size: 2.5em;
        padding-bottom: 1.85vh;
    }
</style>
