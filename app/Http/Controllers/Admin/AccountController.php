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

}