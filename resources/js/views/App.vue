<template>
    <div>
        <section class="hero is-primary is-bold" v-bind:class="{ 'is-fullheight': isFullheight }">
            <div class="hero-head">
                <div class="container">
                    <nav class="navbar" role="navigation" aria-label="main navigation" data-aos="fade-down" data-aos-easing="ease-in-out-cubic" data-aos-duration="200" data-aos-delay="400">
                        <div class="navbar-brand">
                            <router-link :to="{ name: 'home' }" class="navbar-item">
                                AvaIre
                            </router-link>

                            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="mainNav">
                                <span aria-hidden="true"></span>
                                <span aria-hidden="true"></span>
                                <span aria-hidden="true"></span>
                            </a>
                        </div>

                        <div id="mainNav" class="navbar-menu">
                            <div class="navbar-start">
                                <router-link :to="{ name: 'home' }" active-class="is-active" class="navbar-item" exact>
                                    Home
                                </router-link>

                                <router-link :to="{ name: 'faq' }"  active-class="is-active" class="navbar-item" exact>
                                    FAQ
                                </router-link>

                                <router-link :to="{ name: 'support' }"  active-class="is-active" class="navbar-item" exact>
                                    Support
                                </router-link>

                                <router-link :to="{ name: 'invite' }"  active-class="is-active" class="navbar-item" exact>
                                    Invite
                                </router-link>
                            </div>

                            <div class="navbar-end">
                                <div class="navbar-item">
                                    <div class="buttons">
                                        <a class="button is-primary">
                                            <strong>Login with Discord</strong>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

            <router-view name="hero"></router-view>
        </section>

        <transition name="fade" mode="out-in">
            <router-view></router-view>
        </transition>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.setHeroHeight(this.$route.name);
        },
        data() {
            return {
                transitionDirection: 'slide-right',
                isFullheight: false,
            };
        },
        methods: {
            url(route) {
                return window.baseUrl + route;
            },
            setHeroHeight(routeName) {
                this.isFullheight = ['home'].indexOf(routeName) > -1;
            },
        },
        watch: {
            '$route' (to, from) {
                const toDepth = to.meta.index || 0;
                const fromDepth = from.meta.index || 0;

                this.setHeroHeight(to.name);

                this.transitionDirection = toDepth < fromDepth ? 'slide-right' : 'slide-left'
            }
        }
    }
</script>
