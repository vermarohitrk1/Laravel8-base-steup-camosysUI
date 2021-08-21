<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes(['verify' => true]);
Auth::routes(['verfiy' => true]);
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
 Route::group(['middleware' => 'auth', 'middleware' => 'domain'], function() {
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 });

Route::get('/roles',  [App\Http\Controllers\PermissionController::class,'Permission']);
Route::get('/permit',  [App\Http\Controllers\PermissionController::class,'permit']);
Route::post('/subdomaincheck',  [App\Http\Controllers\Auth\RegisterController::class,'subdomaincheck']);

Route::get('/pricing', 'PlanController@get_plans');
Route::get('/test', 'TestController@index');
Route::post('/submit/form', 'TestController@store');
//Route::resource('/caregiver_register', 'Auth\RegistrationController');
Route::resource('/caregiver_register', 'Auth\CaregiverController');

Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');
Route::get('auth/facebook', 'Auth\FacebookController@redirectToFacebook');
Route::get('auth/facebook/callback', 'Auth\FacebookController@handleFacebookCallback');

Route::get('auth/linkedin', 'Auth\LinkdinController@redirectToLinkedin');
Route::get('auth/linkedin/callback', 'Auth\LinkdinController@handleLinkedinCallback');

Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');

Route::get('auth/github', 'Auth\GithubController@redirectToProvider');
Route::get('auth/github/callback', 'Auth\GithubController@handleProviderCallback');

Route::resource('admin/setup','admin\InitialsetupController');
Route::resource('admin/initialsetup','admin\InitialsetupController');
Route::post('admin/initialsetup','admin\InitialsetupController@envfile')->name('settingenvdatabase');


Route::group(['middleware' => 'role:superadmin'], function() {
      Route::post('admin/permissions/edit','PermissionController@edit');
      Route::post('admin/permissions/update','PermissionController@update');
      Route::resource('admin/permissions','PermissionController');
      Route::resource('admin/setting','admin\SettingController');
      Route::post('admin/setting','admin\SettingController@envfile')->name('settingenv');
      Route::resource('admin/profile','admin\ProfileController');
      Route::get('admin/edit','admin\ProfileController@editprofile');
      Route::post('admin/savephoto', 'ProfileController@profileimgsave');
      Route::post('admin/profiledata', 'admin\ProfileController@updateprofile')->name('updateprofile');
     Route::get('admin/ecommerce-dashboard',function(){ return view('ecommerce-dashboard'); });

      Route::post('admin/user/role','admin\UserController@role');
      
      Route::resource('admin/user','admin\UserController');

      Route::post('admin/role/default','RoleController@make_default');
    
      Route::resource('admin/manageproduct','ProductController');
      Route::resource('admin/manageplan','PlanController');
      // Route::resource('admin/userprofile','ProfileController');
      
 });
 
 Route::group(['middleware' => 'role:administrator', 'middleware' => 'role:superadmin'], function() {


 });

Route::group(['middleware' => 'auth', 'middleware' => 'domain'], function() {
     
    Route::post('admin/roles/edit','RoleController@edit');
    Route::post('admin/roles/update','RoleController@update');
    Route::post('admin/roles/permission','RoleController@permission');
    Route::post('admin/roles/assign-permission','RoleController@assignPermission');
    Route::resource('admin/roles','RoleController');
    Route::resource('admin/managestaff','ManagestaffController');
    Route::post('/admin/managestaff/users_card', 'ManagestaffController@users_card');
    Route::get('admin/managefacility/{id}','ManagefacilityController@show');
    Route::get('admin/managefacility','ManagefacilityController@index');
    Route::post('admin/managefacility/update','ManagefacilityController@update');
    Route::get('admin/addfacility','ManagefacilityController@create');
    Route::post('admin/facilitystore','ManagefacilityController@store');
    Route::post('admin/managefacility/card','ManagefacilityController@card');
	  Route::get('admin/userprofile/{id}','ProfileController@userprofile');
    Route::get('admin/userprofile/{id}/edit','ProfileController@usereditprofile');
    Route::post('admin/user/updateprofile','ProfileController@userupdateprofile');
    Route::post('admin/user/qualification/update','QualificationController@update');
    Route::post('admin/profile/edit','ProfileController@updateinfo');
    Route::resource('admin/profile','admin\ProfileController');
    Route::post('admin/profile/status','ProfileController@status_update');
    Route::post('admin/user/assign-role','admin\UserController@assignRole');
    Route::resource('admin/profile','admin\ProfileController');
    Route::get('admin/edit','admin\ProfileController@editprofile');
    Route::post('admin/savephoto', 'ProfileController@profileimgsave');
    Route::post('admin/profiledata', 'admin\ProfileController@updateprofile')->name('updateprofile');
    Route::post('/users/fileupload/','ProfileController@profileimgsave')->name('users.fileupload');
    Route::post('admin/profile-avatar/update', 'admin\ProfileController@avatar_update');
    Route::post('admin/profile-avatar/change', 'admin\ProfileController@avatar_change');
    Route::post('admin/user/terminate', 'ManagestaffController@user_terminate');
    Route::post('admin/user/update_employment','EmploymentController@update_employment');
    Route::post('admin/plan/calculate','PlanController@calculate_price');
    Route::post('/admin/plan/products','PlanController@select_products');
    Route::post('/admin/plan/status','PlanController@status_change');
    Route::post('/admin/plans/index','PlanController@index_change');
    Route::post('/admin/cards','CardController@index');
    Route::post('/admin/add/card','CardController@add');
});


Route::get('/checkout/{id}','SubscriptionController@index');
Route::post('/checkout/custom_plan','CustomplanController@checkout_plan');
Route::post('payments','SubscriptionController@payment');
Route::post('/plan/customize','CustomplanController@customize');


Route::get('/migrate', function () {
    return Artisan::call('migrate', ["--force" => true ]);
});
