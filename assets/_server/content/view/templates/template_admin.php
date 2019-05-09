<html>
  <head>
    <?php
      require_once($router->getIncludes('header'));
      $utils->getCSS('admin_stylesheet.css');
    ?>
  </head>
  <body>
    <?php require_once($router->getIncludes('menu')); ?>
    <div class="row no-gutters">
      <?php if($router->isMemberOnly()) { ?>
      <div class="col-2" style="margin: 0;">
        <?php require_once($router->getIncludes('admin_menu')); ?>
      </div>
      <div class="col-10" style="margin: 0;">
        <?php require_once($router->getView()); ?>
      </div>
      <?php } else { ?>
        <div class="w-100">
          <?php require_once($router->getView()); ?>
        </div>
      <?php } ?>
    </div>
    <?php if(defined('SHOW_MODAL') && SHOW_MODAL) {
      require_once($router->getIncludes('modal'));
    }
    require_once($router->getIncludes('footer'));
    $utils->getJS('menu.js'); ?>
    <script>
      $('#page').css( { "padding": "2vh 2vw" } );
    </script>
  </body>
</html>
