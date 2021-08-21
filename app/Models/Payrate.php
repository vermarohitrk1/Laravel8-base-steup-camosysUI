<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Payrate extends Model
{
    use HasFactory;
       protected $fillable = [
       'user_id',
       'hourly_rate', 'payout_type','daily_rate', 'weekly_rate', 'monthly_rate', 'overtime_rate', 'working_shift', 'clock_in', 'clock_out', 'default_payout_method', 'pay_schedule', 'payout_date', 'threshold',
      
    ];
    public function user()
    {
        return $this->belongsTo(User::class);

    }
	
}

