<template>
    <section class="row justify-content-center">
        <div class="col-md-8 card">
            <h1 class="text-center mb-0">New Announcement</h1>
            <hr>
            <FormErrors :errors="errors"/>
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
            <button class="btn btn-block btn-primary mt-10" @click="newAnnouncement">Save</button>
        </div>
    </section>
</template>

<script>
    import FormErrors from '../../../partials/FormErrors'
    import AdminEditor from '../../../partials/admin/AdminEditor'

    export default {
        data() {
            return {
                errors: null,
                title: null,
                severity: null
            }
        },
        methods: {
            newAnnouncement() {
                let base64 = btoa(unescape(encodeURIComponent(this.$refs.editor.editor.getHTML())));
                axios.post(`/api/admin/announcements/new`, {
                    title: this.title,
                    severity: this.severity,
                    content: base64
                }).then(() => {
                    this.$router.push('/admin/announcements')
                }).catch((response) => {
                    this.errors = response.response.data.errors;
                });
            }
        },
        components: {
            FormErrors,
            AdminEditor
        }
    }
</script>