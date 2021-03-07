<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\PunishmentHistory;
use App\Models\PunishmentProof;
use Illuminate\Http\Request;
use App\Classes\PlayerCache;

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
            $bans = PunishmentHistory::where(['uuid' => $uuid])->orderBy('id', 'DESC')->get();
            return response()->json(['profile' => $profile, 'bans' => $bans]);
        });
    }
}