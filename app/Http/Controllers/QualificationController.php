<?php
namespace App\Http\Controllers;

use Auth;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UsersQualification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class QualificationController extends Controller
{   

	public function index()
	{
		$user= Auth::user();
		$facility ="";
		return view('ajax.user_qualification');
	}

	public function create()
	{
	}

	public function store(Request $request)
	{

		return response()->json(responder("success", "Facility Created", "Facility successfully created", "reload()")); 
	}
	
	public function edit(Request $request)
    {
		//
	}
		
	public function show($id)
    {

	}
	
	public function update(Request $request)
    {

		foreach($request->qualifications as $key => $qualification)
		{
			if($qualification['id'] <= 0){
			$qualific = new UsersQualification;
			$qualific['user_id'] = $request->u_id;
			$qualific['title']= $qualification['qualification'];
			$qualific['credentials_number']=$qualification['cr_number'];
			$qualific['expire_date']= $qualification['expire_date'];
			$qualific->save();
			}else{
			$qualific = array(
			'title' => $qualification['qualification'],
			'credentials_number' => $qualification['cr_number'],
			'expire_date' => $qualification['expire_date']
			);
			$qualific = UserQualification::update($qualific)->where('id',$qualification['id']);
			}
		}
		return response()->json(responder("success", "Qualifications Updated", "Qualifications successfully updated", "reload()")); 
	}

	public function destroy(Role $role)
    {
		//
	}

	
	   
}
