<template>
    <transition name="fade" mode="out-in">
        <table key=1 class="table" v-if="ban.proof && state == states.WAITING">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Label</th>
                    <th>Link</th>
                    <th class="text-right">
                        <button class="btn btn-sm btn-primary" @click="addBan">Upload Proof</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="proof in ban.proof" :key="proof.id">
                    <td>{{proof.id}}</td>
                    <td>{{proof.label}}</td>
                    <td style="word-break: break-all"><a :href="proof.proof" target="_blank">{{proof.proof}}</a></td>
                    <td class="text-right"><button class="btn btn-sm btn-danger" @click="removeProof(proof.id)"><font-awesome-icon icon="trash"/></button></td>
                </tr>
            </tbody>
        </table>
        <div key=2 v-else-if="state == states.UPLOAD">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="proof-type">Proof Type</label>
                        <select class="form-control" id="proof-type" v-model="proofType">
                            <option value="" selected="selected" disabled="disabled">Select proof</option>
                            <option value="internal" disabled>Internal (Coming Soon)</option>
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
            </div>
        </div>
        <div key=3 v-else-if="state == states.LOADING">
            <h3><font-awesome-icon icon="cog" spin/> Loading...</h3>
        </div>
    </transition>
</template>

<script>
    export default {
        data() {
            return {
                states: { WAITING: 'waiting', UPLOAD: 'upload', LOADING: 'loading' },
                state: 'waiting',
                proofType: "",
                proofLabel: "",
                externalUrl: ""
            }
        },
        methods: {
            addBan: function() {
                this.state = this.states.UPLOAD
            },
            addInternal() {
                this.state = this.states.LOADING
                axios.post('/api/admin/proof', {
                    type: 'internal',
                    id: this.ban.id,
                    label: this.proofLabel,
                    url: this.externalUrl
                }).then(() => {
                    this.$emit('updateBan')
                    this.state = this.states.WAITING
                })
            },
            addExternal() {
                this.state = this.states.LOADING
                axios.post('/api/admin/proof', {
                    type: 'external',
                    id: this.ban.id,
                    label: this.proofLabel,
                    url: this.externalUrl
                }).then(() => {
                    this.$emit('updateBan')
                    this.state = this.states.WAITING
                })
            },
            removeProof(id) {
                this.state = this.states.LOADING
                axios.post(`/api/admin/proof/${id}/delete`).then(() => {
                    this.$emit('updateBan')
                    this.state = this.states.WAITING
                })
            }
        },
        props: {
            ban: Object
        }
    }
</script>