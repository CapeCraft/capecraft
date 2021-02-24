<template>
    <section class="row justify-content-center">
        <div class="col-6 d-flex align-items-center">
            <div class="card w-full m-0">
                <h1 class="text-center">LOGIN</h1>
                <hr>
                <div v-if="errors" class="alert alert-danger mt-2">
                    <ul v-for="error in errors" :key="error[0]">
                        <li>{{error[0]}}</li>
                    </ul>
                </div>
                <hr v-if="errors" hr>
                <form v-on:submit.prevent="doLogin">
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" type="text" v-model="username" autocomplete="username">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" v-model="password" autocomplete="current-password">
                        <router-link :to="{ name: 'account-register'}">Forgot your password?</router-link>
                    </div>
                    <div class="custom-checkbox">
                        <input type="checkbox" v-model="remember_me" id="remember_me">
                        <label for="remember_me">Remember me</label>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary" :disabled="loading"><font-awesome-icon v-if="loading" icon="circle-notch" spin/> Login</button>
                    </div>
                </form>
                <hr>
                <div class="text-center">
                    <span class="text-muted">Don't have an account? <router-link :to="{ name: 'account-register'}">Register here</router-link></span>
                </div>
            </div>
        </div>
    </section>
</template>