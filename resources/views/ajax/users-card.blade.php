@foreach($users as $user)
                            <div class="col-lg-3 col-md-4 col-6">
                                <div class="card card-profile">
                                    <img src="../../../app-assets/images/banner/banner-12.jpg" class="img-fluid card-img-top" alt="Profile Cover Photo" />
                                    <div class="card-body">
                                        <div class="profile-image-wrapper">
                                            <div class="profile-image">
                                                <div class="avatar">
                                                @if(empty($user->profile->profile_img))
                                                <img src="{{ asset('/uploads/images/avatar.png') }}" alt="Profile Picture" />
                                                @else
                                                <img src="{{ asset('uploads/images/'.$user->profile->profile_img) }}" alt="Profile Picture" />
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                        <h3>{{ $user->name }}</h3>
                                        <h6 class="text-muted">{{ $user->address }}</h6>
                                        @foreach($roles as $key => $role)
                                        @if($user->userhasRole($user->id, $role->id))<div class="badge badge-light-primary profile-badge"> {{$role->name}}</div> @endif
                                        @endforeach
                                        <hr class="mb-2" />
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                            <a href="{{ url('admin/userprofile/'.$user->id) }}" type="button" class="btn btn-primary waves-effect waves-float waves-light">View</a>
                                            </div>
                                            <div>
                                            <div class="dropdown">
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light" data-toggle="dropdown" aria-expanded="false"><div style="font-size:28px;"><i data-feather='more-vertical'></i> </div> </button>
                                                    </button>
                                                    <div class="dropdown-menu" style="">
                                                        <!-- <a class="dropdown-item fetch-display-click" data="id:|_token:{{ csrf_token() }}" url="{{ url('admin/roles/edit')}}" href="javascript:void(0);" holder='.update-holder' modal="#update">
                                                        <i data-feather="edit-2" class="mr-50"></i>
                                                            <span>Edit</span>
                                                        </a> -->
                                                            <a class="waves-effect dropdown-item fetch-display-click" data="id:{{$user->id}}|_token:{{ csrf_token() }}|type:update_role" url="{{ url('admin/profile/edit')}}" href="javascript:void(0);" holder='.update-holder' modal="#large"><i data-feather="edit" class="mr-50"></i>Update Role</a>
                                            
                                              <a class="dropdown-item fetch-display-click"  data="id:{{ $user->id}}|_token:{{ csrf_token() }}|type:update_employee_hiring" url="{{ url('admin/profile/edit')}}" href="javascript:void(0);" holder='.update-holder' modal="#large"><i data-feather="edit-3" class="mr-50"></i>Update Employee Information</a>

                                               <a class="dropdown-item fetch-display-click"  data="id:{{ $user->id}}|_token:{{ csrf_token() }}|type:update_employee" url="{{ url('admin/profile/edit')}}" href="javascript:void(0);" holder='.update-holder' modal="#large"><i data-feather="edit-3" class="mr-50"></i>Update Account Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                               <div class="modal-size-lg d-inline-block">
                                         
                                            <!-- Modal -->
                                            <div class="modal fade text-left" id="large" tabindex="-1" aria-labelledby="myModalLabel17" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                        
                                                        <div class="update-holder">
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                            @endforeach