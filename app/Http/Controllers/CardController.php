<?php

namespace App\Http\Controllers;

use Stripe\Token;
use Stripe\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CardController extends Controller
{

    public function index(){
        return view('ajax.cards');
    }
    public function add(Request $request){
        Stripe::setApiKey(env('STRIPE_SECRET_DEV'));
        $user = Auth::user();
        if($user->stripe_id == ''){
            
        }
       $token = Token::retrieve(
        $request->stripeToken,
        []
      );
      Customer::createSource(
        $user->cus_id,
        ['source' => $request->stripeToken]
      );
      dd($token);
    }

}