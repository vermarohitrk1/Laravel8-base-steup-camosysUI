<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use App\Permissions\HasPermissionsTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable,HasPermissionsTrait;
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
		'subdomain',
        'google_id',
        'facebook_id',
        'github_id',
		'lname'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userhasRole($user, $role)
    {
        return (bool) DB::table('users_roles')->where('role_id',$role)->where('user_id',$user)->count();

    }
    public function hasplan($id)
    {
        return DB::table('plans')->where('id',$id)->first();
    }
    
    public function profile(){
        return $this->hasOne(Profile::class);
    }
    public function employments(){
        return $this->hasOne(Employment::class);
    }
    public function qualifications(){
        return $this->hasMany(UsersQualification::class);
    }
    public function usersWorkingDays(){
        return $this->hasOne(UsersWorkingDay::class);
    }
    public function payrate(){
        return $this->hasOne(Payrate::class);
    }
    public function bankAccounts(){
        return $this->hasOne(BankAccount::class);
    }
    public function user_subscription(){
        return $this->hasOne(Subscription::class);
    }
    public function has_products($p_id, $s_id) {
        return DB::table('subscriptions_products')->where('product_id',$p_id)->where('subscription_id',$s_id)->first();
    }
    
}

