<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Classes\PlayerCache;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller {

    /**
     * Logs the admin into their account
     *
     * @param  mixed $request
     * @return void
     */
    public function doLogin(Request $request) {
        //Validate the request
        $validator = $request->validate([
            'username' => 'required|min:1|max:16|regex:/^[a-zA-Z0-9_$]+$/',
            'password' => 'required',
        ]);

        //Get UUID
        $cache = PlayerCache::get($request->username);
        if($cache == null) {
            return $this->withJsonErrors("Login failed. Username or password incorrect");
        }

        //Check credentials
        $user = User::where(['uuid' => $cache->uuid])->first();
        if(!$user || !Hash::check($request->password, $user->password)) {
            return $this->withJsonErrors('Login failed. Username or password incorrect');
        }

        //Generate auth token
        $token = $user->createToken('capecraft')->plainTextToken;

        //Success
        return response()->json([ 'success' => true, 'user' => $user, 'token' => $token ], 200);
    }

    /**
     * Update a users bio
     *
     * @param  mixed $request
     * @return void
     */
    public function doBioUpdate(Request $request) {
        $request->validate([
            'uuid' => 'required|min:32|max:32',
            'bio' => 'required|min:1|max:255'
        ]);

        $user = User::where('uuid', $request->uuid)->first();
        if($user->uuid != Auth()->user()->uuid && $user->group <= Auth()->user()->group) {
            return response()->json(['success' => false], 400);
        }
        $user->bio = $request->bio;
        $user->save();

        return response()->json(['success' => true]);
    }

    /**
     * Update the users password
     *
     * @param  mixed $request
     * @return void
     */
    public function doPasswordUpdate(Request $request) {
        $request->validate([
            'password' => [ 'required', 'confirmed', 'min:6', 'max:50', 'regex:/^(?:(?=.*?[A-Z])(?:(?=.*?[0-9])(?=.*?[-!@#$%^&*()_[\]{},.<>+="£:;\'~`|\/\\\\])|(?=.*?[a-z])(?:(?=.*?[0-9])|(?=.*?[-!@#$%^&*()_[\]{},.<>+="£:;\'~`|\/\\\\])))|(?=.*?[a-z])(?=.*?[0-9])(?=.*?[-!@#$%^&*()_[\]{},.<>+="£:;\'~`|\/\\\\]))[A-Za-z0-9-!@#$%^&*()_[\]{},.<>+="£:;\'~`|\/\\\\]{6,50}$/' ],
        ]);

        $user = User::where('uuid', $request->uuid)->first();
        if($user->uuid != Auth()->user()->uuid && $user->group <= Auth()->user()->group) {
            return response()->json(['success' => false], 400);
        }

        $user->forceFill([
            'password' => Hash::make($request->password)
        ]);
        $user->save();

        return response()->json(['success' => true]);
    }
}