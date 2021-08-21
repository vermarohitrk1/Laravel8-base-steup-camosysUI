<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
;
class SettingController extends Controller
{
    /**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
    public function index()
    {

        $planIds =  array();
        $path = base_path('.env');
        $planIdData =array();
        $env =array();
		 $stripe_settings =array();
		 $email_settings =array();
         $aws_settings =array();
          foreach ($planIds as $key => $planId) {
            if($planId->active == 1 && $planId->type == 'basic' ){
                $planIdData[$planId->planId] = $planId->name;
            }
             if($planId->active == 1 && $planId->type == 'advanced' ){
                $planIdDataadvanced[$planId->planId] = $planId->name;
            }
        }
        if (file_exists($path)){
            $env['MODE']= env('MODE');
            $stripe_settings['STRIPE_KEY_LIVE']= env('STRIPE_KEY_LIVE');
            $stripe_settings['STRIPE_SECRET_LIVE']= env('STRIPE_SECRET_LIVE');
            $stripe_settings['STRIPE_KEY_DEV']= env('STRIPE_KEY_DEV');
            $stripe_settings['STRIPE_SECRET_DEV']= env('STRIPE_SECRET_DEV');
			
             $braintree_settings['BRAINTREE_PUBLIC_KEY']= env('BRAINTREE_PUBLIC_KEY');
            $braintree_settings['BRAINTREE_PRIVATE_KEY']= env('BRAINTREE_PRIVATE_KEY');
            $braintree_settings['BRAINTREE_MAERCHANT_ID']= env('BRAINTREE_MAERCHANT_ID');
            //$env['MAIL_DRIVER']= env('MAIL_DRIVER');

            $email_settings['MAIL_MAILER']= env('MAIL_MAILER');
            $email_settings['MAIL_HOST']= env('MAIL_HOST');
            $email_settings['MAIL_PORT']= env('MAIL_PORT');
            $email_settings['MAIL_USERNAME']= env('MAIL_USERNAME');
            $email_settings['MAIL_PASSWORD']= env('MAIL_PASSWORD');
			$email_settings['MAIL_ENCRYPTION']= env('MAIL_ENCRYPTION');
            $email_settings['MAIL_FROM_ADDRESS']= env('MAIL_FROM_ADDRESS');
            $email_settings['MAIL_FROM_NAME']= env('MAIL_FROM_NAME');


            $aws_settings['AWS_ACCESS_KEY_ID']= env('AWS_ACCESS_KEY_ID');
            $aws_settings['AWS_SECRET_ACCESS_KEY']= env('AWS_SECRET_ACCESS_KEY');
            $aws_settings['AWS_DEFAULT_REGION']= env('AWS_DEFAULT_REGION');
            $aws_settings['AWS_BUCKET']= env('AWS_BUCKET');

             $general_settings['GOOGLE_STATUS']= env('GOOGLE_STATUS');
             $general_settings['GOOGLE_CLIENT_ID']= env('GOOGLE_CLIENT_ID');
            $general_settings['GOOGLE_SECRET_KEY']= env('GOOGLE_SECRET_KEY');

            $general_settings['LINKDIN_STATUS']= env('LINKDIN_STATUS');
            $general_settings['LINKDIN_CLIENT_ID']= env('LINKDIN_CLIENT_ID');
            $general_settings['LINKDIN_SECRET_KEY']= env('LINKDIN_SECRET_KEY');

            $general_settings['FACEBOOK_STATUS']= env('FACEBOOK_STATUS');
            $general_settings['FACEBOOK_CLIENT_ID']= env('FACEBOOK_CLIENT_ID');
            $general_settings['FACEBOOK_SECRET_KEY']= env('FACEBOOK_SECRET_KEY');

            $general_settings['TWITTER_STATUS']= env('TWITTER_STATUS');
            $general_settings['TWITTER_CLIENT_ID']= env('TWITTER_CLIENT_ID');
            $general_settings['TWITTER_SECRET_KEY']= env('TWITTER_SECRET_KEY');

            $general_settings['GITHUB_STATUS']= env('GITHUB_STATUS');
            $general_settings['GITHUB_CLIENT_ID']= env('GITHUB_CLIENT_ID');
            $general_settings['GITHUB_SECRET_KEY']= env('GITHUB_SECRET_KEY');

            $recaptcha_settings['RECAPTCHA_REGISTER_STATUS']= env('RECAPTCHA_REGISTER_STATUS');
            $recaptcha_settings['RECAPTCHA_LOGIN_STATUS']= env('RECAPTCHA_LOGIN_STATUS');
            $recaptcha_settings['RECAPTCHA_FPASSWORD_STATUS']= env('RECAPTCHA_FPASSWORD_STATUS');
            $recaptcha_settings['RECAPTCHA_SITEKEY']= env('RECAPTCHA_SITEKEY');
            $recaptcha_settings['RECAPTCHA_SECRET']= env('RECAPTCHA_SECRET');

            $broadcast_settings['BROADCAST_DRIVER']= env('BROADCAST_DRIVER');
            $broadcast_settings['PUSHER_APP_ID']= env('PUSHER_APP_ID');
            $broadcast_settings['PUSHER_APP_KEY']= env('PUSHER_APP_KEY');
            $broadcast_settings['PUSHER_APP_SECRET']= env('PUSHER_APP_SECRET');
            $broadcast_settings['PUSHER_APP_CLUSTER']= env('PUSHER_APP_CLUSTER');
            $broadcast_settings['LARAVEL_WEBSOCKETS_PORT']= env('LARAVEL_WEBSOCKETS_PORT');
        }
		$layout="form"; 
        return view('admin.setting')->with(["adminData" => array() ,"planIdData" => $planIdData,"env"=>$env,"email_settings"=>$email_settings,"layout"=>$layout,"aws_settings"=> $aws_settings,"stripe_settings"=> $stripe_settings,"general_settings"=> $general_settings,'braintree_settings'=>$braintree_settings,"recaptcha_settings"=>$recaptcha_settings,"broadcast_settings"=>$broadcast_settings]);
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
    public function update(Request $request, $id)
    {
        $eventDetail = $request->input('envdetail');
        $admin= Admin::where('id', '=', 1)->update([
            'standard_plan' => $request->input('standard_plan'),
            'advance_plan' => $request->input('advance_plan'),
            'upgrade_plan' => $request->input('upgrade_plan'),
        ]); 
        if($admin){
            return redirect()->route('setting.index')
                ->with('success','Plan added successfully.');
        }
        else{
            return redirect()->route('setting.index')
                ->with('success','Not added successfully.');
        }
    }
    public function registerWebhook(Request $request)
    {
        $url=url('/webhook/stripe');
        if($request->input('customurl')){
            $url=$request->input('customurl');
        }
              $stripemode = env('MODE');
        $stripe='';
        if($stripemode == 1 ){
              $stripe = env('STRIPE_SECRET_LIVE');
        }
        else{
    $stripe = env('STRIPE_SECRET');
       }

                    $stripe = new \Stripe\StripeClient(
           
            );
            $res=$stripe->webhookEndpoints->create([
              'url' => $url,
              'enabled_events' => [
                'customer.subscription.created',
                'customer.subscription.updated',
                'customer.subscription.deleted',
                'customer.subscription.trial_will_end',
                'invoice.payment_succeeded',
                'invoice.payment_failed'
              ],
            ]);
          // dd( $res);
            if($res->status=='enabled'){
             $admin= Admin::where('id', '=', 1)->update([
                 'webhook_staus' => $res->status,
                 'webhooksecret' => $res->secret,
                 'web_hook_livemode' => $res->livemode
              ]); 
            }
           
        if($admin){
            return redirect()->route('setting.index')
                ->with('success','Webhook Registered successfully.');
        }
        else{
            return redirect()->route('setting.index')
                ->with('success','Webhook Registeration Failed.');
        }
    }
    public function envfile(Request $request)
    {
		$vals=array();
		  
		foreach ($request->except('_token') as $key => $value) {
		//$vals[$key]=$part;
      //   $value = strval($value);
           
		$this->envUpdate($key, $value);
		}
  //   dd('p');
	 // $eventDetail = $request->input('envdetail');
        //$updatedenv =array();
        /// dd( $eventDetail['STRIPE_KEY']);
       /*  foreach ($eventDetail as $key => $value) {
            $updatedenv[]= $this->envUpdate($key, $value);
        } */
        
            return response()->json(responder("success", "Setting Updated", "Setting successfully updated", "reload()"));


    }
    public function envUpdate($key, $value)
    {
       
        $path = base_path('.env');
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                $key . '=' . env($key), $key . '=' . $value,
				file_get_contents($path)
            ));
            $data = 1;
        }
        else{
            $data = 0;
        }
        return $data;
    }
    /**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
    public function destroy(Request $request, $id)
    {
    }
}
