<footer>
  <div class="row no-gutters">
    <div class="col-lg-3">
      <img class="img-fluid" src="/assets/img/logo/logo.png">
      <h1>CapeCraft.net</h1>
      <p>Minecraft survival at its best</p>
    </div>
    <div class="col text-right">
      <ul class="nav justify-content-end">
        <li class="nav-item"><a class="nav-link text-white" href="/">Home</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="/blog">Blog</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="/rules">Rules</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="/staff">Staff</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="/donate">Donate</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="/unban">Unban</a></li>
        <li class="nav-item"><a class="nav-link text-white" target="_blank" href="/discord"><span style="margin-right:1vh;font-size:1.3rem;" class="fab fa-discord"></span> Discord</a></li>
        <li class="nav-item"><a class="nav-link text-white" target="_blank" href="/youtube"><span style="margin-right:1vh;font-size:1.3rem;" class="fab fa-youtube"></span> YouTube</a></li>
      </ul>
      <p>Copyright <i class="far fa-copyright"></i> <a style="color:white;" href="https://CapeCraft.net">https://CapeCraft.net</a>
        <?php echo date('Y'); ?>
      </p>
      <a style="color:white;" href="mailto:staff@capecraft.net">staff@capecraft.net</a>
    </div>
  </div>

  <!-- JavaScript -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
  <script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>
  <script>
    new ClipboardJS('.copy');

    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-112174246-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-112174246-1');
  </script>
  <?php if(defined('SHOW_MODAL') && SHOW_MODAL) { ?>
    <script>$('#errormodal').modal('toggle')</script>
  <?php } ?>
</footer>
