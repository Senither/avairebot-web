<template>
    <div>
        <h5>{{ command.name }}</h5>
        <p v-html="description"></p>

        <h6>Usage</h6>
        <ul>
            <li v-for="instruction of usageInstructions">
                {{ instruction.trigger }}
                <ul v-if="instruction.description != null">
                    <li>{{ instruction.description }}</li>
                </ul>
            </li>
        </ul>
    </div>
</template>

<script>
    import marked from 'marked';

    export default {
        props: {
            command: Object,
            prefix: String,
        },
        computed: {
            description() {
                return marked(this.command.description).replace(':prefix', this.prefix);
            },
            trigger() {
                return this.prefix + this.command.triggers[0];
            },
            usageInstructions() {
                let instructions = [];

                if (this.command.usage == null) {
                    return [{
                        trigger: this.trigger,
                        description: null,
                    }];
                }

                for (let usage of this.command.usage) {
                    let parts = usage.split(' - ');

                    let instruction = {
                        trigger: parts[0].substr(1, parts[0].length - 2).replace(':command', this.trigger),
                        description: null,
                    };

                    if (parts.length == 2) {
                        instruction.description = parts[1];
                    }
                    instructions.push(instruction);
                }

                return instructions;
            }
        }
    }
</script>
