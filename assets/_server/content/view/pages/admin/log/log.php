<div id="page" class="content">
  <div name="filter">
    <form method="post" class="row">
      <div class="form-group col">
        <label for="filter_logid">Log ID</label>
        <input type="text" name="filter_logid" class="form-control">
      </div>
      <div class="form-group col">
        <label for="filter_username">Username</label>
        <input type="text" name="filter_username" class="form-control">
      </div>
      <div class="form-group col">
        <label for="filter_uuid">UUID</label>
        <input type="text" name="filter_uuid" class="form-control">
      </div>
      <div class="col">
        <button class="btn btn-raised btn-success" type="submit">Filter</button>
        <a class="btn btn-raised btn-primary" href="/admin/log/new">Post New</a>
      </div>
    </form>
  </div>
  <div name="result">
    <table class="table">
      <tr>
        <th>Log ID</th>
        <th>Username</th>
        <th>UUID</th>
        <th>Type</th>
        <th>Date</th>
        <th></th>
      </tr>
      <?php foreach($logs as $log) { ?>
      <tr class="text-center">
        <td><strong><?php echo $log['logID']; ?></strong></td>
        <td>
          <img class="v-a-m" src="https://crafatar.com/avatars/<?php echo $log['uuid']; ?>?helm&size=32">
          <p class="v-a-m d-inblock">
            <?php echo $usernameHandler->getName($log['uuid']); ?>
          </p>
        </td>
        <td>
          <?php echo $log['uuid']; ?>
        </td>
        <td>
          <?php echo punishType($log['type']); ?>
        </td>
        <td>
          <?php echo date('d/m/Y H:i', $log['date']); ?>
        </td>
        <td>
          <a class="btn btn-raised btn-sm btn-success d-inblock div-center" href="/admin/log/view&logid=<?php echo $log['logID']; ?>">View</a>
        </td>
      </tr>
      <?php } ?>
    </table>
  </div>
  <div name="pagination">
    <div class="flex-box text-center">
      <div class="flex-3">
        <?php if($pagenumber > 1) { ?>
          <a href="/admin/log/&p=<?php echo $pagenumber - 1; ?>">Back</a>
        <?php } ?>
      </div>
      <div class="flex-3">
        <strong>Page <?php echo $pagenumber; ?></strong>
      </div>
      <div class="flex-3">
        <?php
          $database->orderBy("id","desc")->get('userlog', array(($pagenumber - 1) * 9 , 9));
          if($database->count >= 9) { ?>
            <a href="/admin/log/&p=<?php echo $pagenumber + 1; ?>">Next</a>
          <?php } ?>
      </div>
    </div>
  </div>
</div>
