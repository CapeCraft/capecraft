<template>
    <section class="row justify-content-center">
        <div class="col-8 card">
            <h1 class="text-center mb-0">Announcements</h1>
            <p class="text-center my-0">This page will contain past and present announcements.</p>
            <hr>
            <transition name="fade" mode="out-in">
                <div key=1 v-if="announcements != null">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Body</th>
                                <th>Posted</th>
                                <th><button class="btn btn-sm btn-primary">New Announcement</button></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="announcement in announcements.data" :key="announcement.id" :class="classSeverity(announcement.severity)">
                                <th>{{announcement.id}}</th>
                                <td>{{announcement.title}}</td>
                                <td>{{announcement.content}}</td>
                                <td>{{announcement.created_at | formatDate}}</td>
                                <td>
                                    <button class="btn btn-sm btn-secondary"><font-awesome-icon icon="pencil-alt"/> Edit</button>
                                    <button class="btn btn-sm btn-danger"><font-awesome-icon icon="trash"/> Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
    import PaginationNav from '../../partials/PaginationNav'

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
                    this.$router.push(`/admin/announcements/${this.page}`)
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
                    return "table-danger";
                }

                if(severity == 2) {
                    return "table-secondary"
                }

                return "table-primary"
            }
        },
        filters: {
            truncate: function(content) {
                return content.length > 300 ? content.slice(0, 300) : content;
            }
        },
        components: {
            PaginationNav
        }
    }
</script>