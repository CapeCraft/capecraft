<?php
  $showBack = ($pagenumber > 1) ? 'disabled' : null;
  $showNext = (isset($blogPages) && $blogPages > 1) ? 'disabled' : null;