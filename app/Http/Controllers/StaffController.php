<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Classes\PlayerCache;

class StaffController extends Controller {

    /**
     * Get staff
     *
     * @return void
     */
    public function getStaff() {
        $users = User::all();
        foreach($users as $user) {
            $staff[$user->group_name][] = [
                'uuid' => $user->uuid,
                'username' => PlayerCache::get($user->uuid)->username,
                'bio' => $user->bio
            ];
        }
        return response()->json($staff);
    }

}
