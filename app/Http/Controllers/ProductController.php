<?php
namespace App\Http\Controllers;

use App\Payment;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Token;
use Stripe\Product;
use Stripe\Price;
use App\Models\Product as TblProduct;
use App\Models\PriceTier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        // Stripe::setApiKey(env('STRIPE_SECRET_DEV'));
        // $price= Price::retrieve(
        //     'price_1I5mOkG2q70Yk3GjxNTGr53J',
        //     []
        //   );
        //   dd($price);
        $products = TblProduct::all();
        return view('admin.product',compact('products'));
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
    //    dd($request);
        $customMessages = [
            'required' => 'This field is required.'
        ];
        
            $validated = $request->validate([
                'name' => 'required',
            ]);
        if(empty(env('STRIPE_SECRET_DEV')) && empty(env('STRIPE_SECRET'))){
            return response()->json(responder("error", "Hmmm!", "Please Provide Stipe details."));
        }
        Stripe::setApiKey(env('STRIPE_SECRET_DEV'));
        try {
         $product = Product::create([
            'name' => $request->name
          ]);
        } catch (Exception $e) {
            $apiError = $e->getMessage();
        }
        if($product){
            $productObj= new TblProduct;
            $productObj['name'] = $product->name;

            /***
             * slug...
             */
            $slug = slugify($request->name);
            if(TblProduct::Where('slug', 'like', '%' . $slug . '%')->count() > 0){
            $end =array();
            foreach(TblProduct::Where('slug', 'like', '%' . $slug . '%')->pluck('slug')->toArray() as $slugs){
                $array = explode('-',$slugs);
               $end[] = end($array);
            }
            $max = array_filter($end, 'is_numeric');
            if(!empty($max)){
                $ifExist = max($max) + 1;
                $slug .= '-'.$ifExist;
            }else{
                $slug .= '-1';
            }
            }
             /***
              * slug end
              */
            $productObj['slug'] = $slug;
            $productObj['product_id'] = $product->id;
            $productObj['currency'] = 'usd';
            $productObj['interval'] = $request->interval;
            if($request->price_model == 'volume'){
                $productObj['tiered'] = 1;
            }
            $productObj['active'] = $product->active;
            $productObj->save();
            $productId = $productObj->id;
        }
        if($request->price_model== 'volume'){

            $tier_data ="";
            $tier_data= array();
                if($request->tiers){
                    foreach($request->tiers as $tier){
                        $amount = $tier['amount'] * 100;
                        $tier_data[]= ['up_to' => $tier['up_to'], 'unit_amount_decimal' => $amount];
                    }
                }
                $tier_data[] = ['up_to' => 'inf', 'unit_amount_decimal' => $request->amount_inf * 100]; 
            
                    $price = Price::create([
                        'product' => $product->id,
                        'currency' => 'usd',
                        'billing_scheme'=> 'tiered',
                        'tiers_mode' => 'volume',
                        'recurring' => [
                            'interval' => $request->interval,
                        ],
                        'tiers' => [$tier_data],
                    ]);
          
               
                if($request->tiers > 0){
                foreach($request->tiers as $tier){
                    $priceTier = new PriceTier;
                    $priceTier['product_id']= $productId;
                    $priceTier['up_to']= $tier['up_to'];
                    $priceTier['amount']= $tier['amount'];
                    $priceTier->save();
                }
                $startFrom =$request->tiers[0]['amount'];
                }else{
                    $startFrom = $request->amount_inf;
                }
                $priceTier = new PriceTier;
                $priceTier['product_id']= $productId;
                $priceTier['up_to']= 0;
                $priceTier['amount']= $request->amount_inf;
                $priceTier->save();
                TblProduct::where('id',$productId)->update(['price'=>$startFrom]);
            }else{
                if($request->amount == ''){
                    $request->amount = 0;
                }
                $price = Price::create([
                    'product' => $product->id,
                    'unit_amount' => $request->amount*100,
                    'currency' => 'usd',
                    'recurring' => [
                        'interval' => $request->interval,
                      ],
                ]);
               TblProduct::where('id',$productId)->update(['price'=>$request->amount]);
            }
            
            $price = TblProduct::where('id',$productId)->update(['price_id'=>$price->id]);
            return response()->json(responder("success", "Product Added", "Product successfully added", "reload()"));
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function rules($request)
        {
            $rules =[];
            if($request->tiers){
                foreach($request->tiers as $key => $tier){
                    $rule1['tiers['.$key.'][up_to]'] = 'required';
                    $rule2['tiers['.$key.'][amount]'] = 'required';
                }
                $rules = array_merge($rule1,$rule2);
            }
        
         $rules['name'] ='required|max:255';
         $rules['interval'] = 'required';
        return $rules;
        
        }
}