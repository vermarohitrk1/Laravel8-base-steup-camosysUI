<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Profile;
use App\Models\Plan;
use App\Models\PlansProduct;
use App\Models\Product;
use App\Models\Product as TblProduct;
use App\Models\User;
use App\Models\Subscription as TblSubscription;
use App\Models\SubscriptionsProduct;
use App\Payment;
use Auth;
use Illuminate\Http\Request;
use Stripe\Customer;
use Stripe\Price;
use Stripe\Stripe;
use Stripe\Subscription;

class SubscriptionController extends Controller
{
    public function index($id)
    {
        if (Auth::user()) {
            $user_id = Auth::user()->id;
            $user = User::where('id', $user_id)->first();
        }
        
        $plan = Plan::with('plansfeatures', 'products')->where('id', $id)->first();
        if($plan->type == 'Custom' && !Session::has('id')){
            return redirect('/pricing');
        }
        return view('payment', compact('plan', 'user'));
    }

    public function custom_plan(Request $request)
    {
        if (Auth::user()) {
            $user_id = Auth::user()->id;
            $user = User::where('id', $user_id)->first();
        }

        $plan = Plan::with('plansfeatures', 'products')->where('id', $request->id)->first();
        return view('payment', compact('plan', 'user'));
    }

    public function payment(Request $request)
    {
        if (Auth::user()) {
            $user_id = Auth::user()->id;
            $user = User::where('id', $user_id)->first();
        } 
        Stripe::setApiKey(env('STRIPE_SECRET_DEV'));
        if(!Profile::where('user_id',$user->id)->exists()){
            $user->profile()->create(['user_id'=>$user->id]);
        }
        $user_address = $user->profile->address !='' ? $user->profile->address : 'N/A';
        $user_city = $user->profile->city !='' ? $user->profile->city : 'N/A';
        $user_country = $user->profile->country !='' ? $user->profile->country : 'US';
        $user_zip = $user->profile->zip !='' ? $user->profile->zip : 'N/A';
        $user_state = $user->profile->state !='' ? $user->profile->state : 'N/S';
       
        if(!TblSubscription::where('user_id',$user->id)->exists()){
        try{
        $customer = Customer::create([
            'email' => $request->email,
            'source' => $request->stripeToken,
            'name' => $request->name,
            "address" => [
                "city" => $user_city,
                "country" => $user_country,
                "line1" => $user_address,
                "line2" => " ",
                "postal_code" => $user_zip,
                "state" => $user_state,
            ],
        ]);
        }catch(Stripe_CardError $e) {
            $body = $e->getJsonBody();
            return response()->json(responder("error", $e->getHttpStatus(),  $e->getError()->message));

          } catch (Stripe_InvalidRequestError $e) {
            $body = $e->getJsonBody();
            return response()->json(responder("error", $e->getHttpStatus(),  $e->getError()->message));
          } catch (Stripe_AuthenticationError $e) {
            $body = $e->getJsonBody();
            return response()->json(responder("error", $e->getHttpStatus(),  $e->getError()->message));
          } catch (Stripe_ApiConnectionError $e) {
            $body = $e->getJsonBody();
            return response()->json(responder("error", $e->getHttpStatus(),  $e->getError()->message));
          } catch (Stripe_Error $e) {
            $body = $e->getJsonBody();
            return response()->json(responder("error", $e->getHttpStatus(),  $e->getError()->message));
          } catch (Exception $e) {
            $body = $e->getJsonBody();
            return response()->json(responder("error", $e->getHttpStatus(),  $e->getError()->message));
          }
          $customer_id = $customer->id;
        }else{
            $customer_id = TblSubscription::where('user_id',$user->id)->first();
            $customer_id = $customer_id->customer_id;
        }
        $plan = Plan::with('products')->where('id', $request->plan_id)->first();
            if($plan->trial_end != 'now'){
                $trial_end = strtotime('+'.$plan->trial_end.' days', Carbon::now()->timestamp);
            }else{
                $trial_end = $plan->trial_end;
            }
        $plan_items = array();
        foreach ($plan->products as $product) {
            $qantity = PlansProduct::where('product_id', $product->id)->where('plan_id', $plan->id)->first();
            $plan_items[] = ['price' => $product->price_id, 'quantity' => $qantity->qty];
        }
        if($plan->type == 'Custom')
        {
            foreach($request->session()->get('items') as $item){
                $plan_items[] = ['price' => $item['price'], 'quantity' =>  $item['quantity']];
            }
        }
        try{
        $subscription = Subscription::create([
            'customer' => $customer_id,
            'trial_end' => $trial_end,
            'items' => [$plan_items],
        ]);
    }catch(Stripe_CardError $e) {
        $body = $e->getJsonBody();
        $err  = $body['error'];
        return response()->json(responder("error", $e->getHttpStatus(),  $e->getError()->message));

      } catch (Stripe_InvalidRequestError $e) {
        $body = $e->getJsonBody();
        return response()->json(responder("error", $e->getHttpStatus(),  $e->getError()->message));
      } catch (Stripe_AuthenticationError $e) {
        $body = $e->getJsonBody();
        return response()->json(responder("error", $e->getHttpStatus(),  $e->getError()->message));
      } catch (Stripe_ApiConnectionError $e) {
        $body = $e->getJsonBody();
        return response()->json(responder("error", $e->getHttpStatus(),  $e->getError()->message));
      } catch (Stripe_Error $e) {
        $body = $e->getJsonBody();
        return response()->json(responder("error", $e->getHttpStatus(),  $e->getError()->message));
      } catch (Exception $e) {
        $body = $e->getJsonBody();
        return response()->json(responder("error", $e->getHttpStatus(),  $e->getError()->message));
      }
            $subs = new TblSubscription;
            $subs->user_id = $user->id;
            $subs->plan_id = $plan->id;
            $subs->subscription_id = $subscription->id;
            $subs->customer_id = $subscription->customer;
            $subs->start_date = date('Y-m-d H:s:i', $subscription->current_period_start);
            $subs->end_date = date('Y-m-d H:s:i', $subscription->current_period_end);
            $subs->status = $subscription->status;
            $subs->subscription_obj = $subscription;
            $subs->save();
            
            if ($subs) {
                foreach ($plan->products as $item) {
                    $product = TblProduct::where('id', $item['id'])->first();
                    $quantity = PlansProduct::where('product_id', $product->id)->where('plan_id', $plan->id)->first();
                    $subs->products()->attach($product);
                    $productQty = SubscriptionsProduct::where('subscription_id', $subs->id)->where('product_id', $product->id)->update(['quantity' => (int)$quantity->qty]);
                }
                if($plan->type == 'Custom')
                {
                    foreach($request->session()->get('items') as $item){
                        $product = TblProduct::where('price_id', $item['price'])->first();
                        $subs->products()->attach($product);
                        $productQty = SubscriptionsProduct::where('subscription_id', $subs->id)->where('product_id', $product->id)->update(['quantity' => (int)$item['quantity']]);
                    }

                }
                $request->session()->forget(['id', 'interval_mode', 'total_amount', 'custom_default_amount','items']);
            }
            return response()->json(responder("success", "Payment Successfull", "Payment successfully done!",'redirect('.url('/admin/profile').')'));

    }

    public function payment__(Request $request)
    {

        $product = Product::where('product_id', 'prod_IhB20elFx57lhU')->first();

        try {
            /** Add customer to stripe, Stripe customer */
            $customer = Customer::create([
                'email' => $request->email,
                'source' => $request->stripeToken,
                'name' => $request->name,
                "address" => [
                    "city" => "mohali",
                    "country" => "IN",
                    "line1" => "phase 8 mohali punjab",
                    "line2" => "fgdgfdg fdg df gdf",
                    "postal_code" => "155006",
                    "state" => "PB",
                ],
            ]);
        } catch (Exception $e) {
            $apiError = $e->getMessage();
        }

        // if (empty($apiError) && $customer) {
        //     /** Charge a credit or a debit card */
        //     try {
        //         /** Stripe charge class */
        //         $charge = Charge::create(array(
        //             'customer'      => $customer->id,
        //             'amount'        => $request->amount,
        //             'currency'      => 'inr',
        //             'description'   => 'Some testing description'
        //         ));
        //     } catch (Exception $e) {
        //         $apiError = $e->getMessage();
        //     }
        // }

        $subscription = Subscription::create([
            'customer' => $customer->id,
            'coupon' => 'free-period',
            //'default_tax_rates' => ['txr_1EO66sClCIKljWvs98IiVfHW'], //optionnal
            'trial_end' => 1610199999,
            'items' => [
                [
                    'price' => $product->price_id,
                ],
            ],
        ]);
        dd($subscription);
        return response()->json(responder("success", "Payment Successfull", "Payment successfully done!", ""));
    }
}
