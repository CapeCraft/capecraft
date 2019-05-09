<!-- WYSIWYG -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>

<div id="page" class="content">
  <div>
    <h1 class="text-center">Edit Blog</h1>
    <form method="post">
      <div>
        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo $blog['title']; ?>" class="form-control">
      </div>
      <div>
        <label for="htmlcontent">Content:</label>
        <textarea name="blogcontent" rows="8"><?php echo $blog['content']; ?></textarea>
      </div>
      <input type="text" name="id" value="<?php echo $_GET['blogid']; ?>" hidden>
      <div>
        <button type="submit" onclick="copyHtmlToInput()" name="edit-blog" class="btn btn-raised btn-success">Edit Blog</button>
      </div>
    </form>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('[name="blogcontent"]').summernote();
  });
</script>
<style>
  .btn-light, .btn-light.dropdown-toggle {
    background: #4285f4 !important;
  }

  .btn-light:hover, .btn-light.dropdown-toggle {
    background: #4285f4 !important;
  }
</style>
