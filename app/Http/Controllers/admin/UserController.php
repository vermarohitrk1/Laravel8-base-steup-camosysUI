<?php
namespace App\Http\Controllers\admin;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{   

	public function index()
	{
		$user= Auth::user();
		$users= User::all()->except(Auth::id());
		return view('admin.users', compact('users'));
	}

	public function store(Request $request)
	{
		$this->validate($request, ['name' => 'required']);

		$user= Auth::user();
		$perm = new Role;
		$perm['name'] = $request->name;
		$perm['slug'] = $request->slug;
		$perm->save();
		$perm['status'] = 'success';
		return response()->json(responder("success", "User Added", "User successfully added", "reload()"));
	}
	
	public function edit(Request $request)
    {
		$content = Role::where('id',$request->id)->first();
		return view('ajax.roleupdate', compact('content'));

	}
	public function update(Request $request)
    {
		$data = array(
            'name' => $request->name,
            'slug' => $request->slug
            );
            Role::where('id',$request->id)->update($data);
            return response()->json([
                'message' => 'success',
            ]);
        
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
	
	public function role(Request $request)
    {
        $user = User::where('id',$request->id)->first();
		$roles = Role::all();
		return view('ajax.user-role',compact('user','roles'));
	}

	public function assignRole(Request $request)
	{ 
            $user = User::where('id', $request->id)->first();
            foreach($request->input('role') as $key => $value)
            {
                $role = Role::where('id', $key)->first();
                    if($value == 'true'){
                        $hasRole = DB::table('users_roles')->where('role_id',$key)->where('user_id',$request->id)->count();
                        if($hasRole <= 0){
                            $user->roles()->attach($role);
                        }
                }else{
                    $user->roles()->detach($role);
                }
            }
	}
}
