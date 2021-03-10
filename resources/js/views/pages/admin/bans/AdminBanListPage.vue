<template>
    <section class="row justify-content-center">
        <div class="col-10 text-center">
            <div class="card">
                <h1 class="card-title">Bans</h1>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="ID, Username, UUID, Reason" v-model="search">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <div class="custom-checkbox">
                                <input type="checkbox" id="no-proof" v-model="noProof">
                                <label for="no-proof">Only show no proof</label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <transition name="fade" mode="out-in">
                    <div key=1 v-if="data != null">
                        <AdminBanList :bans="data.data" :hideDelete="true"/>
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
                                    <span v-if="data.current_page + index < data.last_page">
                                        <button @click="page = index + data.current_page" class="btn page-link">{{index + data.current_page}}</button>
                                    </span>
                                </li>
                                <li class="page-item" v-if="data.current_page < data.last_page">
                                    <button @click="page++" class="btn page-link"><font-awesome-icon icon="angle-right" class="h-30"/></button>
                                </li>
                            </ul>
                        </nav>
                        <small class="text-muted">Data can be cached for up to 5 minutes</small>
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
    import AdminBanList from '../../../partials/admin/AdminBanList'

    export default {
        data() {
            return {
                page: 1,
                data: null,
                search: null,
                noProof: false,
                stillTyping: null
            }
        },
        watch: {
            page: function() {
                if(this.data != null) {
                    this.$router.push(`/admin/bans/${this.page}`)
                    this.loadBans();
                    document.getElementsByClassName('content-wrapper')[0].scrollTo({ top: 0, behavior: 'smooth' });
                }
            },
            search: function() {
                clearInterval(this.stillTyping);
                this.stillTyping = setTimeout(() => {
                    this.doSearch();
                }, 500)
            },
            noProof: function() {
                this.doSearch()
            }
        },
        created() {
            this.loadBans();
        },
        methods: {
            loadBans() {
                this.data = null;
                if(!this.noProof && (this.search == null || this.search == "")) {
                    axios.get(`/api/admin/bans?page=${this.page}`).then((response) => {
                        this.data = response.data;
                    })
                } else {
                    axios.post(`/api/admin/bans/search?page=${this.page}`, {
                        search: this.search,
                        hasProof: !this.noProof
                    }).then((response) => {
                        this.data = response.data;
                    })
                }
            },
            doSearch() {
                //Clear data
                this.data = null;
                this.page = 1;

                if(!this.noProof && (this.search == null || this.search == "")) {
                    return this.loadBans();
                }

                //Move to fist page and find data
                this.$router.push(`/admin/bans/${this.page}`)
                axios.post(`/api/admin/bans/search?page=${this.page}`, {
                    search: this.search,
                    hasProof: !this.noProof
                }).then((response) => {
                    this.data = response.data;
                })
            }
        },
        components: {
            AdminBanList
        }
    }
</script>