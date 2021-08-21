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
                                        <h2 class="content-header-title float-left mb-0">Manage Staff</h2>
                                        <div class="breadcrumb-wrapper">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a>
                                                </li>
                                                <li class="breadcrumb-item active">Manage Staff
                                                </li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                                <div class="form-group breadcrumb-right">
                                <button class="dt-button filter-collapse btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" data-action="collapse" type="button"><span>
                                <i data-feather="filter"></i> Filter</span></button>
                                <button class="dt-button create-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-toggle="modal" data-target="#create"><span>
                                    <i data-feather="plus" class="mr-50"></i> Add New Staff</span></button>
                                </div>
                            </div>
                        </div>
                        <div class="content-body">
                        <div class="row filter_collapse collapse">
                        <div class="col-md-12 col-sm-12">
                           <div class="card">
                              <div class="card-body">
                              <form class="filter-form" action="" method="">
                                 @csrf
                                 <div class="row">
                              <div class="col-lg-3 col-md-3 col-4">
                                 <h4 class="card-title">Status</h4>
                                 <div class="custom-control custom-radio">
                                             <input type="radio" id="customRadio1" name="status" value="" class="custom-control-input">
                                             <label class="custom-control-label" for="customRadio1">All</label>
                                 </div>
                                 <div class="custom-control custom-radio">
                                             <input type="radio" id="customRadio2" name="status" value="Active" class="custom-control-input" checked="">
                                             <label class="custom-control-label" for="customRadio2">Active</label>
                                 </div>
                                 <div class="custom-control custom-radio">
                                             <input type="radio" id="customRadio3" name="status" value="Inactive" class="custom-control-input">
                                             <label class="custom-control-label" for="customRadio3">Inactive</label>
                                 </div>
                              </div>
                              <div class="col-lg-3 col-md-3 col-4">
                                          <h4 class="card-title">Role</h4>
                                             <div class="custom-control custom-radio">
                                             <input type="radio" id="role00" name="role" value="" class="custom-control-input" checked="">
                                             <label class="custom-control-label" for="role00">All</label>
                                             </div>
                                             @foreach($roles as $key => $role)
                                                <div class="custom-control custom-radio">
                                                            <input type="radio" id="role{{$key}}" name="role" value="{{$role->id}}" class="custom-control-input">
                                                            <label class="custom-control-label" for="role{{$key}}">{{$role->name}}</label>
                                                </div>
                                             @endforeach
                              </div>
                              <div class="col-lg-3 col-md-3 col-4">
                                 <h4 class="card-title">Sort By</h4>
                                 <div class="custom-control custom-radio">
                                             <input type="radio" id="sortName" name="sort" value="name" class="custom-control-input" checked="">
                                             <label class="custom-control-label" for="sortName">Name</label>
                                 </div>
                                 <div class="custom-control custom-radio">
                                             <input type="radio" id="sortDate" name="sort" value="created_at" class="custom-control-input">
                                             <label class="custom-control-label" for="sortDate">Date</label>
                                 </div>
                              </div>
                              <div class="col-lg-3 col-md-3 col-4">
                                 <h4 class="card-title">Order By</h4>
                                 <div class="custom-control custom-radio">
                                             <input type="radio" id="sortAsc" name="order" value="asc" class="custom-control-input" checked="">
                                             <label class="custom-control-label" for="sortAsc">Asc</label>
                                 </div>
                                 <div class="custom-control custom-radio">
                                             <input type="radio" id="sortDesc" name="order" value="desc" class="custom-control-input">
                                             <label class="custom-control-label" for="sortDesc">Desc</label>
                                 </div>
                              </div>
                              </div>
                              </form>
                              </div>
                           </div>
                        </div>
                    </div>
                        <div class="row match-height users-card">
                            <!-- Profile Card -->
                           <input type="hidden" class="csrf-token-val" value="{{ csrf_token() }}">
                            <!--/ Profile Card -->
                        </div>

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
                                          @foreach($roles as $key => $role)
                                          @php $key += 1;@endphp
                                          <div class="col-sm-6 col-12">
                                             <div class="form-group custom-control custom-checkbox">
                                                <input type="checkbox" name="roles[{{$role->id}}]" vaule="{{$role->id}}" class="custom-control-input" id="createcustomCheck{{$key}}" />
                                                <label class="custom-control-label" for="createcustomCheck{{$key}}">{{$role->name}}</label>
                                             </div>
                                          </div>
                                          @endforeach
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
  var s = '.users-card';
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
      url: '/admin/managestaff/users_card',
      data: formData, 
      processData: false,
      contentType: false,
      success: function(e)
      {
              $(s).html(e)
              feather.replace();
      }
    });
});
</script>
@endpush