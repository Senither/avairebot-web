<template>
    <article class="message is-command">
        <div class="message-header" v-on:click="toggleVisibility()">
            <div class="level">
                <div class="level-left">
                    <div class="level-item">
                        <p :id="categoryName + ':' + command.className" class="level-item is-left">
                            <strong>{{ command.name.substr(0, command.name.length - 8) }}</strong>
                        </p>
                    </div>
                </div>

                <div class="level-right">
                    <div class="level-item">
                        <small class="level-item">{{ prefix + command.triggers.join(', !') }}</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="message-body" v-if="command.isShown">
            <p v-html="description"></p>

            <h6>Usage</h6>
            <table class="table">
                <tbody>
                    <tr v-for="instruction of usageInstructions">
                        <td>{{ instruction.trigger }}</td>
                        <td>
                             <span v-if="instruction.description != null">
                                {{ instruction.description }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>

            <h6>Examples</h6>
            <table class="table">
                <tbody>
                    <tr v-for="instruction of exampleInstructions">
                        <td>{{ instruction.trigger }}</td>
                        <td>
                             <span v-if="instruction.description != null">
                                {{ instruction.description }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div v-if="command.relationships != null">
                <h6>See Also</h6>
                <ul>
                    <li v-for="link in seeAlsoLinks">
                        <a
                            :href="'#' + link.category + ':' + link.command"
                            @click="handleClickOnSeeAlso(link)"
                        >{{ link.command }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </article>
</template>

<style type="text/css">
    .level {
        width: 100%;
    }
    .level-item.is-left {
        display: block;
    }
</style>

<script>
    import marked from 'marked';

    export default {
        props: {
            command: Object,
            categoryName: String,
            prefix: String,
        },
        mounted() {
            this.command.isShown = false;
        },
        methods: {
            toggleVisibility() {
                this.command.isShown = !this.command.isShown;

                this.$forceUpdate();
            },
            handleClickOnSeeAlso(link) {
                const { category, command } = link;

                this.$emit('see-also', link);
            },
            formatInstructions(trigger, array) {
                let instructions = [];

                if (array == null) {
                    return [{ trigger, description: null }];
                }

                for (let item of array) {
                    let parts = item.split(' - ');

                    let instruction = {
                        trigger: parts[0].substr(1, parts[0].length - 2).replace(':command', trigger),
                        description: null,
                    };

                    if (parts.length == 2) {
                        instruction.description = parts[1];
                    }
                    instructions.push(instruction);
                }

                return instructions;
            },
        },
        computed: {
            description() {
                return marked(this.command.description).replace(':prefix', this.prefix);
            },
            trigger() {
                return this.prefix + this.command.triggers[0];
            },
            usageInstructions() {
                return this.formatInstructions(this.trigger, this.command.usage);
            },
            exampleInstructions() {
                return this.formatInstructions(this.trigger, this.command.example);
            },
            seeAlsoLinks() {
                if (this.command.relationships == null) {
                    return [];
                }

                let relationships = [];
                for (let relationship of this.command.relationships) {
                    let part = relationship.split('::');
                    if (part.length != 2) {
                        continue;
                    }

                    relationships.push({
                        category: part[0],
                        command: part[1],
                    });
                }

                if (relationships.length == 0) {
                    return [];
                }
                return relationships;
            },
        }
    }
</script>
