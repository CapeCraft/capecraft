<template>
    <nav>
        <ul class="pagination text-center">
            <li class="page-item" v-if="data.current_page > 1">
                <button @click="page--" class="btn page-link"><font-awesome-icon icon="angle-left" class="h-30"/></button>
            </li>
            <li class="page-item" v-for="index in 5" :key="data.current_page - (6 - index)">
                <span v-if="data.current_page - (6 - index) > 0">
                    <button @click="page = data.current_page - (6 - index)" class="btn page-link">{{data.current_page - (6 - index)}}</button>
                </span>
            </li>
            <li class="page-item active">
                <button @click="page = data.current_page" class="btn page-link">{{data.current_page}}</button>
            </li>
            <li class="page-item" v-for="index in 5" :key="index + data.current_page">
                <span v-if="data.current_page + index <= data.last_page">
                    <button @click="page = index + data.current_page" class="btn page-link">{{index + data.current_page}}</button>
                </span>
            </li>
            <li class="page-item" v-if="data.current_page < data.last_page">
                <button @click="page++" class="btn page-link"><font-awesome-icon icon="angle-right" class="h-30"/></button>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        data() {
            return {
                page: 1
            }
        },
        created() {
            this.page = this.data.current_page;
        },
        watch: {
            page: function() {
                this.$emit('page', this.page)
            }
        },
        props: {
            data: Object
        }
    }
</script>