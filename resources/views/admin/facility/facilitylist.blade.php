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
                                <!-- <button class="dt-button filter-collapse btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" data-action="collapse" type="button"><span>
                                <i data-feather="filter"></i> Filter</span></button> -->
                                <a href="{{ url('/admin/addfacility')}}" class="dt-button create-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button"><span>
                                   <i data-feather="plus" class="mr-50"></i> Add New Facility</span> </a>
                                </div>
                            </div>
                        </div>
                        <div class="content-body">
                        <div class="row filter_collapse collapse">
                        <div class="col-md-12 col-sm-12">
                           <div class="card">
                              <div class="card-body">
                             
                              </div>
                           </div>
                        </div>
                    </div>
                    <section id="card-demo-example">
                        <div class="row match-height facility-card">
                            <!-- Profile Card -->
                           <input type="hidden" class="csrf-token-val" value="{{ csrf_token() }}">
                            <!--/ Profile Card -->
                        </div>
                    </section>
                        </div>
        </div>
    </div>

    <div class="modal fade text-left" id="create" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel1">Create New User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
         </div>
         <form id="validateFrom" class="axios-form" action="{{ route('managestaff.store') }}" method="post">
             @csrf
            <div class="modal-body">
               <section id="multiple-column-form">
                  <div class="row">
                     <div class="col-12">
                        <div class="card">
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-md-6 col-12">
                                    <div class="form-group">
                                       <label for="first-name-column">First Name</label>
                                       <input type="text" id="first-name-column" class="form-control" placeholder="First Name" name="fname" required />
                                       
                                    </div>
                                 </div>
                                 <div class="col-md-6 col-12">
                                    <div class="form-group">
                                       <label for="last-name-column">Last Name</label>
                                       <input type="text" id="last-name-column" class="form-control" placeholder="Last Name" name="lname" required/>
                                       
                                    </div>
                                 </div>
                                 <div class="col-12">
                                    <div class="form-group">
                                       <label for="email-id">Email</label>
                                       <input type="email" id="email" class="form-control" name="email" placeholder="Email" autocomplete="off" required/>
                                      
                                    </div>
                                 </div>
                                 <div class="col-12">
                                    <div class="form-group">
                                       <label for="password">Password</label>
                                       <input type="password" id="password" class="form-control" name="password" placeholder="Password" autocomplete="off" required/>
                                      
                                    </div>
                                 </div>
                                 <div class="col-12">
                                    <div class="form-group">
                                       <h5>Roles</h5>
                                       <div class="row">
                                          
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </section>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary waves-effect waves-float waves-light">Submit</button>
            </div>
         </form>
      </div>
   </div>
</div>



    @endsection

@push('page-js')
<script>
$(document).ready(function(e) {
  var s = '.facility-card';
  var status = 'Active'; 
  var role = '';
  var sort = 'name';
  var order = 'asc';
  var token = $('meta[name=csrf-token]').attr("content");
  var formData = new FormData();
  formData.append('_token', token);
  formData.append('status', status);
  formData.append('role', role);
  formData.append('sort', sort);
  formData.append('order', order);
  $.ajax({
      type: "POST",
      url: '/admin/managefacility/card',
      data: formData, 
      processData: false,
      contentType: false,
      success: function(e)
      {
              $(s).html(e)
              feather.replace();
      },
      error: function(e, i, n)
      {
        toastr['error']('😖 '+ n+'!<br> Please contact Rohit!', 'Oops!', {
                closeButton: true,
                tapToDismiss: false
              });
      }
    });
});
</script>
@endpush