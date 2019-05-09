<?php require_once($router->getIncludes('proof')); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<form class="form-inline" method="POST">
  <div class="form-group pt-0">
    <label class="sr-only">Username</label>
    <input type="text" class="form-control mr-5" name="username" placeholder="Username">
  </div>
  <button type="submit" class="btn btn-primary btn-raised" name="search">Search </button>
</form>
<hr>
<div class="row border-bottom mb-1">
  <div class="col-sm-1">
    <strong>Ban ID</strong>
  </div>
  <div class="col-sm-2">
    <strong>Username</strong>
  </div>
  <div class="col-sm-3">
    <strong>Reason</strong>
  </div>
  <div class="col-sm-2">
    <strong>Punishment Type</strong>
  </div>
  <div class="col-sm-2">
    <strong>Issued by</strong>
  </div>
  <div class="col-sm-2">
    <strong>Proof</strong>
  </div>
</div>
<?php if(!isset($logs)) : ?>
  <p>Nothing found</p>
<?php else :
  foreach($logs as $log) : ?>
    <div class="row border-bottom my-1">
      <div class="col-sm-1">
        #<?= $log['id']; ?>
      </div>
      <div class="col-sm-2">
        <?php if($log['punishmentType'] == "IP_BAN") : ?>
          <a target="_blank" href="https://geoiptool.com/en/?ip=<?= $log['uuid']; ?>">
            <?= $log['uuid']; ?> <i class="fas fa-external-link-alt icon"></i>
          </a>
        <?php else : ?>
          <a target="_blank" href="https://namemc.com/<?= $usernameHandler->getName($log['uuid']); ?>">
            <?= $usernameHandler->getName($log['uuid']); ?> <i class="fas fa-external-link-alt icon"></i>
          </a>
        <?php endif; ?>
      </div>
      <div class="col-sm-3">
        <?= $log['reason']; ?>
      </div>
      <div class="col-sm-2">
        <?= $log['punishmentType']; ?><br>
        <?php if($log['punishmentType'] == "TEMP_BAN") : ?>
          <small><span id="expireTime<?= $log['id'] ?>"></span></small>
          <script>$('#expireTime<?= $log['id']; ?>').html(moment.unix(<?= $log['end'] / 1000 ?>).format('D MMMM Y, HH:mm'));</script>
        <?php endif; ?>
      </div>
      <div class="col-sm-2">
        <?= $log['operator']; ?><br>
        <small><span id="banTime<?= $log['id'] ?>"></span></small>
        <script>$('#banTime<?= $log['id']; ?>').html(moment.unix(<?= $log['start'] / 1000 ?>).format('D MMMM Y, HH:mm'));</script>
      </div>
      <div class="col-sm-2">
        <?php if(empty($log['proof'])) : ?>
          <a class="btn btn-info btn-raised" onclick="loadProof(<?= $log['id']; ?>)">Add Proof <i class="fas fa-external-link-alt icon"></i></a>
        <?php else : ?>
          <a class="btn btn-warning btn-raised" target="_blank" href="<?= $log['proof'] ?>">Proof <i class="fas fa-external-link-alt icon"></i></a>
        <?php endif; ?>
      </div>
    </div>
  <?php endforeach;
endif; ?>
<nav class="text-center pagination-nav mt-3">
  <ul class="pagination">
    <?php if(($currentPage - 1) != 0) : ?>
      <li class="page-item">
        <a class="page-link" href="/admin/log/&p=<?= $currentPage - 1 ?>">Previous</a>
      </li>
      <li class="page-item"><a class="page-link" href="/admin/log/&p=<?= $currentPage - 1 ?>"><?= $currentPage - 1 ?></a></li>
    <?php endif; ?>
    <li class="page-item active">
      <span class="page-link"><?=$currentPage ?></span>
    </li>
    <?php if(($currentPage + 1) <= $pages) : ?>
      <li class="page-item"><a class="page-link" href="/admin/log/&p=<?= $currentPage + 1 ?>"><?= $currentPage + 1 ?></a></li>
      <li class="page-item">
        <a class="page-link" href="/admin/log/&p=<?= $currentPage + 1 ?>">Next</a>
      </li>
    <?php endif; ?>
  </ul>
</nav>
<script>
  function loadProof(banID) {
    $('#proof').val(null);
    $('#proofmodal').modal('show');
    $('#banid').val(banID);
  }

  function postProof() {
    $.ajax({
      type: "POST",
      url: "/api/postproof",
      data: {
        banid: $('#banid').val(),
        proof: $('#proof').val()
      },
      success: function() {
        location.reload();
      },
    });
  }
</script>
