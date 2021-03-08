<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Classes\PlayerCache;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminStaffController extends Controller {

    /**
     * Get staff
     *
     * @return void
     */
    public function getStaff() {
        $staff = User::where('group', '>', Auth()->user()->group)->get();
        return response()->json(['success' => true, 'staff' => $staff, 'groups' => User::getGroups()]);
    }

    /**
     * Create a new staff member
     *
     * @param  mixed $request
     * @return void
     */
    public function doCreateStaff(Request $request) {
        $request->validate([
            'username' => 'required|min:1|max:16',
            'group' => 'required|min:1|max:10|numeric'
        ]);

        $user = PlayerCache::get($request->username);
        if($user == null || User::where('uuid', $user->uuid)->count() > 0) {
            return response()->json(['success' => false], 400);
        }

        $password = Str::random(12);

        $staff = new User;
        $staff->uuid = $user->uuid;
        $staff->forceFill([
            'password' => Hash::make($password)
        ]);
        $staff->group = $request->group;
        $staff->save();

        return response()->json(['success' => true, 'admin' => [ 'username' => $user->username, 'password' => $password ]]);
    }

    /**
     * Delete a staff member
     *
     * @param  mixed $request
     * @return void
     */
    public function doDeleteStaff(Request $request) {
        $request->validate([
            'uuid' => 'required|min:32|max:32',
        ]);

        //Check if user exists
        $user = User::where('uuid', $request->uuid)->first();
        if($user == null) {
            return response()->json(['success' => false], 400);
        }

        //Check user has the correct rights
        if($user->uuid != Auth()->user()->uuid && $user->group <= Auth()->user()->group) {
            return response()->json(['success' => false], 400);
        }

        $user->delete();
        return response()->json(['success' => true ]);
    }

}
