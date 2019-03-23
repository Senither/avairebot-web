<template>
    <section class="content">
        <div class="section container">
            <h1 class="title is-1">Command List</h1>

            <p>Below you'll find a list of all <strong>{{ totalCommands == 0 ? '???' : totalCommands }}</strong> commands that Ava has, along with a short description of what each command does.</p>

            <h5 class="subtitle is-5">Command Usage Syntax</h5>
            <ul>
                <li><code>[]</code> optional parameter</li>
                <li><code>&lt;&gt;</code> required parameter</li>
            </ul>
        </div>

        <div v-if="this.commands != null">
            <div class="container">
                <div class="tabs is-toggle is-fullwidth">
                    <ul>
                        <li :class="{ 'is-active': this.selected == null }">
                            <a v-on:click="setSelectedCategory(null)">
                                <span>All</span>
                            </a>
                        </li>
                        <li v-for="category in Object.keys(this.commands)" :class="{ 'is-active': selected == category }">
                            <a v-on:click="setSelectedCategory(category)">
                                <span>{{ category }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="section container" v-if="this.totalCommands > 0" >
                <div v-for="category in Object.keys(this.sortedCommands)">
                    <command-category
                        :name="category"
                        :category="sortedCommands[category]"
                    />
                </div>
            </div>
        </div>

        <div class="section container has-text-centered" v-else>
            <p class="button is-loading transparent"></p>
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
                selected: null,
            };
        },
        methods: {
            setSelectedCategory(category) {
                this.selected = category;
            }
        },
        computed: {
            sortedCommands () {
                if (this.selected == null) {
                    return this.commands;
                }

                let obj = {};
                obj[this.selected] = this.commands[this.selected];

                return obj;
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
