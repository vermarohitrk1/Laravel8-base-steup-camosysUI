<?php
namespace App\Http\Controllers;

use App\Payment;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Token;
use Stripe\Product;
use Stripe\Price;
use Stripe\Plan;
use Stripe\Subscription;
use App\Models\Product as TblProduct;
use App\Models\PriceTier;
use App\Models\PlanFeature;
use App\Models\PlansProduct;
use App\Models\Plan as TblPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $products_monthly = TblProduct::with('pricetiers')->where('interval','month')->where('active',1)->get();
        $products_yearly = TblProduct::with('pricetiers')->where('interval','year')->where('active',1)->get();
        
        $plans= TblPlan::orderBy('indexing', 'asc')->get();
        return view('admin.plan.plan',compact('plans','products_monthly','products_yearly'));
         
        
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
        $validated = $request->validate([
            'plan_name' => 'required',
        ]);
        if(count(array_column($request->{'items_'.$request->interval_mode}, 'product_id')) !== count(array_unique(array_column($request->{'items_'.$request->interval_mode}, 'product_id')))){
                    return response()->json(responder("error", "Hmmm..!", "Products must not be the same!"));

        }
        Stripe::setApiKey(env('STRIPE_SECRET_DEV'));

        //----trial period
        if($request->tiral_period > 0){
            
            $trial_end = (int)$request->tiral_period;
        }else{ $trial_end = "now";} 

        $plans = new TblPlan;
        $plans->name = $request->plan_name;
        $plans->total_amount = $request->total_amount;
        $plans->mode = $request->interval_mode;
        $plans->trial_end = $trial_end;
        if( $request->type == 'Custom')
        {
            $plans->type = $request->type;
        }
        $plans->badge = $request->badge;
        if ($request->plan_image) {
           
            $base64_encode = $request->plan_image;
            $folderPath = public_path()."/uploads/images/plans/";
            $image_parts = explode(";base64,", $base64_encode);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $image = "plan" . uniqid() . '.' . $image_type;                
            $file = $folderPath . $image;
            file_put_contents($file, $image_base64);
            $plans->image = $image; 
        } 
        
        $plans->save();
        foreach($request->{'items_'.$request->interval_mode} as $key => $item)
		{
           
            if($item['product_id'] <= 0 || $item['product_id'] == '' || $item['product_id'] == 'null'){
                continue;
            }
            $product = TblProduct::where('id',$item['product_id'])->first();
                // $exist = PlansProduct::where('plan_id',$plans->id)->where('product_id',$product->id)->first();
                // if($exist){
                //     $qty = $item['product_qty'] + $exist->qty;
                //     $productQty = PlansProduct::where('plan_id',$plans->id)->where('product_id',$product->id)->update(['qty'=>$qty]);
                // }else{
                    if($plans){
                        $plans->products()->attach($product);
                        $productQty = PlansProduct::where('plan_id',$plans->id)->where('product_id',$product->id)->update(['qty'=>$item['product_qty']]);
                    }
        }
        
        foreach($request->features as $feature){
            $featureObj = new PlanFeature;
            $featureObj->title = $feature['feature_name'];
            $featureObj->plan_id = $plans->id;
            $featureObj->save();
        }
        return response()->json(responder("success", "Plan Create", "Plan successfully created", "reload()"));

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
    public function calculate_price(Request $request)
    {//dd($request);
        if($request->custom_default_amount){
            $amount = $request->custom_default_amount;
        }else{
        $amount = 0;
        }
        if($request->{'items_'.$request->interval_mode}){
            foreach($request->{'items_'.$request->interval_mode} as $key => $item)
            {
            if(isset($item['product_id'])){
                $product = TblProduct::where('id',$item['product_id'])->first();

                    if($product->tiered == 0){
                    $amount += $product->price * $item['product_qty'];
                    }elseif($product->tiered == 1){
                        $pricetiers = PriceTier::where('product_id',$item['product_id'])->orderBy('up_to','asc')->get();
                        $min = 1;
                        $up_to_max = PriceTier::where('product_id',$item['product_id'])->max('up_to');
                        
                        foreach($pricetiers as $pricetier )
                        {  
                            $max = $pricetier->up_to;
                            if($max != 0){
                            
                            if( ($min <= $item['product_qty']) && ($item['product_qty'] <= $max)){
                                $tiear_amount = $pricetier->amount;
                                break;
                            }
                            $min = $max +1;
                            }elseif($item['product_qty'] > $up_to_max ){
                                $tiear_amount = $pricetier->amount;
                            }
                        } 

                        $amount += $tiear_amount * $item['product_qty'];
                    }
                }
            }
            }

       
        return $amount;
    }
    public function select_products(Request $request)
    {
        $data ='<option value="0" data-price="0" selected="" disabled="">--Selece Product--</option>';
        $exist = array();
        foreach($request->{'items_'.$request->interval_mode} as $key => $item)
        {
            if(isset($item['product_id']) && $item['product_id'] != 0){
            $exist = array($item['product_id']);
            }
        }
        
        $products = TblProduct::with('pricetiers')->where('interval',$request->interval_mode)->where('active',1)->get();
            
        foreach($products as $product){
            if(!in_array($product->id,$exist))
            $data .= '<option value="'.$product->id.'" data-price="'.$product->price.'">'.$product->name." ".strtoupper($product->currency).":".$product->price.'</option>';
        }
            return $data;
    }
    public function rules($request)
        {
        
        foreach($request->tiers as $key => $tier){
            $rule1['tiers['.$key.'][up_to]'] = 'required';
            $rule2['tiers['.$key.'][amount]'] = 'required';
            }
        $rules = array_merge($rule1,$rule2);
         $rules['name'] ='required|max:255';
        return $rules;
        
        }
    public function get_plans()
    {
        
        $annually = TblPlan::with('plansfeatures', 'products')->where('mode','year')->orderBy('indexing','asc')->get();
        $monthly = TblPlan::with('plansfeatures', 'products')->where('mode','month')->orderBy('indexing','asc')->get();

        return view('pricing',compact('annually','monthly')); 
    }
    public function status_change(Request $request)
    {
        $status = TblPlan::where('id',$request->id)->update(['status'=> $request->status]);
        return true;

    }
    public function index_change(Request $request)
    {
       foreach(array_combine($request->indexing,$request->plan_ids) as $index => $id )
        {
          $indx =  TblPlan::where('id',$id)->update(['indexing'=> $index]);
        }
    }
}