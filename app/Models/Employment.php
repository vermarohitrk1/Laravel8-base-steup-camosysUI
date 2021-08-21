<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Employment extends Model
{
    use HasFactory;
       protected $fillable = [
        'user_id', 'credentials_number', 'last_working_day', 'termination_date', 'termination_note', 'hire_date', 'previous_terminate_date', 're_hire_date', 'notice_period', 'company_id',
      
    ];
    public function user()
    {
        return $this->belongsTo(User::class);

    }
	
}

