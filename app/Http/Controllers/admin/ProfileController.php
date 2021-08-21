<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use DB;
use App\Models\User;
use App\Models\Profile;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Auth;
use Redirect;
use Illuminate\Support\Facades\Validator;
;
class ProfileController extends Controller
{
    /**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
    public function index()
    {
      $id= Auth::user()->id;
    $usersprofile = User::with('profile','user_subscription.products')->where('id',$id)->first();
  
    return view('admin.profile')->with(['user' => $usersprofile]);
        
    }
    /**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
    public function create()
    {
    }
    /**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
    public function store(Request $request,$id)
    {
    }
    /**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
    public function show(Request $request)
    {
    }
    /**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
    public function edit($id)
    {
    }
    /**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
    public function update(Request $request, $id){
    }
    public function updateprofile(Request $request){
          $id = $request->input('id');
           $user = User::find($id);
        
        $request->validate([
            'name' => 'required',
            'lname' => 'required',
        ]);
      if (Profile::where('user_id', '=', $id)->count() > 0) {
          $users = $user->profile()
                ->update([
             'zip'=> $request->zip,
             'phone_number'=> $request->phone_number,
             'address'=> $request->address,
             'country'=> $request->country,
             'state'=> $request->state,
             'city'=> $request->city,
         ]);
         
      }
     else{
         $profile = Profile::create([
             'user_id'=> $request->input('id'),
             'zip'=> $request->input('zip'),
             'address'=> $request->input('address'),
             'phone_number'=> $request->input('phone_number'),
             'country'=> $request->input('country'),
             'state'=> $request->input('state'),
             'city'=> $request->input('city'),
         ]);
        }

    
        $userdetail = User::where('id', $id)
         ->update([
             'name'=> $request->input('name'),
             'lname' =>$request->input('lname'),
            
         ]);
         return response()->json(responder("success", "Profile Updated", "Profile successfully updated", "reload()")); 

    }
    public function editprofile(Request $request)
    {
        return view('admin.editprofile');
       
    }
    public function profileimgsave(Request $request)
    {
      $image = $request->file('image');

      $new_name = rand() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('uploads/images'), $new_name);
     // dd('<img src="/images/'.$new_name.'" class="img-thumbnail" width="300" />');
      $user_id = Auth::user()->id;
     // dd($user_id);
      $userImage =  User::where('id', '=', $user_id)->update([ 'profile_img' => $new_name ]);
     // dd(User::all());
      return response()->json([
       'message'   => 'Image Upload Successfully',
       'uploaded_image' => '<img src="/images/'.$new_name.'" class="img-thumbnail" width="300" />',
       'class_name'  => 'alert-success'
      ]);
 
    }
    public function avatar_update(Request $request)
    {
        
            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/avatar/tmp/'), $new_name);
            return $new_name;
            // $userImage =  User::where('_id', '=', $user_id)->update([ 'image' => 'images/'.$new_name ]);
    }
    public function avatar_change(Request $request)
    { 
        

            $filename = $request->filename;
        
            $large_image_location = public_path('uploads/avatar/tmp/').$request->filename;
            $thumb_image_location = public_path('uploads/images/')."avatar_".$request->filename;
        
            $x1 = $request->x1;
            $y1 = $request->y1;
            $x2 = $request->x2;
            $y2 = $request->y2;
            $w  = $request->w;
            $h  = $request->h;
            
            $scale = 150/$w;
            $cropped = self::resizeThumbnailImage($thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);

            $user = User::where('id', '=', $request->id)->first();
            if (Profile::where('user_id', '=', $user->id)->count() > 0) {
                $users = $user->profile()->update(['profile_img'=> 'avatar_'.$request->filename]);               
            }
           else{
               $profile = Profile::create(['user_id' => $request->id,'profile_img'=> 'avatar_'.$request->filename]);
              }
              unlink($large_image_location);
            return response()->json(responder("success", "Avatar Changed", "Avatar successfully changed", "reload()")); 
        
    }

    function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
        list($imagewidth, $imageheight, $imageType) = getimagesize($image);
        $imageType = image_type_to_mime_type($imageType);
        
        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
        switch($imageType) {
            case "image/gif":
                $source=imagecreatefromgif($image); 
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                $source=imagecreatefromjpeg($image); 
                break;
            case "image/png":
            case "image/x-png":
                $source=imagecreatefrompng($image); 
                break;
          }
        imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
        switch($imageType) {
            case "image/gif":
                  imagegif($newImage,$thumb_image_name); 
                break;
              case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                  imagejpeg($newImage,$thumb_image_name,100); 
                break;
            case "image/png":
            case "image/x-png":
                imagepng($newImage,$thumb_image_name);  
                break;
        }
        chmod($thumb_image_name, 0777);
        return $thumb_image_name;
    }
   
}
