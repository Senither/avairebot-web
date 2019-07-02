<template>
    <div>
        <section class="hero is-primary is-bold" v-bind:class="{ 'is-fullheight': isFullheight }">
            <div class="hero-head">
                <div class="container">
                    <nav class="navbar" role="navigation" aria-label="main navigation" data-aos="fade-down" data-aos-easing="ease-in-out-cubic" data-aos-duration="200" data-aos-delay="400">
                        <div class="navbar-brand">
                            <router-link :to="{ name: 'home' }" class="avaire">
                                AvaIre
                            </router-link>

                            <a
                                role="button"
                                class="navbar-burger burger"
                                aria-label="menu"
                                aria-expanded="false"
                                data-target="mainNav"
                                v-on:click="toggleMenu"
                                v-bind:class="{ 'is-active': isMenuSelected }"
                            >
                                <span aria-hidden="true"></span>
                                <span aria-hidden="true"></span>
                                <span aria-hidden="true"></span>
                            </a>
                        </div>

                        <div
                            id="mainNav"
                            class="navbar-menu"
                            aria-label="dropdown navigation"
                            v-bind:class="{ 'is-active': isMenuSelected }"
                        >
                            <div class="navbar-start">
                                <router-link :to="{ name: 'home' }" active-class="is-active" class="navbar-item" exact>
                                    Home
                                </router-link>

                                <router-link :to="{ name: 'commands' }"  active-class="is-active" class="navbar-item">
                                    Commands
                                </router-link>

                                <router-link :to="{ name: 'faq' }"  active-class="is-active" class="navbar-item" exact>
                                    FAQ
                                </router-link>

                                <a :href="url('/support')" class="navbar-item">
                                    Support
                                </a>

                                <a :href="url('/invite')" class="navbar-item">
                                    Invite
                                </a>

                                <div class="navbar-item has-dropdown is-hoverable">
                                    <a class="navbar-link">
                                        Ecosystem
                                    </a>

                                    <div class="navbar-dropdown">
                                        <a href="https://github.com/avaire" class="navbar-item">
                                            <i class="fab fa-github"></i> GitHub Organization
                                        </a>

                                        <hr class="navbar-divider">

                                        <a :href="url('/self-hosting')" class="navbar-item">
                                            Self-Hosting Guides
                                        </a>

                                        <a :href="url('/developer-handbook')" class="navbar-item">
                                            Plugin Developer Guide
                                        </a>

                                        <hr class="navbar-divider">

                                        <a href="https://status.avairebot.com/" class="navbar-item">
                                            Service Status
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="navbar-end">
                                <div class="navbar-item">
                                    <div class="buttons">
                                        <a class="button is-primary" disabled>
                                            <strong> <i class="discord"></i> Login with Discord</strong>
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

        <footer class="footer">
            <div class="content has-text-centered">
                <p>
                    Created by <a href="https://senither.com/">Alexis Tan</a>, powered by <a href="https://m.do.co/c/9f589c4101c3">DigitalOcean</a>, <a href="https://bulma.io/">Bulma</a>, <a href="https://vuejs.org/">VueJS</a>, and <a href="https://laravel.com/">Laravel</a>.
                    <br>"Discord", "Discord App", and any associated logos are registered trademarks of Hammer & Chisel, Inc.
                </p>
            </div>
        </footer>
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
                isMenuSelected: false,
            };
        },
        methods: {
            setHeroHeight(routeName) {
                this.isFullheight = ['home'].indexOf(routeName) > -1;
            },
            toggleMenu() {
                this.isMenuSelected = ! this.isMenuSelected;
            },
        },
        watch: {
            '$route' (to, from) {
                // Deselect the menu on page navigation.
                this.isMenuSelected = false;

                const toDepth = to.meta.index || 0;
                const fromDepth = from.meta.index || 0;

                this.setHeroHeight(to.name);

                this.transitionDirection = toDepth < fromDepth ? 'slide-right' : 'slide-left'
            }
        }
    }
</script>
