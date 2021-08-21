<?php
namespace App\Http\Controllers;

use Auth;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\Profile;
use App\Models\Hiring;
use App\Models\UsersQualification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{   

	public function index()
	{
		
        $user= Auth::user();
        $profile = profile::all();
		return view('admin.user_profile');
	}

	public function store(Request $request)
	{
        
        $profile = new Profile;
        
        return true;
	}
	
	public function edit(Request $request)
    {
		//
	}
	
	public function update(Request $request)
    {
		//
	}

	public function destroy(Role $role)
    {
		//
	}
	public function profileimgsave(Request $request)
    {
      $image = $request->file('file');

      $new_name = rand() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('uploads/images'), $new_name);
     // dd('<img src="/images/'.$new_name.'" class="img-thumbnail" width="300" />');
      $user_id = $request->input('id');
                $user = User::find($user_id);

      if (Profile::where('user_id', '=', $user_id)->count() > 0) {
          $users = $user->profile()
                ->update([
             'profile_img'=> $new_name,
            
         ]);
         
      }
     else{
      
	       $profile = Profile::create([
             'user_id'=> $user_id,
             'profile_img'=> $new_name,
          
         ]);
        }
     // dd(User::all());
      return response()->json([
       'message'   => 'Image Upload Successfully',
       'uploaded_image' => '<img src="/images/'.$new_name.'" class="img-thumbnail" width="300" />',
       'class_name'  => 'alert-success'
      ]);
 
    }
	// public function updatehiredata(Request $request){
	// 	    $id = $request->input('id');
    //        $user = User::find($id);
    //   if (Hiring::where('user_id', '=', $id)->count() > 0) {
    //       $users = $user->hire()
    //             ->update([
    //          'hire_date'=> $request->input('hire_date'),
    //          'termination_date'=> $request->input('termination_date'),
    //          'credentials_number'=> $request->input('credentials_number'),
           
    //      ]);
        
    //   }
    //  else{
	//        $profile = Hiring::create([
	//        	 'user_id'=> $request->input('id'),
    //           'hire_date'=> $request->input('hire_date'),
    //          'termination_date'=> $request->input('termination_date'),
    //          'credentials_number'=> $request->input('credentials_number'),
             
    //      ]);
    //     }

	// }
	public function userupdateprofile(Request $request){
        $this->validate($request, ['name' => 'required','email' => 'required']);
       

           $id = $request->input('id');
           $user = User::find($id);
      if (Profile::where('user_id', '=', $id)->count() > 0) {
          $users = $user->profile()
                ->update([
             'zip'=> $request->input('zip'),
             'phone_number'=> $request->input('phone_number'),
             'address'=> $request->input('address'),
             'date_of_birth'=> $request->input('date_of_birth'),
             'state'=> $request->input('state'),
             'city'=> $request->input('city'),
             'country'=> $request->input('State'),
         ]);
         
      }
     else{
	       $profile = Profile::create([
             'user_id'=> $request->input('id'),
             'zip'=> $request->input('zip'),
             'address'=> $request->input('address'),
             'phone_number'=> $request->input('phone_number'),
             'date_of_birth'=> $request->input('date_of_birth'),
             'state'=> $request->input('state'),
             'city'=> $request->input('city'),
             'country'=> $request->input('State'),
         ]);
        }

    
        $userdetail = User::where('id', $id)
         ->update([
             'name'=> $request->input('name'),
             'lname' =>$request->input('lname'),
            
         ]);
             return response()->json(responder("success", "User Updated", "User successfully updated", "reload()"));


	}
	public function updateinfo(Request $request){
		if($request->input('type')=='update_employee'){
			$id = $request->input('id');

		     $user = User::with('profile')->where('id',$id)->first();
			return view('ajax/profile/user-profile-detail')->with(['user' => $user]);
		}elseif($request->input('type')=='update_role'){
            $id = $request->input('id');
            $user = User::where('id',$id)->first();
			$roles = Role::where('user_id', auth::user()->id)->orWhere('default_role', 1)->get();
			return view('ajax/profile/role_update', compact('user','roles'));
		}
		elseif($request->input('type')=='update_employee_hiring'){
            $id = $request->id;
		    $user = User::with('employments','usersWorkingDays','payrate','bankAccounts')->where('id',$id)->first();
			return view('ajax/profile/user-hiring-detail')->with(['user' => $user]);

		}

	}
	public function usereditprofile($id=null){

		$usersprofile = User::with('profile')->where('id',$id)->get();
          
		return view('admin.edit_user_profile')->with(['users' => $usersprofile]);
	}
	public function userprofile($id=null)
    {
    	$usersprofile = User::with('profile','qualifications')->where('id',$id)->first();
        $user_parent_id= Auth::user()->parent_id;

        $user_parent=  User::with('profile')->where('id',$user_parent_id)->first();
        
		return view('admin.user_profile')->with(['user' => $usersprofile,'user_parent'=> $user_parent]);

	}
	public function status_update(Request $requset)
    {
        $user = User::where('id',$requset->id)->first();
        $status=$requset->status;
        $update = User::where('id',$user->id)->update(['status'=>$status]);

        return true;
    }
	   
}
