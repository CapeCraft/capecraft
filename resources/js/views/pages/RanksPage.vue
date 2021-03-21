<template>
    <section class="row justify-content-center">
        <div class="col-md-8 card">
            <h1 class="text-center">Ranks</h1>
            <hr>
            <div v-html="content"></div>
        </div>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                content: null
            }
        },
        created() {
            axios.get('/api/content/ranks').then((response) => {
                this.content = decodeURIComponent(escape(atob(response.data.content.content)));
            })
        }
    }
</script>