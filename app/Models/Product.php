<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Product extends Model
{
    use HasFactory;
	
	public function pricetiers()
    {
        return $this->hasMany(PriceTier::class);
    }
    public function plans() {

        return $this->belongsToMany(Plan::class,'plans_products');
            
     }

     public function user() {
        return $this->belongsToMany(User::class,'user_products');
            
     }
}
