<div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Permissions</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
<form class="axios-form add-new-record pt-0" action="{{ url('admin/roles/assign-permission') }}" method="post">
       @csrf
       <input type="hidden" name="id" value="{{$role->id}}">
       <div class="modal-body flex-grow-1">
           <div class="form-group custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="ckbCheckAll" />
                <label class="custom-control-label" for="ckbCheckAll">Select all permissions.</label>
               </div>
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
   <script>
       $("#ckbCheckAll").on("change", function () {
           if($('#ckbCheckAll').prop('checked')){
               $(this).parent('form').find('input[type="checkbox"]').each(function(){
                $(this).prop('checked', $(this).prop('checked'));
               });
           }else{
            $(this).parent('form').find('input[type="checkbox"]').each(function(){
                $(this).prop('checked', false);
               });
           }
            

});
       </script>