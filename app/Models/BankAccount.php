<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class BankAccount extends Model
{
    use HasFactory;
       protected $fillable = [
       'user_id', 'account_number', 'bank_name', 'ifsc_code', 'account_holder_name', 'name_for_cheque', 'zell_id'
      
    ];
    public function user()
    {
        return $this->belongsTo(User::class);

    }
	
}

