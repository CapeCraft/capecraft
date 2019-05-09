<div class="text-center">
  <h1>CapeCraft Admin Panel</h1>
  <h3>There are <?=$serverData['players']['online'] . "/" . $serverData['players']['max'] ?> players online!</h3>
  <?php if($usersOnline) : ?>
  <div class="container-fluid">
    <div class="row my-3 justify-content-center">
      <?php foreach($serverData['players']['sample'] as $key => $player) :
        if ($key === array_key_last($serverData['players']['sample'])) : ?>
          <span data-toggle="tooltip" data-placement="bottom" title="<?= $usernameHandler->getName($player['id']) ?>">
            <img src="https://crafatar.com/avatars/<?= $player['id'] ?>/?helm" width="75" class="avatar mb-1">
          </span>
        <?php else: ?>
          <span class="mr-3" data-toggle="tooltip" data-placement="bottom" title="<?= $usernameHandler->getName($player['id']) ?>">
            <img src="https://crafatar.com/avatars/<?= $player['id'] ?>/?helm" width="75" class="avatar mb-1">
          </span>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endif; ?>
</div>
