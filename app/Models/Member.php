<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Membership;
use App\Models\Measurement;
use App\Models\Transaction;

class Member extends Model
{
    use HasFactory;

    public function membership() {
        return $this->hasOne(Membership::class);
    }

    public function measurements() {
        return $this->hasMany(Measurement::class);
    }

    public function transaction() {
        return $this->hasMany(Transaction::class);
    }
}
