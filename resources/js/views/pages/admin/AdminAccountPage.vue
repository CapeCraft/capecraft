<template>
    <section class="row justify-content-center">
        <div class="col-10">
            <div class="card">
                <h1 class="card-title text-center">{{user.username}}</h1>
                <div class="row justify-content-center">
                    <div class="col-md-2 text-center">
                        <img class="img-fluid" :src="`https://crafatar.com/renders/body/${user.uuid}?overlay=true`">
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="staff-bio" class="required">Staff Bio</label>
                            <textarea id="staff-bio" class="form-control" v-model="staffBio"></textarea>
                        </div>
                        <button class="btn btn-primary float-right" @click="saveBio">Save Bio</button>
                    </div>
                </div>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <p>Change Password</p>
                        <div class="form-inline-md">
                            <input type="password" class="form-control" placeholder="Password" :class="{ 'is-invalid': !validPassword }" v-model="password">
                            <input type="password" class="form-control" placeholder="Confirm Password" :class="{ 'is-invalid': !validPassword }" v-model="confirm_password">
                            <button class="btn btn-primary" @click="savePassword" :disabled="!validPassword">Save</button>
                        </div>
                    </div>
                    <p class="form-text mb-10">Passwords must contain at least 3 of the following. 1 letter, 1 capital, 1 number or 1 symbol. The password must be 6 - 50 characters long.</p>
                </div>
                <div v-if="saved" class="alert alert-success">Changes have been saved</div>
            </div>
        </div>
    </section>
</template>



<script>
    import { mapState } from 'vuex'
    export default {
        data() {
            return {
                users: null,
                saved: false,
                staffBio: null,
                password: null,
                confirm_password: null,
                validPassword: false
            }
        },
        created() {
            this.staffBio = this.user.bio
        },
        watch: {
            password: function() {
                this.validPassword = this.checkPassword();
            },
            confirm_password: function() {
                this.validPassword = this.checkPassword();
            }
        },
        methods: {
            saveBio() {
                axios.post('/api/admin/account/bio', {
                    bio: this.staffBio
                }).then((response) => {
                    //TODO update the user
                    this.showSaved();
                })
            },
            savePassword() {
                axios.post('/api/admin/account/password', {
                    password: this.password,
                    confirm_password: this.confirm_password
                }).then((response) => {
                    this.showSaved();
                })
                console.log("Saving password")
            },
            checkPassword() {
                const passwordRegex = /^(?:(?=.*?[A-Z])(?:(?=.*?[0-9])(?=.*?[-!@#$%^&*()_[\]{},.<>+="£:;\'~`|\/\\])|(?=.*?[a-z])(?:(?=.*?[0-9])|(?=.*?[-!@#$%^&*()_[\]{},.<>+="£:;\'~`|\/\\])))|(?=.*?[a-z])(?=.*?[0-9])(?=.*?[-!@#$%^&*()_[\]{},.<>+="£:;\'~`|\/\\]))[A-Za-z0-9-!@#$%^&*()_[\]{},.<>+="£:;\'~`|\/\\]{6,50}$/
                if(this.password != this.confirm_password) {
                    return false;
                }
                if(!passwordRegex.test(this.password)) {
                    return false
                }
                return true;
            },
            showSaved() {
                this.saved = true;
                setTimeout(() => {
                    this.saved = false;
                }, 5000)
            }
        },
        computed: mapState(['user'])
    }
</script>