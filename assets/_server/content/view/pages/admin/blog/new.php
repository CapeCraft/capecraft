<!-- WYSIWYG -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>

<div id="page" class="content">
  <div>
    <h1 class="text-center">Post Blog</h1>
    <form method="post">
      <div>
        <label for="title">Title:</label>
        <input type="text" name="title" class="form-control">
      </div>
      <div>
        <label for="htmlcontent">Content:</label>
        <textarea name="blogcontent"></textarea>
      </div>
      <div>
        <button type="submit" name="post-blog" class="btn btn-raised btn-success">Post Blog</button>
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
