<?php

namespace App\Classes;

use Illuminate\Support\Facades\Http;

class PlayerCache {

    /**
     * Try and find the player
     *
     * @param  mixed $value
     * @return void
     */
    public static function get($value) {
        if(preg_match("/^[a-fA-F0-9]{32}$/", $value)) {
            $cache = self::getApiResponse($value);
        } else if(preg_match("/^[a-zA-Z0-9_]{1,16}$/", $value)) {
            $cache = self::getApiResponse($value);
        } else {
            return null;
        }

        return $cache;
    }

    /**
     * Updates the uuid cache
     *
     * @param  String $uuid Players uuid to update
     * @param  String $username Players username to update
     * @return void
     */
    private static function getApiResponse($value) {
        $cache = cache()->get("cache:$value");
        if($cache != null) {
            return cache()->get("cache:$value");
        }

        try {
            $response = Http::retry(3, 100)->get("https://api.ashcon.app/mojang/v2/user/$value");
            if($response->successful()) {
                $uuid = str_replace("-", "", $response->json()['uuid']);
                $username = $response->json()['username'];

                $result = (object) [
                    "username" => $username,
                    "uuid" => $uuid
                ];

                //Cache for username and uuid
                cache()->put("cache:$username", $result, 600);
                cache()->put("cache:$uuid", $result, 600);

                return $result;
            } else {
                return null;
            }
        } catch(\Illuminate\Http\Client\RequestException $e) {
            return null;
        }
    }
}