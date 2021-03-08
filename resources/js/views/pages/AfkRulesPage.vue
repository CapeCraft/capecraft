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
                content: "test"
            }
        }
    }
</script>