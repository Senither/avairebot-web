<template>
    <div class="hero-body">
        <div class="container has-text-centered">
            <img src="/img/avaire-512x512.png" class="avaire">
            <h1 class="avaire">AvaIre</h1>

            <h2 class="tagline">
                A high quality Music bot, with moderation, interaction, search,
                <br>administration commands, highly customizable and much more!
            </h2>

            <br><br>

            <p>
                <a :href="url('/invite')" class="button is-discord is-large">
                    Invite AvaIre
                </a>
            </p>

            <br>

            <p>
                <a :href="url('/support')">
                    Join our Support Server
                </a>
            </p>
        </div>
    </div>
</template>

<script>
    export default {}
</script>
