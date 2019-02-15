<template>
    <div>
        <h1>{{ name }}</h1>

        <div v-for="command in category.commands">
            <command
                :prefix="category.prefix"
                :command="command"
            />

            <br>
        </div>
    </div>
</template>

<script>
    import Command from './Command';

    export default {
        props: {
            category: Object,
            name: String,
        },
        components: {
            Command
        },
    }
</script>
