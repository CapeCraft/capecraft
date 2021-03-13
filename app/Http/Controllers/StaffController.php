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
        $cache = cache()->remember('staff', 604800, function() {
            $users = User::orderBy('group', 'ASC')->get();
            foreach($users as $user) {
                $staff[$user->group_name][] = [
                    'uuid' => $user->uuid,
                    'username' => PlayerCache::get($user->uuid)->username,
                    'bio' => $user->bio
                ];
            }
            return $staff;
        });
        return response()->json($cache);
    }

}
