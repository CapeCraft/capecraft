<?php
  //Get Donators
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "https://plugin.buycraft.net/payments");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $headers = [ 'X-Buycraft-Secret: removed', 'limit: 5' ];
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $recentdonators = curl_exec($ch);
  curl_close($ch);

  $recentdonators = json_decode($recentdonators, true);
  $recentdonators = array_slice($recentdonators, 0, 10);

  function getPackage($price) {
    if($price == 0)
      return "<p style=\"color:black\">Unknown or Prize Winner</p>";
    else if($price == "10.00")
      return "<p style=\"color:#5555FF\">Respected</p>";
    else if($price == "25.00")
      return "<p style=\"color:#55FFFF\">Premium</p>";
    else
      return "<p style=\"color:#FFAA00\">VIP</p>";
  }
