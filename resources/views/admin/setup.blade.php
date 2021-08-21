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
                                    <h4 class="card-title">{{ config('app.name', 'Laravel') }} Setup</h4>
                                </div>
                             <div class="card-body">
                                    <form id="jquery-val-form" action="{{route('setup.store')}}" method="post">
									@csrf
                                        <div class="form-group">
                                            <label class="form-label" for="basic-default-name">Name</label>
                                            <input type="text" class="form-control" id="basic-default-name" name="name" placeholder="John Doe" />
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="basic-default-email">Email</label>
                                            <input type="text" id="basic-default-email" name="email" class="form-control" placeholder="john.doe@email.com" />
                                        </div>
										<div class="form-group">
                                            <label class="form-label" for="basic-default-password">Password</label>
                                            <input type="password" id="basic-default-password" name="basic-default-password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="confirm-password">Confirm Password</label>
                                            <input type="password" id="confirm-password" name="confirm-password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
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