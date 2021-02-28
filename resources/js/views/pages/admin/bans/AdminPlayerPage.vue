<template>
    <section class="row justify-content-center">
        <div class="col-10 text-center">
            <div class="card">
                <h1 class="card-title" v-if="player != null">{{player.profile.username}}</h1>
                <hr>
                <transition name="fade" mode="out-in">
                    <div key=1 v-if="player != null">
                        <div class="row">
                            <div class="col-md">
                                <img :src="'https://crafatar.com/renders/body/' + player.profile.uuid">
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
            })
        },
        components: {
            AdminBanList
        }
    }
</script>