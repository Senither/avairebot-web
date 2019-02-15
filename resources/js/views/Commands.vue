<template>
    <section class="content">
        <div class="section container">
            <h1 class="title is-1">Command List</h1>

            <p>Below you'll find a list of all <strong>{{ totalCommands }}</strong> commands that Ava has, along with a short description of what each command does.</p>

            <h5 class="subtitle is-5">Command Usage Syntax</h5>
            <ul>
                <li><code>[]</code> optional parameter</li>
                <li><code>&lt;&gt;</code> required parameter</li>
            </ul>
        </div>

        <div class="section container" v-if="this.totalCommands > 0" >
            <div v-for="category in Object.keys(this.sortedCommands)">
                <command-category
                    :name="category"
                    :category="sortedCommands[category]"
                />
            </div>
        </div>

        <div class="section container has-text-centered" v-else>
            <h3 class="title is-3">Loading...</h3>
        </div>
  </section>
</template>

<script>
    import CommandCategory from '../components/CommandCategory';

    export default {
        mounted() {
            axios('/api/commands').then(response => {
                if (response.status == 200) {
                    this.commands = response.data.data;
                }
            }).catch(error => {
                this.commands = null;
            });
        },
        data() {
            return {
                commands: null,
                query: null,
            };
        },
        computed: {
            sortedCommands () {
                return this.commands;
            },
            totalCommands() {
                if (this.commands == null) {
                    return 0;
                }

                let total = 0;
                for (let category in this.commands) {
                    total += Object.keys(this.commands[category].commands).length;
                }

                return total;
            },
        },
        components: {
            CommandCategory
        }
    }
</script>
