<?php 

namespace App\Http\Controllers\Auth;


use App\Models\User;
use App\Models\Role;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Socialite;
use Auth;
use Exception;


class LinkdinController extends Controller
{


    //use AuthenticatesAndRegistersUsers, ThrottlesLogins;


    protected $redirectTo = '/';


    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }


    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }


    public function redirectToLinkedin()
    {
        return Socialite::driver('linkedin')->redirect();
    }


    public function handleLinkedinCallback()
    {
        try {
            $user = Socialite::driver('linkedin')->user();
            $name = $user->name;
            $email = $user->email;
            $linkedin_id = $user->id;
            $subdomain = '';



            $finduser = User::where('facebook_id', $facebook_id)->first();
     
            if($finduser){
     
                Auth::login($finduser);
    
                return redirect('/home');
     
            }
            else{
             $caretaker_role = Role::where('slug', 'caretaker')->first();
            
        
        $user=User::create([
            'name' => $name,
            'email' => $email,
            'facebook_id' => $linkedin_id,
            'subdomain' => $subdomain,
        ]);
         $user->roles()->attach($caretaker_role);
         
        
        if(!$user){
           
                return redirect()->to('/caregiver_register');
        }
        else{
           auth()->login($user);

        return redirect()->to('/home');

        }
        }
        } catch (Exception $e) {
            dd($e);
            return redirect('auth/linkedin');
        }
    }
}