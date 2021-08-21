<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
//use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Permission;
use App\Models\Role;

//use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SetupController extends Controller
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

    //use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
   // protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
  
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function index()
    {
        return view('admin.Initialsetup');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

   

     public function store(Request $request)
    {

		//RoleTableSeeder.php
		$caretaker_role = new Role();
		$caretaker_role->slug = 'caretaker';
		$caretaker_role->name = 'Care taker';
		$caretaker_role->save();

		$administrator_role = new Role();
		$administrator_role->slug = 'administrator';
		$administrator_role->name = 'Administrator';
		$administrator_role->save();

		$superadmin_role = new Role();
		$superadmin_role->slug = 'superadmin';
		$superadmin_role->name = 'Super Admin';
		$superadmin_role->save();
		
		$administrator_role = Role::where('slug','administrator')->first();
		$superadmin_role = Role::where('slug', 'superadmin')->first();
		$caretaker_role = Role::where('slug', 'caretaker')->first();

		$createTasks = new Permission();
		$createTasks->slug = 'create-tasks';
		$createTasks->name = 'Create Tasks';
		$createTasks->save();

		$editUsers = new Permission();
		$editUsers->slug = 'edit-users';
		$editUsers->name = 'Edit Users';
		$editUsers->save();


		//$createTasks = Permission::where('slug','create-tasks')->first();
		//$editUsers = Permission::where('slug','edit-users')->first();
		
		$superadmin_permission = Permission::all();
		$superadmin_role->permissions()->attach($superadmin_permission);
		$administrator_role->permissions()->attach($createTasks);
		$caretaker_role->permissions()->attach($editUsers);
       //dd($request);
           $admin= User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]); 
				 $admin->roles()->attach($superadmin_role);

           dd($admin);
       return $admin;
        
        
    
    }
}
