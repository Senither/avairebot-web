<template>
    <section class="section content">
        <div class="container">

            <div class="columns">
                <div class="column has-text-centered">
                    <h2 class="title is-2 is-spaced">Discord bot features</h2>
                    <h5 class="subtitle is-5">Equip your Discord server with some of our Discord bot's most popular features.</h5>

                    <br>
                </div>
            </div>

            <div class="columns has-text-centered">
                <feature
                    to="#/docs"
                    icon="fa-music"
                    title="Stream Music"
                    body="Request music via youtube, soundcloud, twitch, radio links, or by name with ease."
                />
                <feature
                    to="#/docs"
                    icon="fa-list"
                    title="Music Playlists"
                    body="Create custom music playlists and share your playlists with other people with ease."
                />
                <feature
                    to="#/docs"
                    icon="fa-gavel"
                    title="Administration"
                    body="Administration made easy, take a load off your shoulders and let Ava do the hard work."
                />
                <feature
                    to="#/docs"
                    icon="fa-trophy"
                    title="Level & Leaderboards"
                    body="Earn XP and levels, and ranks through level ups, show off your rank via the website leaderboard on in-discord."
                />
            </div>

            <div class="columns has-text-centered">
                <div class="column">
                    <feature
                        to="#/docs"
                        icon="fa-hand-holding-heart"
                        title="Join & Leave Messages"
                        body="Broadcast messages when users joins or leaves your server on a per-channel basis."
                    />
                </div>
                <div class="column">
                    <feature
                        to="#/docs"
                        icon="fa-globe"
                        title="Bilingual Commands"
                        body="Ava supports multiple languages, you can change what languages Ava uses on the fly."
                    />
                </div>
                <div class="column">
                    <feature
                        to="#/docs"
                        icon="fa-pencil-alt"
                        title="Customizable Prefixes"
                        body="Don't like the default prefix? No worries, you can change it to anything you'd like."
                    />
                </div>
                <div class="column">
                    <feature
                        to="#/docs"
                        icon="fa-gamepad"
                        title="Lots of Fun Commands"
                        body="Ava has a lot of fun/game commands, and more are constantly being added"
                    />
                </div>
            </div>

            <div class="columns">
                <div class="column has-text-centered">
                    <br>

                    <h5 class="subtitle is-5">And much more!</h5>
                    <p>Learn more by checking out the <a href="#/docs">Command List</a> to see all the commands in Ava.</p>
                </div>
            </div>

        </div>
    </section>
</template>

<script>
    import Feature from '../components/Feature';

    export default {
        mounted() {
            console.log('Home mounted.');
        },
        components: {
            Feature
        }
    }
</script>
