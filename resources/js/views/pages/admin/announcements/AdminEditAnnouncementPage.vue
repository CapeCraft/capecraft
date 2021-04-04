<template>
    <section class="row justify-content-center">
        <div class="col-md-8 card">
            <h1 class="text-center mb-0">Delete Announcement</h1>
            <hr>
            <FormErrors :errors="errors"/>
            <transition name="fade" mode="out-in">
                <div key=1 v-if="announcement != null">
                    <div class="form-group">
                        <label class="required">Title</label>
                        <input class="form-control" v-model="title">
                    </div>
                    <div class="from-group">
                        <label class="required">Severity</label>
                        <select class="form-control" v-model="severity">
                            <option value="" selected="selected" disabled="disabled">Select a severity</option>
                            <option value="1">Alert</option>
                            <option value="2">Warning</option>
                            <option value="3">Information</option>
                        </select>
                    </div>
                    <div class="from-group mt-20">
                        <label class="required">Content</label>
                        <AdminEditor ref="editor"/>
                    </div>
                    <button class="btn btn-block btn-primary mt-10" @click="editAnnouncement">Save</button>
                </div>
                <div key=2 v-else>
                    <h3><font-awesome-icon icon="cog" spin/> Loading...</h3>
                </div>
            </transition>
        </div>
    </section>
</template>

<script>
    import FormErrors from '@/views/partials/FormErrors'
    import AdminEditor from '@/views/partials/admin/AdminEditor'

    export default {
        data() {
            return {
                errors: null,
                announcement: null
            }
        },
        created() {
            axios.get(`/api/admin/announcements/${this.$route.params.id}`).then((response) => {
                this.announcement = response.data
                this.title = this.announcement.title;
                this.severity = this.announcement.severity;
                this.content = decodeURIComponent(escape(atob(this.announcement.content)));
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
            editAnnouncement() {
                let base64 = btoa(unescape(encodeURIComponent(this.$refs.editor.editor.getHTML())));
                axios.post(`/api/admin/announcements/${this.$route.params.id}/edit`, {
                    title: this.title,
                    severity: this.severity,
                    content: base64
                }).then(() => {
                    this.$router.push('/admin/announcements/')
                }).catch((response) => {
                    this.errors = response.response.data.errors;
                });
            }
        },
        filters: {
            decode: function(content) {
                return decodeURIComponent(escape(atob(content)));
            }
        },
        components: {
            FormErrors,
            AdminEditor
        }
    }
</script>