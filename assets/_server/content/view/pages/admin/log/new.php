<div id="page" class="content">
  <div>
    <h2 class="text-center">Add New</h2>
    <hr>
    <form method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" name="username" class="form-control" autocomplete="off">
      </div>
      <div class="form-group">
        <label for="type">Type:</label>
        <select name="type" onclick="showhide();" class="form-control">
          <option value="1">Temp Warning</option>
          <option value="2">Warning</option>
          <option value="3">Temp Mute</option>
          <option value="4">Mute</option>
          <option value="5">Kick</option>
          <option value="6">Temp Ban</option>
          <option value="7">Permanent Ban</option>
        </select>
      </div>
      <div name="optional_length" style="display:none;" class="form-group">
        <label for="length">Length:</label>
        <div class="row">
          <div class="col-5 m-0" style="margin-right: 1vw !important;">
            <input type="number" name="length" class="form-control">
          </div>
          <div class="col-5 m-0">
            <select name="length_type" class="form-control">
              <option value="1">Second/s</option>
              <option value="2">Minute/s</option>
              <option value="3">Hour/s</option>
              <option value="4">Day/s</option>
              <option value="5">Month/s</option>
            </select>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="reason">Reason:</label>
        <input type="text" name="reason" class="form-control" autocomplete="off">
      </div>
      <div class="form-group">
        <label for="proof">Proof:</label>
        <input type="url" name="proof" class="form-control" autocomplete="off">
      </div>
      <div class="form-group">
        <label for="date">Date Issue:</label>
        <input type="text" name="date" class="form-control" autocomplete="off">
      </div>
      <div class="form-group">
        <button class="btn btn-raised btn-success" type="submit" name="add_new_log">Add New</button>
      </div>
    </form>
  </div>
</div>
<?php $utils->getCSS('jquery.datetimepicker.min.css'); ?>
<?php $utils->getJS('jquery.datetimepicker.full.min.js'); ?>
<script>$('[name="date"]').datetimepicker({ format:'d-m-Y H:i' });</script>
<script>
  function showhide() {
    let value = $('[name="type"]').val();
    if(value == 1 || value == 3 || value == 6) {
      $('[name="optional_length"]').show();
    } else {
      $('[name="optional_length"]').hide();
    }
  }
  showhide();
</script>
