<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Profile extends Model
{
    use HasFactory;
       protected $fillable = [
        'user_id',
        'profile_img',
        'phone_number',
        'date_of_birth',
        'address',
        'Zipcode',
        'State',
    ];
    public function user()
{
    return $this->belongsTo('App\Models\User', 'user_id', 'id');
}
	
}
