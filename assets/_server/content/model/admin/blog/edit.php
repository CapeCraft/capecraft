<?php
  $blog = $database->where('ID', $_GET['blogid'])->getOne('blogposts');