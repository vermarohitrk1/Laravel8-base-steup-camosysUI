<?php
namespace App\Http\Controllers;

use Auth;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UsersWorkingDay;
use App\Models\Payrate;
use App\Models\BankAccount;
use App\Models\Employment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class EmploymentController extends Controller
{   

	public function index()
	{
		$user= Auth::user();
		
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
	
	public function update_employment(Request $request)
    {
        $user = User::where('id',$request->id)->where('parent_id',Auth::user()->id)->first();
        
        Employment::UpdateOrCreate(
            ["user_id" => $user->id ], 
            [
              'hire_date' => $request->hire_date,
               'credentials_number' => $request->credentials_number,
            ]);
        $working_day = UsersWorkingDay::UpdateOrCreate(
        ["user_id" => $user->id ], 
        [
        "sunday" => filter_var($request->working_sun,FILTER_VALIDATE_BOOLEAN),
        "monday" => filter_var($request->working_mon,FILTER_VALIDATE_BOOLEAN),
        "tuesday" => filter_var($request->working_tue,FILTER_VALIDATE_BOOLEAN),
        "wednesday" => filter_var($request->working_wed,FILTER_VALIDATE_BOOLEAN),
        "thursday" => filter_var($request->working_thu,FILTER_VALIDATE_BOOLEAN),
        "friday" => filter_var($request->working_fri,FILTER_VALIDATE_BOOLEAN),
        "saturday" => filter_var($request->working_sat,FILTER_VALIDATE_BOOLEAN),
        ]);
         
        $payrates = Payrate::UpdateOrCreate(
            ["user_id" => $user->id ], 
            [
            'payout_type' => $request->payout_type,
            $request->payout_type.'_rate' => $request->pay_rate,
            'overtime_rate' => $request->overtime_rate,
            'working_shift' => $request->working_shift,
            'clock_in' => $request->clock_in,
            'clock_out' => $request->clock_out,
            'default_payout_method' => $request->payout_method,
            'pay_schedule' => $request->pay_schedule,
            'payout_date' => $request->payout_date,
            ]);
    
        $bank = BankAccount::UpdateOrCreate(
            ["user_id" => $user->id ], 
            [
            'account_number' => $request->acc_number,
            'account_holder_name' => $request->acc_name,
            'bank_name' => $request->bank_name,
            'ifsc_code' => $request->ifcs,
            'name_for_cheque' => $request->cheque_name,
            'zell_id' => $request->zell_id,
                ]);
                if($working_day || $payrates || $bank)
                {
                    return response()->json(responder("success", "Setting Updated", "Employment setting successfully updated!", "reload()")); 

                }else{
                    return response()->json(responder("error", "Oops..!", "Something went wrong, Please try again later.", "reload()")); 

                }
	}

	public function destroy(Role $role)
    {
		//
	}

	
	   
}
