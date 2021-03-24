<template>
    <section class="row justify-content-center">
        <div class="col-md-8 card">
            <h1 class="text-center">Unban Request</h1>
            <hr>
            <div v-if="!unbanSent">
                <FormErrors :errors="errors"/>
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
                            <input type="radio" name="platform-radio" id="platform-java" required="required" @click="platform = 'java'">
                            <label for="platform-java">Java</label>
                        </div>
                        <div class="custom-radio">
                            <input type="radio" name="platform-radio" id="platform-bedrock" required="required" @click="platform = 'bedrock'">
                            <label for="platform-bedrock">Bedrock</label>
                        </div>
                    </div>
                </div>
                <div v-if="ban_type != ''">
                    <div class="form-group">
                        <label for="username" class="required">Username</label>
                        <input type="text" class="form-control" id="username" required="required" v-model="username">
                        <small v-if="ban_type == 'discord'">Please make sure this include your discord tag eg; james090500#0001</small>
                        <small v-if="ban_type == 'minecraft' && platform == 'bedrock'">Please input how your username appears in game (without an astrix)</small>
                    </div>
                    <div class="form-group">
                        <label for="email" class="required">Email:</label>
                        <input type="emai" id="email" class="form-control" autocomplete="email" v-model="email">
                        <small>Your email MUST be a real email so we can contact you! If you don't have one, ask your parent/guardian!</small>
                    </div>
                    <div class="form-group">
                        <label for="email_confirm" class="required">Confirm Email:</label>
                        <input type="emai" id="email_confirm" class="form-control" autocomplete="email" v-model="email_confirmation">
                    </div>
                    <div class="form-group">
                        <label for="beforeban" class="required">What happened before you were banned?</label>
                        <textarea rows="6" id="beforeban" class="form-control" v-model="before_ban"></textarea>
                        <small>Include as much detail as you can about what happened leading up to the ban</small>
                        <small class="float-right">{{this.before_ban.length}}/1000</small>
                    </div>
                    <div class="form-group">
                        <label for="whyunban" class="required">Why should we unban you?</label>
                        <textarea rows="6" id="whyunban" class="form-control" v-model="why_unban"></textarea>
                        <small>Include as much detail as you can about why you think you should be unbanned</small>
                        <small class="float-right">{{this.why_unban.length}}/1000</small>
                    </div>
                    <div class="form-group">
                        <label for="whatdifferent" class="required">What will you do to avoid being banned again?</label>
                        <textarea rows="6" id="whatdifferent" class="form-control" v-model="what_different"></textarea>
                        <small>Include as much detail as you can about what you'll do to stop being banned</small>
                        <small class="float-right">{{this.what_different.length}}/1000</small>
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
                    <button class="btn btn-primary btn-block btn-lg" :disabled="!validForm()" @click="submitRequest">Submit Unban Request</button>
                </div>
            </div>
            <div v-else>
                <div class="alert alert-success">Your unban request has been sent. You will recieve a reply within 72 hours.</div>
            </div>
        </div>
    </section>
</template>

<script>
    import FormErrors from '../partials/FormErrors'

    export default {
        data() {
            return {
                unbanSent: false,
                errors: null,
                ban_type: '',
                platform: null,
                username: null,
                email: null,
                email_confirmation: null,
                before_ban: "",
                why_unban: "",
                what_different: "",
                tac: null
            }
        },
        methods: {
            validForm() {
                if(this.ban_type == "minecraft" && this.platform == null) return false;

                if(this.username == null) return false;
                if(this.email == null || this.email_confirmation == null) return false;
                if(this.before_ban == "") return false;
                if(this.why_unban == "") return false;
                if(this.what_different == "") return false;
                if(!this.tac) return false;

                return true;
            },
            submitRequest() {
                //Submit values
                axios.post('/api/unban', {
                    ban_type: this.ban_type,
                    platform: this.platform,
                    username: this.username,
                    email: this.email,
                    email_confirmation: this.email_confirmation,
                    before_ban: this.before_ban,
                    why_unban: this.why_unban,
                    what_different: this.what_different,
                    tac: this.tac
                }).then(() => {
                    this.unbanSent = true;
                    document.getElementsByClassName('content-wrapper')[0].scrollTo({ top: 0, behavior: 'smooth' });
                }).catch((response) => {
                    this.errors = response.response.data.errors;
                    document.getElementsByClassName('content-wrapper')[0].scrollTo({ top: 0, behavior: 'smooth' });
                    this.tac = false;
                })
            }
        },
        components: {
            FormErrors
        }
    }
</script>