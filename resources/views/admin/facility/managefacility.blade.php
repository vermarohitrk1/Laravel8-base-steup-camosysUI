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
                                        <h2 class="content-header-title float-left mb-0">Manage Facility</h2>
                                        <div class="breadcrumb-wrapper">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a>
                                                </li>
                                                <li class="breadcrumb-item active">Manage Facility
                                                </li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                                <div class="form-group breadcrumb-right">
                                <a href="{{ url('/admin/managefacility')}}" class="dt-button create-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button"><span>
                                <i data-feather='grid' class="mr-50"></i> All Facilities</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="content-body">
                            
               
                <section class="modern-vertical-wizard">
                    <div class="bs-stepper vertical wizard-modern modern-vertical-wizard-example">
                        <div class="bs-stepper-header">
                            <div class="step" data-target="#profile-info-vertical-modern">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-box">
                                    <i data-feather='archive' class="font-medium-3"></i>
                                    </span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Profile</span>
                                        <span class="bs-stepper-subtitle">Profile Details</span>
                                    </span>
                                </button>
                            </div>
                            <div class="step" data-target="#resident-info-vertical-modern">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-box">
                                        <i data-feather="users" class="font-medium-3"></i>
                                    </span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Residents</span>
                                        <span class="bs-stepper-subtitle">Residental Info</span>
                                    </span>
                                </button>
                            </div>
                            <div class="step" data-target="#contacts-info-vertical-modern">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-box">
                                    <i data-feather='file' class="font-medium-3"></i>
                                    </span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Contacts</span>
                                        <span class="bs-stepper-subtitle">Contact Information</span>
                                    </span>
                                </button>
                            </div>
                            <div class="step" data-target="#documents-info-vertical-modern">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-box">
                                    <i data-feather='file-text' class="font-medium-3"></i>
                                    </span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Document</span>
                                        <span class="bs-stepper-subtitle">Documents Information</span>
                                    </span>
                                </button>
                            </div>
                            <div class="step" data-target="#task-manager-info-vertical-modern">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-box">
                                    <i data-feather='twitch' class="font-medium-3"></i>
                                    </span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Task Manager</span>
                                        <span class="bs-stepper-subtitle"></span>
                                    </span>
                                </button>
                            </div>
                            <div class="step" data-target="#evecuation-info-vertical-modern">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-box">
                                    <i data-feather='anchor' class="font-medium-3"></i>
                                    </span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Evacuation Drill</span>
                                        <span class="bs-stepper-subtitle"></span>
                                    </span>
                                </button>
                            </div>
                            <div class="step" data-target="#mock-inspection-vertical-modern">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-box">
                                    <i data-feather='thermometer' class="font-medium-3"></i>
                                    </span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Mock Inspection</span>
                                        <span class="bs-stepper-subtitle"></span>
                                    </span>
                                </button>
                            </div>
                            <div class="step" data-target="#reports-vertical-modern">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-box">
                                    <i data-feather='alert-octagon' class="font-medium-3"></i>
                                    </span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Reports</span>
                                        <span class="bs-stepper-subtitle">Facility Report</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content app-user-view">
                            
                            <div id="profile-info-vertical-modern" class="col-12 content">
                            <div class="card user-card">
                                <div class="card-body">
                                    <div class="row match-height">
                                    <div class="col-md-5">
                                        <div class="card">
                                            <img class="card-img-top" src="../../../app-assets/images/slider/04.jpg" alt="Card image cap" />
                                            <div class="card-body">
                                                <h3 class="title">{{ $facility->name}}</h3>
                                                <div class="user-info-wrapper">
                                                <div class="d-flex flex-wrap">
                                                    <div class="user-info-title">
                                                    <i data-feather='star' class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">License</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{ $facility->license != '' ? $facility->license : '–'}}</p>
                                                </div>
                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="user-info-title">
                                                        <i data-feather="check" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">Status</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{ $facility->status != '' ? $facility->status : '–'}}</p>
                                                </div>
                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="user-info-title">
                                                        <i data-feather="user" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">Contact Name</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{ $facility->fname != '' ? $facility->fname.' '.$facility->lname : '–'}}</p>
                                                </div>
                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="user-info-title">
                                                        <i data-feather="phone" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">Phone</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{ $facility->phone != '' ? $facility->phone : '–'}}</p>
                                                </div>
                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="user-info-title">
                                                        <i data-feather='mail' class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">Email</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{ $facility->email != '' ? $facility->email : '–'}}</p>
                                                </div>
                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="user-info-title">
                                                        <i data-feather='hash' class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">Registration</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{ $facility->registration != '' ? $facility->registration : '–'}}</p>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-wrap mt-3">
                                                            <button type="button" class="btn btn-primary waves-effect waves-float waves-light" data-toggle="modal" data-target="#edit-facility" aria-haspopup="true" aria-expanded="false">
                                                                Edit
                                                            </button>
                                                               <!-- Button trigger modal -->
                                                            <form id="confirm-text" class="a" action="{{url('/admin/profile/status')}}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="id" value="">
                                                            <input type="hidden" name="status" value="@if('status' == 'Active') Inactive @else Active @endif">
                                                            @if(1)
                                                            <button type="submit" id="confirm-text" class="btn btn-outline-danger ml-1">Inactivate</button>
                                                             @else 
                                                             <button type="submit" class="btn btn-outline-success ml-1">Activate</button>
                                                             @endif
                                                            </form>
                                                        </div>
                                            </div>
                                        </div>
                                    </div>
                                        
                                        <div class="col-md-7">
                                        <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">General Information</h4>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-borderless">
                                                    
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <span class="font-weight-bold">License Number</span>
                                                                </td>
                                                                <td>
                                                                {{ $facility->license != '' ? $facility->license : '–'}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <span class="font-weight-bold">Address</span>
                                                                </td>
                                                                <td>
                                                                {{ $facility->address != '' ? $facility->address : '–'}}
                                                            </td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <span class="font-weight-bold">City</span>
                                                                </td>
                                                                <td>
                                                                {{ $facility->city != '' ? $facility->city : '–'}}
                                                            </td>
                                                                    
                                                            </tr><tr>
                                                                <td>
                                                                    <span class="font-weight-bold">State</span>
                                                                </td>
                                                                <td>
                                                                {{ $facility->state != '' ? $facility->state : '–'}}
                                                            </td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <span class="font-weight-bold">Zip Code</span>
                                                                </td>
                                                                <td>
                                                                {{ $facility->zip != '' ? $facility->zip : '–'}}
                                                            </td>
                                                                
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Contact Person's Information</h4>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-borderless">
                                                    
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                <span class="font-weight-bold">First Name</span>
                                                                </td>
                                                                <td>
                                                                {{ $facility->fname != '' ? $facility->fname : '–'}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <span class="font-weight-bold">Last Name</span>
                                                                </td>
                                                                <td>
                                                                {{ $facility->lname != '' ? $facility->lname : '–'}}
                                                            </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <span class="font-weight-bold">Phone Number</span>
                                                                </td>
                                                                <td>
                                                                {{ $facility->phone != '' ? $facility->phone : '–'}}
                                                            </td>
                                                                    
                                                            </tr><tr>
                                                                <td>
                                                                    <span class="font-weight-bold">Alternate Phone</span>
                                                                </td>
                                                                <td>
                                                                {{ $facility->alternate != '' ? $facility->alternate : '–'}}
                                                            </td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <span class="font-weight-bold">Fax Number</span>
                                                                </td>
                                                                <td>
                                                                {{ $facility->fax != '' ? $facility->fax : '–'}}
                                                            </td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <span class="font-weight-bold">Email</span>
                                                                </td>
                                                                <td>
                                                                {{ $facility->email != '' ? $facility->email : '–'}}
                                                            </td>
                                                                
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        <!-- end card-->
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="d-flex justify-content-between">
                                    <button class="btn btn-outline-secondary btn-prev" disabled>
                                        <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                    </button>
                                    <button class="btn btn-primary btn-next">
                                        <span class="align-middle d-sm-inline-block d-none">Next</span>
                                        <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                                    </button>
                                </div> -->
                            </div>
                        </div>
                           
                            <div id="resident-info-vertical-modern" class="content">
                            <div class="content-header">
                                    <h5 class="mb-0">General Information</h5>
                                    <small>Enter General Information</small>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-first-name">License Number</label>
                                        <input type="text" id="vertical-modern-first-name" name="license" class="form-control" placeholder="License Number" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-last-name">Address</label>
                                        <input type="text" id="vertical-modern-last-name" name="address" class="form-control" placeholder="Address" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-first-name">City</label>
                                        <input type="text" id="vertical-modern-first-name" name="city" class="form-control" placeholder="City" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-last-name">State</label>
                                        <input type="text" id="vertical-modern-last-name" name="state" class="form-control" placeholder="State" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-last-name">Zip Code</label>
                                        <input type="text" id="vertical-modern-last-name" name="zip" class="form-control" placeholder="Zip Code" />
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-primary btn-prev">
                                        <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                    </button>
                                    <a class="btn btn-primary btn-next">
                                        <span class="align-middle d-sm-inline-block d-none">Next</span>
                                        <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                                </a>
                                </div>
                            </div>
                            <div id="contacts-info-vertical-modern" class="content">
                            <div class="content-header">
                                    <h5 class="mb-0">General Information</h5>
                                    <small>Enter General Information</small>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-first-name">License Number</label>
                                        <input type="text" id="vertical-modern-first-name" name="license" class="form-control" placeholder="License Number" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-last-name">Address</label>
                                        <input type="text" id="vertical-modern-last-name" name="address" class="form-control" placeholder="Address" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-first-name">City</label>
                                        <input type="text" id="vertical-modern-first-name" name="city" class="form-control" placeholder="City" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-last-name">State</label>
                                        <input type="text" id="vertical-modern-last-name" name="state" class="form-control" placeholder="State" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-last-name">Zip Code</label>
                                        <input type="text" id="vertical-modern-last-name" name="zip" class="form-control" placeholder="Zip Code" />
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-primary btn-prev">
                                        <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                    </button>
                                    <a class="btn btn-primary btn-next">
                                        <span class="align-middle d-sm-inline-block d-none">Next</span>
                                        <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                                </a>
                                </div>
                            </div>
                            <div id="documents-info-vertical-modern" class="content">
                            <div class="content-header">
                                    <h5 class="mb-0">General Information</h5>
                                    <small>Enter General Information</small>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-first-name">License Number</label>
                                        <input type="text" id="vertical-modern-first-name" name="license" class="form-control" placeholder="License Number" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-last-name">Address</label>
                                        <input type="text" id="vertical-modern-last-name" name="address" class="form-control" placeholder="Address" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-first-name">City</label>
                                        <input type="text" id="vertical-modern-first-name" name="city" class="form-control" placeholder="City" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-last-name">State</label>
                                        <input type="text" id="vertical-modern-last-name" name="state" class="form-control" placeholder="State" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-last-name">Zip Code</label>
                                        <input type="text" id="vertical-modern-last-name" name="zip" class="form-control" placeholder="Zip Code" />
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-primary btn-prev">
                                        <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                    </button>
                                    <a class="btn btn-primary btn-next">
                                        <span class="align-middle d-sm-inline-block d-none">Next</span>
                                        <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                                </a>
                                </div>
                            </div>
                            <div id="task-manager-info-vertical-modern" class="content">
                            <div class="content-header">
                                    <h5 class="mb-0">General Information</h5>
                                    <small>Enter General Information</small>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-first-name">License Number</label>
                                        <input type="text" id="vertical-modern-first-name" name="license" class="form-control" placeholder="License Number" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-last-name">Address</label>
                                        <input type="text" id="vertical-modern-last-name" name="address" class="form-control" placeholder="Address" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-first-name">City</label>
                                        <input type="text" id="vertical-modern-first-name" name="city" class="form-control" placeholder="City" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-last-name">State</label>
                                        <input type="text" id="vertical-modern-last-name" name="state" class="form-control" placeholder="State" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-last-name">Zip Code</label>
                                        <input type="text" id="vertical-modern-last-name" name="zip" class="form-control" placeholder="Zip Code" />
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-primary btn-prev">
                                        <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                    </button>
                                    <a class="btn btn-primary btn-next">
                                        <span class="align-middle d-sm-inline-block d-none">Next</span>
                                        <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                                </a>
                                </div>
                            </div>
                            <div id="evecuation-info-vertical-modern" class="content">
                            <div class="content-header">
                                    <h5 class="mb-0">General Information</h5>
                                    <small>Enter General Information</small>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-first-name">License Number</label>
                                        <input type="text" id="vertical-modern-first-name" name="license" class="form-control" placeholder="License Number" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-last-name">Address</label>
                                        <input type="text" id="vertical-modern-last-name" name="address" class="form-control" placeholder="Address" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-first-name">City</label>
                                        <input type="text" id="vertical-modern-first-name" name="city" class="form-control" placeholder="City" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-last-name">State</label>
                                        <input type="text" id="vertical-modern-last-name" name="state" class="form-control" placeholder="State" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-last-name">Zip Code</label>
                                        <input type="text" id="vertical-modern-last-name" name="zip" class="form-control" placeholder="Zip Code" />
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-primary btn-prev">
                                        <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                    </button>
                                    <a class="btn btn-primary btn-next">
                                        <span class="align-middle d-sm-inline-block d-none">Next</span>
                                        <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                                </a>
                                </div>
                            </div>
                            <div id="mock-inspection-vertical-modern" class="content">
                            <div class="content-header">
                                    <h5 class="mb-0">General Information</h5>
                                    <small>Enter General Information</small>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-first-name">License Number</label>
                                        <input type="text" id="vertical-modern-first-name" name="license" class="form-control" placeholder="License Number" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-last-name">Address</label>
                                        <input type="text" id="vertical-modern-last-name" name="address" class="form-control" placeholder="Address" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-first-name">City</label>
                                        <input type="text" id="vertical-modern-first-name" name="city" class="form-control" placeholder="City" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-last-name">State</label>
                                        <input type="text" id="vertical-modern-last-name" name="state" class="form-control" placeholder="State" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-last-name">Zip Code</label>
                                        <input type="text" id="vertical-modern-last-name" name="zip" class="form-control" placeholder="Zip Code" />
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-primary btn-prev">
                                        <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                    </button>
                                    <a class="btn btn-primary btn-next">
                                        <span class="align-middle d-sm-inline-block d-none">Next</span>
                                        <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                                </a>
                                </div>
                            </div>

                            <div id="reports-vertical-modern" class="content">
                                <div class="content-header">
                                    <h5 class="mb-0">Social Links</h5>
                                    <small>Enter Your Social Links.</small>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-twitter">Twitter</label>
                                        <input type="text" id="vertical-modern-twitter" class="form-control" placeholder="https://twitter.com/abc" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-facebook">Facebook</label>
                                        <input type="text" id="vertical-modern-facebook" class="form-control" placeholder="https://facebook.com/abc" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-google">Google+</label>
                                        <input type="text" id="vertical-modern-google" class="form-control" placeholder="https://plus.google.com/abc" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-linkedin">Linkedin</label>
                                        <input type="text" id="vertical-modern-linkedin" class="form-control" placeholder="https://linkedin.com/abc" />
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-primary btn-prev">
                                        <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                    </button>
                                    <button class="btn btn-success btn-submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                
             </div>
        </div>
    </div>

    <div class="modal fade text-left" id="edit-facility" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel17">Edit Facility</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <section class="modern-vertical-wizard">
                                                        <form class="axios-form" action="{{ url('admin/managefacility/update')}}" method="post">
                                                                        @csrf
                                                                        <input type="hidden" name="id" value="{{$facility->id}}">
                                                            <div class="bs-stepper vertical wizard-modern modern-vertical-wizard-example2">
                                                                <div class="bs-stepper-header">
                                                                    <div class="step" data-target="#account-details-vertical-modern">
                                                                        <button type="button" class="step-trigger">
                                                                            <span class="bs-stepper-box">
                                                                                <i data-feather="file-text" class="font-medium-3"></i>
                                                                            </span>
                                                                            <span class="bs-stepper-label">
                                                                                <span class="bs-stepper-title">Subscription Details</span>
                                                                                <span class="bs-stepper-subtitle">Setup Subscription Details</span>
                                                                            </span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="step" data-target="#personal-info-vertical-modern">
                                                                        <button type="button" class="step-trigger">
                                                                            <span class="bs-stepper-box">
                                                                                <i data-feather="user" class="font-medium-3"></i>
                                                                            </span>
                                                                            <span class="bs-stepper-label">
                                                                                <span class="bs-stepper-title">General Information</span>
                                                                                <span class="bs-stepper-subtitle">Add General Information</span>
                                                                            </span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="step" data-target="#address-step-vertical-modern">
                                                                        <button type="button" class="step-trigger">
                                                                            <span class="bs-stepper-box">
                                                                                <i data-feather="map-pin" class="font-medium-3"></i>
                                                                            </span>
                                                                            <span class="bs-stepper-label">
                                                                                <span class="bs-stepper-title">Contact Person Information</span>
                                                                                <span class="bs-stepper-subtitle">Add Contact Person Information</span>
                                                                            </span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div class="bs-stepper-content">
                                                                    <div id="account-details-vertical-modern" class="content">
                                                                        <div class="content-header">
                                                                            <h5 class="mb-0">Subscription Details</h5>
                                                                            <small class="text-muted">Enter Subscription Details.</small>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label class="form-label" for="vertical-modern-first-name">Facility Name</label>
                                                                                <input type="text" id="vertical-modern-first-name" name="name" value="{{$facility->name}}" class="form-control" placeholder="Facility" />
                                                                            </div>
                                                                            
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label class="form-label" for="vertical-modern-country">Facility Thumbnail</label>
                                                                                <a href="javascript:void(0)" class="dt-button create-new btn btn-primary ml-5" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-toggle="modal" data-target="#imageChange">
                                                                                <i data-feather='upload-cloud'></i>  Upload
                                                                                            </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex justify-content-between">
                                                                            <a href="javascript:void(0) " class="btn btn-outline-secondary btn-prev" disabled>
                                                                                <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </a>
                                                                            <a href="javascript:void(0) " class="btn btn-primary btn-next">
                                                                                <span class="align-middle d-sm-inline-block d-none">Next</span>
                                                                                <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div id="personal-info-vertical-modern" class="content">
                                                                        <div class="content-header">
                                                                            <h5 class="mb-0">General Information</h5>
                                                                            <small>Enter General Information</small>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label class="form-label" for="vertical-modern-first-name">License Number</label>
                                                                                <input type="text" id="vertical-modern-first-name" name="license" value="{{$facility->license}}" class="form-control" placeholder="License Number" />
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label class="form-label" for="vertical-modern-last-name">Address</label>
                                                                                <input type="text" id="vertical-modern-last-name" name="address" value="{{$facility->address}}" class="form-control" placeholder="Address" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label class="form-label" for="vertical-modern-first-name">City</label>
                                                                                <input type="text" id="vertical-modern-first-name" name="city" value="{{$facility->city}}" class="form-control" placeholder="City" />
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label class="form-label" for="vertical-modern-last-name">State</label>
                                                                                <input type="text" id="vertical-modern-last-name" name="state" value="{{$facility->state}}" class="form-control" placeholder="State" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label class="form-label" for="vertical-modern-last-name">Zip Code</label>
                                                                                <input type="text" id="vertical-modern-last-name" name="zip" value="{{$facility->zip}}" class="form-control" placeholder="Zip Code" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex justify-content-between">
                                                                            <a href="javascript:void(0) " class="btn btn-primary btn-prev">
                                                                                <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </a>
                                                                            <a href="javascript:void(0) " class="btn btn-primary btn-next">
                                                                                <span class="align-middle d-sm-inline-block d-none">Next</span>
                                                                                <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div id="address-step-vertical-modern" class="content">
                                                                        <div class="content-header">
                                                                            <h5 class="mb-0">Contact Person Information</h5>
                                                                            <small>Enter Contact Person Information</small>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label class="form-label" for="vertical-modern-first-name">First Name</label>
                                                                                <input type="text" id="vertical-modern-first-name" name='fname' value="{{$facility->fname}}" class="form-control" placeholder="John" />
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label class="form-label" for="vertical-modern-last-name">Last Name</label>
                                                                                <input type="text" id="vertical-modern-last-name" name='lname' value="{{$facility->lname}}" class="form-control" placeholder="Doe" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label class="form-label" for="pincode4">Phone</label>
                                                                                <input type="text" id="pincode4" name="phone" class="form-control" value="{{$facility->phone}}" placeholder="Phone" />
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label class="form-label" for="city4">Alternate Phone</label>
                                                                                <input type="text" id="city4" class="form-control" name="alternate_phone" value="{{$facility->alternate}}" placeholder="Alternate Phone" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label class="form-label" for="vertical-modern-username">Fax</label>
                                                                                <input type="text" id="vertical-modern-username" name="fax" class="form-control" value="{{$facility->fax}}" placeholder="Fax" />
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label class="form-label" for="vertical-modern-email">Email</label>
                                                                                <input type="email" id="vertical-modern-email" class="form-control" name="email" value="{{$facility->email}}" placeholder="john.doe@email.com" aria-label="john.doe" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex justify-content-between">
                                                                            <a href="javascript:void(0) " class="btn btn-primary btn-prev">
                                                                                <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                                                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                            </a>
                                                                            <button type="submit" class="btn btn-success">Submit</button>
                                                                        </div>
                                                                    </div>                            
                                                                
                                                                </div>
                                                            </div>
                                                            </form>
                                                        </section>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            

                                            

@endsection