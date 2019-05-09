<div id="page" class="content">
  <div style="text-align:right;">
    <a href="/admin/blog/new" class="btn btn-raised btn-success">Post Blog</a>
  </div>
  <div name="result">
    <table class="table text-center">
      <tr>
        <th>Blog ID</th>
        <th>Title</th>
        <th>Author</th>
        <th>Date</th>
        <th></th>
      </tr>
      <?php foreach($blogs as $blog) { ?>
      <tr class="text-center">
        <td><strong><?php echo $blog['ID']; ?></strong></td>
        <td>
          <a href="/blog&blog=<?php echo $blog['ID']; ?>"><?php echo $blog['title']; ?></a>
        </td>
        <td>
          <img class="v-a-m" src="https://crafatar.com/avatars/<?php echo $blog['author']; ?>?helm&size=32">
          <p class="v-a-m d-inblock">
            <?php echo $usernameHandler->getName($blog['author']); ?>
          </p>
        </td>
        <td>
          <?php echo date('d/m/Y H:i', $blog['postdate']); ?>
        </td>
        <td>
          <a class="btn btn-raised btn-primary d-inblock div-center" href="/admin/blog/edit&blogid=<?php echo $blog['ID']; ?>">Edit</a>
          <a class="btn btn-raised btn-danger d-inblock div-center" href="/admin/blog/delete&blogid=<?php echo $blog['ID']; ?>">Delete</a>
        </td>
      </tr>
      <?php } ?>
    </table>
  </div>
  <div name="pagination">
    <div class="row justify-content-center text-center">
      <div class="col-md-3">
        <?php if($pagenumber > 1) { ?>
          <a href="/admin/blog/&p=<?php echo $pagenumber - 1; ?>">Back</a>
        <?php } ?>
      </div>
      <div class="col-md-3">
        <strong>Page <?php echo $pagenumber; ?></strong>
      </div>
      <div class="col-md-3">
        <?php
          $database->orderBy("id","desc")->get('userlog', array(($pagenumber - 1) * 6 , 6));
          if($database->count >= 6) { ?>
            <a href="/admin/blog/&p=<?php echo $pagenumber + 1; ?>">Next</a>
          <?php } ?>
      </div>
    </div>
  </div>
</div>
