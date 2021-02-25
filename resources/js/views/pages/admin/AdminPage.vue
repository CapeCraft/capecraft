<template>
    <section class="row justify-content-center">
        <div class="col-10 text-center">
            <div class="card">
                <h1>CapeCraft Admin Panel</h1>
                <hr>
                <div class="row" v-if="pingData != null">
                    <div class="col">
                        <h1 class="mt-20">
                            <font-awesome-icon class="text-success" icon="smile" v-if="pingData.ping !== false"/>
                            <font-awesome-icon class="text-danger" icon="frown" v-else />
                        </h1>
                        <p>CapeCraft Status</p>
                    </div>
                    <div class="col">
                        <h2>{{pingData.server.players.online}}/{{pingData.server.players.max}}</h2>
                        <p>Players Online</p>
                    </div>
                    <div class="col">
                        <h2 v-if="pingData !== false">{{pingData.ping}}ms</h2>
                        <h2 v-else>Error</h2>
                        <p>Ping</p>
                    </div>
                </div>
                <h3 v-else>Loading...</h3>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        data() {
            return {
               pingData: null
            }
        },
        created() {
            axios.get('/api/admin/init').then((response) => {
                this.pingData = response.data;
            })
        }
    }
</script>