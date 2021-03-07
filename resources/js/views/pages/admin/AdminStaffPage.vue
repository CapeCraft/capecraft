<template>
        <section class="row justify-content-center">
        <div class="col-10">
            <div class="card">
                <h1 class="card-title text-center">Staff Modify</h1>
                <div class="row justify-content-center">
                    <div class="col-7">
                        <div class="form-inline-sm">
                            <select class="form-control" v-model="selectedStaff">
                                <option value="" selected="selected" disabled="disabled">Select a staff member</option>
                                <option v-for="member in staff" :key="member.uuid" :value="member">{{member.username}}</option>
                            </select>
                            <button class="btn btn-primary" @click="newStaffMember">New</button>
                        </div>
                        <hr>
                        <div v-if="selectedStaff != ''">
                            <AdminManagement :user="selectedStaff"/>
                        </div>
                        <div v-if="newStaff && selectedStaff == ''">
                            <div class="form-group">
                                <label for="username" class="required">Username</label>
                                <input type="text" class="form-control" v-model="username">
                            </div>
                            <div class="form-group">
                                <label for="group" class="required">Select a group</label>
                                <select class="form-control" id="group" v-model="group">
                                    <option v-for="group in validGroups" :key="group[1]" :value="group[1]">{{group[0]}}</option>
                                </select>
                            </div>
                            <button class="btn btn-primary" @click="createUser">Create User</button>
                            <div v-if="createdAdmin != null">
                                <hr>
                                <div class="alert alert-success">
                                    <strong>User Created</strong>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th>Username:</th>
                                                <td><kbd>{{createdAdmin.username}}</kbd></td>
                                            </tr>
                                            <tr>
                                                <th>Password:</th>
                                                <td><kbd>{{createdAdmin.password}}</kbd></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div v-if="error">
                            <hr>
                            <div class="alert alert-danger">
                                An error has occured
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { mapState } from 'vuex'
    import AdminManagement from '../../partials/admin/AdminManagement'

    export default {
        data() {
            return {
                staff: null,
                groups: null,
                error: false,
                selectedStaff: '',
                newStaff: false,
                username: null,
                group: null,
                createdAdmin: null
            }
        },
        created() {
            axios.get('/api/admin/staff').then((response) => {
                this.staff = response.data.staff;
                this.groups = response.data.groups;
            })
        },
        methods: {
            newStaffMember() {
                this.selectedStaff = '';
                this.newStaff = true;
            },
            createUser() {
                axios.post('/api/admin/staff/create', {
                    username: this.username,
                    group: this.group
                }).then((response) => {
                    this.createdAdmin = response.data.admin;
                }).catch(() => {
                    this.createdAdmin = null;
                    this.error = true;
                });
            }
        },
        computed: {
            validGroups: function() {
                return Object.entries(this.groups).filter((_group, id) => id >= this.user.group);
            },
            ...mapState(['user'])
        },
        components: {
            AdminManagement
        }
    }
</script>