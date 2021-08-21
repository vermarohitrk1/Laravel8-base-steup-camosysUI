<form class="axios-form form form-horizontal" action="{{ url('admin/permissions/update') }}" method="post">
                @csrf
                <input class="hidden" value="{{ $content->id}}">
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
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-3 col-form-label">
                                                        <label for="slug">Slug</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="slug" class="form-control" value="{{$content->slug}}" name="slug" placeholder="Slug">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light">Update</button>
                </div>
                </form>