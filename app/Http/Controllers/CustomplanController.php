<?php
namespace App\Http\Controllers;

use App\Payment;
use App\Models\Product as TblProduct;
use App\Models\PriceTier;
use App\Models\PlanFeature;
use App\Models\PlansProduct;
use App\Models\Plan as TblPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomplanController extends Controller
{
    public function customize(Request $request){
        $custom_plan = TblPlan::where('id',$request->id)->first();
        
            $a = array_values($custom_plan->products->pluck('id')->toArray());
                $custom_plan->product_items = TblProduct::with('pricetiers')->where('interval',$custom_plan->mode)->where('active',1)->whereNotIn('id',$a)->get();
        
        return view('ajax.customize_plan',compact('custom_plan'));
    }

    public function checkout_plan(Request $request){
    
    $request->session()->forget(['id', 'interval_mode', 'total_amount', 'custom_default_amount','items']);

    $request->session()->put("id", $request->id);
    $request->session()->put("interval_mode", $request->interval_mode);
    $request->session()->put("total_amount", $request->total_amount);
    $request->session()->put("custom_default_amount", $request->custom_default_amount);

        foreach($request->{'items_'.$request->interval_mode} as $key => $item){
            if(isset($item['product_id'])){
                $product = TblProduct::where('id',$item['product_id'])->first();
                $request->session()->push('items', ['price' => $product->price_id, 'quantity' => $item['product_qty']]);
            }
        } 
        return redirect('/checkout/'.$request->session()->get('id'));
    }

}
