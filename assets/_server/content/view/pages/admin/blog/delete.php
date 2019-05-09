<div id="page" class="content">
  <div>
    <div class="alert alert-warning">
      <h2>Are you sure you want to delete the blog post</h2>
      <h3><strong><i><?php echo $blog['title']; ?></i></strong></h3>
    </div>
    <form method="post">
      <input type="text" name="id" value="<?php echo $_GET['blogid']; ?>" hidden>
      <button type="submit" class="btn-red w-100" name="delete_blog">Yes</button>
    </form>
    <a class="button d-block text-center" href="/admin/blog/">No</a>
  </div>
</div>