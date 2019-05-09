<div id="page" class="content">
  <div>
    <h1 class="text-center">CapeCraft unban request</h1>
    <div class="row no-gutters justify-content-center">
      <div class="col-10">
        <form method="post">
          <div>
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo isset($username) ? $username : null; ?>" class="form-control">
            <small>Your username</small>
          </div>
          <div>
            <label>Email:</label>
            <input type="emai" name="email" value="<?php echo isset($email) ? $email : null; ?>" class="form-control">
            <small>Your Email so we can contact you</small>
          </div>
          <div>
            <label>Banned By:</label>
            <input type="text" name="bannedby" value="<?php echo isset($bannedby) ? $bannedby : null; ?>" class="form-control">
            <small>The staff member who banned you</small>
          </div>
          <div>
            <label>Date Banned:</label>
            <input type="text" name="databanned" readonly class="form-control">
          </div>
          <div>
            <label>What happened before you was banned?</label>
            <textarea rows="6" name="beforeban" class="form-control"><?php echo isset($beforeban) ? $beforeban : null; ?></textarea>
            <small>Include as much detail as you can about what happened leading up to the ban</small>
          </div>
          <div>
            <label>Why should we unban you?</label>
            <textarea rows="6" name="whyunban" class="form-control"><?php echo isset($whyunban) ? $whyunban : null; ?></textarea>
            <small>Include as much detail as you can about why you think you should be unbanned</small>
          </div>
          <div>
            <label>What will you do to avoid being banned again?</label>
            <textarea rows="6" name="whatdifferent" class="form-control"><?php echo isset($whatdifferent) ? $whatdifferent : null; ?></textarea>
            <small>Include as much detail as you can about what you'll do to stop being banned</small>
          </div>
          <hr>
          <div>
            <label>
              <input type="checkbox" name="confirmunban" style="width:auto;">
              I am in good faith to believe that I deserve to be unbanned and all information supplied is true. I also understand that I can
              submit this form only once every 24 hours.
            </label>
          </div>
          <hr>
          <div>
            <div class="g-recaptcha" data-sitekey="<?php echo $settings->googleRecaptcha(false); ?>"></div>
            <script src='https://www.google.com/recaptcha/api.js'></script>
          </div>
          <hr>
          <div>
            <button type="submit" class="btn btn-success" name="unbanrequest">Submit Unban Request</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $utils->getCSS('jquery.datetimepicker.min.css'); ?>
<?php $utils->getJS('jquery.datetimepicker.full.min.js'); ?>
<script>$('[name="databanned"]').datetimepicker({ format:'d-m-Y H:i' });</script>
