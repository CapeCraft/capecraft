<template>
    <section class="row justify-content-center">
        <div class="col-md-8 card">
            <h1 class="text-center mb-0">Delete Announcement</h1>
            <hr>
            <transition name="fade" mode="out-in">
                <div key=1 v-if="announcement != null">
                    <div class="alert alert-danger text-center">
                        <p><strong>Are you sure you want to delete the announcement? It can't be undone.</strong></p>
                        <button @click="deleteAnnouncement" class="btn btn-danger btn-sm">Delete</button>
                    </div>
                    <hr>
                    <div class="alert mb-10" :class="classSeverity(announcement.severity)">
                        <h4 class="alert-header">{{announcement.title}}</h4>
                        <div :inner-html.prop="announcement.content | decode"></div>
                        <p class="text-right">{{announcement.created_at | formatDate}}</p>
                    </div>
                </div>
                <div key=2 v-else>
                    <h3><font-awesome-icon icon="cog" spin/> Loading...</h3>
                </div>
            </transition>
        </div>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                announcement: null
            }
        },
        created() {
            axios.get(`/api/admin/announcements/${this.$route.params.id}`).then((response) => {
                this.announcement = response.data
            })
        },
        methods: {
            classSeverity: function(severity) {
                if(severity == 1) {
                    return "alert-danger";
                }

                if(severity == 2) {
                    return "alert-secondary"
                }

                return "alert-primary"
            },
            deleteAnnouncement() {
                axios.post(`/api/admin/announcements/${this.$route.params.id}/delete`);
                this.$router.push('/admin/announcements/')
            }
        },
        filters: {
            decode: function(content) {
                return decodeURIComponent(escape(atob(content)));
            }
        },
    }
</script>