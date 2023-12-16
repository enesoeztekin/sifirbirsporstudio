<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Package;

class Membership extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'package_id',
        'member_id',
        'starting_date',
        'expiration_date',
    ];

    protected $casts = [
        'starting_date' => 'date',
        'expiration_date' => 'date',
    ];

    public function package() {
        return $this->belongsTo(Package::class, 'package_id');
    }
}
