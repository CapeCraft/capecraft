<template>
    <section class="row justify-content-center">
        <div class="col-md-10 text-center">
            <div class="card">
                <h1 class="card-title" v-if="player != null">{{player.profile.username}}</h1>
                <hr>
                <transition name="fade" mode="out-in">
                    <div v-if="player != null">
                        <div class="row">
                            <div class="col-md-4 p-10">
                                <img class="img-fluid" :src="`https://crafatar.com/renders/body/${player.profile.uuid}?overlay=true`">
                                <hr>
                                    <strong class="text-success" v-if="player.active == null">Player is not banned</strong>
                                    <strong class="text-danger" v-else-if="player.active.end == -1">Player is banned permanently</strong>
                                    <strong class="text-danger" v-else>Player is banned until {{player.active.end | formatDate}}</strong>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>UUID</th>
                                            <td><kbd>{{player.profile.uuid}}</kbd></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="alert text-left" v-if="player.profile.name_history.length > 1">
                                    <strong>Name History</strong>
                                    <table class="table">
                                        <tbody>
                                            <tr v-for="(name_history, index) in player.profile.name_history" :key="index">
                                                <th>{{player.profile.name_history.length - index}}</th>
                                                <td>{{name_history.name}}</td>
                                                <td v-if="name_history.changedToAt != null">{{name_history.changedToAt | formatDate}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <a class="btn btn-primary btn-block" :href="profile" target="_blank">
                                    <font-awesome-icon icon="id-badge"/> View Profile
                                </a>
                                <button class="btn btn-danger btn-block mt-10" @click="unbanUser">
                                    <span v-if="!unbanned"><font-awesome-icon icon="eraser"/> Unban User</span>
                                    <CheckAnimation v-else/>
                                </button>
                            </div>
                            <div class="col-md-8">
                                <AdminBanList :bans="player.bans" @remove="removeBan"/>
                            </div>
                        </div>
                    </div>
                    <div key=2 v-else>
                        <h3><font-awesome-icon icon="cog" spin/> Loading...</h3>
                    </div>
                </transition>
            </div>
        </div>
    </section>
</template>

<script>
    import AdminBanList from '../../partials/admin/AdminBanList'
    import CheckAnimation from '../../partials/CheckAnimation'

    export default {
        data() {
            return {
                player: null,
                unbanned: false
            }
        },
        created() {
            axios.get(`/api/admin/player/${this.$route.params.uuid}`).then((response) => {
                this.player = response.data;
            }).catch(() => {
                alert("error");
            })
        },
        methods: {
            unbanUser() {
                if(this.unbanned) return
                axios.post(`/api/admin/player/${this.$route.params.uuid}/unban`).then((response) => {
                    if(response.data.success) {
                        this.unbanned = true;
                        setTimeout(() => {
                            this.unbanned = false;
                        }, 5000)
                    }
                })
            },
            removeBan(id) {
                this.player.bans = this.player.bans.filter(item => item.id != id);
            }
        },
        computed: {
            profile: function() {
                if(this.player.profile.bedrock) {
                    return `https://account.xbox.com/profile?gamertag=${this.player.profile.username}`
                 } else {
                     return `https://namemc.com/profile/${this.player.profile.uuid}`
                 }
            }
        },
        components: {
            AdminBanList,
            CheckAnimation
        }
    }
</script>