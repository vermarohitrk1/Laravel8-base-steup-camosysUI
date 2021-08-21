<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Subscription extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);

    }
    
    public function plan()
    {
        return $this->belongsTo(Plan::class);

    }
    public function products() {
        return $this->belongsToMany(Product::class,'subscriptions_products');
     }
}

