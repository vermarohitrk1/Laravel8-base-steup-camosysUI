<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Plan extends Model
{
    use HasFactory;
	public function products() {

	   return $this->belongsToMany(Product::class,'plans_products');
		   
	}
	public function plansfeatures()
    {
        return $this->hasMany(PlanFeature::class);
    }
	public function users_subs(){
        return $this->hasMany(Subscripton::class);
    }
}
