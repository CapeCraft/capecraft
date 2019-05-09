<?php

  if(isset($_GET['blogid'])) {
    $blogID = filter_var($_GET['blogid'], FILTER_SANITIZE_NUMBER_INT);
    $blogPost = $database->get('blogposts', '*', [ "ID" => $blogID ]);
  } else {
    $blogPosts = $database->select('blogposts', '*', [ "ORDER" => ["blogposts.id" => "DESC"] ]);

    foreach($blogPosts as $key => $blog) {
      $blogPosts[$key]['preview'] = substr(strip_tags($blog['content']), 0, 300) . "...";
    }
  }
