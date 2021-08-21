<?php
namespace App\Http\Controllers;

use Auth;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\Product;
use App\Models\Facility;
use App\Models\Profile;
use App\Models\Employment;
use App\Models\UserRating;
use App\Models\SubscriptionsProduct;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ManagestaffController extends Controller
{   


	public function index()
	{	
		
		$user= Auth::user();
		if(!$user->can('manage-staff')){
			abort(401);
		}
		$roles = Role::where('user_id',$user->id)->orWhere('default_role', 1)->get();
		return view('admin.managestaff', compact('roles'));
		
	}

	public function users_card(Request $request)
	{
		$sort = $request->sort;
		$order= $request->order;
		$status=$request->status;
		$role= $request->role;

		$user= Auth::user();
		$roles = Role::all();
		if($role != ''){
			$users = User::with('profile')->where('parent_id', $user->id)
			->when($status, function ($query) use ($status) {
				return $query->where('status', $status);
			})->join('users_roles', function ($join) use ($role) {
				$join->on('users_roles.user_id', '=', 'users.id')->when($role, function ($query) use ($role) {
					return $query->where('role_id', $role);
				});})->orderBy($sort, $order)->get();
			}else{
				$users = User::with('profile')->where('parent_id', $user->id)->when($status, function ($query) use ($status) {
					return $query->where('status', $status);
				})->orderBy($sort, $order)->get();
			}
		return view('ajax.users-card', compact('users', 'roles'));

		
	}

	public function store(Request $request)
	{ 
		//dd($request);
		$this->validate($request, ['email' => 'required']);
		$subs_id = User::find(Auth::user()->id)->user_subscription;
		$product_id = Product::where('slug','users')->first();
	 	$quantity = SubscriptionsProduct::where('subscription_id', $subs_id->id)->where('product_id', $product_id->id)->first();
	   if($quantity->quantity <= $quantity->used){
		return response()->json(responder("error", "Oops!", "Please Upgrade your Plan", "reload()"));

	   }

		$user = new User;
	   $user['name'] = $request->fname;
	   $user['lname'] = $request->lname;
	   $user['email'] = $request->email;
	   $user['parent_id'] = Auth::user()->id;
	   $user['password'] = Hash::make($request->password);
	   $user->save();

	   if($user){
		SubscriptionsProduct::where('subscription_id', $subs_id->id)->where('product_id', $product_id->id)->update(['used' => DB::raw('used+1')]);
		DB::table('subscriptions_products_uses')->insert([
			'subscription_id' => $subs_id->id,
			'user_id'=> Auth::user()->id,
			'product_id' => $product_id->id
		]);
		}
		$profile = new Profile;
		$profile['user_id']= $user->id;
		$profile->save();
		foreach($request->input('roles') as $key => $value)
		{
			$role = Role::where('id',$key)->first();
				if($value == 'true'){
					$hasRole = DB::table('users_roles')->where('user_id',$user->id)->where('role_id',$key)->count();
					if($hasRole <= 0){
						$user->roles()->attach($role);
					}
			}else{
				$user->roles()->detach($role);
			}
		}
	//    Mail::send(['text'=>'mail'], $data, function($message) {
	// 	$message->to('abc@gmail.com', 'Tutorials Point')->subject
	// 	   ('Laravel Basic Testing Mail');
	// 	$message->from('xyz@gmail.com','Virat Gandhi');
	//  });

       		 return response()->json(responder("success", "User Created", "User successfully added", "reload()"));

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
	
	public function user_terminate(Request $request)
    {
		$rating = $request->cleanliness + $request->cooking + $request->communication + $request->reliability + $request->recomendation;
		$ratingAvg =(double) $rating / 5;
		$user = User::where('id',$request->id)->where('parent_id',Auth::user()->id)->first();
		$terminate = Employment::UpdateOrCreate(
            ["user_id" => $user->id ], 
            [ 
				'last_working_day' => $request->last_working_day, 
				'termination_date' => date('Y-m-d'),
				'termination_note' => $request->termination_note, 
				'notice_period' => $request->notice_period
			]);
		$emp = Employment::where('user_id',$user->id)->first();
			$rating = new UserRating; 
				
					$rating['employment_id'] = $emp->id;
					$rating['user_id'] = $user->id;
					$rating['title'] = '';
					$rating['rating'] = $ratingAvg;
					$rating['comments'] = '';
					$rating->save();
		$user_terminate = User::where('id',$user->id)->update(['parent_id'=> 0]);

			if(($terminate || $rating) && $user_terminate)
                {
                    return response()->json(responder("success", "User Terminated", "User successfully terminated!", "redirect('".url('/admin/managestaff')."', true)")); 

                }else{
                    return response()->json(responder("error", "Oops..!", "Something went wrong, Please try again later.", "reload()")); 

                }
	} 

	public function update_employment(Request $request)
    {
		dd($request);
		$user = User::where('id',$request->id)->where('parent_id',Auth::user()->id)->frist();
	}
}
