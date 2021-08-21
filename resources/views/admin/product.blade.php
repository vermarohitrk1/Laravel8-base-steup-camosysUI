@extends('layouts.app')

@section('content')

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
                        <div class="content-header row">
                            <div class="content-header-left col-md-9 col-12 mb-2">
                                <div class="row breadcrumbs-top">
                                    <div class="col-12">
                                        <h2 class="content-header-title float-left mb-0">Products</h2>
                                        <div class="breadcrumb-wrapper">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a>
                                                </li>
                                                <li class="breadcrumb-item active">Table products
                                                </li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                                <div class="form-group breadcrumb-right">
                                        <button class="btn-icon btn btn-primary btn-round btn-sm waves-effect waves-float waves-light" type="button" data-toggle="modal" data-target="#create" aria-haspopup="true" aria-expanded="false">
                                        Create New product
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
                                            <th>Name</th>
                                            <th>Product ID</th>
                                            <th>Slug</th>
                                            <th>Interval Mode</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   
                                    @foreach($products as $key => $product)
                                        @php $key += 1; @endphp
                                            <tr>
                                            <th scope="row">{{$key}}</th>
                                            <td>{{ $product->name}}</td>
                                            <td>{{$product->slug}}</td>
                                            <td>@if($product->tiered == 1)<span class="small">Start At:</span>@endif {{$product->price}}.00<span class="small">/US$</span></td>
                                            <td>{{ ucfirst($product->interval).'ly'}}</td>
                                            
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light" data-toggle="dropdown" aria-expanded="false">
                                                    <i data-feather="more-vertical"></i>                                                    </button>
                                                    <div class="dropdown-menu" style="">
                                                        <a class="dropdown-item fetch-display-click" data="id:{{ $product->id}}|_token:{{ csrf_token() }}" url="{{ url('admin/roles/edit')}}" href="javascript:void(0);" holder='.update-holder' modal="#update">
                                                        <i data-feather="edit-2" class="mr-50"></i>                                                            <span>Edit</span>
                                                        </a>
                                                        <form class="axios-form" action="{{route('manageproduct.destroy', $product->id)}}" method="post">
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Create New product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="axios-form add-new-record invoice-repeater" action="{{ route('manageproduct.store')}}">
                                @csrf
                                <div class="modal-body flex-grow-1">
                                    <div class="form-group">
                                        <label class="form-label" for="basic-icon-default-fullname">Name</label>
                                        <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" name="name" placeholder="John Doe" aria-label="John Doe" />
                                    </div>
                                    
                                    <div class="form-group">
                                       <label for="customSelect3">Interval</label>
                                       <select class="custom-select" name="interval" id="customSelect3" aria-describedby='qualification'>
                                          <option value="month">Monthly</option>
                                          <option value="year">Yearly</option>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                       <label for="itemname">Pricing Model</label>
                                       <select class="custom-select pricing-model" name="price_model" id="customSelect" aria-describedby='qualification'>
                                          <option value="standard">Standard Pricing</option>
                                          <option value="volume">Volume Pricing</option>
                                          
                                       </select>
                                    </div>
                                                        <div class="tab-content payout-tabs">
                                                                <div class="tab-pane active" id="standard" aria-labelledby="home-tab" role="tabpanel">
                                                                <label class="form-label" for="basic-icon-default-fullname">Amount</label>
                                                                 
                                                                  <div class="input-group input-group-merge mb-2">
                                                                                            <div class="input-group-prepend">
                                                                                                <span class="input-group-text">$</span>
                                                                                            </div>
                                                                                            <input type="text" class="form-control" id="itemname" name="amount" aria-describedby="itemname" value="0" placeholder="100" aria-label="Amount (to the nearest dollar)">
                                                                                            <div class="input-group-append">
                                                                                                <span class="input-group-text">.00</span>
                                                                                            </div>
                                                                                        </div>
                                                               </div>
                                                               <div class="tab-pane" id="volume" aria-labelledby="home-tab" role="tabpanel">
                                                                  
                                                                  <div class="card-body">
                                                                        <div data-repeater-list="tiers">
                                                                           <div data-repeater-item>
                                                                                 <div class="row d-flex align-items-end">
                                                                                    <div class="col-md-4 col-12">
                                                                                       <div class="form-group">
                                                                                             <label for="itemname">Item Up-to</label>
                                                                                             <input type="text" class="form-control" id="itemname" name="up_to" aria-describedby="itemname" placeholder="Vuexy Admin Template" />
                                                                                       </div>
                                                                                    </div>

                                                                                    <div class="col-md-4 col-12">
                                                                                    <label class="form-label" for="basic-icon-default-fullname">Amount</label>
                                                                                       <div class="input-group input-group-merge mb-1">
                                                                                            <div class="input-group-prepend">
                                                                                                <span class="input-group-text">$</span>
                                                                                            </div>
                                                                                            <input type="text" class="form-control" id="itemname" name="amount" aria-describedby="itemname" value="0" placeholder="100" aria-label="Amount (to the nearest dollar)">
                                                                                            <div class="input-group-append">
                                                                                                <span class="input-group-text">.00</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-4 col-12 mb-1">
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

                                                                        <div data-repeater-list="tiere">
                                                                           <div>
                                                                                 <div class="row d-flex align-items-end">
                                                                                    <div class="col-md-4 col-12">
                                                                                       <div class="form-group">
                                                                                             <label for="itemname">Item Up-to - Inf</label>
                                                                                             <input type="text" class="form-control" id="itemname" value="Infinity" disabled name="up_to_inf" aria-describedby="itemname" placeholder="Infinity" />
                                                                                       </div>
                                                                                    </div>

                                                                                    <div class="col-md-4 col-12">
                                                                                    <label class="form-label" for="basic-icon-default-fullname">Amount</label>
                                                                                       <div class="input-group input-group-merge mb-1">
                                                                                            <div class="input-group-prepend">
                                                                                                <span class="input-group-text">$</span>
                                                                                            </div>
                                                                                            <input type="text" class="form-control" id="itemname" name="amount_inf" value="0" aria-describedby="itemname"  placeholder="100" aria-label="Amount (to the nearest dollar)">
                                                                                            <div class="input-group-append">
                                                                                                <span class="input-group-text">.00</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-2 col-12 mb-50">
                                                                                       <div class="form-group">
                                                                                             <button class="btn btn-outline-danger text-nowrap px-1" disabled data-repeater-delete type="button">
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
                <button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light">Create</button>   
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
<script src="{{ asset('app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>

<script src="{{ asset('app-assets/js/scripts/forms/form-repeater.js') }}"></script>
<script>
               $('.pricing-model').on('change', function(){
                $('.payout-tabs .tab-pane').removeClass('active');
                $('.payout-tabs #'+$(this).val()).addClass('active');
            });
   </script>
@endpush