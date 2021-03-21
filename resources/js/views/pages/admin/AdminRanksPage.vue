<template>
    <section class="row justify-content-center">
        <div class="col-md-8 card">
            <h1 class="text-center">Admin Ranks</h1>
            <hr>
            <div class="alert alert-success" v-if="saved">Saved successfully</div>
            <div v-if="content != null">
                <AdminEditor ref="editor" :content="content"/>
                <button class="btn btn-block btn-primary mt-10" @click="saveContent">Save</button>
            </div>
        </div>
    </section>
</template>

<script>
    import AdminEditor from '../../partials/admin/AdminEditor'
    export default {
        data() {
            return {
                saved: false,
                content: null
            }
        },
        created() {
            this.getAllContent();
        },
        methods: {
            getAllContent() {
                axios.get('/api/admin/content/ranks').then((response) => {
                    this.content = decodeURIComponent(escape(atob(response.data.content.content)));
                })
            },
            saveContent() {
                let base64 = btoa(unescape(encodeURIComponent(this.$refs.editor.editor.getHTML())));
                axios.post('/api/admin/content/ranks/save', {
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