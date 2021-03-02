<template>
    <div class="modal-content">
        <h5 class="modal-title text-center">Upload Proof</h5>
        <div class="form-group">
            <div class="custom-checkbox">
                <input type="checkbox" id="external-proof" v-model="externalProof">
                <label for="external-proof">External Proof</label>
            </div>
        </div>
        <div class="form-group">
            <label for="prooflabel" class="required">Label</label>
            <input type="text" class="form-control" id="prooflabel" v-model="proofLabel">
        </div>
        <div v-if="externalProof">
            <div class="form-group">
                <label for="externalurl" class="required">External Proof</label>
                <input type="text" class="form-control" id="externalurl" v-model="externalUrl">
            </div>
            <button class="btn btn-block btn-primary" @click="addExternal">Add Proof</button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                externalProof: false,
                proofLabel: "",
                externalUrl: ""
            }
        },
        methods: {
            addExternal() {
                axios.post('/api/admin/ban/proof', {
                    type: 'external',
                    id: this.data.id,
                    label: this.proofLabel,
                    url: this.externalUrl
                }).then(() => {
                    this.$store.dispatch('modal', 'close')
                })
            }
        },
        props: {
            data: Object
        }
    }
</script>