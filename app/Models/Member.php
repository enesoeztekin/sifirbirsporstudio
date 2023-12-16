<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Membership;

class Member extends Model
{
    use HasFactory;

    public function membership() {
        return $this->hasOne(Membership::class);
    }
}
