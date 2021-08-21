    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel1">Update Role</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
<form class="axios-form form form-horizontal" action="{{ url('/admin/roles/update') }}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $role->id}}">
    <div class="modal-body">
        <h5>Form update roles.</h5>
        
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="first-name">Name</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="first-name" class="form-control" name="name" value="{{$role->name}}" placeholder="Name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5>Permissions</h5>
                            <div class="row">
                                @foreach($permissions as $key => $permission)
                                    @php $key += 1;@endphp
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group custom-control custom-checkbox">
                                            <input type="checkbox" name="permission[{{$permission->id}}]" vaule="{{$permission->id}}" class="custom-control-input" id="customCheck{{$key}}" @if($role->rolehasPermission($permission->id, $role->id)) checked @endif />
                                            <label class="custom-control-label" for="customCheck{{$key}}">{{$permission->name}}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        
    </div>
    <div class="modal-footer">
    <button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light">Update</button>
    </div>
    </form>
    