<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationDetail extends Model
{
    protected $fillable = [
        'quotation_id',
        'drug_name',
        'net_unit_cost',
        'qty',
        'total',
    ];

    public function quotation()
    {
    	return $this->belongsTo(Quotation::class, 'quotation_id', 'id');
    }

}
