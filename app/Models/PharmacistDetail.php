<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacistDetail extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'license_number',
        'license_expiry',
        'specialization',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
