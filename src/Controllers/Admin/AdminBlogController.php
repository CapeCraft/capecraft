<?php

  Namespace CapeCraft\Controllers\Admin;

  use \CapeCraft\Controllers\Controller;
  use \CapeCraft\System\Database as DB;
  use \CapeCraft\Helpers\MojangAPI;

  class AdminBlogController extends Controller {

    /**
     * Shows the blog list page
     * @param  Request $request   The Request Object
     * @param  Response $response The Response Object
     * @param  Array $args        Args from the URL (If any)
     * @return Twig               Returns the View
     */
    public static function getBlog($request, $response, $args) {
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
        $blogList[$key]['html_content'] = base64_decode($blogList[$key]['content']);
        $blogList[$key]['username'] = MojangAPI::getUsername($blog['author']);
      }

      //Returns the view
      return self::getView()->render($response, 'Pages/admin/blog/bloglist.twig', [
        'blogList' => $blogList
      ]);
    }

    /**
     * Shows the blog edit page
     * @param  Request $request   The Request Object
     * @param  Response $response The Response Object
     * @param  Array $args        Args from the URL (If any)
     * @return Twig               Returns the View
     */
    public static function getEditBlog($request, $response, $args) {
      //Checks the blog is valid, else returns an error page
      if(empty($args['blog']) || strlen($args['blog']) !== 25) {
        return self::doError($response, "That's not a valid blog!", "Look likes you inputed a invalid blog id!");
      }

      //Tries to get the blog from the database else returns an error
      $blog = DB::getInstance()->get('blogs', '*', [ 'id' => $args['blog'] ]);
      if(empty($blog)) {
        return self::doError($response, "That's not a valid blog!", "Look likes that blog wasn't found!");
      }

      $blog['html_content'] = base64_decode($blog['content']);

      return self::getView()->render($response, 'Pages/admin/blog/edit.twig', [
        'blog' => $blog
      ]);
    }

    /**
     * Actually edits the blog
     * @param  Request $request   The Request Object
     * @param  Response $response The Response Object
     * @param  Array $args        Args from the URL (If any)
     * @return Twig               Returns the View
     */
    public static function doEditBlog($request, $response, $args) {
      $blogid = $request->getParsedBody()['blogid'];
      $title = $request->getParsedBody()['title'];
      $content = $request->getParsedBody()['content'];

      DB::getInstance()->update('blogs', [
        'title' => $title,
        'content' => base64_encode($content)
      ], [
        'id' => $blogid
      ]);

      return $response->withRedirect("/admin/blog", 301);
    }

    /**
     * Shows the delete blog page
     * @param  Request $request   The Request Object
     * @param  Response $response The Response Object
     * @param  Array $args        Args from the URL (If any)
     * @return Twig               Returns the View
     */
    public static function getDeleteBlog($request, $response, $args) {
      $blogID = $args['blog'];

      $blogExist = DB::getInstance()->has('blogs', [ 'id' => $blogID ]);
      if(!$blogExist) {
        return self::doError($response, "That's not a valid blog!", "Look likes you inputed a invalid blog id!");
      }

      return self::getView()->render($response, 'Pages/admin/blog/delete.twig', [
        'blogID' => $blogID
      ]);
    }
  }
