<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Redirect;
use Socialite;
use Auth;
use Exception;
use App\Models\User;
  
class GithubController extends Controller
{
     /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('github')->user();
        } catch (Exception $e) {
            return Redirect::to('auth/github');
        }
//dd($user);
        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);

        return Redirect::to('home');
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $githubUser
     * @return User
     */
    private function findOrCreateUser($githubUser)
    {
        if ($authUser = User::where('github_id', $githubUser->id)->first()) {
            return $authUser;
        }

         $finduser = User::where('github_id', $githubUser->id)->first();
     
            if($finduser){
     
               return $finduser;
     
            }else{
               return  $newUser = User::create([
                    'name' => $githubUser->nickname,
                    'email' => $githubUser->email,
                    'github_id'=> $githubUser->id,
                    'password' => encrypt('123456dummy')
                ]);
    
                
            }
    }
}