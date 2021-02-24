<template>
    <section class="row justify-content-center">
        <div class="d-flex align-items-center text-center">
            <div class="d-block">
                <img class="w-half" src="/images/logo/logo-grass.png"/>
                <h3>Come and join {{message}} on <kbd class="pl-3">Play.CapeCraft.Net</kbd></h3>
                <a class="btn btn-lg btn-discord" target="_blank" href="/discord"><font-awesome-icon :icon="['fab', 'discord']"/> Discord</a>
                <a class="btn btn-lg btn-secondary" target="_blank" href="/donate"><font-awesome-icon icon="money-bill-wave"/> Store</a>
            </div>
        </div>
    </section>
</template>

<style scoped>
    img {
        margin-bottom: -2.5rem;
    }
</style>

<script>
    export default {
        data() {
            return {
                message: "us",
                online: 0
            }
        },
        created() {
            axios.get('/api/server').then((response) => {
                this.online = response.data.players.online
                if(this.online > 10) {
                    this.message = this.online + " others"
                }
            })
        }
    }
</script>