<template>
    <article class="message is-command">
        <div class="message-header" v-on:click="toggleVisibility()">
            <div class="level">
                <div class="level-left">
                    <div class="level-item">
                        <p :id="categoryName + ':' + command.className" class="level-item is-left">
                            <strong>{{ command.name.substr(0, command.name.length - 8) }}</strong>
                            <span class="tag is-primary" v-for="requirement of formattedRequiredPermission.bot">
                                {{ requirement }}
                            </span>
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

            <span v-if="formattedRequiredPermission.user.length > 0">
                <p v-if="formattedRequiredPermission.hasOwnProperty('system')">
                    <span class="tag is-primary" v-for="requirement of formattedRequiredPermission.user">
                        {{ requirement }}
                    </span>
                </p>
                <p v-else>
                    <strong>The user running the command must have the following permission{{ formattedRequiredPermission.user.length != 1 ? 's' : null }}</strong><br>
                    <ul>
                        <li class="tag is-primary" v-for="requirement of formattedRequiredPermission.user">
                            {{ requirement }}
                        </li>
                    </ul>
                </p>
                <br>
            </span>

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
                        >{{ link.name.substr(0, link.name.length - 8) }}</a>
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
    .tag {
        margin-right: 10px;
    }
</style>

<script>
    import marked from 'marked';

    import {
        getPermission,
    } from '../utils/PermissionManager';

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

                    let name = part[1]
                        .split(/(?=[A-Z])/)
                        .join(' ');

                    relationships.push({
                        category: part[0],
                        command: part[1],
                        name,
                    });
                }

                if (relationships.length == 0) {
                    return [];
                }
                return relationships;
            },
            formattedRequiredPermission() {
                let middlewares = this.command.middlewares;
                if (middlewares.includes('isBotAdmin') || middlewares.includes('isBotAdmin:use-role')) {
                    return {
                        system: true,
                        user: ['You must be a Bot Administrator to use this command!']
                    };
                }

                let requirements = {
                    user: [],
                    bot: [],
                    all: [],
                };

                for (let middleware of middlewares) {
                    if (middleware.substr(0, 8) != 'require:') {
                        continue;
                    }

                    let parts = middleware.substr(8, middleware.length).split(',');
                    if (parts.length !== 2 || ! requirements.hasOwnProperty(parts[0])) {
                        continue;
                    }

                    let permission = getPermission(parts[1]);
                    if (permission == null) {
                        continue;
                    }

                    requirements[parts[0]].push(permission);
                }

                for (let requirement of requirements.all) {
                    requirements.bot.push(requirement);
                    requirements.user.push(requirement);
                }
                delete requirements.all;

                return requirements;
            },
        }
    }
</script>
