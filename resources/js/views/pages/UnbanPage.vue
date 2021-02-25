<template>
    <section class="row justify-content-center">
        <div class="col-8 card">
            <h1 class="text-center">Unban Request</h1>
            <label for="ban-type">Where have you been banned?</label>
            <select class="form-control" id="ban-type" v-model="ban_type">
                <option value="" disabled="disabled">Select a platform</option>
                <option value="minecraft">Minecraft</option>
                <option value="discord">Discord</option>
            </select>
            <hr>
            <div v-if="ban_type == 'minecraft'">
                <div class="form-group">
                    <label for="platform-java" class="required">Which platform were you using?</label>
                    <div class="custom-radio">
                        <input type="radio" id="platform-java" value="male" required="required" @click="platform = 'java'">
                        <label for="platform-java">Java</label>
                    </div>
                    <div class="custom-radio">
                        <input type="radio" id="platform-bedrock" value="female" required="required" @click="platform = 'bedrock'">
                        <label for="platform-bedrock">Bedrock</label>
                    </div>
                </div>
            </div>
            <div v-if="ban_type != ''">
                <div class="form-group">
                    <label for="username" class="required">Username</label>
                    <input type="text" class="form-control" id="username" required="required" v-model="username">
                </div>
                <div class="form-group">
                    <label for="email" class="required">Email:</label>
                    <input type="emai" id="email" class="form-control" autocomplete="off" v-model="email">
                    <small>Your email MUST be a real email so we can contact you! If you don't have one, ask your parent/guardian!</small>
                </div>
                <div class="form-group">
                    <label for="email_confirm" class="required">Confirm Email:</label>
                    <input type="emai" id="email_confirm" class="form-control" autocomplete="off" v-model="confirm_email">
                </div>
                <div class="form-group">
                    <label for="beforeban" class="required">What happened before you were banned?</label>
                    <textarea rows="6" id="beforeban" class="form-control" v-model="before_ban"></textarea>
                    <small>Include as much detail as you can about what happened leading up to the ban</small>
                </div>
                <div class="form-group">
                    <label for="whyunban" class="required">Why should we unban you?</label>
                    <textarea rows="6" id="whyunban" class="form-control" v-model="why_unban"></textarea>
                    <small>Include as much detail as you can about why you think you should be unbanned</small>
                </div>
                <div class="form-group">
                    <label for="whatdifferent" class="required">What will you do to avoid being banned again?</label>
                    <textarea rows="6" id="whatdifferent" class="form-control" v-model="what_different"></textarea>
                    <small>Include as much detail as you can about what you'll do to stop being banned</small>
                </div>
                <div class="alert alert-primary">
                    Please read through your answers carefully! DO NOT LIE! We store proof/evidence of every ban and will not tolerate liars. We recommend reading through our rules so you understand what you did wrong!
                </div>
                <hr>
                <div class="custom-checkbox">
                    <input type="checkbox" id="tac" value="" v-model="tac">
                    <label for="tac">I am in good faith to believe that I deserve to be unbanned and all information supplied is true. I also understand that I can submit this form only once every 24 hours.</label>
                </div>
                <hr>
                <button class="btn btn-primary btn-block btn-lg" :disabled="!tac" @click="submitRequest">Submit Unban Request</button>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                ban_type: "",
                platform: "",
                username: "",
                email: "",
                confirm_email: "",
                before_ban: "",
                why_unban: "",
                what_different: "",
                tac: false
            }
        },
        methods: {
            submitRequest() {
                //Submit values
                axios.post('/api/unban', {
                    ban_type: this.ban_type,
                    platform: this.platform,
                    username: this.username,
                    email: this.email,
                    confirm_email: this.confirm_email,
                    before_ban: this.before_ban,
                    why_unban: this.why_unban,
                    what_different: this.what_different,
                    tac: this.tac
                }).then((response) => {
                    //TODO
                })
            }
        }
    }
</script>