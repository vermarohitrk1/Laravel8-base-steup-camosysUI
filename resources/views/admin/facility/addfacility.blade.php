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
                                        <h2 class="content-header-title float-left mb-0">Add Facility</h2>
                                        <div class="breadcrumb-wrapper">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a>
                                                </li>
                                                <li class="breadcrumb-item active">Add Facility
                                                </li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                                <div class="form-group breadcrumb-right">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="content-body">
                <section class="modern-vertical-wizard">
                            <form class="axios-form" action="{{ url('admin/facilitystore')}}" method="post">
                                @csrf

                    <div class="bs-stepper vertical wizard-modern modern-vertical-wizard-example">
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
                                        <input type="text" id="vertical-modern-first-name" name="name" class="form-control" placeholder="Facility" />
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
                                        <input type="text" id="vertical-modern-first-name" name='fname' class="form-control" placeholder="John" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-last-name">Last Name</label>
                                        <input type="text" id="vertical-modern-last-name" name='lname' class="form-control" placeholder="Doe" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="pincode4">Phone</label>
                                        <input type="text" id="pincode4" name="phone" class="form-control" placeholder="Phone" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="city4">Alternate Phone</label>
                                        <input type="text" id="city4" class="form-control" name="alternate_phone" placeholder="Alternate Phone" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-username">Fax</label>
                                        <input type="text" id="vertical-modern-username" name="fax" class="form-control" placeholder="Fax" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-email">Email</label>
                                        <input type="email" id="vertical-modern-email" class="form-control" name="email" placeholder="john.doe@email.com" aria-label="john.doe" />
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

    @endsection