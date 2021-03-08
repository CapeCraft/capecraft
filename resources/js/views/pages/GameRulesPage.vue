<template>
    <section class="row justify-content-center">
        <div class="col-8 card">
            <h1 class="text-center">Game Rule</h1>
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
            axios.get('/api/content/rules-game').then((response) => {
                this.content = decodeURIComponent(escape(atob(response.data.content.content)));
            })
        }
    }
</script>