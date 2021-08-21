<form class="axios-form form form-horizontal" action="{{ url('admin/permissions/update') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $content->id}}">
                <div class="modal-body">
                    <h5>Form update permission.</h5>
                    
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-3 col-form-label">
                                                        <label for="first-name">Name</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="first-name" class="form-control" name="name" value="{{$content->name}}" placeholder="Name">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light">Update</button>
                </div>
                </form>