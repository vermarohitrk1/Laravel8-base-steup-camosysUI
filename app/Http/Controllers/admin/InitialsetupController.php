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

class InitialsetupController extends Controller
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
         $planIds =  array();
        $path = base_path('.env');
        $planIdData =array();
        $env =array();
         $stripe_settings =array();
         $email_settings =array();
         $aws_settings =array();
         
        if (file_exists($path)){
            $env['MODE']= env('MODE');
            $database_settings['APP_NAME']= env('APP_NAME');
            $database_settings['DB_DATABASE']= env('DB_DATABASE');
            $database_settings['DB_USERNAME']= env('DB_USERNAME');
            $database_settings['DB_PASSWORD']= env('DB_PASSWORD');
            $database_settings['DB_HOST']= env('DB_HOST');
            
   
        }
        //dd($database_settings);
        $layout="form"; 
        return view('admin.Initialsetup')->with(["database_settings"=> $database_settings]);
       // return view('admin.Initialsetup');
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
		 $admin= User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
			'lname'=> $request->input('name'),
            'password' => Hash::make($request->input('password')),
        ]); 
		$administrator_role = new Role();
		$administrator_role->slug = 'administrator';
		$administrator_role->name = 'Administrator';
		$administrator_role->user_id = $admin->id;
		
		$administrator_role->save();

		$caretaker_role = new Role();
		$caretaker_role->slug = 'caretaker';
		$caretaker_role->name = 'Care taker';
		$caretaker_role->user_id = $admin->id;
		$caretaker_role->save();

		
		$superadmin_role = new Role();
		$superadmin_role->slug = 'superadmin';
		$superadmin_role->name = 'Super Admin';
		$superadmin_role->user_id = $admin->id;

		$superadmin_role->save();
		
		$administrator_role = Role::where('slug','administrator')->first();
		$superadmin_role = Role::where('slug', 'superadmin')->first();
		$caretaker_role = Role::where('slug', 'caretaker')->first();

		$createTasks = new Permission();
		$createTasks->slug = 'manage-facility';
		$createTasks->name = 'Manage Facility';
		$createTasks->save();

		$editUsers = new Permission();
		$editUsers->slug = 'manage-staff';
		$editUsers->name = 'Manage Staff';
		$editUsers->save();


		//$createTasks = Permission::where('slug','create-tasks')->first();
		//$editUsers = Permission::where('slug','edit-users')->first();
		
		$superadmin_permission = Permission::all();
		$superadmin_role->permissions()->attach($superadmin_permission);
		$administrator_role->permissions()->attach($createTasks);
		$caretaker_role->permissions()->attach($editUsers);
       //dd($request);
          
				 $admin->roles()->attach($superadmin_role);

           //dd($admin);
       return $admin;
        
        
    
    }
     public function envfile(Request $request)
    {
        $vals=array();
          
        foreach ($request->except('_token') as $key => $value) {
        //$vals[$key]=$part;

        $this->envUpdate($key, $value);
        }
     
     // $eventDetail = $request->input('envdetail');
        //$updatedenv =array();
        /// dd( $eventDetail['STRIPE_KEY']);
       /*  foreach ($eventDetail as $key => $value) {
            $updatedenv[]= $this->envUpdate($key, $value);
        } */
        return view('admin.setup')
            ->with('message','Information added successfully.');
    }
        public function envUpdate($key, $value)
    {
       // dd($key,$value);
        $path = base_path('.env');
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                $key . '=' . env($key), $key . '=' . $value,
                file_get_contents($path)
            ));
            $data = 1;
        }
        else{
            $data = 0;
        }
        return $data;
    }
}
