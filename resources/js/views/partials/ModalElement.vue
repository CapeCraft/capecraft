<template>
    <div class="modal" id="modal" tabindex="-1" role="dialog" data-overlay-dismissal-disabled="true">
        <div class="modal-dialog" role="document" v-if="modal">
            <small class="text-center">Hit <kbd>esc</kbd> to leave the modal</small>
        </div>
    </div>
</template>

<style>
    .modal {
        z-index: 10000;
    }
</style>

<script>
    import { mapState } from 'vuex'

    export default {
        watch: {
            modal: function() {
                halfmoon.toggleModal("modal")
            }
        },
        computed: mapState(['modal'])
    }
</script>