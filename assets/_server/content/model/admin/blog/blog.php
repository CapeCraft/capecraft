<?php
  $pagenumber = isset($rawpagenumber) ? $rawpagenumber : 1;  

  $database->get('blogposts');
  $totalpage = $database->count;
  $blogs = $database->orderBy("id","desc")->get('blogposts', array(($pagenumber - 1) * 6 , 6));