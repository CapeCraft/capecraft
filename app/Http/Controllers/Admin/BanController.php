<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\PunishmentHistory;
use App\Models\PunishmentProof;
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
        $request->validate([
            'id' => 'exists:capecraft.PunishmentHistory,id',
            'type' => 'required|in:internal,external',
            'label' => 'required|string|min:1|max:50',
            'url' => 'url'
        ]);

        $proof = new PunishmentProof;
        $proof->punishment_history_id = $request->id;
        $proof->label = $request->label;
        if($request->type == "internal") {
            $proof->proof = "HASH";
        } else {
            $proof->proof = $request->url;
            $proof->external = true;
        }
        $proof->save();

        return $proof;
    }

}