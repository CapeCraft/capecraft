<template>
    <section>
        <div class="row justify-content-center" v-for="(rank, index) in staff" :key="index">
            <div class="col-md-4" v-for="member in rank" :key="member.uuid">
                <div class="card">
                    <div class="row">
                        <div class="col-4 pr-10">
                            <img class="img-fluid" :src="`https://minecraftapi.net/api/v1/profile/${member.uuid}/avatar?size=256&overlay=true`">
                        </div>
                        <div class="col-8 pl-5">
                            <h3 class="m-0">{{member.username}}</h3>
                            <strong>{{index}}</strong>
                        </div>
                        <p>{{member.bio}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                staff: {}
            }
        },
        created() {
            axios.get('/api/staff').then((response) => {
                this.staff = response.data;
            })
        }
    }
</script>