<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\PunishmentHistory;
use App\Models\PunishmentProof;
use Illuminate\Http\Request;

class ProofController extends Controller {

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

        cache()->forget("ban_{$request->id}");

        return $proof;
    }

}