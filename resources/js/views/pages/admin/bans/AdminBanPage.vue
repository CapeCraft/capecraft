<template>
    <section class="row justify-content-center">
        <div class="col-10 text-center">
            <div class="card">
                <h1 class="card-title">Ban <span v-if="ban != null">#{{ban.id}}</span></h1>
                <hr>
                <transition name="fade" mode="out-in">
                    <div key=1 v-if="ban != null">
                        <div class="row">
                            <div class="col-md-4">
                                <img :src="`https://crafatar.com/renders/body/${ban.uuid}?overlay=true`">
                                <hr>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Username</th>
                                            <td><router-link :to="`/admin/player/${ban.uuid}`">{{ban.name}}</router-link></td>
                                        </tr>
                                        <tr>
                                            <th>Reason</th>
                                            <td>{{ban.reason}}</td>
                                        </tr>
                                        <tr>
                                            <th>Punishment Type</th>
                                            <td>{{ban.punishmentType}}</td>
                                        </tr>
                                        <tr>
                                            <th>Issued By</th>
                                            <td>{{ban.operator}}</td>
                                        </tr>
                                        <tr>
                                            <th>Date Issued</th>
                                            <td :alt="ban.start">{{ban.start | formatDate}}</td>
                                        </tr>
                                        <tr v-if="ban.end > 0">
                                            <th>Date Expires</th>
                                            <td>{{ban.end | formatDate}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-8">
                                <strong>Proof</strong>
                                <AdminBanProof :ban="ban" @updateBan="updateBan"/>
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
    import AdminBanProof from '../../../partials/admin/AdminBanProof'
    export default {
        data() {
            return {
                ban: null
            }
        },
        created() {
            this.getBan();
        },
        methods: {
            updateBan() {
                this.getBan();
            },
            getBan() {
                axios.get(`/api/admin/ban/${this.$route.params.id}`).then((response) => {
                    this.ban = response.data;
                })
            }
        },
        components: {
            AdminBanProof
        }
    }
</script>