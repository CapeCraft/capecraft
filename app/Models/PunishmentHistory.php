<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PunishmentHistory extends Model {

    protected $table = "PunishmentHistory";
    protected $connection = "capecraft";

    protected $with = ['proof'];

    public function proof() {
        return $this->setConnection('mysql')->hasMany(PunishmentProof::class);
    }
}
