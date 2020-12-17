<template>
    <div id="skin_container">
        <button id="toggleElytra" v-if="this.showElytra" class="btn btn-link" v-on:click="toggleElytra"><font-awesome-icon :icon="buttonClass"/> Elytra</button>
        <canvas :id="currentUuid"></canvas>
    </div>
</template>

<style lang="scss">
    #skin_container {
        text-align: center;
        cursor: move;

        canvas {
            filter: drop-shadow(-5px 5px 7px rgba(0, 0, 0, 0.4));
            outline: none;
            position: relative;
            width: 100%;
        }

        #toggleElytra {
            position: absolute;
            right: 1.5rem;
            z-index: 10;
        }
    }
</style>

<script>
    import { mapState } from 'vuex'

    export default {
        data() {
            return {
                skinViewer: null,
                currentUuid: null,
                currentCape: null,
                currentEars: null,
                buttonClass: 'toggle-off',
                showElytra: true,
            }
        },
        props: {
            uuid: String,
            cape: String,
            ears: String,
            hideelytra: Boolean
        },
        watch: {
      	    uuid: {
                handler: function(newValue, oldValue) {
                    this.currentUuid = newValue;
                },
                immediate: true
            },
            cape: {
                handler: function(newValue, oldValue) {
                    this.currentCape = newValue;
                    if(this.skinViewer != null) {
                        this.skinViewer.loadCape(newValue)
                        this.buttonClass = 'toggle-off'
                    }
                },
                immediate: true
            },
            ears: {
                handler: function(newValue, oldValue) {
                    this.currentEars = newValue;
                    if(this.skinViewer != null) {
                        this.skinViewer.loadEars(newValue)
                    }
                },
                immediate: true
            }
        },
        created() {
            if(this.user != null) {
                this.currentUuid = this.user.uuid;
                this.currentCape = this.user.profile.textures.cape;
                this.currentEars = this.user.profile.textures.ears;

                if(this.currentCape != null) {
                    this.currentCape = `data:image/png;base64,${this.currentCape}`
                }

                if(this.currentEars != null) {
                    this.currentEars = `data:image/png;base64,${this.currentEars}`
                }
            } else {
                this.currentUuid = 'c06f89064c8a49119c29ea1dbd1aab82';
            }
        },
        mounted() {
            this.createObject();
        },
        methods: {
            createObject() {
                let unixTime = Date.now();
                this.skinViewer = new skinview3d.SkinViewer({
                    canvas: document.getElementById(this.currentUuid),
                    width: 300,
                    height: 400,
                    skin: `https://crafatar.com/skins/${this.currentUuid}?default=https://minotar.net/skin/${this.currentUuid}`,
                    cape: this.currentCape,
                    ears: this.currentEars
                });

                // Control objects with your mouse!
                let control = skinview3d.createOrbitControls(this.skinViewer);
                control.enableRotate = true;
                control.enableZoom = false;
                control.enablePan = false;

                this.skinViewer.playerObject.rotation.y = Math.PI;

                if(this.hideelytra) {
                    this.showElytra = false
                }
            },
            toggleElytra() {
                if(this.skinViewer.playerObject.backEquipment == "cape") {
                    this.buttonClass = "toggle-on"
                    this.skinViewer.loadCape(this.skinViewer.capeImage.currentSrc, { backEquipment: "elytra" })
                } else {
                    this.buttonClass = "toggle-off"
                    this.skinViewer.loadCape(this.skinViewer.capeImage.currentSrc)
                }
            }
        },
        computed: mapState(['user'])
    }
</script>