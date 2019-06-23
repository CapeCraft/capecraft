<?php

Namespace CapeCraft\Helpers;

use \CapeCraft\System\Database as DB;

class MojangAPI {
  /**
   * Will pick an IP to send the request out off.
   * @return String IP Address
   */
  private static function getIP() {
    return (time() & 1) ? getenv('IP1') : getenv('IP2');
  }

  /**
   * Will send a request to the API
   * @param  String $url URL of the request
   * @return Array       Returns the data from the request and whether it was successfull
   */
  private static function sendRequest($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    if(!DEVELOPMENT_MODE) {
      curl_setopt($ch, CURLOPT_INTERFACE, self::getIP());
    }

    $output = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return [ 'success' => $httpcode === 200, 'data' => json_decode($output, true) ];
  }

  /**
   * Gets a username from a UUID
   * @param  String $uuid The players uuid in 32 length format
   * @return String       The players username
   */
  public static function getUsername($uuid) {
    //Lets check the UUID is valid
    if(!preg_match("/[a-fA-F0-9]{32}/", $uuid)) {
      return null;
    }

    //Lets first look for cache
    $checkCache = self::checkCache($uuid);
    if($checkCache) {
      return $checkCache['username'];
    }

    //Else if old cache generate the URL and get the request
    $url = "https://api.mojang.com/user/profiles/$uuid/names";
    $data = self::sendRequest($url);

    //If the request fails return null
    if(!$data['success']) {
      return null;
    }

    $finalData = [ 'uuid' => $uuid, 'username' => $data['data'][count($data['data']) - 1]['name']];

    //Now lets add the data to the cache
    self::updateCache($finalData);
    return $finalData['username'];
  }

  public static function getUUID($username) {
    //Lets check the username is valid
    if(!preg_match("/^[a-zA-Z0-9_]{1,17}$/", $username)) {
      return null;
    }

    //Lets first look for cache
    $checkCache = self::checkCache($username, false);
    if($checkCache) {
      return $checkCache['uuid'];
    }

    //Else if old cache generate the URL and get the request
    $url = "https://api.mojang.com/users/profiles/minecraft/$username";
    $data = self::sendRequest($url, false);

    //If the request fails return null
    if(!$data['success']) {
      return null;
    }

    $finalData = [ 'uuid' => $data['data']['id'], 'username' => $username ];

    //Now lets add the data to the cache
    self::updateCache($finalData);
    return $finalData['uuid'];
  }

  private static function checkCache($value, $uuid = true) {
    //Gets the cache
    if($uuid) {
      $cache = DB::getInstance()->get('uuidcache', '*', [ 'uuid' => $value ]);
    } else {
      $cache = DB::getInstance()->get('uuidcache', '*', [ 'username' => $value ]);
    }

    //If no cache
    if(empty($cache)) {
      return false;
    }

    $finalData = ['uuid' => $cache['uuid'], 'username' => $cache['username']];

    //If cache time isn't reached return cache else return false
    return ($cache['updated_at'] > time()) ? $finalData : false;
  }


  private static function updateCache($value, $uuid = true) {
    //Update or create cache
    if($uuid) {
      $cache = DB::getInstance()->updateOrCreate("uuidcache",
        [ 'uuid' => $value['uuid'] ],
        [ 'username' => $value['username'], 'updated_at' => time() + 300 ]
      );
    } else {
      $cache = DB::getInstance()->updateOrCreate("uuidcache",
        [ 'username' => $value['username'] ],
        [ 'uuid' => $value['uuid'], 'updated_at' => time() + 300 ]
      );
    }
  }
}
