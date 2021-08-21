<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class UsersQualification extends Model
{
    use HasFactory;
	
	public function users() {

	   return $this->belongsToMany(User::class);
		   
	}
}