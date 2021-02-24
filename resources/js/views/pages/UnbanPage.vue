<template>
    <section class="row justify-content-center">
        <div class="col-8 card">
            <h1 class="text-center">Unban Request</h1>
            <label for="ban-type">Where have you been banned?</label>
            <select class="form-control" id="ban-type" v-model="banType">
                <option value="" disabled="disabled">Select a platform</option>
                <option value="minecraft">Minecraft</option>
                <option value="discord">Discord</option>
            </select>
            <hr>
            <div v-if="banType == 'minecraft'">
                <div class="form-group">
                    <label for="platform-java" class="required">Which platform were you using?</label>
                    <div class="custom-radio">
                        <input type="radio" name="gender" id="platform-java" value="male" required="required">
                        <label for="platform-java">Java</label>
                    </div>
                    <div class="custom-radio">
                        <input type="radio" name="gender" id="platform-bedrock" value="female" required="required">
                        <label for="platform-bedrock">Bedrock</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="required">Username</label>
                    <input type="text" class="form-control" id="username" required="required">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="emai" id="email" class="form-control" autocomplete="off" value="">
                    <small>Your email MUST be a real email so we can contact you! If you don't have one, ask your parent/guardian!</small>
                </div>
                <div class="form-group">
                    <label for="email_confirm">Confirm Email:</label>
                    <input type="emai" id="email_confirm" class="form-control" autocomplete="off" value="">
                </div>
                <div class="form-group">
                    <label for="beforeban">What happened before you were banned?</label>
                    <textarea rows="6" id="beforeban" class="form-control"></textarea>
                    <small>Include as much detail as you can about what happened leading up to the ban</small>
                </div>
                <div class="form-group">
                    <label for="whyunban">Why should we unban you?</label>
                    <textarea rows="6" id="whyunban" class="form-control"></textarea>
                    <small>Include as much detail as you can about why you think you should be unbanned</small>
                </div>
                <div class="form-group">
                    <label for="whatdifferent">What will you do to avoid being banned again?</label>
                    <textarea rows="6" id="whatdifferent" class="form-control"></textarea>
                    <small>Include as much detail as you can about what you'll do to stop being banned</small>
                </div>
            </div>
            <div v-else-if="banType == 'discord'">
            </div>
            <div v-if="banType != ''">
                <div class="alert alert-primary">
                    Please read through your answers carefully! DO NOT LIE! We store proof/evidence of every ban and will not tolerate liars. We recommend reading through our rules so you understand what you did wrong!
                </div>
                <hr>
                <div class="custom-checkbox">
                    <input type="checkbox" id="tac" value="" v-model="tac">
                    <label for="tac">I am in good faith to believe that I deserve to be unbanned and all information supplied is true. I also understand that I can submit this form only once every 24 hours.</label>
                </div>
                <hr>
                <button class="btn btn-primary btn-block btn-lg" :disabled="!tac">Submit Unban Request</button>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                banType: "",
                tac: false
            }
        }
    }
</script>