<?php

namespace App\Http\Controllers;

use App\Models\UnbanRequest;
use App\Models\Punishment;
use App\Classes\PlayerCache;
use Illuminate\Http\Request;
use App\Mail\UnbanRequestMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class UnbanController extends Controller {

    /**
     * Handle the unban request
     *
     * @param  mixed $request
     * @return void
     */
    public function doUnban(Request $request) {
        $request->validate([
            'ban_type' => 'required|in:minecraft,discord',
            'email' => 'required|email|confirmed',
            'before_ban' => 'required|min:50|max:1000',
            'why_unban' => 'required|min:50|max:1000',
            'what_different' => 'required|min:50|max:1000',
            'tac' => 'required'
        ], [
           'before_ban.required' => 'The "What happened before you were banned?" field is required',
           'why_unban.required' => 'The "Why should we unban you?" field is required',
           'what_different.required' => 'The "What will you do to avoid being banned again?" field is required',
        ]);

        if($request->ban_type == "minecraft") {
            return $this->doMinecraftUnban($request);
        } else if($request->ban_type == "discord") {
            return $this->doDiscordUnban($request);
        }
    }

    /**
     * Handle unban form for minecraft users
     *
     * @param  mixed $request
     * @return void
     */
    public function doMinecraftUnban(Request $request) {
        $request->validate([
            'platform' => 'required|in:java,bedrock',
        ]);

        //Get the player (will be null for bedrock players)
        $player = PlayerCache::get($request->username);
        if($player == null && $request->platform == "java") {
            return $this->withJsonErrors("That username is not real minecraft account");
        }

        if($request->platform == "java") {
            $ban = Punishment::where('uuid', $player->uuid)->first();
            if($ban == null) {
                return $this->withJsonErrors("You are not currently banned from CapeCraft");
            }
        }

        $unbanRequest = new UnbanRequest;
        $unbanRequest->ban_type = $request->ban_type;
        $unbanRequest->platform = $request->platform;
        $unbanRequest->email = $request->email;
        $unbanRequest->username = ($player != null) ? $player->username : $request->username;
        $unbanRequest->uuid = ($player != null) ? $player->uuid : null;
        $unbanRequest->before_ban = strip_tags($request->before_ban);
        $unbanRequest->why_unban = strip_tags($request->why_unban);
        $unbanRequest->what_different = strip_tags($request->what_different);
        $unbanRequest->save();

        Mail::to(config('mail.to.address'))->queue(new UnbanRequestMail($unbanRequest));
    }

}
