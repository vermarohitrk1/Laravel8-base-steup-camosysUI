<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class UserRating extends Model
{
    use HasFactory;
       protected $fillable = [
       'user_id',
       'employment_id',
       'user_id',
       'title',
       'rating',
       'comments',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);

    }
	
}

