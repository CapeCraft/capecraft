<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<section>
  <div class="text-center">
    <h1>CapeCraft Presedential Election</h1>
    <h3>Meet your candidates</h3>
  </div>
  <hr>
  <div class="row">
    <div class="col">
      <h2 class="text-center font-weight-bold"><?= $usernameHandler->getName('6f1bc9f6046b40e898baedc8402d9346'); ?></h2>
      <a href="/assets/img/election/President1.png" target="_blank"><img class="img-fluid" src="/assets/img/election/President1.png"></a>
    </div>
    <div class="col">
      <h2 class="text-center font-weight-bold"><?= $usernameHandler->getName('dfc9f96425ce43d594b1da7ec2c8bb3c'); ?></h2>
      <a href="/assets/img/election/President2.png" target="_blank"><img class="img-fluid" src="/assets/img/election/President2.png"></a>
    </div>
  </div>
  <hr>
  <?php if($electionStatus == "before") : ?>
  <div class="text-center">
    <h1>Time left until the election</h1>
    <h1 class="display-1" id="timeleft"></h1>
    <script>
    const end = moment.unix(<?= $time; ?>).utc();

    setInterval(function() {
        const timeLeft = moment.utc(end.diff(moment()));
        const formatted = timeLeft.format('HH:mm:ss');
        console.log(end.diff(moment()));
        if(timeLeft <= 0) {
          location.reload();
        }
        $('#timeleft').html(formatted);
    }, 1000);
    </script>
  </div>
  <?php elseif($electionStatus == "after") : ?>
  <div class="text-center">
    <h1>Your new CapeCraft President is:</h1>
    <?php foreach($electionWinner as $uuid => $key) : ?>      
      <h1 class="display-1"><?= $usernameHandler->getName($uuid); ?></h1>
      <small>A total of <?= $totalVotes; ?> players voted!</small>
    <?php endforeach; ?>
  </div>
  <?php else : ?>
  <div class="text-center">
    <h1>The Election is in progress!</h1>
    <h1>Vote with <kbd>/elect</kbd></h1>
  </div>
  <?php endif; ?>
</section>
