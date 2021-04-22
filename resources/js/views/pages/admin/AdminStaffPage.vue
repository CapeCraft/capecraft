<template>
        <section class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <h1 class="card-title text-center">Staff Modify</h1>
                <div class="row justify-content-center">
                    <div class="col-7" v-if="staff != null">
                        <div class="form-inline-sm">
                            <select class="form-control" v-model="selectedStaff">
                                <option value="" selected="selected" disabled="disabled">Select a staff member</option>
                                <option v-for="member in staff" :key="member.uuid" :value="member">{{member.username}}</option>
                            </select>
                            <button class="btn btn-primary" @click="newStaffMember">New</button>
                        </div>
                        <hr>
                        <transition-group name="fade" mode="out-in">
                            <div v-if="selectedStaff != ''" key=1>
                                <AdminManagement :user="selectedStaff"/>
                                <div class="alert alert-danger">
                                    <h4 class="alert-heading">Delete User</h4>
                                    <p>This action can not be undone!</p>
                                    <div class="custom-checkbox">
                                        <input type="checkbox" id="confirm-delete" v-model="confirmDelete">
                                        <label for="confirm-delete">I am <strong>CERTAIN</strong> I want to delete this user</label>
                                    </div>
                                    <button class="btn btn-sm btn-danger mt-10" @click="deleteUser" :disabled="!confirmDelete">Delete</button>
                                </div>
                            </div>
                            <div v-if="newStaff && selectedStaff == ''" key=2>
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
                            <div v-if="error" key=3>
                                <hr>
                                <div class="alert alert-danger">
                                    An error has occured
                                </div>
                            </div>
                        </transition-group>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style>
    .alert-outline {
        background: none;
    }
</style>

<script>
import { mapState } from 'vuex'
    import AdminManagement from '@/views/partials/admin/AdminManagement'

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
                createdAdmin: null,
                confirmDelete: false
            }
        },
        created() {
            this.loadStaff();
        },
        methods: {
            loadStaff() {
                axios.get('/api/admin/staff').then((response) => {
                    this.staff = response.data.staff;
                    this.groups = response.data.groups;
                })
            },
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
                    this.loadStaff();
                }).catch(() => {
                    this.createdAdmin = null;
                    this.error = true;
                });
            },
            deleteUser() {
                axios.post('/api/admin/staff/delete', {
                    uuid: this.selectedStaff.uuid,
                }).then(() => {
                    this.selectedStaff = ''
                    this.loadStaff();
                }).catch(() => {
                    this.error = true;
                });
            }
        },
        watch: {
            selectedStaff: function() {
                this.confirmDelete = false
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