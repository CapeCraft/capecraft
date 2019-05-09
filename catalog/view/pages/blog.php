<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<?php if(!isset($blogID)) : ?>
  <section class="blogpage">
    <?php foreach($blogPosts as $blogPost) : ?>
      <div class="row justify-content-lg-center blogpost">
        <div class="col-lg-2">
          <img src="https://crafatar.com/avatars/<?= $blogPost['author'] ?>?size=512&helm" class="img-fluid mb-3">
        </div>
        <div class="col-lg-7">
          <h3><a class="font-weight-bold" href="/blog&blogid=<?= $blogPost['ID']; ?>"><?= $blogPost['title'] ?></a></h3>
          <p><?= $blogPost['preview'] ?></p>
          <p>by <span class="font-weight-bold dark-grey-text"><?= $usernameHandler->getName($blogPost['author']) ?></span>, <span id="blogPost<?= $blogPost['ID']; ?>"></span></p>
          <a class="btn btn-primary btn-raised" href="/blog&blogid=<?= $blogPost['ID']; ?>">Read More</a>
        </div>
      </div>
      <script>$('#blogPost<?= $blogPost['ID']; ?>').html(moment.unix(<?= $blogPost['postdate'] ?>).format('D MMMM Y, HH:mm'));</script>
    <?php endforeach; ?>
  </section>
<?php else : ?>
  <div class="row col-md-8 blogpost">
    <div class="col-lg-2">
      <img class="img-fluid" src="https://crafatar.com/avatars/<?= $blogPost['author']; ?>?size=512&helm">
      <hr>
      <p>by <span class="font-weight-bold dark-grey-text"><?= $usernameHandler->getName($blogPost['author']) ?></span>, <span id="blogPost"></span></p>
    </div>
    <div class="col-lg-10">
      <h1>
        <?php echo $blogPost['title']; ?>
      </h1>
      <hr>
      <p>
        <?php echo $blogPost['content']; ?>
      </p>
    </div>
  </div>
  <script>$('#blogPost').html(moment.unix(<?= $blogPost['postdate'] ?>).format('D MMMM Y, HH:mm'));</script>
<?php endif; ?>
