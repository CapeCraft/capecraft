<template>
    <section class="row justify-content-center">
        <div class="col-8 card">
            <h1 class="text-center">Announcements</h1>
            <hr>
            <transition name="fade" mode="out-in">
                <div key=1 v-if="announcements != null">
                    <div v-for="announcement in announcements.data" :key="announcement.id" class="alert mb-10" :class="classSeverity(announcement.severity)">
                        <h4 class="alert-header">{{announcement.title}}</h4>
                        <div v-html="announcement.content"></div>
                        <p class="text-right">{{announcement.created_at | formatDate}}</p>
                    </div>
                    <hr>
                    <PaginationNav :data="announcements" @page="page = $event"/>
                </div>
                <div key=2 v-else>
                    <h3><font-awesome-icon icon="cog" spin/> Loading...</h3>
                </div>
            </transition>
        </div>
    </section>
</template>

<script>
    import PaginationNav from '../partials/PaginationNav'

    export default {
        data() {
            return {
                page: 1,
                announcements: null
            }
        },
        created() {
            axios.get('/api/announcements').then((response) => {
                this.announcements = response.data
            })
        },
        methods: {
            classSeverity: function(severity) {
                if(severity == 1) {
                    return "alert-danger";
                }

                if(severity == 2) {
                    return "alert-secondary"
                }
            }
        },
        components: {
            PaginationNav
        }
    }
</script>