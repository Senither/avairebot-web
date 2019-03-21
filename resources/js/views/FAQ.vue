<template>
    <section class="content">
        <div class="section container has-text-centered">
            <h2 class="title is-2">Frequently Asked Questions</h2>

            <div class="control has-icons-left has-icons-right">
                <input class="input is-large is-rounded" type="text" placeholder="What did you need help with?" v-model="query">
                <span class="icon is-medium is-left">
                    <i class="fas fa-question"></i>
                </span>
            </div>
        </div>

        <div class="section container" v-if="this.sortedFaqs != null && this.sortedFaqs.length > 0" >
            <article class="message is-primary" v-for="category in this.sortedFaqs">
                <div class="message-header">
                    {{ category.name }}
                </div>
                <div class="message-body">
                    <article class="message" v-for="item of category.faqs">
                        <div class="message-body">
                            <strong>{{ item.title }}</strong>
                            <br><span v-html="item.body"></span>
                        </div>
                    </article>
                </div>
            </article>
        </div>

        <div class="section container has-text-centered" v-else>
            <p class="button is-loading transparent"></p>
        </div>
  </section>
</template>

<script>
    export default {
        mounted() {
            axios('/api/faq').then(response => {
                if (response.status == 200) {
                    this.faq = response.data.data;
                }
            }).catch(error => {
                this.faq = null;
            });
        },
        data() {
            return {
                faq: null,
                query: null,
            };
        },
        computed: {
            sortedFaqs () {
                return this.faq;
            }
        },
    }
</script>
