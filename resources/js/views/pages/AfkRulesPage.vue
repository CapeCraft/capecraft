<template>
    <section class="row justify-content-center">
        <div class="col-8 card">
            <h1 class="text-center">AFK Rules</h1>
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
            axios.get('/api/content/rules-afk').then((response) => {
                this.content = decodeURIComponent(escape(atob(response.data.content.content)));
            })
        }
    }
</script>