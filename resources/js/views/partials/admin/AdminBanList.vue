<template>
    <div v-if="bans.length > 0" class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Reason</th>
                    <th>Punishment</th>
                    <th>Issued By</th>
                    <th v-if="hideDelete !== true"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="ban in bans" :key="ban.id">
                    <th><router-link :to="`/admin/ban/${ban.id}`">{{ban.id}}</router-link></th>
                    <td><router-link :to="`/admin/player/${ban.uuid}`">{{ban.name}}</router-link></td>
                    <td>{{ban.reason}}</td>
                    <td>{{ban.punishmentType}}</td>
                    <td>{{ban.operator}}</td>
                    <td v-if="hideDelete !== true"><button class="btn btn-sm btn-danger" @click="removeBan(ban.id)"><font-awesome-icon icon="trash"/></button></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-else>
        <h3>No bans found</h3>
    </div>
</template>

<script>
    export default {
        methods: {
            removeBan(id) {
                axios.post(`/api/admin/ban/${id}/delete`).then((response) => {
                    this.$emit('remove', id)
                })
            }
        },
        props: {
            bans: Array,
            hideDelete: Boolean
        }
    }
</script>