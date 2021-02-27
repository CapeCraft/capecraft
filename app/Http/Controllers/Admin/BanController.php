<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\PunishmentHistory;
use Illuminate\Http\Request;
use App\Classes\PlayerCache;

class BanController extends Controller {

    public function getBans() {
        $bans = PunishmentHistory::orderBy('id', 'DESC')->paginate(10);
        return response()->json($bans);
    }

}