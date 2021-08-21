<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class PriceTier extends Model
{
    use HasFactory;
    protected $fillable =[
        'product_id', 'up_to', 'amount',
    ];
    public function products()
    {
        return $this->belongsTo(Product::class);
    }
	
}

