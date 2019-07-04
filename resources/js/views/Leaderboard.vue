<template>
    <section class="section content">
        <div class="container has-text-centered" v-if="isLoading">
            <h1 class="title is-3">Loading...</h1>

            <p class="button is-loading transparent"></p>
        </div>

        <div class="container has-text-centered" v-else-if="isError">
            <h4 class="title is-4">Found no matching server with an ID of {{ this.$route.params.id }}</h4>
        </div>

        <div class="container has-text-centered" v-else-if="!enabled">
            <h1 class="title is-1">{{ name }}</h1>
            <h4 class="title is-4">This server does not have the leveling feature enabled :(</h4>
        </div>

        <div class="container has-text-centered" v-else>
            <div class="columns">
                <div class="column">
                    <h1>{{ name }}</h1>
                </div>
            </div>
            <div class="columns">
                <div class="column is-one-quarter is-desktop">

                    <div class="tile is-parent">
                        <article class="tile is-child notification is-dark">
                            <div class="content">
                                <p class="subtitle">How it Works</p>
                                <div class="content">

                                    <p>Each time you post a message you get a random number of XP between 10 and 15.</p>
                                    <p>To avoid absue, you can only gain XP once per minute.</p>
                                    <p>In the server, you can type <code>!rank</code> to get your rank and your level.</p>

                                </div>
                            </div>
                        </article>
                    </div>

                    <div class="tile is-parent" v-if="roles.length > 0">
                        <article class="tile is-child notification is-dark">
                            <div class="content">
                                <p class="subtitle">Level Rewards</p>
                                <div class="content">
                                    <table class="table is-fullwidth is-hoverable is-role-reward">
                                        <tr class="level-reward" v-for="role of roles">
                                            <th class="role-level">Level {{ role.level }}</th>
                                            <th>
                                                <span class="tag is-role">{{ role.roleName }}</span>
                                            </th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </article>
                    </div>

                </div>

                <div class="column">
                    <table class="table is-fullwidth is-hoverable is-leaderboard">
                        <tbody>
                            <player-experience-table-row
                                v-for="user of leaderboardUsers"
                                :key="user.id"
                                :serverModifier="modifier"
                                :user="user"
                            />
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
  </section>
</template>

<script>
    import PlayerExperienceTableRow from '../components/PlayerExperienceTableRow';

    export default {
        mounted() {
            const { id } = this.$route.params;

            axios(`https://api.avairebot.com/v1/leaderboard/${id}`).then(response => {
                if (response.status == 200) {
                    this.name = response.data.name;
                    this.enabled = response.data.enabled;
                    this.modifier = response.data.modifier;
                    this.leaderboard = response.data.leaderboard;
                    this.roles = response.data.roles.reverse();
                }

                this.isLoading = false;
            }).catch(error => this.$router.push({ name: 'home' }));
        },
        data() {
            return {
                name: null,
                enabled: false,
                modifier: -1,
                leaderboard: [],
                roles: [],
                isLoading: true,
                isError: false,
            };
        },
        computed: {
            leaderboardUsers() {
                let index = 1;
                let leaderboardUsers = [];
                for (let user of this.leaderboard) {
                    user.rank = index++;
                    leaderboardUsers.push(user);
                }
                return leaderboardUsers;
            }
        },
        components: {
            PlayerExperienceTableRow
        }
    }
</script>

