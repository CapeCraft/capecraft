<template>
    <section class="row justify-content-center">
        <div class="col-md-8 card">
            <h1 class="text-center">Admin Rules</h1>
            <hr>
            <div class="alert alert-success" v-if="saved">Saved successfully</div>
            <div>
                <label for="content-selector" class="required">Select a content to edit</label>
                <select v-model="selectedSlug" class="form-control" id="content-selector">
                    <option v-for="content in contents" :key="content.slug" :value="content.slug">{{content.name}}</option>
                </select>
                <hr>
                <div v-if="selectedContent != null">
                    <AdminEditor ref="editor" :content="selectedContent.content"/>
                    <button class="btn btn-block btn-primary mt-10" @click="saveContent">Save</button>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import AdminEditor from '@/views/partials/admin/AdminEditor'
    export default {
        data() {
            return {
                saved: false,
                selectedSlug: null,
                selectedContent: null,
                contents: null
            }
        },
        created() {
            this.getAllContent();
        },
        watch: {
            selectedSlug: function() {
                this.selectedContent = null;
                axios.get(`/api/admin/content/${this.selectedSlug}`).then((response) => {
                    let content = response.data.content;
                    content.content = decodeURIComponent(escape(atob(content.content)));
                    this.selectedContent = content;
                })
            }
        },
        methods: {
            getAllContent() {
                axios.get('/api/admin/content').then((response) => {
                    this.contents = response.data.content;
                })
            },
            saveContent() {
                let base64 = btoa(unescape(encodeURIComponent(this.$refs.editor.editor.getHTML())));
                axios.post(`/api/admin/content/${this.selectedSlug}/save`, {
                    content: base64
                });

                this.saved = true;
                document.getElementsByClassName('content-wrapper')[0].scrollTo({ top: 0, behavior: 'smooth' });
                setTimeout(() => {
                    this.saved = false;
                }, 5000)
            }
        },
        components: {
            AdminEditor
        }
    }
</script>