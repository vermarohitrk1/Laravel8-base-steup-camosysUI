@extends('layouts.app')
@push('page-css')

<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/jquery.rateyo.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/pickers/form-pickadate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/page-profile.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-file-manager.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/new-crop.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/ext-component-ratings.css') }}">
@endpush
@section('content')
   
      <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="app-user-view">
                    <!-- User Card & Plan Starts -->
                    <div class="row">
                        <!-- User Card starts-->
                        <div class="col-xl-9 col-lg-8 col-md-7">
                            <div class="card user-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                                            <div class="user-avatar-section">
                                                <div class="d-flex justify-content-start">
                                                <div class="profile-img">
                                                <a href="javascript:void(0)" type="button" data-toggle="modal" data-target="#imageChange">
                                                     @if($user->profile != null)
                                                     @if($user->profile->profile_img != null)
                                                        <img class="img-fluid rounded" src="/uploads/images/{{ $user->profile->profile_img }}" height="104" width="104" alt="User avatar" />
                                                        @else
                                                        <img class="img-fluid rounded" src="{{ asset('/uploads/images/avatar.png') }}" height="104" width="104" alt="User avatar" />
                                                        @endif
                                                    @else
                                                    <img class="img-fluid rounded" src="{{ asset('/uploads/images/avatar.png') }}" height="104" width="104" alt="User avatar" />
                                                    
                                                    @endif
                                                    <div class="middel"><i data-feather='upload-cloud'></i></div>
                                                    </a>
                                                    </div>
                                                    <div class="d-flex flex-column ml-1">
                                                        <div class="user-info mb-1">

                                                            <h4 class="mb-0">
                                                              {{ $user->name }} {{ $user->lname }}</h4>
                                                             
                                                            <span class="card-text"> </span>
                                                        </div>
                                                        <div class="d-flex flex-wrap">
                                                            <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-float waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Update
                                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" style="">
                                               <a class="waves-effect dropdown-item fetch-display-click" data="id:{{$user->id}}|_token:{{ csrf_token() }}|type:update_role" url="{{ url('admin/profile/edit')}}" href="javascript:void(0);" holder='.update-holder' modal="#large"><i data-feather="edit" class="mr-50"></i>Update Role</a>
                                            
                                              <a class="dropdown-item fetch-display-click"  data="id:{{ $user->id}}|_token:{{ csrf_token() }}|type:update_employee_hiring" url="{{ url('admin/profile/edit')}}" href="javascript:void(0);" holder='.update-holder' modal="#large"><i data-feather='user-check' class="mr-50"></i>Employment Settings</a>

                                               <a class="dropdown-item fetch-display-click"  data="id:{{ $user->id}}|_token:{{ csrf_token() }}|type:update_employee" url="{{ url('admin/profile/edit')}}" href="javascript:void(0);" holder='.update-holder' modal="#large"><i data-feather="edit-3" class="mr-50"></i>Update Account Details</a>
                                               <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#qualification"><i data-feather="award" class="mr-50"></i>Update Qualification</a>
                                            
                                               <a class="waves-effect dropdown-item fetch-display-click" data-toggle="modal" data-target="#large"><i data-feather='refresh-ccw' class="mr-50"></i> Reset Password</a>
                                            </div>
                                                               <!-- Button trigger modal -->
                                                            <form id="confirm-text" class="a" action="{{url('/admin/profile/status')}}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{$user->id}}">
                                                            <input type="hidden" name="status" value="@if($user->status == 'Active') Inactive @else Active @endif">
                                                            @if($user->status == 'Active')
                                                            <button type="submit" id="confirm-text" class="btn btn-outline-danger ml-1">Inactivate</button>
                                                             @else 
                                                             <button type="submit" class="btn btn-outline-success ml-1">Activate</button>
                                                             @endif
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center user-total-numbers">
                                                <div class="d-flex align-items-center mr-2">
                                                    <div class="color-box bg-light-primary">
                                                        <i data-feather="dollar-sign" class="text-primary"></i>
                                                    </div>
                                                    <div class="ml-1">
                                                        <h5 class="mb-0">23.3k</h5>
                                                        <small>Monthly Sales</small>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="color-box bg-light-success">
                                                        <i data-feather="trending-up" class="text-success"></i>
                                                    </div>
                                                    <div class="ml-1">
                                                        <h5 class="mb-0">$99.87K</h5>
                                                        <small>Annual Profit</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-12 mt-2 mt-xl-0">
                                            <div class="user-info-wrapper">
                                                <div class="d-flex flex-wrap">
                                                    <div class="user-info-title">
                                                        <i data-feather="user" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">Email</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{ $user->email}}</p>
                                                </div>
                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="user-info-title">
                                                        <i data-feather="check" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">Status</span>
                                                    </div>
                                                    <p class="card-text mb-0">Active</p>
                                                </div>
                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="user-info-title">
                                                        <i data-feather="star" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">Role</span>
                                                    </div>
                                                    <p class="card-text mb-0"> @foreach(Auth::user()->roles as $role)
                                                        {{$role->name.' '}}
                                                        @endforeach</p>
                                                </div>
                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="user-info-title">
                                                        <i data-feather="flag" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">Country</span>
                                                    </div>
                                                    <p class="card-text mb-0">England</p>
                                                </div>
                                                <div class="d-flex flex-wrap">
                                                    <div class="user-info-title">
                                                        <i data-feather="phone" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">Contact</span>
                                                    </div>
                                                    <p class="card-text mb-0">
                                                       @if($user->profile != null)

                                                        {{ $user->profile->phone_number}}</p>
                                                        @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /User Card Ends-->

                        <!-- Plan Card starts-->
                        <div class="col-xl-3 col-lg-4 col-md-5">
                            <div class="card plan-card border-primary">
                                <div class="card-header d-flex justify-content-between align-items-center pt-75 pb-1">
                                    <h5 class="mb-0">Current Plan</h5>
                                    <span class="badge badge-light-secondary" data-toggle="tooltip" data-placement="top" title="Expiry Date">July 22, <span class="nextYear"></span>
                                    </span>
                                </div>
                                <div class="card-body">
                                    <div class="badge badge-light-primary">Basic</div>
                                    <ul class="list-unstyled my-1">
                                        <li>
                                            <span class="align-middle">5 Users</span>
                                        </li>
                                        <li class="my-25">
                                            <span class="align-middle">10 GB storage</span>
                                        </li>
                                        <li>
                                            <span class="align-middle">Basic Support</span>
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary text-center btn-block">Upgrade Plan</button>
                                </div>
                            </div>
                        </div>
                        <!-- /Plan CardEnds -->
                    </div>
                    <!-- User Card & Plan Ends -->
 <!-- User Card & Plan Starts -->

                    <!-- User Timeline & Permissions Starts -->
                    <div class="row">
                        <!-- information starts -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">General Information</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                    
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span class="font-weight-bold">Firstname</span>
                                                </td>
                                                <td>
                                                    
                                                    {{ $user->name != '' ? $user->name : '–'}}
                                                    
                                                </td>
                                                
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="font-weight-bold">Lastname</span>
                                                </td>
                                                <td>
                                            
                                                    {{ $user->lname != '' ? $user->lname : '–'}}
                                            </td>
                                                
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="font-weight-bold">Date of Birth</span>
                                                </td>
                                                <td>
                                                    @if($user->profile)
                                                    {{ $user->profile->date_of_birth != '' ? $user->profile->date_of_birth : '–'}}
                                                    @endif
                                            </td>
                                                
                                            </tr><tr>
                                                <td>
                                                    <span class="font-weight-bold">Creation Date</span>
                                                </td>
                                                <td>
                                                {{ $user->created_at != '' ? date('d M, Y', strtotime($user->created_at)) : '–'}}</td>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Hiring Informations</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                    
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span class="font-weight-bold">Hire Date</span>
                                                </td>
                                                <td>
                                                  
                                                    
                                                </td>
                                                
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="font-weight-bold">Termination Date</span>
                                                </td>
                                                <td>
                                                    
                                            </td>
                                                
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="font-weight-bold">Date of Birth</span>
                                                </td>
                                                <td>
                                            </td>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- information Ends -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Contact Person'S Information</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                    
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span class="font-weight-bold">Email</span>
                                                </td>
                                                <td>{{ $user->email}}</td>
                                                
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="font-weight-bold">Mobile</span>
                                                </td>
                                                <td>
                                                    @if($user->profile)
                                                    {{ $user->profile->phone_number}}
                                                    @endif
                                            </td>
                                                
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="font-weight-bold">Address</span>
                                                </td>
                                                <td>
                                                    @if($user->profile)
                                                    {{ $user->profile->address }}
                                                    @endif
                                            </td>
                                                    
                                            </tr><tr>
                                                <td>
                                                    <span class="font-weight-bold">Zipcode</span>
                                                </td>
                                                <td>
                                                    @if($user->profile)
                                                    {{ $user->profile->Zipcode}}
                                                    @endif
                                            </td>
                                                
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="font-weight-bold">State</span>
                                                </td>
                                                <td>
                                                    @if($user->profile)
                                                    {{ $user->profile->State}}
                                                    @endif
                                            </td>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Qualifications</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <thead>
                                        <th>Qualification</th>
                                        <th>CR Number</th>
                                        <th>Expire Date</th>
                                        </thead>
                                        <tbody>
                                        @if($user->qualifications)
                                        @foreach($user->qualifications as $qualification)
                                            <tr>
                                                <td>
                                                    <span class="font-weight-bold">{{$qualification->title}}</span>
                                                </td>
                                                <td>
                                                   {{$qualification->credentials_number}}
                                                </td>
                                                <td>
                                                    {{$qualification->expire_date}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                       
                            <!-- User Permissions Starts -->
                        

                        <!-- User Permissions Ends -->
                    </div>
                    <!-- User Timeline & Permissions Ends -->

                    <!-- User Invoice Starts-->
                    <div class="row invoice-list-wrapper">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-datatable table-responsive">
                                    <table class="invoice-list-table table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>#</th>
                                                <th><i data-feather="trending-up"></i></th>
                                                <th>Client</th>
                                                <th>Total</th>
                                                <th class="text-truncate">Issued Date</th>
                                                <th>Balance</th>
                                                <th>Invoice Status</th>
                                                <th class="cell-fit">Actions</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /User Invoice Ends-->
                </section>

            </div>
        </div>
    </div>
    <div class="modal-size-lg d-inline-block">
     
        <!-- Modal -->
        <div class="modal fade text-left" id="large" tabindex="-1" aria-labelledby="myModalLabel17" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    
                    <div class="update-holder">
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-left" id="imageChange" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Change Profile Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <!-- <form action="{{ url('admin/profile-avatar/update')}}" method="post" class="dropzone-dropzone-area" id="-dpz-single-file">
                    @csrf
                <div class="modal-body">
                    <input type="file" class="croppie" placeholder="Course Cover Image" crop-width="400" crop-height="400" accept="image/*" required=""> 
                
                
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary waves-effect waves-float waves-light">Upload</button>
                </div>
                </form> -->
                <div class="crop_box">
                    <form class="uploadform" method="post" enctype="multipart/form-data" action='' name="photo">	
                    @csrf
                        <div class="crop_set_upload">
                            <div class="crop_upload_label">Upload files: </div>
                            <div class="crop_select_image"><div class="file_browser"><input type="file" name="imagefile" id="imagefile" class="hide_broswe" /></div></div>
                            <!-- <div class="crop_select_image"><input type="submit" value="Upload" class="upload_button" name="submitbtn" id="submitbtn" /></div> -->
                        </div>
                    </form>			
                    <div class="crop_set_preview">
                        <div class="crop_preview_left"> 
                            <div class="crop_preview_box_big" id='viewimage'> 
                                
                            </div>
                        </div>
                        <div class="crop_preview_right">
                            Preview (150x150 px)
                            <div class="crop_preview_box_small" id='thumbviewimage' style="position:relative; overflow:hidden;"> </div>
                            
                            <form class="axios-form" name="thumbnail" action="{{ url('/admin/profile-avatar/change')}}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}" />
                                <input type="hidden" name="x1" value="" id="x1" />
                                <input type="hidden" name="y1" value="" id="y1" />
                                <input type="hidden" name="x2" value="" id="x2" />
                                <input type="hidden" name="y2" value="" id="y2" />
                                <input type="hidden" name="w" value="" id="w" />
                                <input type="hidden" name="h" value="" id="h" />
                                <input type="hidden" name="wr" value="" id="wr" />
                                
                                <input type="hidden" name="filename" value="" id="filename" />
                                <div class="crop_preview_submit">
                               
                                <input type="submit" name="upload_thumbnail" value="Save Thumbnail" id="save_thumb" class="submit_button" /> </div>
                            </form>
			    </div>
		</div>
	</div>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="qualification" tabindex="-1" aria-labelledby="myModalLabel16" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Update Qualifications</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <section class="form-control-repeater">
                    <div class="row">
                        <!-- Invoice repeater -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Qualifications</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('admin/user/qualification/update')}}" class="axios-form invoice-repeater">
                                    @csrf
                                    <input type="hidden" name="u_id" value="{{ $user->id}}">
                                        <div data-repeater-list="qualifications">
                                            <div data-repeater-item>
                                                <div class="row d-flex align-items-end">
                                                    <div class="col-md-4 col-12">
                                                        <input type="hidden" name="id" value="0">
                                                        <div class="form-group">
                                                            <label for="itemname">Qualification</label>
                                                            <select class="custom-select" name="qualification" id="customSelect" aria-describedby='qualification'>
                                                                <option selected="selected" disabled>Select Qualification</option>
                                                                <option value="75hrs">75hrs</option>
                                                                <option value="CPR">CPR</option>
                                                                <option value="NAR">NAR</option>
                                                                <option value="HCA">HCA</option>
                                                                <option value="CNA">CNA</option>
                                                                <option value="driving-licence">Driving Licence</option>
                                                                <option value="work-permit">Work Permit</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2 col-12">
                                                        <div class="form-group">
                                                            <label for="itemcost">CR Number</label>
                                                            <input type="text" name="cr_number" class="form-control" id="itemcost" aria-describedby="itemcost" placeholder="EX0CS1111" />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 col-12">
                                                        <div class="form-group">
                                                            <label for="itemquantity">Expire Date</label>
                                                            <input type="date" name="expire_date" id="pd-default-" aria-describedby="itemquantity" class="form-control" />
                                                        </div>
                                                    </div>

                                                    <!-- <div class="col-md-2 col-12">
                                                        <div class="form-group">
                                                            <label for="staticprice">Price</label>
                                                            <input type="text" readonly class="form-control-plaintext" id="staticprice" value="$32" />
                                                        </div>
                                                    </div> -->

                                                    <div class="col-md-2 col-12 mb-50">
                                                        <div class="form-group">
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
                                            <div class="col-12 d-flex flex-wrap">
                                                <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                                    <i data-feather="plus" class="mr-25"></i>
                                                    <span>Add New</span>
                                                </button>
                                                <button class="btn ml-1 btn-icon btn-success" type="submit">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /Invoice repeater -->
                    </div>
                </section>
            </div>
        </div>
    </div>

@endsection

@push('page-js')

    <script src="{{ asset('app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/legacy.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/pages/app-file-manager.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/pages/page-profile.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.form.js') }}"></script>
    <script src="{{ asset('assets/js/imageareaselect.js') }}"></script>
    <script src="{{ asset('assets/js/new-crop.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/pickers/form-pickers.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/form-repeater.js') }}"></script>
    
    <script src="{{ asset('app-assets/js/scripts/extensions/ext-component-ratings.js') }}"></script>
@endpush