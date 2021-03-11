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
                    <div key=1 v-if="bans != null">
                        <AdminBanList :bans="bans.data" :hideDelete="true"/>
                        <hr>
                        <PaginationNav :data="bans" @page="page = $event"/>
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
    import PaginationNav from '../../../partials/PaginationNav'

    export default {
        data() {
            return {
                page: 1,
                bans: null,
                search: null,
                noProof: false,
                stillTyping: null
            }
        },
        watch: {
            page: function() {
                if(this.bans != null) {
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
            if(this.$route.params.page != null) {
                this.page = this.$route.params.page
            }

            this.loadBans();
        },
        methods: {
            loadBans() {
                this.bans = null;
                if(!this.noProof && (this.search == null || this.search == "")) {
                    axios.get(`/api/admin/bans?page=${this.page}`).then((response) => {
                        this.bans = response.data;
                    })
                } else {
                    this.sendSearch();
                }
            },
            doSearch() {
                //Clear data
                this.bans = null;
                this.page = 1;

                if(!this.noProof && (this.search == null || this.search == "")) {
                    return this.loadBans();
                }

                //Move to fist page and find data
                this.$router.push(`/admin/bans/${this.page}`) //TODO nav only if not there
                this.sendSearch();
            },
            sendSearch() {
                axios.post(`/api/admin/bans/search?page=${this.page}`, {
                    search: this.search,
                    hasProof: !this.noProof
                }).then((response) => {
                    this.bans = response.data;
                })
            }
        },
        components: {
            AdminBanList,
            PaginationNav
        }
    }
</script>