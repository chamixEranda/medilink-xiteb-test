<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'prescription_id',
        'total_cost',
        'status'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function prescription()
    {
    	return $this->belongsTo(Prescription::class, 'prescription_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(QuotationDetail::class);
    }

}
