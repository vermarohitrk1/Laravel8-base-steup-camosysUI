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
                                        <h2 class="content-header-title float-left mb-0">Users</h2>
                                        <div class="breadcrumb-wrapper">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a>
                                                </li>
                                                <li class="breadcrumb-item active">Table Users
                                                </li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                                <div class="form-group breadcrumb-right">
                                      <!--   <button class="btn-icon btn btn-primary btn-round btn-sm waves-effect waves-float waves-light" type="button" data-toggle="modal" data-target="#create" aria-haspopup="true" aria-expanded="false">
                                        Create New User
                                    </button> -->
                                    
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
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $key => $user)
                                        @php $key += 1; @endphp
                                            <tr>
                                            <th scope="row">{{$key}}</th>
                                            <td>{{ $user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td><a class="dropdown-item fetch-display-click" data="id:{{ $user->id}}|_token:{{ csrf_token() }}" url="{{ url('admin/user/role')}}" href="javascript:void(0);" holder='.update-holder' modal="#update">
                                             
                                             <i data-feather="edit" class="mr-50"></i>
                                                     </a> </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light" data-toggle="dropdown" aria-expanded="false">
                                                    <i data-feather="more-vertical"></i>                                                    </button>
                                                    <div class="dropdown-menu" style="">
                                                        <a class="dropdown-item fetch-display-click" data="id:{{ $user->id}}|_token:{{ csrf_token() }}" url="{{ url('admin/roles/edit')}}" href="javascript:void(0);" holder='.update-holder' modal="#update">
                                                        <i data-feather="edit-2" class="mr-50"></i>                                                            <span>Edit</span>
                                                        </a>
                                                        <form class="axios-form" action="{{route('user.destroy', $user->id)}}" method="post">
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
                    <div class="modal modal-slide-in fade" id="modals-slide-in">
                        <div class="modal-dialog sidebar-sm">
                            <form class="axios-form add-new-record modal-content pt-0">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">New Record</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="form-group">
                                        <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                                        <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="John Doe" aria-label="John Doe" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="basic-icon-default-post">Post</label>
                                        <input type="text" id="basic-icon-default-post" class="form-control dt-post" placeholder="Web Developer" aria-label="Web Developer" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="basic-icon-default-email">Email</label>
                                        <input type="text" id="basic-icon-default-email" class="form-control dt-email" placeholder="john.doe@example.com" aria-label="john.doe@example.com" />
                                        <small class="form-text text-muted"> You can use letters, numbers & periods </small>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="basic-icon-default-date">Joining Date</label>
                                        <input type="text" class="form-control dt-date" id="basic-icon-default-date" placeholder="MM/DD/YYYY" aria-label="MM/DD/YYYY" />
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="form-label" for="basic-icon-default-salary">Salary</label>
                                        <input type="text" id="basic-icon-default-salary" class="form-control dt-salary" placeholder="$12000" aria-label="$12000" />
                                    </div>
                                    <button type="button" class="btn btn-primary data-submit mr-1">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
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
<div class="modal fade text-left" id="create" tabindex="-1" aria-labelledby="myModalLabel1" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Create New User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="axios-form add-new-record">
                                
                                <div class="modal-body flex-grow-1">
                                    <div class="form-group">
                                        <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                                        <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="John Doe" aria-label="John Doe" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="basic-icon-default-post">Post</label>
                                        <input type="text" id="basic-icon-default-post" class="form-control dt-post" placeholder="Web Developer" aria-label="Web Developer" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="basic-icon-default-email">Email</label>
                                        <input type="text" id="basic-icon-default-email" class="form-control dt-email" placeholder="john.doe@example.com" aria-label="john.doe@example.com" />
                                        <small class="form-text text-muted"> You can use letters, numbers & periods </small>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="basic-icon-default-date">Joining Date</label>
                                        <input type="text" class="form-control dt-date" id="basic-icon-default-date" placeholder="MM/DD/YYYY" aria-label="MM/DD/YYYY" />
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="form-label" for="basic-icon-default-salary">Salary</label>
                                        <input type="text" id="basic-icon-default-salary" class="form-control dt-salary" placeholder="$12000" aria-label="$12000" />
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
<script>

</script>
@endsection