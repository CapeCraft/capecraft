<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PunishmentHistory extends Model {

    protected $table = "PunishmentHistory";
    protected $connection = "capecraft";
    public $timestamps = false;

    protected $with = ['proof'];

    /**
     * Get proof model
     *
     * @return void
     */
    public function proof() {
        return $this->hasMany(PunishmentProof::class);
    }

    /**
     * Find punishments which have active proof
     *
     * @param  mixed $query
     * @param  mixed $hasProof
     * @return void
     */
    public function scopeHasProof($query, $hasProof) {
        if(!$hasProof) {
            $proofIds = PunishmentProof::select('punishment_history_id')->distinct()->get();
            return $query->orderBy('id', 'DESC')->whereNotIn('id', $proofIds);
        } else {
            return $query->orderBy('id', 'DESC');
        }
    }

    /**
     * Find punishments by ID
     *
     * @param  mixed $query
     * @param  mixed $id
     * @return void
     */
    public function scopeById($query, $id) {
        return $query->where('id', $id);
    }

    /**
     * Find punishments by player/operator
     *
     * @param  mixed $query
     * @param  mixed $player
     * @return void
     */
    public function scopeByPlayer($query, $player) {
        return $query->where('uuid', $player->uuid)->orWhere('operator', $player->username);
    }

    /**
     * Find a punishment by a legacy player
     *
     * @param  mixed $query
     * @param  mixed $string
     * @return void
     */
    public function scopeByLegacyName($query, $string) {
        return $query->where('name', 'like', "%$string%");
    }

    /**
     * Find punishments by reason
     *
     * @param  mixed $query
     * @param  mixed $string
     * @return void
     */
    public function scopeByReason($query, $string) {
        return $query->where('reason', 'like', "%$string%");
    }
}
