<?php

namespace App\Http\Middleware;

use Closure;
//use App\UserContact;
use App\Models\User;

class DomainMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) { 
		 $domain='';
		 $currentURL = \URL::current();
		$currentURL = preg_replace("(^https?://)", "", $currentURL);
		$urlparts = explode('.', $currentURL);
		$subdomain =$urlparts[0];
		if(count($urlparts)>2){
			$domain=$urlparts[1].'.'.$urlparts[2];
		}else{
			$domain = $urlparts[0].'.'.$urlparts[1] ;
		}
		if($subdomain==''||$subdomain==null||$subdomain=='www'||$subdomain=='camosys' ){
					$subdomain ='';
		}
		 
		 $user = \Auth::user();
		 if(!$user){
			abort(401); 
		 }
		 if($user->subdomain!=''||$user->subdomain!=null){
			 $user_subdomain=$user->subdomain;
			 if($subdomain!=$user_subdomain){
				 return redirect()->away('https://'.$user_subdomain.'.'.$domain);
			 }else{
				return $next($request);
			 }
		 }
        return $next($request);
    }

}