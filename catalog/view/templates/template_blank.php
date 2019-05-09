<!DOCTYPE html>
<html>
  <head>
    <?php require_once($router->getIncludes('header')); ?>
  </head>
  <body>
    <?php require_once($router->getIncludes('modal')); ?>
    <?php require_once($router->getIncludes('menu')); ?>
    <div class="container-fluid">
      <?php require_once($router->getView()); ?>
    </div>
    <?php require_once($router->getIncludes('footer')); ?>
  </body>
</html>
