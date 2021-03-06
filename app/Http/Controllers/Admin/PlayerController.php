<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\PunishmentHistory;
use App\Models\PunishmentProof;
use Illuminate\Http\Request;
use App\Classes\PlayerCache;
use App\Models\Punishment;

class PlayerController extends Controller {

    /**
     * Unbans a player with a command
     *
     * @param  mixed $request
     * @param  mixed $uuid
     * @return void
     */
    public function doUnban(Request $request, $uuid) {
        $response = Http::withToken(config('services.panel.key'))->post(config('services.panel.url'), [
            'command' => config('app.debug') ? "bungee" : "unban $uuid"
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
            if($profile != null) {
                return response()->json(['profile' => $profile]);
            } else {
                return response()->json(['success' => false], 400);
            }
        });
    }

    /**
     * Gets the bans for a player
     *
     * @param  mixed $request
     * @param  mixed $uuid
     * @return void
     */
    public function getPlayerBans(Request $request, $uuid) {
        return cache()->remember("player_{$uuid}_bans", 300, function() use ($uuid) {
            // Get active punishment
            $active = Punishment::where(['uuid' => $uuid])->where(function($query) {
                $query->where('punishmentType', 'BAN')->orWhere('punishmentType', 'TEMP_BAN');
            })->orderBy('id', 'DESC')->first();

            // Get past punishment
            $bans = PunishmentHistory::where(['uuid' => $uuid])->orderBy('id', 'DESC');
            if($bans->exists()) {
                return response()->json(['active' => $active, 'bans' => $bans->get()]);
            } else {
                return response()->json(['active' => [], 'bans' => []]);
            }
        });
    }
}