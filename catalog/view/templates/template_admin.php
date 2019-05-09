<!DOCTYPE html>
<html>
  <head>
    <?php require_once($router->getIncludes('header')); ?>
    <?php $utils->getCSS('admin/stylesheet.css'); ?>
  </head>
  <body>
    <?php require_once($router->getIncludes('modal')); ?>
    <?php require_once($router->getIncludes('menu')); ?>
    <div class="container-fluid">
      <section class="content">
        <?php require_once($router->getIncludes('admin_menu')); ?>
        <?php require_once($router->getView()); ?>
      </section>
    </div>
    <?php require_once($router->getIncludes('footer')); ?>
  </body>
</html>
