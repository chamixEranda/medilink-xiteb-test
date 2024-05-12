<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
        'user_id',
        'images',
        'delivery_address',
        'delivery_note',
        'delivery_time',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
