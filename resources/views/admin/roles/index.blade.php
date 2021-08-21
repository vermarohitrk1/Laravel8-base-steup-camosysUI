@extends('layouts.app')
@push('page-css')

@endpush
@section('content')

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
                        <div class="content-header row">
                            <div class="content-header-left col-md-9 col-12 mb-2">
                                <div class="row breadcrumbs-top">
                                    <div class="col-12">
                                        <h2 class="content-header-title float-left mb-0">Role</h2>
                                        <div class="breadcrumb-wrapper">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a>
                                                </li>
                                                <li class="breadcrumb-item active">Role
                                                </li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                                <div class="form-group breadcrumb-right">
                                    <button class="dt-button create-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-toggle="modal" data-target="#modals-create"><span>
                                    <i data-feather="plus" class="mr-50"></i> Add New Role</span></button>
                                </div>
                            </div>
                        </div>
                        <div class="content-body">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                            <table class="datatables-basic-- table" id="my-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                        
                                            @if(Auth::user()->hasRole('superadmin'))
                                            <th>Default</th>
                                            @else
                                            <th>Type</th>
                                            @endif
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($roles as $key => $role)
                                        @php $key += 1; @endphp
                                            <tr>
                                            <th scope="row">{{$key}}</th>
                                            <td>{{ $role->name}}</td>
                                            <td>{{ $role->slug}}</td>
                                            <td>
                                                   @if(Auth::user()->hasRole('superadmin'))
                                                <form class="switch-button" action="/admin/role/default" action="post">
                                                    <div class="custom-control custom-switch custom-switch-primary">
                                                        <input type="checkbox" class="custom-control-input" name="default_role" data-id="{{$role->id}}" data-token="{{ csrf_token()}}" id="customSwitch{{$key}}" @if($role->default_role == 1) checked @endif />
                                                        <label class="custom-control-label" for="customSwitch{{$key}}">
                                                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                        </label>
                                                    </div>
                                                </form>
                                                @else
                                                    @if($role->default_role == 1)
                                                       <span>System</span> 
                                                    @else
                                                    <span>Custom</span>
                                                    @endif
                                                   
                                                @endif
                                            </td>
                                            <td>
                                                 @if(Auth::user()->hasRole('superadmin') || $role->default_role == 0)
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light" data-toggle="dropdown" aria-expanded="false">
                                                    <i data-feather="more-vertical"></i>                                                    </button>
                                                    </button>
                                                    <div class="dropdown-menu" style="">
                                                        <a class="dropdown-item fetch-display-click" data="id:{{ $role->id}}|_token:{{ csrf_token() }}" url="{{ url('admin/roles/edit')}}" href="javascript:void(0);" holder='.update-holder' modal="#update">
                                                        <i data-feather="edit-2" class="mr-50"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                        <form class="axios-form" action="{{route('roles.destroy', $role->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item" href="javascript:void(0);">
                                                        <i data-feather="trash" class="mr-50"></i>
                                                            <span>Delete</span>
                                                        </button>
                                                        </form>
                                                    </div>
                                                </div>
                                                @else
                                                      <span>-</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Modal to add new record -->
                    <div class="modal modal-slide-in fade" id="modals-create">
                        <div class="modal-dialog sidebar-sm">
                            <form class="axios-form dd-new-record modal-content pt-0" action="{{ route('roles.store') }}" method="post">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Create New Role</h5>
                                </div>
                                @csrf
                                <div class="modal-body flex-grow-1">
                                    <div class="form-group">
                                        <label class="form-label" for="basic-icon-default-fullname">Role Name</label>
                                        <input type="text" class="form-control dt-full-name" id="fullname" name="name" placeholder="Role Name" required>
                                    </div>
                                    <div class="form-group">
                                        <h5>Permissions</h5>
                                        <div class="row">
                                            @foreach($permissions as $key => $permission)
                                                @php $key += 1;@endphp
                                                <div class="col-sm-6 col-12">
                                                <div class="form-group custom-control custom-checkbox">
                                                        <input type="checkbox" name="permission[{{$permission->id}}]" vaule="{{$permission->id}}" class="custom-control-input" id="createcustomCheck{{$key}}" />
                                                        <label class="custom-control-label" for="createcustomCheck{{$key}}">{{$permission->name}}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary data-submit mr-1 waves-effect waves-float waves-light">Submit</button>
                                    <!-- <button type="reset" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Cancel</button> -->
                                </div>
                            </form>
                        </div>
                    </div>

                </section>
                 </div>
                 </div>
             </div>
        </div>
    </div>

<!-- modals -->

<div class="modal fade text-left" id="update" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="update-holder"></div>
            </div>
        </div>
</div>

@endsection
@push('page-js')

@endpush