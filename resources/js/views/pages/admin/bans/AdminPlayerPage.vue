<template>
    <section class="row justify-content-center">
        <div class="col-10 text-center">
            <div class="card">
                <h1 class="card-title" v-if="player != null">{{player.profile.username}}</h1>
                <hr>
                <transition name="fade" mode="out-in">
                    <div key=1 v-if="player != null">
                        <div class="row">
                            <div class="col-md p-10">
                                <img class="img-fluid" :src="'https://crafatar.com/renders/body/' + player.profile.uuid">
                                <hr>
                                <strong>UUID: <kbd>{{player.profile.uuid}}</kbd></strong>
                                <hr>
                                <a v-if="player.profile.bedrock" class="btn btn-primary btn-block" :href="'https://account.xbox.com/profile?gamertag=' + player.profile.username" target="_blank">View Profile</a>
                                <a v-else class="btn btn-primary btn-block" :href="'https://namemc.com/profile/' + player.profile.uuid" target="_blank">View Profile</a>
                                <button class="btn btn-danger btn-block mt-10" @click="unbanUser">Unban User</button>
                            </div>
                            <div class="col-md-8">
                                <AdminBanList :bans="player.bans"/>
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
    import AdminBanList from '../../../partials/admin/AdminBanList'

    export default {
        data() {
            return {
                player: null
            }
        },
        created() {
            axios.get(`/api/admin/player/${this.$route.params.uuid}`).then((response) => {
                this.player = response.data;
            }).catch(() => {
                location.reload();
            })
        },
        methods: {
            unbanUser() {
                axios.post(`/api/admin/player/${this.$route.params.uuid}/unban`).then((response) => {
                    console.log(response);
                })
            }
        },
        components: {
            AdminBanList
        }
    }
</script>