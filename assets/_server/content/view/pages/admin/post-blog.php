<div id="page" class="content">
  <div>
    <h1 class="text-center">Post Blog</h1>
    <form method="post">
      <div>
        <label for="title">Title:</label>
        <input type="text" name="title">
      </div>
      <div>
        <label for="htmlcontent">Content:</label>
        <div name="htmlcontent"></div>
      </div>
      <input type="text" name="content" hidden>
      <div>
        <button type="submit" onclick="copyHtmlToInput()" name="post-blog" class="btn-right">Post Blog</button>
      </div>
    </form>
  </div>
</div>
<?php $utils->getJS('wysiwyg/trumbowyg.min.js'); ?>
<?php $utils->getCSS('../js/wysiwyg/ui/trumbowyg.min.css'); ?>
<script>
  $('[name="htmlcontent"]').trumbowyg();
  
  function copyHtmlToInput() {
    $('[name="content"]').val($('[name="htmlcontent"]').trumbowyg('html'));
  }
</script>