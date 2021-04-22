<template>
    <section class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <h1 class="card-title text-center">{{user.username}}</h1>
                <div class="row justify-content-center">
                    <div class="col-6">
                        <AdminManagement :user="user"/>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>



<script>
    import AdminManagement from '@/views/partials/admin/AdminManagement'
    import { mapState } from 'vuex'
    export default {
        components: {
            AdminManagement
        },
        computed: mapState(['user'])
    }
</script>