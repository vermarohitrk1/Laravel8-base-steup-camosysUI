<div class="card">
                               <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel17">Contact Personal Information</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                <div class="card-body">
                             

                                        <div class="row">
                                            <div class="col-12">
                                                  <form class="form form-horizontal axios-form" method="post" action="{{ url('admin/user/updateprofile') }}">
                                        @csrf
                                               <input type="hidden" name="id" value="{{$user->id}}">
                                                 <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-3 col-form-label">
                                                        <label for="first-name">First Name</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="first-name" class="form-control" name="name" placeholder="First Name" value="{{ $user->name}}" >
                                                    </div>
                                                </div>
                                            </div>
                                              <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-3 col-form-label">
                                                        <label for="first-name">Last Name</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="last-name" class="form-control" name="lname" placeholder="Last Name" value="{{ $user->lname}}" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-3 col-form-label">
                                                        <label for="email-id">Email</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="email" id="email" class="form-control" name="email" placeholder="Email" value="{{ $user->email}}" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-3 col-form-label">
                                                        <label for="contact-info">Mobile</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                                                

                                                        <input type="text" id="contact-info" class="form-control" name="phone_number" placeholder="Mobile" value="@if($user->profile){{ $user->profile->phone_number}} @endif">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-3 col-form-label">
                                                        <label for="password">Date Of Birth</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                                                

                                                        <input type="date" id="date_of_birth" class="form-control" name="date_of_birth" value="@if($user->profile){{ $user->profile->date_of_birth}} @endif">
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                               <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-3 col-form-label">
                                                        <label for="password">Address</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                                                

                                                        <input type="text" id="address" class="form-control" name="address" placeholder="Address" value="@if($user->profile){{ $user->profile->address}} @endif">
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                               <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-3 col-form-label">
                                                        <label for="password">City</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                            <input type="text" id="city" class="form-control" name="city" placeholder="City" value="@if($user->profile){{ $user->profile->city}} @endif">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-3 col-form-label">
                                                        <label for="password">State</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                            <input type="text" id="state" class="form-control" name="state" placeholder="State" value="@if($user->profile){{ $user->profile->state}} @endif">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-3 col-form-label">
                                                        <label for="password">Country</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                            <input type="text" id="country" class="form-control" name="country" placeholder="Country" value="@if($user->profile){{ $user->profile->country}} @endif">
                                                    </div>
                                                </div>
                                            </div>
                                           <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-3 col-form-label">
                                                        <label for="password">Zipcode</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                                                

                                                        <input type="text" id="zipcode" class="form-control" name="zip" placeholder="Zipcode" value="@if($user->profile){{ $user->profile->zip}} @endif">
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-9 offset-sm-3">
                                                <button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light">Submit</button>
                                            </div>
                                            </form>
                                            </div>
                                           
                                        </div>
                                    
                                </div>
                            </div>
                             <script type="text/javascript">
     
    
  
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
 
        $('#imagepic').change(function(){
          
            let reader = new FileReader();
            reader.onload = (e) => { 
                
              $('#image_preview_container').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
 
        });
 
        $('#upload_image_form').submit(function(e) {
            e.preventDefault();
 
            var formData = new FormData(this);
 
            $.ajax({
                type:'POST',
                url: "{{ url('admin/savephoto')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    location.reload();
                    

                  //  alert('Image has been uploaded successfully');
                },
                error: function(data){
                    console.log(data);
                }
            });
        });

        validate();
</script>
         
