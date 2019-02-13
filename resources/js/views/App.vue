<template>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link tag="li" :to="{ name: 'home' }" exact active-class="active" class="nav-item">
                            <a class="nav-link">Home</a>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link tag="li" :to="{ name: 'faq' }" exact active-class="active" class="nav-item">
                            <a class="nav-link">FAQ</a>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link tag="li" :to="{ name: 'support' }" exact active-class="active" class="nav-item">
                            <a class="nav-link">Support</a>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link tag="li" :to="{ name: 'invite' }" exact active-class="active" class="nav-item">
                            <a class="nav-link">Invite</a>
                        </router-link>
                    </li>
                </ul>
            </div>
        </nav>

        <transition :name="transitionDirection">
            <router-view></router-view>
        </transition>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                transitionDirection: 'slide-right',
            };
        },
        methods: {
            url: (route) => {
                return window.baseUrl + route;
            }
        },
        watch: {
            '$route' (to, from) {
                const toDepth = to.meta.index || 0;
                const fromDepth = from.meta.index || 0;

                this.transitionDirection = toDepth < fromDepth ? 'slide-right' : 'slide-left'
            }
        }
    }
</script>
