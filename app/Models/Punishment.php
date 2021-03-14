<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Punishment extends Model {

    protected $table = "Punishments";
    protected $connection = "capecraft";
    public $timestamps = false;

}
