<template>
    <div>
        <h1 class="has-text-centered is-1">{{ name }}</h1>

        <div v-for="(command, index) in commands">
            <command
                :prefix="category.prefix"
                :command="command"
                :categoryName="name"
                @see-also="handleSeeAlsoEvent"
            />
        </div>
    </div>
</template>

<style type="text/css">
    .message {
        margin-bottom: 8px;
    }
</style>

<script>
    import Command from './Command';

    export default {
        props: {
            category: Object,
            name: String,
        },
        methods: {
            handleSeeAlsoEvent(event) {
                this.$emit('see-also', event);
            },
        },
        computed: {
            commands() {
                return Object.keys(this.category.commands).filter(command => {
                    return this.category.commands[command].priority != 'HIDDEN';
                }).map(command => {
                    this.category.commands[command].className = command;
                    return this.category.commands[command];
                });
            }
        },
        components: {
            Command
        },
    }
</script>
