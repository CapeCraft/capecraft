<?php

  class ContentManager {
    
    //Gets the MD5 of the files supplied
    function getMD5($var) {
      $md5 = md5_file($_SERVER['DOCUMENT_ROOT'] . $var);
      return $md5;
    }
    
    //Gets CSS with the md5 of it
    function getCSS($var) {
      $css_dir = "/assets/css/" . $var;
      $md5 = $this->getMD5($css_dir); 
      echo "<link rel=\"stylesheet\" href=\"$css_dir?$md5\">";
    }
    
    //Gets JS with the md5 of it
    function getJS($var) {
      $js_dir = "/assets/js/" . $var;
      $md5 = $this->getMD5($js_dir); 
      echo "<script src=\"$js_dir?$md5\"></script>";
    }
    
  }