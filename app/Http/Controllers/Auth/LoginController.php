<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    protected $maxAttempts = 2; // Default is 5
    protected $decayMinutes = 2; // Default is 1
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
	   // protected $redirectTo = '/home';
	   
    protected function redirectTo()
    {
        
        if(auth()->user()->hasRole('superadmin')){
            return '/admin/ecommerce-dashboard';
        }else{
            return '/admin/profile';
        }
        
         $role = auth()->user()->role; 
        switch ($role) {
            case 'superadmin':
                    return '/admin/ecommerce-dashboard';
                break;
            case 'manager':
                    return '/projects';
                break; 
            default:
                    return '/admin/profile'; 
                break;
        }
    }
 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
	 public function showLoginForm(){
		 $currentURL = \URL::current();
		$currentURL = preg_replace("(^https?://)", "", $currentURL);
		$urlparts = explode('.', $currentURL);
		$subdomain =$urlparts[0];
		if($subdomain==''||$subdomain==null||$subdomain=='www'||$subdomain=='camosys' ){
					$subdomain ='';
		}
		   return view('auth.login')->with(['subdomain' => $subdomain]);
	 }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    
}
