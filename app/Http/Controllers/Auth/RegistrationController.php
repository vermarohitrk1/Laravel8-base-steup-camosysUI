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


class RegistrationController extends Controller
{
    
    protected function index()
    {
        return view('auth.caregiver_registration');
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


    protected function store(Request $request)
    {
       // dd($request);
        $this->validate($request, [
          'name' => ['required', 'string', 'max:255'],
          'email' => 'required|email|unique:users',
         'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
		$name= $request->input('name');
        $email= $request->input('email');
        $password= $request->input('password');
        $subdomain= '';
		
		//$adminstrator_role = Role::where('slug','administrator')->first();
		$caretaker_role = Role::where('slug', 'caretaker')->first();
		
		$user=User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
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
}
