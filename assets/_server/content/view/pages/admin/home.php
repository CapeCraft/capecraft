<div class="content">
  <div>
    <h1 class="text-center">CapeCraft Admin Panel</h1>
    <div class="text-center">
      <a href="/assets/files/Groups%20_%20Commands,%20Permissions%20and%20Purpose.pdf" class="button">Groups Documentation</a>
      <a href="/assets/files/Punishment%20Chain.pdf" class="button">Punishment Chain</a>
      <a href="/assets/files/" class="button" disabled>Ingame Shop Prices</a>
    </div>
  </div>
  <div>
    <div class="row no-gutters text-center">
      <div class="col-6">
        <h3>There are <?php echo $serverInfo->getInfo()['players']['online'] . "/" . $serverInfo->getInfo()['players']['max']; ?> players online</h3>
        <table class="table text-center">
          <tbody>
            <tr>
              <th></th>
              <th>Username</th>
              <th>UUID</th>
            </tr>
        <?php foreach($serverInfo->getInfo()['players']['sample'] as $player) { ?>
          <tr>
            <td><img src="https://crafatar.com/avatars/<?= $usernameHandler->getUUID($player['name']); ?>?helm&size=50"></td>
            <td><a href="https://namemc.com/profile/<?php echo $player['name'] ?>"><?= $player['name']; ?></a></td>
            <td><?= str_replace('-', '', $player['id']); ?></td>
          </tr>
        <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="col-6">
        <h3>Recent Donators</h3>
        <table class="table text-center">
          <tbody>
            <tr>
              <th></th>
              <th>Username</th>
              <th>Package</th>
            </tr>
            <?php foreach($recentdonators as $donator) { ?>
              <tr class="text-center">
                <td><img src="https://crafatar.com/avatars/<?php echo $donator['player']['uuid']; ?>?helm&size=50"></td>
                <td><a href="https://namemc.com/profile/<?php echo $donator['player']['uuid']; ?>"><?php echo $donator['player']['name']; ?></a></td>
                <td><?= getPackage($donator['amount']); ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
