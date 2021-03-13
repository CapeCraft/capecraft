<?php

namespace App\Models;

use Hoyvoy\CrossDatabase\Eloquent\Model;

class Punishment extends Model {

    protected $table = "Punishments";
    protected $connection = "capecraft";
    public $timestamps = false;

}
