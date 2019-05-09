<html>
  <head>
    <?php require_once($router->getIncludes('header')); ?>
  </head>
  <body>
    <?php require_once($router->getIncludes('menu')); ?>
    <div id="wrapper">    
      <?php require_once($router->getView()); ?>
    </div>
    <?php if(defined('SHOW_MODAL') && SHOW_MODAL) {
      require_once($router->getIncludes('modal'));
    }
    require_once($router->getIncludes('footer')); ?>
  </body>
</html>
