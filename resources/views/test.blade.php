@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" integrity="sha512-zxBiDORGDEAYDdKLuYU9X/JaJo/DPzE42UubfBw9yg8Qvb2YRRIQ8v4KsGHOx2H1/+sdSXyXxLXv5r7tHc9ygg==" crossorigin="anonymous" />
<div class="app-content content ">
    <div class="row justify-content-center">
<button class="btn btn-primary ml-5" type="button" role="menuitem" data-toggle="modal" data-target="#create"><span><i class="mdi mdi-plus-circle-outline"></i></span> Add File</button>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Image</th>
      <th scope="col">Description</th>
      <th scope="col">Cover</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach($data as $d)
    <tr>
      <th scope="row">{{$d->id}}</th>
      <td>{{$d->name}}</td>
      <td>{{ asset('/storage/public/uploads/images/'.$d->image)}}</td>
      <td>{{$d->description}}</td>
      <td>{{$d->cover}}</td>
      <td></td>
    </tr>
    @endforeach
  </tbody>
</table>

</div>
</div>

<div class="modal fade" id="create" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Course</h4>
            </div>
            
            <form class="axios-form" action="{{ url('/submit/form') }}" data-parsley-validate="" loader="true" method="POST"
              enctype="multipart/form-data">
                @csrf
              <div class="modal-body">
                <p>Enter course details.</p>
                <div class="form-group">
                    <div class="row">
                      <div class="col-md-12">
                        <label>Course Name</label>
                        <input type="text" id="#profilepicture" name="name" class="form-control" placeholder="Course Name" required>
                      </div>
                    </div>
                  </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <label>Image</label>
                      <input type="file" name="image" class="cropify" placeholder="Course Cover Image" crop-width="480"
                        crop-height="280" accept="image/*" v-on:change="handleFilesUpload()">
                    </div>
                  </div>
                </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-12">
                        <label>Course Description</label>
                        <textarea class="form-control summernote" name="description" placeholder="Course Description" rows="5"
                          required></textarea>
                      </div>
                    </div>
                  </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <label>Cover Image</label>
                      <input type="file" name="cover" id="image" class="cropify" placeholder="Course Cover Image" crop-width="800"
                        crop-height="400" accept="image/*" v-on:change="handleFilesUpload()">
                    </div>
                    <div  id='profile-image'>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="file-upload-wrapper">
                          <input type="file" id="input-file-now" class="file-upload" />
                        </div>
                      </div></div>
            </div>
                
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Course</button>
              </div>
            </form>
        </div>

    </div>
</div>


<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js" integrity="sha512-DZqqY3PiOvTP9HkjIWgjO6ouCbq+dxqWoJZ/Q+zPYNHmlnI2dQnbJ5bxAHpAMw+LXRm4D72EIRXzvcHQtE8/VQ==" crossorigin="anonymous"></script>
<script>
$('.file-upload').file_upload();
var resize = $("#profile-image").croppie({
	viewport: {
		width: 200,
		height: 200
	},
	boundary: {
		width: 300,
		height: 300
	}
});

$('#image').on('change', function () { 
  var reader = new FileReader();
    reader.onload = function (e) {
      resize.croppie('bind',{
        url: e.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
});

    $("body").on("submit", ".axios-form", function(e) {
        e.preventDefault();
        var formData = new FormData();
        $(":input").each(function(e) {
        var $this = $(this);
        if ($this.is("input")) {
           
            if($(this).attr('type') == 'text'){
                formData.append($(this).attr('name'),  $(this).val());
            }
            if($(this).attr('type') == 'file'){
              var files = $(this)[0].files;
              formData.append($(this).attr('name'),files[0]);
            }
            if($(this).attr('type') == 'checkbox'){
              if($(this).is(':checked')){
                var res = true;
              }else{
                var res = false;
              }
                formData.append($(this).attr('name'), res);
            }
            if($(this).attr('type') == 'radio'){
              if ($(this).is(':checked'))
              { var radio = $(this).val(); }else{ var radio = null;}
                formData.append($(this).attr('name'), radio);
            }
            if($(this).attr('type') == 'hidden'){
                formData.append($(this).attr('name'), $(this).val());
            }
            } else if ($this.is("select")) {
                formData.append($(this).attr('name'), $(this).val());
            } else if ($this.is("textarea")) {
              formData.append($(this).attr('name'), $(this).val());
             }
        });
        axios.post($(this).attr('action'), formData, {
        headers: {
        'Content-Type': 'multipart/form-data',
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        }).then(function(response)
        {
            console.log(response);
        }).catch(function(){
            console.log('FALIURE!!');
        })
});
</script>
@endsection