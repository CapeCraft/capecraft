<template>
    <div class="modal-content">
        <h5 class="modal-title text-center">Upload Proof</h5>
        <div class="form-group">
            <label for="proof-type">Proof Type</label>
            <select class="form-control" id="proof-type" v-model="proofType">
                <option value="" selected="selected" disabled="disabled">Select proof</option>
                <option value="internal">Internal</option>
                <option value="external">External</option>
            </select>
        </div>
        <div class="form-group" v-if="proofType != ''">
            <label for="proof-label" class="required">Label</label>
            <input type="text" class="form-control" id="proof-label" v-model="proofLabel">
        </div>
        <div v-if="proofType == 'internal'">
            <div class="form-group">
                <label for="internal-proof" class="required">Upload Proof</label>
                <div class="custom-file">
                    <input type="file" id="internal-proof">
                    <label for="internal-proof">Choose a file</label>
                </div>
            </div>
            <button class="btn btn-block btn-primary" @click="addInternal">Add Proof</button>
        </div>
        <div v-else-if="proofType == 'external'">
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
                proofType: "",
                proofLabel: "",
                externalUrl: ""
            }
        },
        methods: {
            addInternal() {
                axios.post('/api/admin/proof', {
                    type: 'internal',
                    id: this.data.id,
                    label: this.proofLabel,
                    url: this.externalUrl
                }).then(() => {
                    this.$store.dispatch('modal', 'close')
                })
            },
            addExternal() {
                axios.post('/api/admin/proof', {
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