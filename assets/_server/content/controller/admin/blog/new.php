<?php
  if(isset($_POST['post-blog'])) {

    $title = isset($_POST['title']) ? $_POST['title'] : null;
    if(!isset($title) || empty($title)) {
      $globalScript->setModal("Error", "Please supply a title");
      return;
    }

    $content = isset($_POST['blogcontent']) ? $_POST['blogcontent'] : null;
    if(!isset($content) || empty($content)) {
      $globalScript->setModal("Error", "Please supply content");
      return;
    }

    $author = $_SESSION['MEMBER']['uuid'];
    $postdate = time();

    $buildArray = array(
      "title" => $title,
      "content" => $content,
      "author" => $author,
      "postdate" => $postdate
    );

    $database->insert('blogposts', $buildArray);
    $globalScript->setModal("Success", "Your blog post has been posted");
    Header("Location: /admin/blog");
  }