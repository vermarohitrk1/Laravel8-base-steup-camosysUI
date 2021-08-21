@extends('layouts.app')

@section('content')
         <div class="app-content content ">         
              <div class="col-lg-12">
                <div class="p-5">
                        @if(session()->get('error'))
                 <div class="alert alert-warning">
                      {{ session()->get('error') }}  
                 </div>
                      @endif  
         <!-- Bootstrap Validation -->
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"> Database Setup</h4>
                                </div>
                             <div class="card-body">
                                    <form id="jquery-val-form" action="{{route('settingenvdatabase')}}" method="post">
									                      @csrf
                                         <div class="form-group">
                                            <label class="form-label" for="basic-default-name">App Name</label>
                                            <input type="text" class="form-control" id="basic-default-name" name="APP_NAME" placeholder="App Name" value="{{ $database_settings['APP_NAME']}}"/>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="basic-default-name">Database Name</label>
                                            <input type="text" class="form-control" id="basic-default-name" name="DB_DATABASE" placeholder="Database Name" value="{{ $database_settings['DB_DATABASE']}}"/>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="basic-default-username">Username</label>
                                            <input type="text" class="form-control" id="basic-default-username" name="DB_USERNAME" placeholder="Username" value="{{ $database_settings['DB_USERNAME']}}" />
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="basic-default-password">Password</label>
                                            <input type="text" class="form-control" id="basic-default-password" name="DB_PASSWORD" placeholder="Password" value="{{ $database_settings['DB_PASSWORD']}}"/>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="basic-default-host">Database Host</label>
                                            <input type="text" class="form-control" id="basic-default-host" name="DB_HOST" placeholder="Database Host" value="{{ $database_settings['DB_HOST']}}"/>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /Bootstrap Validation -->  
                </div>
				</div>
				</div>
           @endsection