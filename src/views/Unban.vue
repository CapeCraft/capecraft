<template>
  <div id="page" class="content">
    <h1 class="text-center">CapeCraft unban request</h1>
    <div class="row no-gutters justify-content-center">
      <div class="col-10">
        <form method="post">
          <div class="form-group">
            <label class="bmd-label-floating">Username:</label>
            <input type="text" name="username" value="<?= isset($username) ? $username : null; ?>" class="form-control" autocomplete="off">
            <small class="bmd-help">Your username</small>
          </div>
          <div class="form-group">
            <label class="bmd-label-floating">Email:</label>
            <input type="emai" name="email" value="<?= isset($email) ? $email : null; ?>" class="form-control" autocomplete="off">
            <small class="bmd-help">Your Email so we can contact you</small>
          </div>
          <div class="form-group">
            <label class="bmd-label-floating">Confirm Email:</label>
            <input type="emai" name="email" value="<?= isset($email) ? $email : null; ?>" class="form-control" autocomplete="off">
          </div>
          <div class="form-group">
            <label class="bmd-label-floating">Date Banned:</label>
            <input type="text" name="databanned" readonly class="form-control">
          </div>
          <div class="form-group">
            <label class="bmd-label-floating">What happened before you were banned?</label>
            <textarea rows="6" name="beforeban" class="form-control"><?= isset($beforeban) ? $beforeban : null; ?></textarea>
            <small class="bmd-help">Include as much detail as you can about what happened leading up to the ban</small>
          </div>
          <div class="form-group">
            <label class="bmd-label-floating">Why should we unban you?</label>
            <textarea rows="6" name="whyunban" class="form-control"><?= isset($whyunban) ? $whyunban : null; ?></textarea>
            <small class="bmd-help">Include as much detail as you can about why you think you should be unbanned</small>
          </div>
          <div class="form-group">
            <label class="bmd-label-floating">What will you do to avoid being banned again?</label>
            <textarea rows="6" name="whatdifferent" class="form-control"><?= isset($whatdifferent) ? $whatdifferent : null; ?></textarea>
            <small class="bmd-help">Include as much detail as you can about what you'll do to stop being banned</small>
          </div>
          <hr>
          <div class="checkbox">
            <label>
              <input type="checkbox" class="dynamic" name="confirmunban" style="width:auto;">
              I am in good faith to believe that I deserve to be unbanned and all information supplied is true. I also understand that I can
              submit this form only once every 24 hours.
            </label>
          </div>
          <hr>
          <div>
            <VueRecaptcha sitekey="6LfvnUgUAAAAAG1J9jDgHb4AHebVaBoVrasEgNVq"></VueRecaptcha>
          </div>
          <hr>
          <div>
            <button type="submit" class="btn btn-success btn-raised" name="unbanrequest">Submit Unban Request</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
  import VueRecaptcha from 'vue-recaptcha';
  export default {
    name: 'Unban',
    components: { VueRecaptcha }
  }
</script>
