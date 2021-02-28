<template>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Reason</th>
                    <th>Punishement</th>
                    <th>Issued By</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="ban in bans" :key="ban.id">
                    <th><router-link :to="'/admin/ban/' + ban.id">{{ban.id}}</router-link></th>
                    <td><router-link :to="'/admin/player/' + ban.uuid">{{ban.name}}</router-link></td>
                    <td>{{ban.reason}}</td>
                    <td>{{ban.punishmentType}}</td>
                    <td>{{ban.operator}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: {
            bans: Array
        }
    }
</script>