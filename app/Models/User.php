<?php

namespace App\Models;

use App\Classes\PlayerCache;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use HasApiTokens, Notifiable;


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [ 'username' ];

    /**
     * Add the username to the player
     */
    public function getUsernameAttribute() {
        return PlayerCache::get($this->uuid)->username;
    }
}
