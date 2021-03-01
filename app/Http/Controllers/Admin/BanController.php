<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\PunishmentHistory;
use Illuminate\Http\Request;
use App\Classes\PlayerCache;

class BanController extends Controller {

    /**
     * Get all bans
     *
     * @return void
     */
    public function getBans() {
        return PunishmentHistory::orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * Get a specific ban
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function getBan(Request $request, $id) {
        return PunishmentHistory::find($id);
    }

    /**
     * Get a specific player
     *
     * @param  mixed $request
     * @param  mixed $uuid
     * @return void
     */
    public function getPlayer(Request $request, $uuid) {
        $profile = PlayerCache::get($uuid);
        $bans = PunishmentHistory::where(['uuid' => $uuid])->get();
        return response()->json(['profile' => $profile, 'bans' => $bans]);
    }

    public function doAddProof(Request $request) {
        dd($request);
    }

}