<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\PunishmentHistory;
use App\Models\PunishmentProof;
use App\Classes\PlayerCache;
use Illuminate\Http\Request;

class BanController extends Controller {

    /**
     * Get all bans
     *
     * @param  mixed $request
     * @return void
     */
    public function getBans(Request $request) {
        $page = $request->input('page');
        return cache()->tags(['banlist'])->remember("banlist_$page", 150, function() {
            return PunishmentHistory::orderBy('id', 'DESC')->paginate(10);
        });
    }

    /**
     * Search for some bans
     *
     * @param  mixed $request
     * @return void
     */
    public function doBanSearch(Request $request) {
        $request->validate([
            'search' => 'nullable|min:1|max:255',
            'hasProof' => 'boolean'
        ]);

        $punishmentHistory = PunishmentHistory::hasProof($request->hasProof);

        //For when searching no proof only
        if($request->search == null) {
            return $punishmentHistory->paginate(10);
        }

        //ID
        if(is_numeric($request->search)) {
            return $punishmentHistory->byId($request->search)->paginate(10);
        }

        //Username/UUID
        $player = PlayerCache::get($request->search);
        if($player != null) {
            $result = clone $punishmentHistory;
            $result->byPlayer($player);
            if($result->exists()) {
                return $result->paginate(10);
            }
        }

        //Reason
        return $punishmentHistory->byReason($request->search)->paginate(10);
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
     * Deletes a ban
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function deleteBan(Request $request, $id) {
        $ban = PunishmentHistory::find($id);
        if($ban != null) {
            //Remove Cache
            cache()->tags(['banlist'])->flush();
            cache()->forget("ban_$id");
            cache()->forget("player_$ban->uuid");

            //Delete proof
            foreach($ban->proof as $proof) {
                //TODO delete files
                $proof->delete();
            }

            //Delete the ban
            $ban->delete();
        }
        return response()->json(['success' => true]);
    }

}