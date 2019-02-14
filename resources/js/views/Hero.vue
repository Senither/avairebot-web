<template>
    <div class="hero-body">
        <div class="container has-text-centered">
            <img src="https://avairebot.com/images/main-slider/content-image-3.png" class="avaire">
            <h1 class="avaire">AvaIre</h1>

            <h2 class="tagline">
                A high quality Music bot, with moderation, interaction, search,
                <br>administration commands, highly customizable and much more!
            </h2>

            <br><br>

            <p>
                <router-link :to="{ name: 'invite' }" class="button is-discord is-large" exact>
                    Invite AvaIre
                </router-link>
            </p>

            <br>

            <p>
                <router-link :to="{ name: 'support' }" exact>
                    Join our Support Server
                </router-link>
            </p>
        </div>
    </div>
</template>

<script>
    export default {}
</script>
