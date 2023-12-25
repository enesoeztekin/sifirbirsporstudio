<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected  $primaryKey = 'id';

    protected $fillable = [
        'package_name',
        'package_period',
        'package_cost',
        'is_student',
        'is_vip',
        // Diğer fillable özellikleriniz...
    ];

    public function memberships() {
        return $this->hasMany(Membership::class, 'package_id');
    }
}
