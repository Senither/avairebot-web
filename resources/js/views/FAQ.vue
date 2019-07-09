<template>
    <section class="content">
        <div class="section container has-text-centered">
            <h2 class="title is-2">Frequently Asked Questions</h2>

            <div class="control has-icons-left">
                <input class="input is-large is-rounded" type="text" placeholder="What did you need help with?" v-model="query" autofocus>
                <span class="icon is-medium is-left">
                    <i class="fas fa-question"></i>
                </span>
            </div>
        </div>

        <div class="section container" v-if="this.sortedFaqs != null" >
            <div v-if="this.sortedFaqs.length > 0">
                <article class="message is-medium is-primary" v-for="category in this.sortedFaqs">
                    <div class="message-header" v-on:click="category.display = !category.display" :class="{ 'closed-message': !category.display }">
                        <p>
                            <i class="fas fa-chevron-down" v-if="category.display"></i>
                            <i class="fas fa-chevron-right" v-else></i>
                            {{ category.name }}
                        </p>
                    </div>
                    <div class="message-body" v-show="category.display">
                        <article class="message" v-for="item of category.faqs">
                            <div class="message-header has-background-black-ter" v-on:click="item.display = !item.display" :class="{ 'closed-message': !item.display }">
                                <p>
                                    <i class="fas fa-chevron-down" v-if="item.display"></i>
                                    <i class="fas fa-chevron-right" v-else></i>
                                    {{ item.title }}
                                </p>
                            </div>
                            <div class="message-body" v-show="item.display">
                                <span v-html="markdown(item.body)"></span>
                            </div>
                        </article>
                    </div>
                </article>
            </div>

            <div v-else>
                <h4 class="subtitle has-text-centered is-4">No entries were found matching your query!</h4>
            </div>
        </div>

        <div class="section container has-text-centered" v-else>
            <p class="button is-loading transparent"></p>
        </div>
  </section>
</template>

<style type="text/css">
    .message-header {
        cursor: pointer;
    }
    .message-header i.fas {
        width: 26px;
    }
    .closed-message {
        border-radius: 3px;
    }
</style>

<script>
    import marked from 'marked';

    export default {
        mounted() {
            axios('/api/faq').then(response => {
                if (response.status == 200) {
                    this.faq = response.data.data.map(item => {
                        item.display = false;

                        item.faqs = item.faqs.map(entry => {
                            entry.display = false;

                            return entry;
                        });

                        return item;
                    });
                }
            }).catch(error => {
                this.faq = null;
            });
        },
        data() {
            return {
                faq: null,
                query: '',
            };
        },
        methods: {
            markdown(content) {
                return marked(content);
            }
        },
        computed: {
            sortedFaqs() {
                if (this.faq == null || this.query.trim().length == 0) {
                    return this.faq;
                }

                let faqClone = JSON.parse(JSON.stringify(this.faq));
                let query = new RegExp(this.query.trim(), 'gi');

                return faqClone.map(category => {
                    let hasMatch = false;

                    category.faqs.map(faq => {
                        faq.display = faq.title.match(query) || faq.body.match(query);

                        if (faq.display) {
                            hasMatch = true;
                        }

                        return faq;
                    });

                    category.display = hasMatch;
                    return category;
                }).filter(category => category.faqs.length > 0);
            }
        },
    }
</script>
