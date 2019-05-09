<div id="page" class="content">
  <div name="userinfo">
    <h3 class="text-center">User Info</h3>
    <div class="row no-gutters">
      <div class="col-5">
        <img class="ml-auto" src="https://crafatar.com/avatars/<?php echo $userlog['uuid']; ?>?helm&size=100">
      </div>
      <div class="col-7">
        <p>Username:
          <?php echo $usernameHandler->getName($userlog['uuid']); ?>
        </p>
        <p>UUID:
          <?php echo $userlog['uuid']; ?>
        </p>
      </div>
    </div>
  </div>
  <div name="loginfo">
    <h3 class="text-center">Log Info</h3>
    <div class="row no-gutters">
      <div class="col-6">
        <table class="table">
          <tbody>
            <tr>
              <th>Log ID</th>
              <td><?php echo $userlog['logID']; ?></td>
            </tr>
            <tr>
              <th>Punishment Type</th>
              <td><?php echo punishType($userlog['type']); ?></td>
            </tr>
            <tr>
              <th>Punishment Reason</th>
              <td><?php echo $userlog['reason']; ?></td>
            </tr>
            <?php if(!empty($userlog['length'])) { ?>
            <tr>
              <th>Punishment Length</th>
              <td><?php echo $userlog['length'] . " " . getPunishLength($userlog['length_type']) ?></td>
            </tr>
            <?php } ?>
            <tr>
              <th>Punishment Issued</th>
              <td><?php echo date('m-d-y G:i', $userlog['date']); ?></td>
            </tr>
            <tr>
              <th>Punishment Issued by</th>
              <td><?php echo $usernameHandler->getName($userlog['loggedby']); ?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-6">
        <a class="btn btn-raised btn-warning btn-sm d-inblock" href="<?php echo $userlog['proof']; ?>" target="_blank">View Proof</a>
      </div>
    </div>
  </div>
</div>
