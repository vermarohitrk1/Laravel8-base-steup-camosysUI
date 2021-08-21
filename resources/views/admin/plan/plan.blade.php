@extends('layouts.app')
@section('content')
@push('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/dragula.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/ext-component-drag-drop.css')}}">
@endpush
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
                        <div class="content-header row">
                            <div class="content-header-left col-md-9 col-12 mb-2">
                                <div class="row breadcrumbs-top">
                                    <div class="col-12">
                                        <h2 class="content-header-title float-left mb-0">Plans</h2>
                                        <div class="breadcrumb-wrapper">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a>
                                                </li>
                                                <li class="breadcrumb-item active">Table plans
                                                </li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                                <div class="form-group breadcrumb-right">
                                        <button class="btn-icon btn btn-primary btn-round btn-sm waves-effect waves-float waves-light" type="button" data-toggle="modal" data-target="#create" aria-haspopup="true" aria-expanded="false">
                                        Create New Plans
                                    </button>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="content-body">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                            <div class="card">
                            <table class="datatables-basic-- table" id="my-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Plan Name</th>
                                            <th>Plan Mode</th>
                                            <th>Plan Amount</th>
                                            <th>Trial Period</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <form id="drag-form1" class="drag-form" action="{{ url('/admin/plans/index')}}" method="post">
                                    @csrf
                                    </form>
                                    <tbody id="drag-container">
                                   
                                    @foreach($plans as $key => $plan)
                                        @php $key += 1; @endphp
                                            <tr class="draggable">
                                            <th scope="row">{{$key}}</th>
                                            
                                            <input type="hidden" id="indexing" name="indexing[]" value="{{$key}}" form="drag-form1">
                                            <input type="hidden" name="plan_ids[]" value="{{$plan->id}}" form="drag-form1">
                                            <td>{{ $plan->name}}</td>
                                            <td>{{ucfirst($plan->mode)}}ly</td>
                                            <td>{{$plan->total_amount}}</td>
                                            <td>{{$plan->trial_end != 'now' ? $plan->trial_end : '0'}} Day's</td>
                                            <td>{{$plan->type}}</td>
                                            <td>
                                            <form class="switch-button" action="{{ url('/admin/plan/status')}}" action="post">
                                                    <div class="custom-control custom-switch custom-switch-primary">
                                                        <input type="checkbox" class="custom-control-input" name="status" data-id="{{$plan->id}}" data-token="{{ csrf_token()}}" id="customSwitch{{$key}}" @if($plan->status == 1) checked @endif />
                                                        <label class="custom-control-label" for="customSwitch{{$key}}">
                                                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                        </label>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light" data-toggle="dropdown" aria-expanded="false">
                                                    <i data-feather="more-vertical"></i>                                                    </button>
                                                    <div class="dropdown-menu" style="">
                                                        <a class="dropdown-item fetch-display-click" data="id:{{ $plan->id}}|_token:{{ csrf_token() }}" url="{{ url('admin/roles/edit')}}" href="javascript:void(0);" holder='.update-holder' modal="#update">
                                                        <i data-feather="edit-2" class="mr-50"></i>                                                            <span>Edit</span>
                                                        </a>
                                                        <form class="axios-form" action="{{route('manageplan.destroy', $plan->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item" href="javascript:void(0);">
                                                        <i data-feather="trash" class="mr-50"></i>
                                                            <span>Delete</span>
                                                        </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                 </form>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Modal to add new record -->
                   
                </section>
                                   
                            </div>
                            </div>
                        </div>
        </div>
    </div>

<!-- modals -->
<div class="modal fade text-left" id="create" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
   <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel1">Create New Plan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
         </div>
         <form id="plans_create" class="axios-form add-new-record" method="post" action="{{ route('manageplan.store')}}">
            @csrf
            <input type='hidden' name="total_amount" value="0">
            <div class="modal-body flex-grow-1">
            <div class="row">
            <div class="col-lg-6 col-12">
            <div class="form-group">
                  <label for="customSelect4">Type</label>
                  <select class="custom-select" name="type" id="customSelect4">
                     <option value="Regular" selected>Regular</option>
                     <option value="Custom">Custom</option>
                  </select>
               </div>
               <div class="form-group">
                  <label for="customSelect2">Interval Mode</label>
                  <select class="custom-select interval-mode" onchange="calculator();" name="interval_mode" id="customSelect2" aria-describedby='qualification'>
                     <option value="year">Yearly</option>
                     <option value="month">Monthly</option>
                  </select>
               </div>
               <div class="form-group">
                  <label class="form-label" for="basic-icon-default-fullname">Plan Name</label>
                  <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" name="plan_name" placeholder="Basic" aria-label="John Doe" />
               </div>
               <div class="form-group">
                  <label class="form-label" for="basic-icon-default-fullname">Badge Text</label>
                  <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" name="badge" placeholder="Popular, Recommended etc." aria-label="John Doe" />
                  <p><small class="text-muted">Leave empty if do not need badge.</small></p>
               </div>
               <label class="form-label" for="basic-icon-default-fullname">Trial Period</label>
                <div class="input-group mb-2">
                                        <input type="text" class="form-control" value="0" placeholder="31" name="tiral_period" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">/Day's</span>
                                        </div>
                                    </div>
               <div class="form-group">
                  <label class="form-label" for="basic-icon-default-fullname">Image</label>
                <input type="file" class="croppie" name='plan_image' placeholder="Course Cover Image" crop-width="33" crop-height="59" accept="image/*"> 
                </div>
                </div><div class="col-lg-6 col-12">
               <div class="tab-content product-tabs">
                   <h4>Add Products</h4>
                  <div class="tab-pane active" id="year" aria-labelledby="home-tab" role="tabpanel">
                     <div class="card invoice-repeater">
                        <div data-repeater-list="items_year">
                           <div class="product_item" data-repeater-item>
                              <div class="row d-flex align-items-end">
                                 <div class="col-md-5 col-12">
                                    <div class="form-group">
                                       <label for="itemname">Product</label>
                                       <select data-placeholder="Select a product" onchange="calculator();" name="product_id" class="custom-select" id="customSelect" aria-describedby='qualification'>
                                          <option value="0" data-price="0" selected disabled>--Selece Products--</option>
                                          @foreach($products_yearly as $product)
                                          <option value="{{$product->id}}" data-price="{{$product->price}}">{{$product->name." ".strtoupper($product->currency).":".$product->price}}</option>
                                         @endforeach
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-4 col-12">
                                    <div class="form-group">
                                       <label for="itemname">Qty:</label>
                                       <div class="item-quantity">
                                          <div class="input-group input-group-lg">
                                             <input type="number" onchange="calculator();" class="form-control py-75 custom-touchspin-min-max" name="product_qty" value="1" min='1'/>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-3 col-12 mb-1">
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
                  <div class="tab-pane" id="month" aria-labelledby="home-tab" role="tabpanel">
                     <div class="card  invoice-repeater">
                        <div data-repeater-list="items_month">
                           <div class="product_item" data-repeater-item>
                              <div class="row d-flex align-items-end">
                                 <div class="col-md-5 col-12">
                                    <div class="form-group">
                                       <label for="itemname">Product</label>
                                       <select class="custom-select" onchange="calculator();" name="product_id" id="customSelect" aria-describedby='qualification'>
                                       <option value="0" data-price="0" selected disabled>--Selece Products--</option>
                                         @foreach($products_monthly as $product)
                                          <option value="{{$product->id}}" data-price="{{$product->price}}">{{$product->name." ".strtoupper($product->currency).":".$product->price}}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-4 col-12">
                                    <div class="form-group">
                                       <label for="itemname">Qty:</label>
                                       <div class="item-quantity">
                                          <div class="input-group input-group-lg">
                                             <input type="number" onchange="calculator();" class="py-75 custom-touchspin-min-max" name="product_qty" value="1" min='1'/>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-3 col-12 mb-1">
                                    <div class="form-group mb-0">
                                       <button class="btn btn-outline-danger text-nowrap px-1 delete-product" data-repeater-delete type="button">
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
                              <button class="btn btn-icon btn-primary add-more" onclick="setTimeout(function(){calculator();},350);"  type="button" data-repeater-create>
                              <i data-feather="plus" class="mr-25"></i>
                              <span>Add New</span>
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card  invoice-repeater">
                   <h4>Add Features</h4>
                        <div data-repeater-list="features">
                           <div data-repeater-item>
                              <div class="row d-flex align-items-end">
                                 <div class="col-md-9 col-12">
                                    
                                <div class="form-group">
                                    <label class="form-label" for="basic-icon-default-fullname">Feature Title</label>
                                    <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" name="feature_name" placeholder="Up to 10 users" aria-label="John Doe" />
                                </div>
                                 </div>
                                 
                                 <div class="col-md-3 col-12 mb-1">
                                    <div class="form-group mb-0">
                                       <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
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
                              <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                              <i data-feather="plus" class="mr-25"></i>
                              <span>Add New</span>
                              </button>
                           </div>
                        </div>
                     </div>
                     </div>  
                     </div>                         
            </div>

            <div class="modal-footer">
            
            <div class="plan_totat_amount h2 mr-2"></div>
               <button type="submit" class="btn btn-success mr-1 waves-effect waves-float waves-light">Create</button>   
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade text-left" id="update" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="update-holder"></div>
            </div>
        </div>
</div>

                                      

@endsection
@push('page-js')
<script src="{{ asset('app-assets/vendors/js/extensions/dragula.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/forms/form-repeater.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/extensions/ext-component-drag-drop.js') }}"></script>
<script>
               $('.interval-mode').on('change', function(){
                $('.product-tabs .tab-pane').removeClass('active');
                $('.product-tabs #'+$(this).val()).addClass('active');
            });
            var event = jQuery.Event("destroyed");
            $(document).trigger(event);
        $('.add-more, .interval-mode').bind('click','change', function(e){
            // $("input.custom-touchspin-min-max").trigger('touchspin.destroy');	
            
            setTimeout(function(e){ 
                $("input.custom-touchspin-min-max").TouchSpin({
                  min: 1,
                max: 100,
                initval: 1,
                });
                $('.product_item').bind('destroyed', function(event) {
                  setTimeout(function(e){   resetOptions(); calculator();},300);
                  });
            },300);
            
        }).trigger('click');

        function calculator(){
         var val = $('.interval-mode').val();
            var formData = new FormData($("#plans_create")[0]);
            $("#plans_create").find("button[type='submit]").prop('disabled',true);
               $.ajax({
                     type: "POST",
                     url: '/admin/plan/calculate',
                     data: formData, 
                     processData: false,
                     contentType: false,
                     success: function(e)
                     {
                        $("#plans_create").find("button[type='submit]").prop('disabled',false);
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
    $('.tab-pane.active .product_item').each(function(i){
      $(this).find('select').children("option").show();
            });

   
    $('.tab-pane.active .product_item').each(function(i){
        var selectedVal = $(this).find('select').val(); 
        var attrID = $(this).find('select').attr("name"); 
        $('.tab-pane.active .product_item').each(function(i){
            if($(this).find('select').attr("name") != attrID){
                if(selectedVal != "" && selectedVal != 0){
                    $(this).find('select').children("option[value="+selectedVal+"]").hide();
                }
            }
        });
    });
}
$(document).on('change','.product-tabs .tab-pane.active .product_item select',function(){
   resetOptions();
});
$(document).on('click','.add-more',function(){
   setTimeout(function(){resetOptions();},350);
});

var container = document.getElementById('drag-container');
var rows = container.children;

// forEach method from https://toddmotto.com/ditch-the-array-foreach-call-nodelist-hack/
var nodeListForEach = function (array, callback, scope) {
  for (var i = 0; i < array.length; i++) {
		callback.call(scope, i, array[i]);
  }
};

var sortableTable = dragula([container]);

sortableTable.on('dragend', function() {
   
  nodeListForEach(rows, function (index, row) {
    row.firstElementChild.textContent = index + 1;
    row.querySelector("#indexing").value =  index + 1;
    row.dataset.rowPosition = index + 1;
  });

  var formData = new FormData($(".drag-form")[0]);
   $.ajax({
                     type: "POST",
                     url: $(".drag-form").attr('action'),
                     data: formData, 
                     processData: false,
                     contentType: false,
                     success: function(e)
                     {
                        console.log('success');
                     }
   });
});
</script>
   <script src="{{ asset('app-assets/js/scripts/forms/form-number-input.js') }}"></script>
@endpush