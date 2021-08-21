<?php
namespace App\Http\Controllers;

use Auth;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{   

    public function Permission()
    {   
    	//$dev_permission = Permission::where('slug','create-tasks')->first();
		//$manager_permission = Permission::where('slug', 'edit-users')->first();

		//RoleTableSeeder.php
		$caretaker_role = new Role();
		$caretaker_role->slug = 'caretaker';
		$caretaker_role->name = 'Care taker';
		$caretaker_role->save();
		//$caretaker->permissions()->attach($dev_permission);

		$administrator_role = new Role();
		$administrator_role->slug = 'administrator';
		$administrator_role->name = 'Administrator';
		$administrator_role->save();
		//$manager_role->permissions()->attach($manager_permission);

		$caretaker_role = Role::where('slug','caretaker')->first();
		$administrator_role = Role::where('slug', 'administrator')->first();

		$createTasks = new Permission();
		$createTasks->slug = 'create-tasks';
		$createTasks->name = 'Create Tasks';
		$createTasks->save();
		$createTasks->roles()->attach($administrator_role);

		$editUsers = new Permission();
		$editUsers->slug = 'edit-users';
		$editUsers->name = 'Edit Users';
		$editUsers->save();
		$editUsers->roles()->attach($caretaker_role);

		$dev_role = Role::where('slug','developer')->first();
		$manager_role = Role::where('slug', 'manager')->first();
		$dev_perm = Permission::where('slug','create-tasks')->first();
		$manager_perm = Permission::where('slug','edit-users')->first();


		$developer = new User();
		$developer->name = 'kuldeep Singh';
		$developer->email = 'kuldeep@gmail.com';
		$developer->password = bcrypt('12345678');
		$developer->save();
		$developer->roles()->attach($dev_role);
		$developer->permissions()->attach($dev_perm);

		$manager = new User();
		$manager->name = 'Sekhon Lucky';
		$manager->email = 'sekhon@gmail.com';
		$manager->password = bcrypt('12345678');
		$manager->save();
		$manager->roles()->attach($manager_role);
		$manager->permissions()->attach($manager_perm);

		
		return redirect()->back();
    }
	
	function permit(Request $request){
		$user = $request->user();
		foreach( $request->user()->roles as $role){
			echo"<pre>";
			echo $role->name;
			echo"</pre>";
		}
		echo $user->can('create-tasks')."<br> developer";
		dd($user->hasRole('developer')); 		
		dd($user->can('permission-slug'));
		
		dd($user->givePermissionsTo('create-tasks'));
		echo($user->can('create-tasks')); 
	}

	public function index()
	{
		$user= Auth::user();
		$permissions= Permission::all();
		return view('admin.permissions.index', compact('user','permissions'));
	}

	public function store(Request $request)
	{
		$user= Auth::user();
		$this->validate($request, ['name' => 'required']);

		$slug = self::slugify($request->name);
		$ifExist = Permission::Where('slug', 'like', '%' . $slug . '%')->count();
			if($ifExist > 0){
					$slug .= '-'.$ifExist;
			}

		$perm = new Permission;
		$perm['name'] = $request->name;
		$perm['slug'] = $slug;
		$perm->save();
		$perm['status'] = 'success';
		return response()->json(responder("success", "Permission Added", "Permission successfully added", "reload()"));
	}
	
	public function edit(Request $request)
    {
		$content = Permission::where('id',$request->id)->first();
		// dd(view('includes.ajax.permissionupdate')->with('content',$content));
		return view('ajax.permissionupdate', compact('content'));

	}
	public function update(Request $request)
    {
		$slug = self::slugify($request->name);
				$this->validate($request, ['name' => 'required']);

		$ifExist = Permission::Where('slug', 'like', '%' . $slug . '%')->count();
			if($ifExist > 0){
					$slug .= '-'.$ifExist;
			}
		$data = array(
            'name' => $request->name
            );
		Permission::where('id','=',$request->id)->update($data);
		
		return response()->json(responder("success", "Permission Updated", "Permission successfully updated", "reload()"));
	}
	
	public function destroy(Permission $permission)
    {
		$delete = Permission::where('id','=',$permission->id)->delete();
		$arr = array();
		$arr['status'] = 200;
		return response()->json([
			'message' => 'success',
		]);
	}
	
	public function slugify($text)
	   {
		 $text = preg_replace('~[^\pL\d]+~u', '-', $text);
		 $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		 $text = preg_replace('~[^-\w]+~', '', $text);
		 $text = trim($text, '-');
		 $text = preg_replace('~-+~', '-', $text);
		 $text = strtolower($text);
	   
		 if (empty($text)) {
		   return 'n-a';
		 }
		 return $text;
	   }
}
