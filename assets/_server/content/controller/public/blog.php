<?php
  if(isset($_GET['p'])) {
    $rawpagenumber = $_GET['p'];
    $rawpagenumber = filter_var($_GET['p'], FILTER_SANITIZE_NUMBER_INT);
  }
  $pagenumber = isset($rawpagenumber) ? $rawpagenumber : 1;

  if(isset($_GET['blog'])) {
    $blog = filter_var($_GET['blog'], FILTER_SANITIZE_NUMBER_INT);
    $blogpost = $database->where('ID', $blog)->getOne('blogposts');
  } else {
    $database->get('blogposts');
    $blogPages = round($database->count / 5);
    $blogPosts = $database->orderBy("id","desc")->get('blogposts', array(($pagenumber - 1) * 5 , 5));
  }
