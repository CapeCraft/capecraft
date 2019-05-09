<main class="text-white">
  <?php $utils->getCSS('home.css'); ?>
  <div class="div-mid text-center">
  <h1 class="display-2">Welcome to the CapeCraft Website</h1>
  <h3>Come and <?= $serverDataMsg; ?> on <kbd class="pl-3">Play.CapeCraft.Net
    <span data-toggle="tooltip" data-placement="right" id="copyIP" data-original-title="Copy!" class="pr-1" style="cursor:pointer;" data-clipboard-text="Play.CapeCraft.Net">
      <i class="fa fa-copy" data-clipboard-text="Play.CapeCraft.Net"></i>
    </span>
    <script>
      new ClipboardJS('#copyIP');
      $('#copyIP').on('click', function() {
        $(this).attr('data-original-title', 'Copied!').tooltip('show');
      });
    </script>
  </kbd></h3>
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
  <a class="btn btn-discord btn-raised" target="_blank" href="/discord"><i class="fab fa-discord"></i> Join our Discord</a>
</main>
