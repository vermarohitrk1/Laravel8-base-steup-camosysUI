<div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Update Roles</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
<form class="axios-form add-new-record pt-0" action="{{ url('admin/user/assign-role') }}" method="post">
       @csrf
       <input type="hidden" name="id" value="{{$user->id}}">
       <div class="modal-body flex-grow-1">
           <div class="form-group custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="ckbCheckAll" />
                <label class="custom-control-label" for="ckbCheckAll">Select all roles.</label>
            </div>
           <div class="row">
           @foreach($roles as $key => $role)
           @php $key += 1;@endphp
           <div class="col-sm-6 col-12">
           <div class="form-group custom-control custom-checkbox">
      <input type="checkbox" name="role[{{$role->id}}]" vaule="{{$role->id}}"  class="custom-control-input" id="customCheck{{$key}}" @if($user->userhasRole($user->id, $role->id)) checked @endif  />
                   <label class="custom-control-label" for="customCheck{{$key}}">{{$role->name}}</label>
               </div>
           </div>
           @endforeach
           </div>
       </div> 
       <div class="modal-footer">
       <button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light">Update</button>
       </div>
   </form>
   <script>
     $("#ckbCheckAll").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
});
       </script>