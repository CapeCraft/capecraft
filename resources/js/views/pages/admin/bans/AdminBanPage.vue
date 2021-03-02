<template>
    <section class="row justify-content-center">
        <div class="col-10 text-center">
            <div class="card">
                <h1 class="card-title">Ban <span v-if="ban != null">#{{ban.id}}</span></h1>
                <hr>
                <transition name="fade" mode="out-in">
                    <div key=1 v-if="ban != null">
                        <div class="row">
                            <div class="col-md">
                                <img :src="'https://crafatar.com/renders/body/' + ban.uuid">
                            </div>
                            <div class="col-md-8">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th>Username</th>
                                                <td><router-link :to="'/admin/player/' + ban.uuid">{{ban.name}}</router-link></td>
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
                                                <th>Proof</th>
                                                <td>
                                                    <ul>
                                                        <li v-for="item in ban.proof" :key="item.id">
                                                            <a :href="item.proof" target="_blank">{{item.label}}</a>
                                                        </li>
                                                        <button class="btn btn-sm btn-primary" @click="$store.dispatch('modal', { type: 'PROOF_MODAL', id: ban.id })">Upload Proof</button>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
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
    export default {
        data() {
            return {
                ban: null
            }
        },
        created() {
            axios.get(`/api/admin/ban/${this.$route.params.id}`).then((response) => {
                this.ban = response.data;
            })
        }
    }
</script>