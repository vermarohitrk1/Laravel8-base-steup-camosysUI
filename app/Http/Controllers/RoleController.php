<?php
namespace App\Http\Controllers;

use Auth;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{   

	public function index()
	{
		$user= Auth::user();
		$roles= DB::table('roles')->where('user_id',$user->id)->orWhere('default_role',1)->get();
		$permissions = Permission::all();
		return view('admin.roles.index', compact('user','roles','permissions'));
	}

	public function store(Request $request)
	{
		$user= Auth::user();
		$this->validate($request, ['name' => 'required']);

		$slug = self::slugify($request->name,'roles');
		
		
		$perm = new Role;
		$perm['name'] = $request->name;
		$perm['user_id'] = $user->id;
		$perm['slug'] = $slug;
		$perm->save();
		
		$role = Role::where('id', $perm->id)->first();
		foreach($request->input('permission') as $key => $value)
		{
			$perm = Permission::where('id',$key)->first();
				if($value == 'true'){
					$hasPermission = DB::table('roles_permissions')->where('role_id',$role->id)->where('permission_id',$key)->count();
					if($hasPermission <= 0){
						$role->permissions()->attach($perm);
					}
			}else{
				$role->permissions()->detach($perm);
			}
		}

		 return response()->json(responder("success", "Role Added", "Role successfully added", "reload()"));
		
	}
	
	public function edit(Request $request)
    {
		$role = Role::where('id',$request->id)->first();
		$permissions = Permission::all();
		return view('ajax.roleupdate', compact('role','permissions'));

	}
	public function update(Request $request)
    {

		// $slug = self::slugify($request->name, 'roles');
		// $ifExist = Role::Where('slug', 'like', '%' . $slug . '%')->count();
		// if($ifExist > 0){
		// 		$slug .= '-'.$ifExist;
		// }

		$data = array(
			'name' => $request->name
            );
			Role::where('id',$request->id)->update($data);
			$role =  Role::where('id', $request->id)->first();
			foreach($request->input('permission') as $key => $value)
				{
					$perm = Permission::where('id',$key)->first();
						if($value == 'true'){
							$hasPermission = DB::table('roles_permissions')->where('role_id',$role->id)->where('permission_id',$key)->count();
							if($hasPermission <= 0){
								$role->permissions()->attach($perm);
							}
					}else{
						$role->permissions()->detach($perm);
					}
				}
				return response()->json(responder("success", "Role Updated", "Role successfully updated", "reload()"));
        
	}
	
	public function destroy(Role $role)
    {
		$delete = Role::where('id','=',$role->id)->delete();
		$arr = array();
		$arr['status'] = 200;
		return response()->json([
			'message' => 'success',
		]);
	}
	
	public function permission(Request $request)
    {
		$permissions = Permission::all();
		$role = Role::where('id',$request->id)->first();
		return view('ajax.permission',compact('permissions','role'));
	}

	public function assignPermission(Request $request)
	{ 
		
		$role = Role::where('id', $request->id)->first();
		foreach($request->input('permission') as $key => $value)
		{
			$perm = Permission::where('id',$key)->first();
				if($value == 'true'){
					$hasPermission = DB::table('roles_permissions')->where('role_id',$role->id)->where('permission_id',$key)->count();
					if($hasPermission <= 0){
						$role->permissions()->attach($perm);
					}
			}else{
				$role->permissions()->detach($perm);
			}
		}
	}

	
		public function slugify($text,$tblname)
	   {
		 $text = preg_replace('~[^\pL\d]+~u', '-', $text);
		 $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		 $text = preg_replace('~[^-\w]+~', '', $text);
		 $text = trim($text, '-');
		 $text = preg_replace('~-+~', '-', $text);
		 $slug = strtolower($text);
	   
		 if (empty($slug)) {
		   return 'n-a';
		 }

		 if(DB::table($tblname)->Where('slug', 'like', '%' . $slug . '%')->count() > 0){
            $end =array();
            foreach(DB::table($tblname)->Where('slug', 'like', '%' . $slug . '%')->pluck('slug')->toArray() as $slugs){
                $array = explode('-',$slugs);
               $end[] = end($array);
            }
            $max = array_filter($end, 'is_numeric');
            if(!empty($max)){
                $ifExist = max($max) + 1;
                $slug .= '-'.$ifExist;
            }else{
                $slug .= '-1';
            }
            }
		 return $slug;
		
	   }
	
	   public function make_default(Request $request)
	   {
		Role::where('id',$request->id)->update(['default_role'=>(bool)$request->default_role]);
		return true;
	   }
	   
}
