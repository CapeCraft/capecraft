<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServerController;

class AdminController extends Controller {

    /**
     * Gets the admin api stuff
     *
     * @return void
     */
    public function getInit() {
        $ping = new \JJG\Ping("play.capecraft.net", 128, 5);
        $serverResponse = ServerController::getServerResponse();
        return response()->json([ "ping" => $ping->ping(), "server" => $serverResponse ]);
    }
}