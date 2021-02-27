<template>
    <section class="row justify-content-center">
        <div class="col-10 text-center">
            <div class="card">
                <h1 class="card-title">Bans</h1>
                <hr>
                <transition name="fade" mode="out-in">
                    <div key=1 v-if="data != null">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Reason</th>
                                        <th>Punishement</th>
                                        <th>Issued By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="ban in data.data" :key="ban.id">
                                        <th>{{ban.id}}</th>
                                        <td>{{ban.name}}</td>
                                        <td>{{ban.reason}}</td>
                                        <td>{{ban.punishmentType}}</td>
                                        <td>{{ban.operator}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <nav>
                            <ul class="pagination text-center">
                                <li class="page-item" v-if="data.current_page > 1">
                                    <button @click="page--" class="btn page-link"><font-awesome-icon icon="angle-left" class="h-30"/></button>
                                </li>
                                <li class="page-item" v-for="index in 5" :key="data.current_page - (6 - index)">
                                    <span v-if="data.current_page - (6 - index) > 0">
                                        <button @click="page = data.current_page - (6 - index)" class="btn page-link">{{data.current_page - (6 - index)}}</button>
                                    </span>
                                </li>
                                <li class="page-item active">
                                    <button @click="page = data.current_page" class="btn page-link">{{data.current_page}}</button>
                                </li>
                                <li class="page-item" v-for="index in 5" :key="index + data.current_page">
                                    <button @click="page = index + data.current_page" class="btn page-link">{{index + data.current_page}}</button>
                                </li>
                                <li class="page-item" v-if="data.current_page <= data.last_page">
                                    <button @click="page++" class="btn page-link"><font-awesome-icon icon="angle-right" class="h-30"/></button>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div key=2 v-else>
                        <h3><font-awesome-icon icon="cog" spin/> Loading...</h3>
                    </div>
                </transition>
            </div>
        </div>
    </section>
</template>

<style scoped>
    .h-30 {
        height: 3.4rem;
    }
</style>

<script>
    export default {
        data() {
            return {
                page: 1,
                data: null
            }
        },
        watch: {
            page: function() {
                this.$router.push(`/admin/bans/${this.page}`)
                this.loadBans();
                document.getElementsByClassName('content-wrapper')[0].scrollTo({ top: 0, behavior: 'smooth' });
            }
        },
        created() {
            this.loadBans();
        },
        methods: {
            loadBans() {
                this.data = null;
                axios.get(`/api/admin/bans?page=${this.page}`).then((response) => {
                    this.data = response.data;
                })
            }
        }
    }
</script>