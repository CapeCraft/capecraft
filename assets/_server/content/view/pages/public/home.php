<?php $utils->getCSS('home.css'); ?>
<section>
  <article class="text-center">
    <h1 class="display-2">Welcome to the CapeCraft Website</h1>
    <h3>Come and <?php echo $playOthers; ?> on
      <kbd>Play.CapeCraft.net
        <span data-toggle="tooltip" data-placement="right" title="Copy!" onclick="$(this).attr('data-original-title', 'Copied!').tooltip('show');">
          <i data-clipboard-text="play.capecraft.net" class="fas fa-copy copy"></i>
        </span>
      </kbd>
    </h3>
  </article>
</section>
