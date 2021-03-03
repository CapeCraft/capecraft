<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\PunishmentHistory;
use App\Models\PunishmentProof;
use Illuminate\Http\Request;
use App\Classes\PlayerCache;

class BanController extends Controller {

    /**
     * Get all bans
     *
     * @param  mixed $request
     * @return void
     */
    public function getBans(Request $request) {
        $page = $request->input('page');
        return cache()->remember("banlist_$page", 60, function() {
            return PunishmentHistory::orderBy('id', 'DESC')->paginate(10);
        });
    }

    /**
     * Get a specific ban
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function getBan(Request $request, $id) {
        return cache()->remember("ban_$id", 86400, function() use ($id) {
            return PunishmentHistory::find($id);
        });
    }

    /**
     * Unbans a player with a command
     *
     * @param  mixed $request
     * @param  mixed $uuid
     * @return void
     */
    public function doUnban(Request $request, $uuid) {
        $response = Http::withToken(config('services.panel.key'))->post(config('services.panel.url'), [
            'command' => "unban $uuid"
        ]);

        return response()->json(['success' => $response->successful()]);
    }

    /**
     * Get a specific player
     *
     * @param  mixed $request
     * @param  mixed $uuid
     * @return void
     */
    public function getPlayer(Request $request, $uuid) {
        return cache()->remember("player_$uuid", 300, function() use ($uuid) {
            $profile = PlayerCache::get($uuid);
            $bans = PunishmentHistory::where(['uuid' => $uuid])->orderBy('id', 'DESC')->get();
            return response()->json(['profile' => $profile, 'bans' => $bans]);
        });
    }

    /**
     * Add proof to the ban
     *
     * @param  mixed $request
     * @return void
     */
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