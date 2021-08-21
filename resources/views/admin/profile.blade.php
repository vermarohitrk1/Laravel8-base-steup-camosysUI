@extends('layouts.app')
@push('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/page-profile.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-file-manager.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/new-crop.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-ecommerce.css')}}">
@endpush
@section('content')

   <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Profile</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Pages</a>
                                    </li>
                                    <li class="breadcrumb-item active">Profile
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="app-todo.html"><i class="mr-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="mr-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="mr-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="mr-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div id="user-profile">
                    <!-- profile header -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card profile-header mb-2">
                                <!-- profile cover photo -->
                                <img class="card-img-top" src="../../../app-assets/images/profile/user-uploads/timeline.jpg" alt="User Profile Image" />
                                <!--/ profile cover photo -->

                                <div class="position-relative">
                                    <!-- profile picture -->
                                    <div class="profile-img-container d-flex align-items-center">
                                        <a href="javascript:void(0)" type="button" data-toggle="modal" data-target="#imageChange">
                                        <div class="profile-img">
                                            <div class="overlay"></div>
                                            @if(Auth::user()->profile != null)
                                                @if(Auth::user()->profile->profile_img != null)
                                                <img src="/uploads/images/{{ Auth::user()->profile->profile_img }}" width="200px" class="rounded img-fluid" alt="Card image">
                                                @else
                                                <img src="{{ asset('/uploads/images/avatar.png') }}" width="200px" class="rounded img-fluid" alt="Card image"/>
                                                @endif
                                                @endif
                                            <i data-feather='edit-2'></i>
                                        </div>
                                        </a>
                                        <!-- profile title -->
                                        <div class="profile-title ml-3">
                                            <h2 class="text-white">{{ auth()->user()->name }}</h2>
                                            <p class="text-white">@foreach(Auth::user()->roles as $role) {{$role->name}} @endforeach</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- tabs pill -->
                                <div class="profile-header-nav">
                                    <!-- navbar -->
                                    <nav class="navbar navbar-expand-md navbar-light justify-content-end justify-content-md-between w-100">
                                        <button class="btn btn-icon navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                            <i data-feather="align-justify" class="font-medium-5"></i>
                                        </button>

                                        <!-- collapse  -->
                                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                            <div class="profile-tabs d-flex justify-content-between flex-wrap mt-1 mt-md-0">
                                                <ul class="nav nav-pills mb-0">
                                                 
                                                    <li class="nav-item">
                                                        <a class="nav-link font-weight-bold" data-item="Profile" href="javascript:void(0)">
                                                            <span class="d-none d-md-block">My Profile</span>
                                                            <i data-feather="info" class="d-block d-md-none"></i>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link font-weight-bold" data-item="Document" href="javascript:void(0)">
                                                            <span class="d-none d-md-block">My Document</span>
                                                            <i data-feather="image" class="d-block d-md-none"></i>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link font-weight-bold" data-item="Setting" href="javascript:void(0)">
                                                            <span class="d-none d-md-block">Setting</span>
                                                            <i data-feather="image" class="d-block d-md-none"></i>
                                                        </a>
                                                    </li>
                                                  
                                                </ul>
                                                <!-- edit button -->
                                             <!--  <a href="{{ url('admin/edit') }}" class="btn btn-primary">
                                                    
                                                    <i data-feather="edit" class="d-block d-md-none"></i>
                                                    <span class="font-weight-bold d-none d-md-block">Edit</span>
                                                </a> -->
                                            </div>
                                        </div>
                                        <!--/ collapse  -->
                                    </nav>
                                    <!--/ navbar -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ profile header -->

                    <!-- profile info section -->
                    <section id="profile-info">
                        <div class="row">
                           
                           <!-- left profile info section -->
                            <div class="col-lg-3 col-12 order-2 order-lg-1">
                                    @if(Auth::user()->hasRole('administrator'))
                                        @if(!is_null($user->user_subscription))
                                    <div class="card plan-card border-primary">
                                        <div class="card-header d-flex justify-content-between align-items-center pt-75 pb-1">
                                            <span><h5 class="mb-1">Current Plan</h5>
                                            <div class="badge badge-light-primary">{{$user->hasplan($user->user_subscription->plan_id)->name}}</div>
                                            </span> @php if($user->user_subscription->status == 'active'){$status ='success'; }elseif($user->user_subscription->status == 'trial'){$status = 'primary';} @endphp
                                             <span>
                                             <div class="d-block mb-1 badge badge-light-{{$status}}">{{ucfirst($user->user_subscription->status)}}</div>
                                            <span class="d-block badge badge-light-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Expiry Date & Renewal">{{date('M d',strtotime($user->user_subscription->end_date))}}, <span class="nextYear">{{date('Y',strtotime($user->user_subscription->end_date))}}</span>
                                            </span>
                                            </span>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-unstyled my-1">
                                            <li class="d-flex justify-content-between border-bottom">
                                                    <span class="align-middle h5">Products</span><span class="h5">Remaining</span>
                                                </li>
                                               
                                            @foreach($user->user_subscription->products as $key => $item)
                                              <li class="d-flex justify-content-between">
                                                    <span class="align-middle">{{$item->name}}</span><span>{{$user->has_products($item->id,$user->user_subscription->id)->quantity - $user->has_products($item->id,$user->user_subscription->id)->used}}/{{$user->has_products($item->id,$user->user_subscription->id)->quantity}}</span>
                                                </li>
                                            @endforeach
                                             
                                            </ul>
                                            <button onclick="location.href='/pricing'" class="btn btn-primary text-center btn-block waves-effect waves-float waves-light">Upgrade Plan</button>
                                        </div>
                                    </div>
                                        @else
                                        <div class="card plan-card border-primary">
                                        <div class="card-header d-flex justify-content-between align-items-center pt-75 pb-1">
                                            <h3 class="text-center w-100 my-2">You Don't have any Plan</h3>
                                        </div>
                                        <div class="card-body">
                                           
                                            <button class="btn btn-primary text-center btn-block waves-effect waves-float waves-light">View Pricing</button>
                                        </div>
                                    </div>
                                        @endif
                                    
                                <!-- card -->
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5>Card Detail</h5>
                                       <a class="fetch-display-click" data="_token:{{ csrf_token()}}" url="{{url('/admin/cards')}}" href="javascript:void(0);" holder=".update-holder" modal="#large"><span class="badge badge-primary" data-toggle="tooltip" data-placement="top"><i data-feather='plus'></i> Add Card</span>
                                        </a>
                                       </div>
                                    <div class="card-body">
                                        <div class="design-group mb-1">
                                            <h6 class="section-label">Card Number</h6>
                                            <h6 class="mb-0">xxxx xxxx xxxx 4444</h6>
                                            <h6 class="section-label">Exp/Date</h6>
                                            <h6 class="mb-0">02/2022</h6>
                                        </div>    
                                        <button class="btn btn-outline-danger text-center btn-block waves-effect waves-float waves-light">Cancel Subscription</button>
                                    </div>

                                </div>
                                <!--card -->
                                @endif
                                <!-- about -->
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="mb-75">About</h5>
                                        <p class="card-text">
                                            Tart I love sugar plum I love oat cake. Sweet ⭐️ roll caramels I love jujubes. Topping cake wafer.
                                        </p>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Joined:</h5>
                                            <p class="card-text"> {{ auth()->user()->created_at != '' ? date('d M, Y', strtotime(auth()->user()->created_at)) : '–'}}</td></p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Lives:</h5>
                                            <p class="card-text">@if(auth()->user()->profile)
                                                    {{ auth()->user()->profile->state != '' ? auth()->user()->profile->state.', ' : '' }} {{ auth()->user()->profile->country }} 
                                                    @endif</p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Email:</h5>
                                            <p class="card-text">{{ auth()->user()->email }}</p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-50">Website:</h5>
                                            <p class="card-text mb-0">www.pixinvent.com</p>
                                        </div>
                                    </div>
                                </div>
                                <!--/ about -->

                                <!--/ suggestion pages -->

                              
                                <!--/ twitter feed card -->
                            </div>
                            <!--/ left profile info section -->

                            <!-- center profile info section -->
                            <div id="profile" class="col-lg-9 col-12 order-1 order-lg-2 show">
                                <!-- post 1 -->
                                <div class="card">
                                    <div class="card-body">
                                    <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Profile</h4>
                                </div>
                                <div class="card-body">
                                
                                    <form class="form axios-form" method="post" action="{{ url('admin/profiledata') }}" >
                                         @csrf
                                         <input type="hidden" name="id" value="{{$user->id}}">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">First Name</label>
                                                    <input type="text" id="first-name-column" class="form-control" placeholder="First Name" name="name" value="{{ $user->name}}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Last Name</label>
                                                    <input type="text" id="last-name-column" class="form-control" placeholder="Last Name" name="lname" value="{{ $user->lname}}" />
                                                </div>
                                            </div>
                                             <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Email</label>
                                                    <input type="email" id="email-id-column" class="form-control" name="email" disabled placeholder="Email"value="{{ $user->email}}" />
                                                </div>
                                            </div>
                                              <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="company-column">Phone Number</label>
                                                    <input type="text" id="company-column" class="form-control" name="phone_number" placeholder="Phone Number" value="@if($user->profile){{ $user->profile->phone_number}}@endif" />
                                                </div>
                                            </div>
                                               <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="city-column">Address</label>
                                                    <input type="text" id="city-column" class="form-control" placeholder="Address" name="address" value="@if($user->profile){{ $user->profile->address}}@endif"/>
                                                </div>
                                            </div>
                                              <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="city-column">City</label>
                                                    <input type="text" id="city-column" class="form-control" placeholder="City" name="city" value="@if($user->profile){{ $user->profile->city}}@endif"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="city-column">State</label>
                                                    <input type="text" id="city-column" class="form-control" placeholder="State" name="state" value="@if($user->profile){{ $user->profile->state}}@endif"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="country-floating">Country</label>
                                                    <input type="text" id="country-floating" class="form-control" name="country" placeholder="Country" value="@if($user->profile){{ $user->profile->country}}@endif"/>
                                                </div>
                                            </div>
                                             <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="company-column">Zip</label>
                                                    <input type="text" id="company-column" class="form-control" name="zip" placeholder="Zip" value="@if($user->profile){{ $user->profile->zip}}@endif"/>
                                                </div>
                                            </div>
                                          
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mr-1">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                                    </div>
                                </div>
                            </div>
                            <div id="document" class="col-lg-9 col-12 order-1 order-lg-2 collapse">
                                <!-- post 1 -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="content-area-wrapper">
                                            <div class="sidebar-left">
                                                <div class="sidebar">
                                                    <div class="sidebar-file-manager">
                                                        <div class="sidebar-inner">
                                                            <!-- sidebar menu links starts -->
                                                            <!-- add file button -->
                                                            <div class="dropdown dropdown-actions">
                                                                <button class="btn btn-primary add-file-btn text-center btn-block" type="button" id="addNewFile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    <span class="align-middle">Add New</span>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="addNewFile">
                                                                    <div class="dropdown-item" data-toggle="modal" data-target="#new-folder-modal">
                                                                        <div class="mb-0">
                                                                            <i data-feather="folder" class="mr-25"></i>
                                                                            <span class="align-middle">Folder</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dropdown-item">
                                                                        <div class="mb-0" for="file-upload">
                                                                            <i data-feather="upload-cloud" class="mr-25"></i>
                                                                            <span class="align-middle">File Upload</span>
                                                                            <input type="file" id="file-upload" hidden />
                                                                        </div>
                                                                    </div>
                                                                    <div class="dropdown-item">
                                                                        <div for="folder-upload" class="mb-0">
                                                                            <i data-feather="upload-cloud" class="mr-25"></i>
                                                                            <span class="align-middle">Folder Upload</span>
                                                                            <input type="file" id="folder-upload" webkitdirectory mozdirectory hidden />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- add file button ends -->

                                                            <!-- sidebar list items starts  -->
                                                            <div class="sidebar-list">
                                                                <!-- links for file manager sidebar -->
                                                                <div class="list-group">
                                                                    <div class="my-drive"></div>
                                                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action active">
                                                                        <i data-feather="star" class="mr-50 font-medium-3"></i>
                                                                        <span class="align-middle">Important</span>
                                                                    </a>
                                                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                                                        <i data-feather="clock" class="mr-50 font-medium-3"></i>
                                                                        <span class="align-middle">Recents</span>
                                                                    </a>
                                                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                                                        <i data-feather="trash" class="mr-50 font-medium-3"></i>
                                                                        <span class="align-middle">Deleted Files</span>
                                                                    </a>
                                                                </div>
                                                                <div class="list-group list-group-labels">
                                                                    <h6 class="section-label px-2 mb-1">Labels</h6>
                                                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                                                        <i data-feather="file-text" class="mr-50 font-medium-3"></i>
                                                                        <span class="align-middle">Documents</span>
                                                                    </a>
                                                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                                                        <i data-feather="image" class="mr-50 font-medium-3"></i>
                                                                        <span class="align-middle">Images</span>
                                                                    </a>
                                                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                                                        <i data-feather="video" class="mr-50 font-medium-3"></i>
                                                                        <span class="align-middle">Videos</span>
                                                                    </a>
                                                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                                                        <i data-feather="music" class="mr-50 font-medium-3"></i>
                                                                        <span class="align-middle">Audio</span>
                                                                    </a>
                                                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                                                        <i data-feather="layers" class="mr-50 font-medium-3"></i>
                                                                        <span class="align-middle">Archives</span>
                                                                    </a>
                                                                </div>
                                                                <!-- links for file manager sidebar ends -->

                                                                <!-- storage status of file manager starts-->
                                                                <div class="storage-status mb-1 px-2">
                                                                    <h6 class="section-label mb-1">Storage Status</h6>
                                                                    <div class="d-flex align-items-center cursor-pointer">
                                                                        <i data-feather="server" class="font-large-1"></i>
                                                                        <div class="file-manager-progress ml-1">
                                                                            <span>68GB used of 100GB</span>
                                                                            <div class="progress progress-bar-primary my-50" style="height: 6px">
                                                                                <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="80" aria-valuemax="100" style="width: 80%"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- storage status of file manager ends-->
                                                            </div>
                                                            <!-- side bar list items ends  -->
                                                            <!-- sidebar menu links ends -->
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="content-right">
                                                <div class="content-wrapper">
                                                    <div class="content-header row">
                                                    </div>
                                                    <div class="content-body">
                                                        <!-- overlay container -->
                                                        <div class="body-content-overlay"></div>

                                                        <!-- file manager app content starts -->
                                                        <div class="file-manager-main-content">
                                                            <!-- search area start -->
                                                            <div class="file-manager-content-header d-flex justify-content-between align-items-center">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="sidebar-toggle d-block d-xl-none float-left align-middle ml-1">
                                                                        <i data-feather="menu" class="font-medium-5"></i>
                                                                    </div>
                                                                    <div class="input-group input-group-merge shadow-none m-0 flex-grow-1">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text border-0">
                                                                                <i data-feather="search"></i>
                                                                            </span>
                                                                        </div>
                                                                        <input type="text" class="form-control files-filter border-0 bg-transparent" placeholder="Search" />
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="file-actions">
                                                                        <i data-feather="arrow-down-circle" class="font-medium-2 cursor-pointer d-sm-inline-block d-none mr-50"></i>
                                                                        <i data-feather="trash" class="font-medium-2 cursor-pointer d-sm-inline-block d-none mr-50"></i>
                                                                        <i data-feather="alert-circle" class="font-medium-2 cursor-pointer d-sm-inline-block d-none" data-toggle="modal" data-target="#app-file-manager-info-sidebar"></i>
                                                                        <div class="dropdown d-inline-block">
                                                                            <i class="font-medium-2 cursor-pointer" data-feather="more-vertical" role="button" id="fileActions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            </i>
                                                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="fileActions">
                                                                                <a class="dropdown-item" href="javascript:void(0);">
                                                                                    <i data-feather="move" class="cursor-pointer mr-50"></i>
                                                                                    <span class="align-middle">Open with</span>
                                                                                </a>
                                                                                <a class="dropdown-item d-sm-none d-block" href="javascript:void(0);" data-toggle="modal" data-target="#app-file-manager-info-sidebar">
                                                                                    <i data-feather="alert-circle" class="cursor-pointer mr-50"></i>
                                                                                    <span class="align-middle">More Options</span>
                                                                                </a>
                                                                                <a class="dropdown-item d-sm-none d-block" href="javascript:void(0);">
                                                                                    <i data-feather="trash" class="cursor-pointer mr-50"></i>
                                                                                    <span class="align-middle">Delete</span>
                                                                                </a>
                                                                                <div class="dropdown-divider"></div>
                                                                                <a class="dropdown-item" href="javascript:void(0);">
                                                                                    <i data-feather="plus" class="cursor-pointer mr-50"></i>
                                                                                    <span class="align-middle">Add shortcut</span>
                                                                                </a>
                                                                                <a class="dropdown-item" href="javascript:void(0);">
                                                                                    <i data-feather="folder-plus" class="cursor-pointer mr-50"></i>
                                                                                    <span class="align-middle">Move to</span>
                                                                                </a>
                                                                                <a class="dropdown-item" href="javascript:void(0);">
                                                                                    <i data-feather="star" class="cursor-pointer mr-50"></i>
                                                                                    <span class="align-middle">Add to starred</span>
                                                                                </a>
                                                                                <a class="dropdown-item" href="javascript:void(0);">
                                                                                    <i data-feather="droplet" class="cursor-pointer mr-50"></i>
                                                                                    <span class="align-middle">Change color</span>
                                                                                </a>
                                                                                <div class="dropdown-divider"></div>
                                                                                <a class="dropdown-item" href="javascript:void(0);">
                                                                                    <i data-feather="download" class="cursor-pointer mr-50"></i>
                                                                                    <span class="align-middle">Download</span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="btn-group btn-group-toggle view-toggle ml-50" data-toggle="buttons">
                                                                        <label class="btn btn-outline-primary p-50 btn-sm active">
                                                                            <input type="radio" name="view-btn-radio" data-view="grid" checked />
                                                                            <i data-feather="grid"></i>
                                                                        </label>
                                                                        <label class="btn btn-outline-primary p-50 btn-sm">
                                                                            <input type="radio" name="view-btn-radio" data-view="list" />
                                                                            <i data-feather="list"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- search area ends here -->

                                                            <div class="file-manager-content-body">
                                                                <!-- drives area starts-->
                                                                <div class="drives">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <h6 class="files-section-title mb-75">Drives</h6>
                                                                        </div>
                                                                        <div class="col-lg-3 col-md-6 col-12">
                                                                            <div class="card shadow-none border cursor-pointer">
                                                                                <div class="card-body">
                                                                                    <div class="d-flex justify-content-between">
                                                                                        <img src="../../../app-assets/images/icons/drive.png" alt="google drive" height="38" />
                                                                                        <div class="dropdown-items-wrapper">
                                                                                            <i data-feather="more-vertical" id="dropdownMenuLink1" role="button" data-toggle="dropdown" aria-expanded="false"></i>
                                                                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink1">
                                                                                                <a class="dropdown-item" href="javascript:void(0)">
                                                                                                    <i data-feather="refresh-cw" class="mr-25"></i>
                                                                                                    <span class="align-middle">Refresh</span>
                                                                                                </a>
                                                                                                <a class="dropdown-item" href="javascript:void(0)">
                                                                                                    <i data-feather="settings" class="mr-25"></i>
                                                                                                    <span class="align-middle">Manage</span>
                                                                                                </a>
                                                                                                <a class="dropdown-item" href="javascript:void(0)">
                                                                                                    <i data-feather="trash" class="mr-25"></i>
                                                                                                    <span class="align-middle">Delete</span>
                                                                                                </a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="my-1">
                                                                                        <h5>Google drive</h5>
                                                                                    </div>
                                                                                    <div class="d-flex justify-content-between mb-50">
                                                                                        <span class="text-truncate">35GB Used</span>
                                                                                        <small class="text-muted">50GB</small>
                                                                                    </div>
                                                                                    <div class="progress progress-bar-warning progress-md mb-0" style="height: 10px">
                                                                                        <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="70" aria-valuemax="100" style="width: 70%"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3 col-md-6 col-12">
                                                                            <div class="card shadow-none border cursor-pointer">
                                                                                <div class="card-body">
                                                                                    <div class="d-flex justify-content-between">
                                                                                        <img src="../../../app-assets/images/icons/dropbox.png" alt="dropbox" height="38" />
                                                                                        <div class="dropdown-items-wrapper">
                                                                                            <i data-feather="more-vertical" id="dropdownMenuLink2" role="button" data-toggle="dropdown" aria-expanded="false"></i>
                                                                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink2">
                                                                                                <a class="dropdown-item" href="javascript:void(0)">
                                                                                                    <i data-feather="refresh-cw" class="mr-25"></i>
                                                                                                    <span class="align-middle">Refresh</span>
                                                                                                </a>
                                                                                                <a class="dropdown-item" href="javascript:void(0)">
                                                                                                    <i data-feather="settings" class="mr-25"></i>
                                                                                                    <span class="align-middle">Manage</span>
                                                                                                </a>
                                                                                                <a class="dropdown-item" href="javascript:void(0)">
                                                                                                    <i data-feather="trash" class="mr-25"></i>
                                                                                                    <span class="align-middle">Delete</span>
                                                                                                </a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="my-1">
                                                                                        <h5>Dropbox</h5>
                                                                                    </div>
                                                                                    <div class="d-flex justify-content-between mb-50">
                                                                                        <span class="text-truncate">1.2GB Used</span>
                                                                                        <small class="text-muted">2GB</small>
                                                                                    </div>
                                                                                    <div class="progress progress-bar-success progress-md mb-0" style="height: 10px">
                                                                                        <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="70" aria-valuemax="100" style="width: 68%"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3 col-md-6 col-12">
                                                                            <div class="card shadow-none border cursor-pointer">
                                                                                <div class="card-body">
                                                                                    <div class="d-flex justify-content-between">
                                                                                        <img src="../../../app-assets/images/icons/onedrivenew.png" alt="icloud" height="38" class="p-25" />
                                                                                        <div class="dropdown-items-wrapper">
                                                                                            <i data-feather="more-vertical" id="dropdownMenuLink3" role="button" data-toggle="dropdown" aria-expanded="false"></i>
                                                                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink3">
                                                                                                <a class="dropdown-item" href="javascript:void(0)">
                                                                                                    <i data-feather="refresh-cw" class="mr-25"></i>
                                                                                                    <span class="align-middle">Refresh</span>
                                                                                                </a>
                                                                                                <a class="dropdown-item" href="javascript:void(0)">
                                                                                                    <i data-feather="settings" class="mr-25"></i>
                                                                                                    <span class="align-middle">Manage</span>
                                                                                                </a>
                                                                                                <a class="dropdown-item" href="javascript:void(0)">
                                                                                                    <i data-feather="trash" class="mr-25"></i>
                                                                                                    <span class="align-middle">Delete</span>
                                                                                                </a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="my-1">
                                                                                        <h5>OneDrive</h5>
                                                                                    </div>
                                                                                    <div class="d-flex justify-content-between mb-50">
                                                                                        <span class="text-truncate">1.6GB Used</span>
                                                                                        <small class="text-muted">2GB</small>
                                                                                    </div>
                                                                                    <div class="progress progress-bar-primary progress-md mb-0" style="height: 10px">
                                                                                        <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="70" aria-valuemax="100" style="width: 80%"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-3 col-md-6 col-12">
                                                                            <div class="card shadow-none border cursor-pointer">
                                                                                <div class="card-body">
                                                                                    <div class="d-flex justify-content-between">
                                                                                        <img src="../../../app-assets/images/icons/icloud-1.png" alt="icloud" height="38" class="p-25" />
                                                                                        <div class="dropdown-items-wrapper">
                                                                                            <span data-feather="more-vertical" id="dropdownMenuLink4" role="button" data-toggle="dropdown" aria-expanded="false"></span>
                                                                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink4">
                                                                                                <a class="dropdown-item" href="javascript:void(0)">
                                                                                                    <i data-feather="refresh-cw" class="mr-25"></i>
                                                                                                    <span class="align-middle">Refresh</span>
                                                                                                </a>
                                                                                                <a class="dropdown-item" href="javascript:void(0)">
                                                                                                    <i data-feather="settings" class="mr-25"></i>
                                                                                                    <span class="align-middle">Manage</span>
                                                                                                </a>
                                                                                                <a class="dropdown-item" href="javascript:void(0)">
                                                                                                    <i data-feather="trash" class="mr-25"></i>
                                                                                                    <span class="align-middle">Delete</span>
                                                                                                </a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="my-1">
                                                                                        <h5>iCloud</h5>
                                                                                    </div>
                                                                                    <div class="d-flex justify-content-between mb-50">
                                                                                        <span class="text-truncate">1.8GB Used</span>
                                                                                        <small class="text-muted">3GB</small>
                                                                                    </div>
                                                                                    <div class="progress progress-bar-info progress-md mb-0" style="height: 10px">
                                                                                        <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="70" aria-valuemax="100" style="width: 60%"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- drives area ends-->

                                                                <!-- Folders Container Starts -->
                                                                <div class="view-container">
                                                                    <h6 class="files-section-title mt-25 mb-75">Folders</h6>
                                                                    <div class="files-header">
                                                                        <h6 class="font-weight-bold mb-0">Filename</h6>
                                                                        <div>
                                                                            <h6 class="font-weight-bold file-item-size d-inline-block mb-0">Size</h6>
                                                                            <h6 class="font-weight-bold file-last-modified d-inline-block mb-0">Last modified</h6>
                                                                            <h6 class="font-weight-bold d-inline-block mr-1 mb-0">Actions</h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card file-manager-item folder level-up">
                                                                        <div class="card-img-top file-logo-wrapper">
                                                                            <div class="d-flex align-items-center justify-content-center w-100">
                                                                                <i data-feather="arrow-up"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body pl-2 pt-0 pb-1">
                                                                            <div class="content-wrapper">
                                                                                <p class="card-text file-name mb-0">...</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card file-manager-item folder">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck1" />
                                                                            <label class="custom-control-label" for="customCheck1"></label>
                                                                        </div>
                                                                        <div class="card-img-top file-logo-wrapper">
                                                                            <div class="dropdown float-right">
                                                                                <i data-feather="more-vertical" class="toggle-dropdown mt-n25"></i>
                                                                            </div>
                                                                            <div class="d-flex align-items-center justify-content-center w-100">
                                                                                <i data-feather="folder"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="content-wrapper">
                                                                                <p class="card-text file-name mb-0">Projects</p>
                                                                                <p class="card-text file-size mb-0">2gb</p>
                                                                                <p class="card-text file-date">01 may 2019</p>
                                                                            </div>
                                                                            <small class="file-accessed text-muted">Last accessed: 21 hours ago</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card file-manager-item folder">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck2" />
                                                                            <label class="custom-control-label" for="customCheck2"></label>
                                                                        </div>
                                                                        <div class="card-img-top file-logo-wrapper">
                                                                            <div class="dropdown float-right">
                                                                                <i data-feather="more-vertical" class="toggle-dropdown mt-n25"></i>
                                                                            </div>
                                                                            <div class="d-flex align-items-center justify-content-center w-100">
                                                                                <i data-feather="folder"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="content-wrapper">
                                                                                <p class="card-text file-name mb-0">Design</p>
                                                                                <p class="card-text file-size mb-0">500mb</p>
                                                                                <p class="card-text file-date">05 may 2019</p>
                                                                            </div>
                                                                            <small class="file-accessed text-muted">Last accessed: 18 hours ago</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card file-manager-item folder">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck3" />
                                                                            <label class="custom-control-label" for="customCheck3"></label>
                                                                        </div>
                                                                        <div class="card-img-top file-logo-wrapper">
                                                                            <div class="dropdown float-right">
                                                                                <i data-feather="more-vertical" class="toggle-dropdown mt-n25"></i>
                                                                            </div>
                                                                            <div class="d-flex align-items-center justify-content-center w-100">
                                                                                <i data-feather="folder"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="content-wrapper">
                                                                                <p class="card-text file-name mb-0">UI Kit</p>
                                                                                <p class="card-text file-size mb-0">200mb</p>
                                                                                <p class="card-text file-date">01 may 2019</p>
                                                                            </div>
                                                                            <small class="file-accessed text-muted">Last accessed: 2 days ago</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card file-manager-item folder">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck4" />
                                                                            <label class="custom-control-label" for="customCheck4"></label>
                                                                        </div>
                                                                        <div class="card-img-top file-logo-wrapper">
                                                                            <div class="dropdown float-right">
                                                                                <i data-feather="more-vertical" class="toggle-dropdown mt-n25"></i>
                                                                            </div>
                                                                            <div class="d-flex align-items-center justify-content-center w-100">
                                                                                <i data-feather="folder"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="content-wrapper">
                                                                                <p class="card-text file-name mb-0">Documents</p>
                                                                                <p class="card-text file-size mb-0">50.3mb</p>
                                                                                <p class="card-text file-date">10 may 2019</p>
                                                                            </div>
                                                                            <small class="file-accessed text-muted">Last accessed: 6 days ago</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card file-manager-item folder">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck5" />
                                                                            <label class="custom-control-label" for="customCheck5"></label>
                                                                        </div>
                                                                        <div class="card-img-top file-logo-wrapper">
                                                                            <div class="dropdown float-right">
                                                                                <i data-feather="more-vertical" class="toggle-dropdown mt-n25"></i>
                                                                            </div>
                                                                            <div class="d-flex align-items-center justify-content-center w-100">
                                                                                <i data-feather="folder"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="content-wrapper">
                                                                                <p class="card-text file-name mb-0">Videos</p>
                                                                                <p class="card-text file-size mb-0">354mb</p>
                                                                                <p class="card-text file-date">08 may 2019</p>
                                                                            </div>
                                                                            <small class="file-accessed text-muted">Last accessed: 8 days ago</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card file-manager-item folder">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck6" />
                                                                            <label class="custom-control-label" for="customCheck6"></label>
                                                                        </div>
                                                                        <div class="card-img-top file-logo-wrapper">
                                                                            <div class="dropdown float-right">
                                                                                <i data-feather="more-vertical" class="toggle-dropdown mt-n25"></i>
                                                                            </div>
                                                                            <div class="d-flex align-items-center justify-content-center w-100">
                                                                                <i data-feather="folder"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="content-wrapper">
                                                                                <p class="card-text file-name mb-0">Styles</p>
                                                                                <p class="card-text file-size mb-0">32.2mb</p>
                                                                                <p class="card-text file-date">05 may 2019</p>
                                                                            </div>
                                                                            <small class="file-accessed text-muted">Last accessed: 2 months ago</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-none flex-grow-1 align-items-center no-result mb-3">
                                                                        <i data-feather="alert-circle" class="mr-50"></i>
                                                                        No Results
                                                                    </div>
                                                                </div>
                                                                <!-- /Folders Container Ends -->

                                                                <!-- Files Container Starts -->
                                                                <div class="view-container">
                                                                    <h6 class="files-section-title mt-2 mb-75">Files</h6>
                                                                    <div class="card file-manager-item file">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck7" />
                                                                            <label class="custom-control-label" for="customCheck7"></label>
                                                                        </div>
                                                                        <div class="card-img-top file-logo-wrapper">
                                                                            <div class="dropdown float-right">
                                                                                <i data-feather="more-vertical" class="toggle-dropdown mt-n25"></i>
                                                                            </div>
                                                                            <div class="d-flex align-items-center justify-content-center w-100">
                                                                                <img src="../../../app-assets/images/icons/jpg.png" alt="file-icon" height="35" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="content-wrapper">
                                                                                <p class="card-text file-name mb-0">Profile.jpg</p>
                                                                                <p class="card-text file-size mb-0">12.6mb</p>
                                                                                <p class="card-text file-date">23 may 2019</p>
                                                                            </div>
                                                                            <small class="file-accessed text-muted">Last accessed: 3 hours ago</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card file-manager-item file">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck8" />
                                                                            <label class="custom-control-label" for="customCheck8"></label>
                                                                        </div>
                                                                        <div class="card-img-top file-logo-wrapper">
                                                                            <div class="dropdown float-right">
                                                                                <i data-feather="more-vertical" class="toggle-dropdown mt-n25"></i>
                                                                            </div>
                                                                            <div class="d-flex align-items-center justify-content-center w-100">
                                                                                <img src="../../../app-assets/images/icons/doc.png" alt="file-icon" height="35" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="content-wrapper">
                                                                                <p class="card-text file-name mb-0">account.doc</p>
                                                                                <p class="card-text file-size mb-0">82kb</p>
                                                                                <p class="card-text file-date">25 may 2019</p>
                                                                            </div>
                                                                            <small class="file-accessed text-muted">Last accessed: 23 minutes ago</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card file-manager-item file">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck9" />
                                                                            <label class="custom-control-label" for="customCheck9"></label>
                                                                        </div>
                                                                        <div class="card-img-top file-logo-wrapper">
                                                                            <div class="dropdown float-right">
                                                                                <i data-feather="more-vertical" class="toggle-dropdown mt-n25"></i>
                                                                            </div>
                                                                            <div class="d-flex align-items-center justify-content-center w-100">
                                                                                <img src="../../../app-assets/images/icons/txt.png" alt="file-icon" height="35" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="content-wrapper">
                                                                                <p class="card-text file-name mb-0">notes.txt</p>
                                                                                <p class="card-text file-size mb-0">54kb</p>
                                                                                <p class="card-text file-date">01 may 2019</p>
                                                                            </div>
                                                                            <small class="file-accessed text-muted">Last accessed: 43 minutes ago</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card file-manager-item file">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheck10" />
                                                                            <label class="custom-control-label" for="customCheck10"></label>
                                                                        </div>
                                                                        <div class="card-img-top file-logo-wrapper">
                                                                            <div class="dropdown float-right">
                                                                                <i data-feather="more-vertical" class="toggle-dropdown mt-n25"></i>
                                                                            </div>
                                                                            <div class="d-flex align-items-center justify-content-center w-100">
                                                                                <img src="../../../app-assets/images/icons/json.png" alt="file-icon" height="35" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="content-wrapper">
                                                                                <p class="card-text file-name mb-0">users.json</p>
                                                                                <p class="card-text file-size mb-0">200kb</p>
                                                                                <p class="card-text file-date">12 may 2019</p>
                                                                            </div>
                                                                            <small class="file-accessed text-muted">Last accessed: 1 hour ago</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-none flex-grow-1 align-items-center no-result mb-3">
                                                                        <i data-feather="alert-circle" class="mr-50"></i>
                                                                        No Results
                                                                    </div>
                                                                </div>
                                                                <!-- /Files Container Ends -->
                                                            </div>
                                                        </div>
                                                        <!-- file manager app content ends -->

                                                        <!-- File Info Sidebar Starts-->
                                                        <div class="modal modal-slide-in fade show" id="app-file-manager-info-sidebar">
                                                            <div class="modal-dialog sidebar-lg">
                                                                <div class="modal-content p-0">
                                                                    <div class="modal-header d-flex align-items-center justify-content-between mb-1 p-2">
                                                                        <h5 class="modal-title">menu.js</h5>
                                                                        <div>
                                                                            <i data-feather="trash" class="cursor-pointer mr-50" data-dismiss="modal"></i>
                                                                            <i data-feather="x" class="cursor-pointer" data-dismiss="modal"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-body flex-grow-1 pb-sm-0 pb-1">
                                                                        <ul class="nav nav-tabs tabs-line" role="tablist">
                                                                            <li class="nav-item">
                                                                                <a class="nav-link active" data-toggle="tab" href="#details-tab" role="tab" aria-controls="details-tab" aria-selected="true">
                                                                                    <i data-feather="file"></i>
                                                                                    <span class="align-middle ml-25">Details</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="nav-item">
                                                                                <a class="nav-link" data-toggle="tab" href="#activity-tab" role="tab" aria-controls="activity-tab" aria-selected="true">
                                                                                    <i data-feather="activity"></i>
                                                                                    <span class="align-middle ml-25">Activity</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                        <div class="tab-content" id="myTabContent">
                                                                            <div class="tab-pane fade show active" id="details-tab" role="tabpanel" aria-labelledby="details-tab">
                                                                                <div class="d-flex flex-column justify-content-center align-items-center py-5">
                                                                                    <img src="../../../app-assets/images/icons/js.png" alt="file-icon" height="64" />
                                                                                    <p class="mb-0 mt-1">54kb</p>
                                                                                </div>
                                                                                <h6 class="file-manager-title my-2">Settings</h6>
                                                                                <ul class="list-unstyled">
                                                                                    <li class="d-flex justify-content-between align-items-center mb-1">
                                                                                        <span>File Sharing</span>
                                                                                        <div class="custom-control custom-switch">
                                                                                            <input type="checkbox" class="custom-control-input" id="sharing" />
                                                                                            <label class="custom-control-label" for="sharing"></label>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li class="d-flex justify-content-between align-items-center mb-1">
                                                                                        <span>Synchronization</span>
                                                                                        <div class="custom-control custom-switch">
                                                                                            <input type="checkbox" class="custom-control-input" checked id="sync" />
                                                                                            <label class="custom-control-label" for="sync"></label>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li class="d-flex justify-content-between align-items-center mb-1">
                                                                                        <span>Backup</span>
                                                                                        <div class="custom-control custom-switch">
                                                                                            <input type="checkbox" class="custom-control-input" id="backup" />
                                                                                            <label class="custom-control-label" for="backup"></label>
                                                                                        </div>
                                                                                    </li>
                                                                                </ul>
                                                                                <hr class="my-2" />
                                                                                <h6 class="file-manager-title my-2">Info</h6>
                                                                                <ul class="list-unstyled">
                                                                                    <li class="d-flex justify-content-between align-items-center">
                                                                                        <p>Type</p>
                                                                                        <p class="font-weight-bold">JS</p>
                                                                                    </li>
                                                                                    <li class="d-flex justify-content-between align-items-center">
                                                                                        <p>Size</p>
                                                                                        <p class="font-weight-bold">54kb</p>
                                                                                    </li>
                                                                                    <li class="d-flex justify-content-between align-items-center">
                                                                                        <p>Location</p>
                                                                                        <p class="font-weight-bold">Files > Documents</p>
                                                                                    </li>
                                                                                    <li class="d-flex justify-content-between align-items-center">
                                                                                        <p>Owner</p>
                                                                                        <p class="font-weight-bold">Sheldon Cooper</p>
                                                                                    </li>
                                                                                    <li class="d-flex justify-content-between align-items-center">
                                                                                        <p>Modified</p>
                                                                                        <p class="font-weight-bold">12th Aug, 2020</p>
                                                                                    </li>

                                                                                    <li class="d-flex justify-content-between align-items-center">
                                                                                        <p>Created</p>
                                                                                        <p class="font-weight-bold">01 Oct, 2019</p>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="tab-pane fade" id="activity-tab" role="tabpanel" aria-labelledby="activity-tab">
                                                                                <h6 class="file-manager-title my-2">Today</h6>
                                                                                <div class="media align-items-center mb-2">
                                                                                    <div class="avatar avatar-sm mr-50">
                                                                                        <img src="../../../app-assets/images/avatars/5-small.png" alt="avatar" width="28" />
                                                                                    </div>
                                                                                    <div class="media-body">
                                                                                        <p class="mb-0">
                                                                                            <span class="font-weight-bold">Mae</span>
                                                                                            shared the file with
                                                                                            <span class="font-weight-bold">Howard</span>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="media align-items-center">
                                                                                    <div class="avatar avatar-sm bg-light-primary mr-50">
                                                                                        <span class="avatar-content">SC</span>
                                                                                    </div>
                                                                                    <div class="media-body">
                                                                                        <p class="mb-0">
                                                                                            <span class="font-weight-bold">Sheldon</span>
                                                                                            updated the file
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <h6 class="file-manager-title mt-3 mb-2">Yesterday</h6>
                                                                                <div class="media align-items-center mb-2">
                                                                                    <div class="avatar avatar-sm bg-light-success mr-50">
                                                                                        <span class="avatar-content">LH</span>
                                                                                    </div>
                                                                                    <div class="media-body">
                                                                                        <p class="mb-0">
                                                                                            <span class="font-weight-bold">Leonard</span>
                                                                                            renamed this file to
                                                                                            <span class="font-weight-bold">menu.js</span>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="media align-items-center">
                                                                                    <div class="avatar avatar-sm mr-50">
                                                                                        <img src="../../../app-assets/images/portrait/small/avatar-s-1.jpg" alt="Avatar" width="28" />
                                                                                    </div>
                                                                                    <div class="media-body">
                                                                                        <p class="mb-0">
                                                                                            <span class="font-weight-bold">You</span>
                                                                                            shared this file with Leonard
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <h6 class="file-manager-title mt-3 mb-2">3 days ago</h6>
                                                                                <div class="media">
                                                                                    <div class="avatar avatar-sm mr-50">
                                                                                        <img src="../../../app-assets/images/portrait/small/avatar-s-1.jpg" alt="Avatar" width="28" />
                                                                                    </div>
                                                                                    <div class="media-body">
                                                                                        <p class="mb-50">
                                                                                            <span class="font-weight-bold">You</span>
                                                                                            uploaded this file
                                                                                        </p>
                                                                                        <img src="../../../app-assets/images/icons/js.png" alt="Avatar" class="mr-50" height="24" />
                                                                                        <span class="font-weight-bold">app.js</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- File Info Sidebar Ends -->

                                                        <!-- File Dropdown Starts-->
                                                        <div class="dropdown-menu dropdown-menu-right file-dropdown">
                                                            <a class="dropdown-item" href="javascript:void(0);">
                                                                <i data-feather="eye" class="align-middle mr-50"></i>
                                                                <span class="align-middle">Preview</span>
                                                            </a>
                                                            <a class="dropdown-item" href="javascript:void(0);">
                                                                <i data-feather="user-plus" class="align-middle mr-50"></i>
                                                                <span class="align-middle">Share</span>
                                                            </a>
                                                            <a class="dropdown-item" href="javascript:void(0);">
                                                                <i data-feather="copy" class="align-middle mr-50"></i>
                                                                <span class="align-middle">Make a copy</span>
                                                            </a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="javascript:void(0);">
                                                                <i data-feather="edit" class="align-middle mr-50"></i>
                                                                <span class="align-middle">Rename</span>
                                                            </a>
                                                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#app-file-manager-info-sidebar">
                                                                <i data-feather="info" class="align-middle mr-50"></i>
                                                                <span class="align-middle">Info</span>
                                                            </a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="javascript:void(0);">
                                                                <i data-feather="trash" class="align-middle mr-50"></i>
                                                                <span class="align-middle">Delete</span>
                                                            </a>
                                                            <a class="dropdown-item" href="javascript:void(0);">
                                                                <i data-feather="alert-circle" class="align-middle mr-50"></i>
                                                                <span class="align-middle">Report</span>
                                                            </a>
                                                        </div>
                                                        <!-- /File Dropdown Ends -->

                                                        <!-- Create New Folder Modal Starts-->
                                                        <div class="modal fade" id="new-folder-modal">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">New Folder</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <input type="text" class="form-control" value="New folder" placeholder="Untitled folder" />
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-primary mr-1" data-dismiss="modal">Create</button>
                                                                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- /Create New Folder Modal Ends -->

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="setting" class="col-lg-9 col-12 order-1 order-lg-2 collapse">
                                <!-- post 1 -->
                                <div class="card">
                                    <div class="card-body">
                                    <div class="col-12">
                                                <div class="table-responsive border rounded mt-1">
                                                    <h6 class="py-1 mx-1 mb-0 font-medium-2">
                                                    <i data-feather='info' class="font-medium-3 mr-25"></i>
                                                        <span class="align-middle">Notification Setting</span>
                                                    </h6>
                                                    <table class="table">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th colspan="2">Module</th>
                                                                
                                                                <th>Application</th>
                                                                <th>Email</th>
                                                                <th>SMS</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="2">Password Expiration</td>
                                                                
                                                                <td>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="admin-write" />
                                                                        <label class="custom-control-label" for="admin-write"></label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="admin-create" />
                                                                        <label class="custom-control-label" for="admin-create"></label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="admin-delete" />
                                                                        <label class="custom-control-label" for="admin-delete"></label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ center profile info section -->

                            <!-- right profile info section -->
                            
                            <!--/ right profile info section -->
                        </div>

                        <!-- reload button -->
                      
                        <!--/ reload button -->
                    </section>
                    <!--/ profile info section -->
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
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}" />
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

    <div class="modal fade text-left" id="large" tabindex="-1" aria-labelledby="myModalLabel17" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    
                    <div class="update-holder">
                        
                    </div>
                    
                </div>
            </div>
    </div>
@endsection

@push('page-js')
<script src="{{ asset('app-assets/js/scripts/pages/app-file-manager.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/pages/page-profile.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.form.js') }}"></script>
    <script src="{{ asset('assets/js/imageareaselect.js') }}"></script>
    <script src="{{ asset('assets/js/new-crop.js') }}"></script>
    <script src="https://js.stripe.com/v3/"></script>
@endpush