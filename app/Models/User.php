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

    protected $appends = [ 'username', 'group_name' ];

    /**
     * Add the username to the player
     */
    public function getUsernameAttribute() {
        return PlayerCache::get($this->uuid)->username;
    }

    /**
     * Get user group as name
     */
    public function getGroupNameAttribute() {
        foreach($this->getGroups() as $name => $id) {
            if($this->group == $id) return $name;
        }
    }

    /**
     * Get names to ID
     *
     * @return void
     */
    public static function getGroups() {
        return [
            "FOUNDER" => 1,
            "ADMIN" => 2,
            "MODERATOR" => 3,
            "TRAINEE-MOD" => 4
        ];
    }
}
