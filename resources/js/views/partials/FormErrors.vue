<template>
    <div class="invalid-feedback" v-if="errors != null">
        <ul>
            <li v-for="error in finalErrors" :key="error[0]">{{error[0]}}</li>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                finalErrors: {}
            }
        },
        props: {
            errors: Object
        },
        watch: {
            errors: function(newErrors) {
                this.finalErrors = newErrors;
            }
        }
    }
</script>