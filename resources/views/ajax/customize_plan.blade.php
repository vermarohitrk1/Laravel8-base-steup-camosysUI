<div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">{{ucfirst($custom_plan->name)}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
                <form id="add_product" class="add-new-record" method="post" action="{{ url('/checkout/custom_plan')}}">
                    @csrf
                    <div class="modal-body">
                    <div class="annual-plan">
                                <ul class="list-group list-group-circle text-left">
                                @foreach($custom_plan->plansfeatures as $feature)
                                    <li class="list-group-item">{{$feature->title}}</li>
                                @endforeach
                                </ul>
                            </div>
                    <input type="hidden" name="id" value="{{$custom_plan->id}}">
                    <input type="hidden" name="interval_mode" value="{{$custom_plan->mode}}">
                    <input type='hidden' name="total_amount" value="0">
                    <input type='hidden' name="custom_default_amount" value="{{$custom_plan->total_amount}}">
                            <div class="card product-repeater">
                                <div data-repeater-list="items_{{$custom_plan->mode}}">
                                <div class="product_item" data-repeater-item>
                                    <div class="row d-flex align-items-end">
                                        <div class="col-xs-5">
                                            <div class="form-group">
                                            <label for="itemname">Product</label>
                                            <select data-placeholder="Select a product" onchange="calculator();" name="product_id" class="custom-select" id="customSelect" aria-describedby='qualification'>
                                                <option value="0" data-price="0" selected disabled>--Selece Products--</option>
                                                @foreach($custom_plan->product_items as $product)
                                                <option value="{{$product->id}}" data-price="{{$product->price}}">{{$product->name." ".strtoupper($product->currency).":".$product->price}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="form-group">
                                            <label for="itemname">Qty:</label>
                                            <div class="item-quantity">
                                                <div class="input-group input-group-lg">
                                                    <input type="number" onchange="calculator();" class="form-control py-75 custom-touchspin-min-max" name="product_qty" value="1" min='1'/>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-3 mb-1">
                                            <div class="form-group mb-0">
                                            <button class="btn btn-outline-danger text-nowrap px-1 delete-product" onclick="calculator();" data-repeater-delete type="button">
                                            <i data-feather="x" class="mr-25"></i>
                                            <span>Delete</span>
                                            </button>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-icon btn-primary add-more" onclick="setTimeout(function(){calculator();},350);" type="button" data-repeater-create>
                                    <i data-feather="plus" class="mr-25"></i>
                                    <span>Add New</span>
                                    </button>
                                </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <div class="plan_totat_amount"> </div>
                        <button type="submit" class="btn btn-success mr-1 waves-effect waves-float waves-light px-2">Buy</button>   
                    </div>
                </form>

        </div>
        <script>
$(function () {
  'use strict';
$('.product-repeater, .repeater-default').repeater({
    show: function () {
      $(this).slideDown();
      // Feather Icons
      if (feather) {
        feather.replace({ width: 14, height: 14 });
      }
    },
    hide: function (deleteElement) {
      if (confirm('Are you sure you want to delete this element?')) {
        $(this).slideUp(deleteElement);
      }
    }
  });
});
 $(document).find('.add-more').bind('click', function(e){
            // $("input.custom-touchspin-min-max").trigger('touchspin.destroy');	
            
            setTimeout(function(e){ 
                $("input.custom-touchspin-min-max").TouchSpin({
                  min: 1,
                max: 100,
                initval: 1,
                });
                $('.product_item').bind('destroyed', function(event) {
                  setTimeout(function(e){resetOptions(); calculator();},300);
                  });
            },300);
            
        }).trigger('click');

  function calculator(){
         var val = 'year';

            var formData = new FormData($("#add_product")[0]);
            $("#add_product").find("button[type='submit]").prop('disabled',true);
               $.ajax({
                     type: "POST",
                     url: '/admin/plan/calculate',
                     data: formData, 
                     processData: false,
                     contentType: false,
                     success: function(e)
                     {
                        $("#add_product").find("button[type='submit]").prop('disabled',false);
                           $('.modal-footer').find('.plan_totat_amount').html('<span class="text-body">Total: </span><span class="text-primary font-weight-bolder">'+e+'</span><sub class="text-body"><small> /'+val+'</small></sub>');
                           $('input[name="total_amount"]').val(e);
                     }
                  });
         }


(function($){
            $.event.special.destroyed = {
               remove: function(o) {
                  if (o.handler) {
                     
                  o.handler()
                  }
               }
            }
})(jQuery)
function resetOptions(){
    $('.product_item').each(function(i){
      $(this).find('select').children("option").show();
            });

   
    $('.product_item').each(function(i){
        var selectedVal = $(this).find('select').val(); 
        var attrID = $(this).find('select').attr("name"); 
        $('.product_item').each(function(i){
            if($(this).find('select').attr("name") != attrID){
                if(selectedVal != "" && selectedVal != 0){
                    $(this).find('select').children("option[value="+selectedVal+"]").hide();
                }
            }
        });
    });
}
$(document).on('change','.product_item select',function(){
   resetOptions();
});
$(document).on('click','.add-more',function(){
   setTimeout(function(){resetOptions();},350);
});
        </script>