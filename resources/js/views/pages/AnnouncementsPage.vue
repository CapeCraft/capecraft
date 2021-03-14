<template>
    <section class="row justify-content-center">
        <div class="col-md-8 card">
            <h1 class="text-center mb-0">Announcements</h1>
            <p class="text-center my-0">This page will contain past and present announcements.</p>
            <hr>
            <transition name="fade" mode="out-in">
                <div key=1 v-if="announcements != null">
                    <div v-for="announcement in announcements.data" :key="announcement.id" class="alert mb-10" :class="classSeverity(announcement.severity)">
                        <h4 class="alert-header">{{announcement.title}}</h4>
                        <div :inner-html.prop="announcement.content | decode"></div>
                        <p class="text-right">{{announcement.created_at | formatDate}}</p>
                    </div>
                    <hr>
                    <PaginationNav :data="announcements" @page="page = $event"/>
                </div>
                <div key=2 v-else>
                    <h3><font-awesome-icon icon="cog" spin/> Loading...</h3>
                </div>
            </transition>
        </div>
    </section>
</template>

<script>
    import PaginationNav from '../partials/PaginationNav'

    export default {
        data() {
            return {
                page: 1,
                announcements: null
            }
        },
        watch: {
            page: function() {
                if(this.announcements != null) {
                    this.$router.push(`/announcements/${this.page}`)
                    this.loadAnnouncements();
                    document.getElementsByClassName('content-wrapper')[0].scrollTo({ top: 0, behavior: 'smooth' });
                }
            },
        },
        created() {
            if(this.$route.params.page != null) {
                this.page = this.$route.params.page
            }

            this.loadAnnouncements();
        },
        methods: {
            loadAnnouncements() {
                this.announcements = null;
                axios.get(`/api/announcements?page=${this.page}`).then((response) => {
                    this.announcements = response.data
                })
            },
            classSeverity: function(severity) {
                if(severity == 1) {
                    return "alert-danger";
                }

                if(severity == 2) {
                    return "alert-secondary"
                }

                return "alert-primary"
            }
        },
        filters: {
            decode: function(content) {
                return decodeURIComponent(escape(atob(content)));
            }
        },
        components: {
            PaginationNav
        }
    }
</script>