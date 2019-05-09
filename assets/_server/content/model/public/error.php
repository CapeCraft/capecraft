<?php  
  switch(PAGE_CODE) {
    case "404":
      $pageTitle = "Error 404";
      $pageDesc = "That page can't be found!";
      break;
    default:
      $pageTitle = "An Error has Occured";
      $pageDesc = "Oops, Looks like an error!, We're working on it";
      break;
  }