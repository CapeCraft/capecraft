<?php
  class ReCaptcha
  {
    private $secret;
    
    function __construct($secret) {
      $this->secret = $secret;      
    }
    
    function getResult($g_response) {
      $curl = curl_init();
      
      $post = array(
        "secret" => $this->secret,
        "response" => $g_response
      );
      
      curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => $post,
        CURLOPT_URL => "https://www.google.com/recaptcha/api/siteverify"      
      ));
      
      $json = curl_exec($curl);
      $json = json_decode($json, true);
      return $json['success'];
    }
  }