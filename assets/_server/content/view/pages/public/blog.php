<?php $utils->getCSS('blog.css'); ?>
<?php if(!isset($blogPost) && isset($blogPosts)) {
  foreach($blogPosts as $blog) { ?>
    <div class="row justify-content-lg-center blogpost">
      <div class="col-lg-2">
        <div class="view overlay rounded z-depth-1-half">
          <img src="https://crafatar.com/avatars/<?php echo $blog['author']; ?>?size=512&helm" class="img-fluid">
        </div>
      </div>
      <div class="col-lg-7">
        <h3>
          <strong><a class="mb-3 font-weight-bold dark-grey-text" href="/blog&blog=<?php echo $blog['ID']; ?>"><?php echo $blog['title']; ?></a></strong>
        </h3>
        <p class="grey-text"><?php echo substr(strip_tags($blog['content']), 0, 300); ?>...</p>
        <p>
          by <span class="font-weight-bold dark-grey-text"><?php echo $usernameHandler->getName($blog['author']); ?></span>, <?php echo date('d/m/Y H:i', $blog['postdate']); ?>
        </p>
        <a href="/blog&blog=<?php echo $blog['ID']; ?>" class="btn btn-primary btn-raised btn-md">Read more</a>
      </div>
    </div>
  <?php } ?>
  <nav class="blogpost">
    <ul class="pagination justify-content-center m-0">
      <!--Previous button-->
      <li class="page-item <?php echo $showBack; ?>">
          <a class="page-link" href="#" tabindex="-1">Previous</a>
      </li>

      <!--Numbers-->
      <?php for($blogPage = 1; $blogPage <= $blogPages; $blogPage++) { ?>
      <li class="page-item <?php echo $pagenumber == $blogPage ? 'active' : null; ?>"><a class="page-link" href="/blog&page=<?php echo $blogPage; ?>"><?php echo $blogPage; ?></a></li>
      <?php } ?>

      <!--Next button-->
      <li class="page-item <?php echo $showNext; ?>">
          <a class="page-link" href="#">Next</a>
      </li>
    </ul>
  </nav>
<?php } else if(!isset($blogpost)) { ?>
<div id="page" class="content">
  <div>
    <h1>Error</h1>
    <hr>
    <p>
      That blog post isn't found. Sorry.
    </p>
  </div>
</div>
<?php } else { ?>
  <div class="row blogpost">
    <div class="col-lg-2">
      <img class="img-fluid" src="https://crafatar.com/avatars/<?php echo $blogpost['author']; ?>?size=512&helm">
      <hr>
      <p>
        Posted by <strong><?php echo $usernameHandler->getName($blogpost['author']); ?></strong> at
        <?php echo date('d/m/Y H:i', $blogpost['postdate']); ?>
      </p>
    </div>
    <div class="col-lg-10">
      <h1>
        <?php echo $blogpost['title']; ?>
      </h1>
      <hr>
      <p>
        <?php echo $blogpost['content']; ?>
      </p>
    </div>
  </div>
<?php } ?>
