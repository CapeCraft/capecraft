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
        $cache = cache()->get("cache:$value");
        if($cache != null) {
            return $cache;
        }

        if(preg_match("/^[a-fA-F0-9]{32}$/", $value)) {
            if(substr($value, 0, 16) == "0000000000000000") {
                $cache = self::getBedrockApiResponse($value);
            } else {
                $cache = self::getApiResponse($value);
            }
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
        try {
            $response = Http::retry(3, 100)->get("https://minecraftapi.net/api/v1/profile/$value");
            if($response->successful()) {
                $uuid = $response->json()['uuid'];
                $username = $response->json()['name'];

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

    /**
     * Get the bedrock api response
     *
     * @param  mixed $value
     * @return void
     */
    private static function getBedrockApiResponse($value) {
        $xuid = hexdec(substr($value, 16, 32));
        try {
            $response = Http::withHeaders([
                'X-Authorization' => config('services.xbox.key')
            ])->retry(3, 100)->get("https://xbl.io/api/v2/account/$xuid");
            if($response->successful()) {
                $username = $response->json()['profileUsers'][0]['settings'][2]['value'];

                $result = (object) [
                    "username" => $username,
                    "uuid" => $value
                ];

                //Cache for username and uuid
                cache()->put("cache:$username", $result, 600);
                cache()->put("cache:$value", $result, 600);

                return $result;
            } else {
                return null;
            }
        } catch(\Illuminate\Http\Client\RequestException $e) {
            return null;
        }
    }
}