<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PunishmentProof extends Model {

    protected $connection = "mysql";

    public function ban() {
        return $this->hasOne(PunishmentHistory::class);
    }

}
