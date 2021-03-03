<template>
    <div>
        <div class="table-responsive" v-if="ban.proof">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Label</th>
                        <th class="text-right">
                            <button class="btn btn-sm btn-primary" @click="$store.dispatch('modal', { type: 'PROOF_MODAL', id: ban.id })">Upload Proof</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="proof in ban.proof" :key="proof.id">
                        <td>{{proof.id}}</td>
                        <td>{{proof.label}}</td>
                        <td><a :href="proof.proof" target="_blank">{{proof.proof}}</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            ban: Object
        }
    }
</script>