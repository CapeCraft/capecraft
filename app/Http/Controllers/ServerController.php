<?php

namespace App\Http\Controllers;

use xPaw\MinecraftPing;
use xPaw\MinecraftPingException;

class ServerController extends Controller {

    /**
     * Get the server ping
     *
     * @return void
     */
    public static function getServerResponse() {
        $value = cache()->remember('server:capecraft', 300, function () {
            $result = null;

            try {
                $ping = new MinecraftPing('play.capecraft.net', 25565);
                $result = $ping->query();
            } catch(MinecraftPingException $e) {
                dd($ping);
            } finally {
                if($ping) {
                    $ping->Close();
                }
            }

            return $result;
        });

        return $value;
    }

    /**
     * Json response for the server
     *
     * @return void
     */
    public function getServer() {
        return response()->json($this->getServerResponse());
    }

}
