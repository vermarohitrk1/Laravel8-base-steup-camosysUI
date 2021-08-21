<?php


namespace App\Http\Controllers\Auth;


use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Socialite;
use Exception;
use Auth;


class FacebookController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
        

              $name= $user->getName();
              $email= $user->getEmail();
              $facebook_id= $user->getId();
              $subdomain= '';
        

            $finduser = User::where('facebook_id', $facebook_id)->first();
     
            if($finduser){
     
                Auth::login($finduser);
    
                return redirect('/home');
     
            }
            else{


               //$adminstrator_role = Role::where('slug','administrator')->first();
        $caretaker_role = Role::where('slug', 'caretaker')->first();
        
        $user=User::create([
            'name' => $name,
            'email' => $email,
            'facebook_id' => $facebook_id,
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

   //  dd($e);
            return redirect('auth/facebook');


        }
    }
}