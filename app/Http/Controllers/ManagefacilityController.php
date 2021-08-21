<?php
namespace App\Http\Controllers;

use Auth;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ManagefacilityController extends Controller
{   

	public function index()
	{
		$user= Auth::user();
		if(!$user->can('manage-facility')){
			abort(401);
		}
		$user= Auth::user();
		$facility ="";
		return view('admin.facility.facilitylist');
	}

	public function create()
	{
		$user= Auth::user();
		return view('admin.facility.addfacility');
	}

	public function store(Request $request)
	{
		$request->validate([
            'name' => 'required',
			'license' => 'required',
			'zip' =>  'required',
			'fname' =>'required',
			'lname' => 'required',
			'phone' => 'required',
			'email' => 'required',
		]);
		
        $facility = new Company;
        $facility['name']= $request->name;
        $facility['license'] = $request->license;
		$facility['address'] = $request->address;
		$facility['city'] = $request->city;
 		$facility['state'] = $request->state;
		$facility['zip'] = $request->zip;
		$facility['fname'] = $request->fname;
		$facility['lname'] = $request->lname;
		$facility['phone'] = $request->phone;
		$facility['alternate'] = $request->alternate_phone;
		$facility['fax'] = $request->fax;
		$facility['email'] = $request->email;
		$facility->save();
		
		return response()->json(responder("success", "Facility Created", "Facility successfully created", "reload()")); 
	}
	
	public function edit(Request $request)
    {
		//
	}
		
	public function show($id)
    {
		$user= Auth::user();
		$facility =Company::where('id',$id)->first();
		return view('admin.facility.managefacility', compact('facility'));

	}
	
	public function update(Request $request)
    {
		$request->validate([
            'name' => 'required',
			'license' => 'required',
			'zip' =>  'required',
			'fname' =>'required',
			'lname' => 'required',
			'phone' => 'required',
			'email' => 'required',
		]);
        $facility = array(
        'name' => $request->name,
        'license' => $request->license,
		'address' => $request->address,
		'city' => $request->city,
 		'state' => $request->state,
		'zip' => $request->zip,
		'fname' => $request->fname,
		'lname' => $request->lname,
		'phone' => $request->phone,
		'alternate' => $request->alternate_phone,
		'fax' => $request->fax,
		'email' => $request->email
		);
		$facility= Company::where('id', $request->id)->update($facility);
		
		return response()->json(responder("success", "Facility Updated", "Facility successfully updated", "reload()")); 
	}

	public function destroy(Role $role)
    {
		//
	}

	public function card(Request $request)
    {
		$facilities = Company::all();
		return view('ajax.facility-card',compact('facilities'));
	}
	
	   
}
