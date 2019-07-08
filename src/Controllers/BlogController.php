<?php

  Namespace CapeCraft\Controllers;

  use \CapeCraft\Controllers\Controller;
  use \CapeCraft\System\Database as DB;
  use \CapeCraft\Helpers\MojangAPI;

  class BlogController extends Controller {

    public static function getBlogs($request, $response, $args) {
      //Sets the variables such as page number and max count on page
      $PAGE_NUMBER = empty($args['page']) || !is_numeric($args['page']) ? 1 : $args['page'];
      $PAGE_LIMIT = 10;
      $TOTAL_BLOGS = DB::getInstance()->count('blogs');

      //Gets the blogs for the selected page
      $blogList = DB::getInstance()->select('blogs', '*', [
        "ORDER" => [ "posttime" => "DESC" ],
        "LIMIT" => [ ($PAGE_NUMBER - 1) * $PAGE_LIMIT, 10 ]
      ]);

      //Adds author username to blog
      foreach($blogList as $key => $blog) {
        $blogList[$key]['username'] = MojangAPI::getUsername($blog['author']);
      }

      //Returns the view
      return self::getView()->render($response, 'Pages/blog/bloglist.twig', [
        'blogList' => $blogList,
        'pageNumber' => $PAGE_NUMBER,
        'totalPages' => ceil($TOTAL_BLOGS / $PAGE_LIMIT)
      ]);
    }

    public static function getBlog($request, $response, $args) {
      $blog = DB::getInstance()->get('blogs', '*', [ 'ID' => $args['blog']]);
      if(empty($blog)) {
        return; //Error
      }

      $blog['username'] = MojangAPI::getUsername($blog['author']);

      return self::getView()->render($response, 'Pages/blog/blog.twig', [
        'blog' => $blog
      ]);
    }
  }
