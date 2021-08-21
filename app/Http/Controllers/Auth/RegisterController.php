<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
	public function subdomaincheck(Request $request){
      //$user = Register::where('email', Input::get('email'))->get();
      $user = User::where('subdomain', $request->subdomain)->get();
        if($user->count()) {
            return response()->json([
			'message' => 'success',
		]);
        }
        return  response()->json([
			'message' =>'Failed'
		]);  
    
	}
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
			'subdomain' => ['required', 'string', 'min:3','unique:users'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
 	public function  showRegistrationForm(){
			
		  $currentURL = \URL::current();
		$currentURL = preg_replace("(^https?://)", "", $currentURL);
		$urlparts = explode('.', $currentURL);
		$subdomain =$urlparts[0];
		if($subdomain==''||$subdomain==null||$subdomain=='www'||$subdomain=='camosys' ){
					$subdomain ='';
		}
		   return view('auth.register')->with(['subdomain' => $subdomain]);
	 } 
    protected function create(array $data)
    {
		//dd($data);
		$role='';
		$currentURL = \URL::current();
		$currentURL = preg_replace("(^https?://)", "", $currentURL);
		$urlparts = explode('.', $currentURL);
		$subdomain = $urlparts[0];
		$adminstrator_role = Role::where('slug','administrator')->first();
		$caretaker_role = Role::where('slug', 'caretaker')->first();
		if($subdomain!=''&&$subdomain!=null&&$subdomain!='www' ){
			$role=$adminstrator_role;
			$subdomain=$data['subdomain'];
		}else{
			$role=$caretaker_role;
		}
		$user=User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
			'subdomain' => $subdomain,
        ]);
		 $user->roles()->attach($role);
		 
        return $user;
    }
}
