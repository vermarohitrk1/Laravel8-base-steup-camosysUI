@extends('layouts.app')
@section('content')
<div class="app-content content ">
   <div class="content-overlay"></div>
   <div class="header-navbar-shadow"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
               <div class="col-12">
                  <h2 class="content-header-title float-left mb-0">Admin Settings</h2>
                  <div class="breadcrumb-wrapper">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Admin</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Settings
                        </li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrumb-right">
               <div class="dropdown">
                  <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                  <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="app-todo.html"><i class="mr-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="mr-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="mr-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="mr-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
               </div>
            </div>
         </div>
      </div>
      <div class="content-body">
         <!-- Validation -->
         <section class="bs-validation">
            <div class="row">
               <!-- Bootstrap Validation -->
               <div class="col-md-6 col-12">
                  <div class="card">
                     <div class="card-header">
                        <h4 class="card-title">Stripe Settings</h4>
                     </div>
                     <div class="card-body">
                        <form id="jquery-val-form" method="post" class="axios-form" action="{{route('settingenv')}}">
                           @csrf
                           <div class="form-group">
                              <label class="form-label" for="basic-default-name">Stripe Live Key</label>
                              <input type="text" class="form-control"  id="basic-default-name" name="STRIPE_KEY_LIVE" placeholder="Stripe Live Key" value="@php echo $stripe_settings['STRIPE_KEY_LIVE']; @endphp"/>
                           </div>
                           <div class="form-group">
                              <label class="form-label" for="basic-default-name">Stripe Live Secret</label>
                              <input type="text" class="form-control" id="basic-default-name" name="STRIPE_SECRET_LIVE" placeholder="Stripe Live Secret" value="@php echo $stripe_settings['STRIPE_SECRET_LIVE']; @endphp"/>
                           </div>
                           <div class="form-group">
                              <label class="form-label" for="basic-default-name">Stripe Dev Key</label>
                              <input type="text" class="form-control" id="basic-default-name" name="STRIPE_KEY_DEV" placeholder="Stripe Dev Key" value="@php echo $stripe_settings['STRIPE_KEY_DEV']; @endphp"/>
                           </div>
                           <div class="form-group">
                              <label class="form-label" for="basic-default-name">Stripe Dev Secret</label>
                              <input type="text" class="form-control" id="basic-default-name" name="STRIPE_SECRET_DEV" placeholder="Stripe Dev Secret" value="@php echo $stripe_settings['STRIPE_SECRET_DEV']; @endphp"/>
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
               <!-- jQuery Validation -->
               <div class="col-md-6 col-12">
                  <div class="card">
                     <div class="card-header">
                        <h4 class="card-title">AWS Settings</h4>
                     </div>
                     <div class="card-body">
                        <form id="jquery-val-form"  action="{{route('settingenv')}}" method="post" class="axios-form">
                           @csrf
                           <div class="form-group">
                              <label class="form-label" for="aws-default-id">AWS ACCESS KEY ID</label>
                              <input type="text" class="form-control" id="aws-default-id" name="AWS_ACCESS_KEY_ID" placeholder="AWS ACCESS KEY ID" value="@php echo $aws_settings['AWS_ACCESS_KEY_ID']; @endphp" />
                           </div>
                           <div class="form-group">
                              <label class="form-label" for="aws-default-secret">AWS SECRET ACCESS KEY</label>
                              <input type="text" class="form-control" id="aws-default-secret" name="AWS_SECRET_ACCESS_KEY" placeholder="AWS SECRET ACCESS KEY" value="@php echo $aws_settings['AWS_SECRET_ACCESS_KEY'] @endphp"/>
                           </div>
                           <div class="form-group">
                              <label class="form-label" for="aws-default-region">AWS DEFAULT REGION</label>
                              <input type="text" class="form-control" id="aws-default-region" name="AWS_DEFAULT_REGION" placeholder="AWS DEFAULT REGION" value="@php echo $aws_settings['AWS_DEFAULT_REGION'] @endphp" />
                           </div>
                           <div class="form-group">
                              <label class="form-label" for="aws-default-bucket">AWS BUCKET</label>
                              <input type="text" class="form-control" id="aws-default-bucket" name="AWS_BUCKET" placeholder="AWS BUCKET" value="@php echo $aws_settings['AWS_BUCKET'] @endphp" />
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
               <!-- /jQuery Validation -->
            </div>
            <div class="row">
               <div class="col-md-6 col-12">
                  <div class="card">
                     <div class="card-header">
                        <h4 class="card-title">Braintree Settings</h4>
                     </div>
                     <div class="card-body">
                        <form id="jquery-val-form" method="post" class="axios-form" action="{{route('settingenv')}}">
                           @csrf
                           <div class="form-group">
                              <label class="form-label" for="basic-default-name">Public Key</label>
                              <input type="text" class="form-control"  id="basic-default-publickey" name="BRAINTREE_PUBLIC_KEY" placeholder="Public Key" value="@php echo $braintree_settings['BRAINTREE_PUBLIC_KEY']; @endphp"/>
                           </div>
                           <div class="form-group">
                              <label class="form-label" for="basic-default-name">Private Key</label>
                              <input type="text" class="form-control" id="basic-default-ORIVTAEKEY" name="BRAINTREE_PRIVATE_KEY" placeholder="Private Key" value="@php echo $braintree_settings['BRAINTREE_PRIVATE_KEY']; @endphp"/>
                           </div>
                           <div class="form-group">
                              <label class="form-label" for="basic-default-name">Merchant ID</label>
                              <input type="text" class="form-control" id="basic-default-MERCHANTID" name="BRAINTREE_MAERCHANT_ID" placeholder="Merchant Id" value="@php echo $braintree_settings['BRAINTREE_MAERCHANT_ID']; @endphp"/>
                           </div>
                           <div class="row">
                              <div class="col-12">
                                 <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
                  <div class="card">
                     <div class="card-header">
                        <h4 class="card-title">Email Settings</h4>
                     </div>
                     <div class="card-body">
                        <form id="jquery-val-form"  action="{{route('settingenv')}}" method="post" class="axios-form">
                           @csrf
                           <div class="form-group">
                              <label class="form-label" for="basic-default-email">From Email</label>
                              <input type="text" id="basic-default-email" required name="MAIL_FROM_ADDRESS" class="form-control" placeholder="john.doe@email.com" value="@php echo $email_settings['MAIL_FROM_ADDRESS']; @endphp" />
                           </div>
                           <div class="form-group">
                              <label class="form-label" for="basic-default-email">From Host</label>
                              <input type="text" id="basic-default-email" required name="MAIL_HOST" class="form-control" placeholder="john.doe@email.com" value="@php echo $email_settings['MAIL_HOST']; @endphp" />
                           </div>
                           <div class="form-group">
                              <label class="form-label" for="basic-default-name">User Name</label>
                              <input type="text" class="form-control" id="basic-default-name" required name="MAIL_USERNAME" placeholder="username" value="@php echo $email_settings['MAIL_USERNAME']; @endphp"/>
                           </div>
                           <div class="form-group">
                              <label class="form-label" for="basic-default-email">Password </label>
                              <input type="text" id="basic-default-email" name="MAIL_PASSWORD" required class="form-control" placeholder="password" value="@php echo $email_settings['MAIL_PASSWORD']; @endphp"/>
                           </div>
                           <div class="form-group">
                              <label class="form-label" for="basic-default-port">MAIL PORT </label>
                              <input type="text" id="basic-default-port" name="MAIL_PORT" required class="form-control" placeholder="Mail Port" value="@php echo $email_settings['MAIL_PORT']; @endphp"/>
                           </div>
                           <div class="form-group">
                              <label for="select-country">Mail Mailer</label>
                              <select class="form-control select2" id="select-country" name="MAIL_MAILER">
                                 <option value="">Select Mailer</option>
                                 <option value="smtp" @php if($email_settings["MAIL_MAILER"] == "smtp"){ echo 'selected' ;} @endphp>smtp</option>
                              </select>
                           </div>
                           <div class="form-group">
                              <label for="select-country">Mail Encryption</label>
                              <select class="form-control select2" id="select-country" name="MAIL_ENCRYPTION">
                                 <option value="">Select Encription</option>
                                 <option value="SSL" @php if($email_settings["MAIL_ENCRYPTION"] == "SSL"){ echo 'selected' ;} @endphp>SSL</option>
                                 <option value="TLS" @php if($email_settings["MAIL_ENCRYPTION"] == "TLS"){ echo 'selected' ;} @endphp>TLS</option>
                              </select>
                           </div>
                           <div class="row">
                              <div class="col-12">
                                 <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
                  <div class="card">
                    <div class="card-header">
                     <h4 class="card-title">Recaptcha settings</h4>
                 </div>
                     <div class="card-body">
                        <div class="col-12">
                        <form id="jquery-val-form"  action="{{route('settingenv')}}" method="post" class="axios-form">
                           @csrf
                           <div class="table-responsive  rounded mt-1">
                              <h6 class="py-1 mx-1 mb-0 font-medium-2">
                              
                                 
                              </h6>
                              <table class="table">
                                 <thead class="thead-light">
                                    <tr>
                                       <th colspan="2">Recaptcha</th>
                                       <th>Register</th>
                                       <th>Login</th>
                                       <th>Forgot Password</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td colspan="2">Enable/Disable</td>
                                       <td>
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" name="RECAPTCHA_REGISTER_STATUS" id="admin-googleegister" @php if($recaptcha_settings['RECAPTCHA_REGISTER_STATUS']==true){  echo "checked"; }@endphp/>
                                             <label class="custom-control-label" for="admin-googleegister"></label>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" name="RECAPTCHA_LOGIN_STATUS" id="admin-googlelogin"  @php if($recaptcha_settings['RECAPTCHA_LOGIN_STATUS']==true){  echo "checked"; }@endphp/>
                                             <label class="custom-control-label" for="admin-googlelogin"></label>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" name="RECAPTCHA_FPASSWORD_STATUS" id="admin-googleepasswod" @php if($recaptcha_settings['RECAPTCHA_FPASSWORD_STATUS']==true){  echo "checked"; }@endphp/>
                                             <label class="custom-control-label" for="admin-googleepasswod"></label>
                                          </div>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                              <div class="form-group">
                              <label class="form-label" for="aws-default-RECAPTCHA_SITEKEY">Recaptcha Site Key</label>
                              <input type="text" class="form-control" id="aws-default-RECAPTCHA_SITEKEY" name="RECAPTCHA_SITEKEY" placeholder="Recaptcha Site Key" value="@php echo $recaptcha_settings['RECAPTCHA_SITEKEY']; @endphp"/>
                           </div>
                           <div class="form-group">
                              <label class="form-label" for="aws-default-RECAPTCHA_SECRET">Recaptcha Secret Key</label>
                              <input type="text" class="form-control" id="aws-default-RECAPTCHA_SECRET" name="RECAPTCHA_SECRET" placeholder="Recaptcha Secret Key" value="@php echo $recaptcha_settings['RECAPTCHA_SECRET']; @endphp" />
                           </div>
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
               </div>
               <div class="col-md-6 col-12">
                  <div class="card">
                     <div class="card-header">
                        <h4 class="card-title">Social Login Settings</h4>
                     </div>
                     <div class="card-body">
                        <form id="jquery-val-form"  action="{{route('settingenv')}}" method="post" class="axios-form">
                           @csrf
                           <div class="custom-control custom-switch custom-switch-primary">
                              <p class="mb-50">Google enable</p>
                              <input type="checkbox" class="custom-control-input" name="GOOGLE_STATUS" id="customSwitch10" @php if($general_settings['GOOGLE_STATUS']==true){  echo "checked"; }@endphp />
                              <label class="custom-control-label" for="customSwitch10">
                              <span class="switch-icon-left"><i data-feather="check"></i></span>
                              <span class="switch-icon-right"><i data-feather="x"></i></span>
                              </label>
                           </div>
                           <div class="form-group">
                              <label class="form-label" for="basic-default-email">Google Client Id</label>
                              <input type="text" id="basic-default-email" required name="GOOGLE_CLIENT_ID" class="form-control" placeholder="Google Client Id" value="@php echo $general_settings['GOOGLE_CLIENT_ID']; @endphp" />
                           </div>
                           <div class="form-group">
                              <label class="form-label" for="basic-default-email">Google Secret key</label>
                              <input type="text" id="basic-default-email" required name="GOOGLE_SECRET_KEY" class="form-control" placeholder="Google Secret key" value="@php echo $general_settings['GOOGLE_SECRET_KEY']; @endphp" />
                           </div>
                           <div class="custom-control custom-switch custom-switch-primary">
                              <p class="mb-50">Linkdin enable</p>
                              <input type="checkbox" class="custom-control-input" name="LINKDIN_STATUS" id="customSwitch102" @php if($general_settings['LINKDIN_STATUS']==true){  echo "checked"; }@endphp />
                              <label class="custom-control-label" for="customSwitch102">
                              <span class="switch-icon-left"><i data-feather="check"></i></span>
                              <span class="switch-icon-right"><i data-feather="x"></i></span>
                              </label>
                           </div>
                           <div class="form-group">
                              <label class="form-label" for="basic-default-name">Linkdin Client Id</label>
                              <input type="text" class="form-control" id="basic-default-name" required name="LINKDIN_CLIENT_ID" placeholder="Linkdin Client Id" value="@php echo $general_settings['LINKDIN_CLIENT_ID']; @endphp"/>
                           </div>
                           <div class="form-group">
                              <label class="form-label" for="basic-default-email">Linkdin Secret key </label>
                              <input type="text" id="basic-default-email" name="LINKDIN_SECRET_KEY" required class="form-control" placeholder="Linkdin Secret key" value="@php echo $general_settings['LINKDIN_SECRET_KEY']; @endphp"/>
                           </div>
                           <div class="custom-control custom-switch custom-switch-primary">
                              <p class="mb-50">Facebook enable</p>
                              <input type="checkbox" class="custom-control-input" name="FACEBOOK_STATUS" id="customSwitch103" @php if($general_settings['FACEBOOK_STATUS']==true){  echo "checked"; }@endphp />
                              <label class="custom-control-label" for="customSwitch103">
                              <span class="switch-icon-left"><i data-feather="check"></i></span>
                              <span class="switch-icon-right"><i data-feather="x"></i></span>
                              </label>
                           </div>
                           <div class="form-group">
                              <label class="form-label" for="basic-default-port">Facebook Client Id </label>
                              <input type="text" id="basic-default-port" name="FACEBOOK_CLIENT_ID" required class="form-control" placeholder="Facebook Client Id" value="@php echo $general_settings['FACEBOOK_CLIENT_ID']; @endphp"/>
                           </div>
                           <div class="form-group">
                              <label class="form-label" for="basic-default-port">Facebook Secret key </label>
                              <input type="text" id="basic-default-port" name="FACEBOOK_SECRET_KEY" required class="form-control" placeholder="Facebook Secret key" value="@php echo $general_settings['FACEBOOK_SECRET_KEY']; @endphp"/>
                           </div>
                           <div class="custom-control custom-switch custom-switch-primary">
                              <p class="mb-50">Twitter enable</p>
                              <input type="checkbox" class="custom-control-input" name="TWITTER_STATUS" id="customSwitch104" @php if($general_settings['TWITTER_STATUS']==true){  echo "checked"; }@endphp />
                              <label class="custom-control-label" for="customSwitch104">
                              <span class="switch-icon-left"><i data-feather="check"></i></span>
                              <span class="switch-icon-right"><i data-feather="x"></i></span>
                              </label>
                           </div>
                           <div class="form-group">
                              <label class="form-label" for="basic-default-port">Twitter Client Id </label>
                              <input type="text" id="basic-default-port" name="TWITTER_CLIENT_ID" required class="form-control" placeholder="Twitter Client Id" value="@php echo $general_settings['TWITTER_CLIENT_ID']; @endphp"/>
                           </div>
                           <div class="form-group">
                              <label class="form-label" for="basic-default-port">Twitter Secret Key </label>
                              <input type="text" id="basic-default-port" name="TWITTER_SECRET_KEY" required class="form-control" placeholder="Twitter Secret Key" value="@php echo $general_settings['TWITTER_SECRET_KEY']; @endphp"/>
                           </div>
                           <div class="custom-control custom-switch custom-switch-primary">
                              <p class="mb-50">Github enable</p>
                              <input type="checkbox" class="custom-control-input" name="GITHUB_STATUS" id="customSwitch105" @php if($general_settings['GITHUB_STATUS']==true){  echo "checked"; }@endphp />
                              <label class="custom-control-label" for="customSwitch105">
                              <span class="switch-icon-left"><i data-feather="check"></i></span>
                              <span class="switch-icon-right"><i data-feather="x"></i></span>
                              </label>
                           </div>
                           <div class="form-group">
                              <label class="form-label" for="basic-default-github">Github Client Id </label>
                              <input type="text" id="basic-default-port" name="GITHUB_CLIENT_ID" required class="form-control" placeholder="Github Client Id" value="@php echo $general_settings['GITHUB_CLIENT_ID']; @endphp"/>
                           </div>
                           <div class="form-group">
                              <label class="form-label" for="basic-default-githubk">Github Secret Key </label>
                              <input type="text" id="basic-default-githubk" name="GITHUB_SECRET_KEY" required class="form-control" placeholder="Github Secret Key" value="@php echo $general_settings['GITHUB_SECRET_KEY']; @endphp"/>
                           </div>
                           <div class="row">
                              <div class="col-12">
                                 <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>


                    <div class="card">
                     <div class="card-header">
                        <h4 class="card-title">Broadcast settings</h4>
                     </div>
                     <div class="card-body">
                        <form id="jquery-val-form" method="post" class="axios-form" action="{{route('settingenv')}}">
                           @csrf
                           <div class="form-group">
                              <label class="form-label" for="basic-default-Broadcast">Broadcast Driver</label>
                              <input type="text" class="form-control"  id="basic-default-Broadcast" name="BROADCAST_DRIVER" placeholder="Broadcast Driver" value="@php echo $broadcast_settings['BROADCAST_DRIVER']; @endphp"/>
                           </div>
                           <div class="form-group">
                              <label class="form-label" for="basic-default-pusherid">Pusher App Id</label>
                              <input type="text" class="form-control" id="basic-default-pusherid" name="PUSHER_APP_ID" placeholder="Pusher App Id" value="@php echo $broadcast_settings['PUSHER_APP_ID']; @endphp"/>
                           </div>
                           <div class="form-group">
                              <label class="form-label" for="basic-default-PUSHER_APP_KEY">Pusher App Key</label>
                              <input type="text" class="form-control" id="basic-default-PUSHER_APP_KEY" name="PUSHER_APP_KEY" placeholder="Pusher App Key" value="@php echo $broadcast_settings['PUSHER_APP_KEY']; @endphp"/>
                           </div>

                           <div class="form-group">
                              <label class="form-label" for="basic-default-PUSHER_APP_SECRET">Pusher App Secret</label>
                              <input type="text" class="form-control"  id="basic-default-PUSHER_APP_SECRET" name="PUSHER_APP_SECRET" placeholder="Pusher App Secret" value="@php echo $broadcast_settings['PUSHER_APP_SECRET']; @endphp"/>
                           </div>
                           <div class="form-group">
                              <label class="form-label" for="basic-default-PUSHER_APP_CLUSTER">Pusher App Cluster</label>
                              <input type="text" class="form-control" id="basic-default-PUSHER_APP_CLUSTER" name="PUSHER_APP_CLUSTER" placeholder="Pusher App Cluster" value="@php echo $broadcast_settings['PUSHER_APP_CLUSTER']; @endphp"/>
                           </div>
                           <div class="form-group">
                              <label class="form-label" for="basic-default-LARAVEL_WEBSOCKETS_PORT">Laravel Websockets Port</label>
                              <input type="text" class="form-control" id="basic-default-LARAVEL_WEBSOCKETS_PORT" name="LARAVEL_WEBSOCKETS_PORT" placeholder="Laravel Websockets Port" value="@php echo $broadcast_settings['LARAVEL_WEBSOCKETS_PORT']; @endphp"/>
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
            </div>
         </section>
         <!-- /Validation -->
      </div>
   </div>
</div>
<!-- END: Content-->
<!-- <hr>
   <div class="app-content content ">
       <div class="container-fluid">
          <div class="row">
       <div class="col-lg-12 margin-tb">
           <div class="pull-left">
               <h2>Settings</h2>
           </div>
          
       </div>
   </div>
   @if ($message = Session::get('success'))
       <div class="alert alert-success">
           <p>{{ $message }}</p>
       </div>
   @endif
      <div class="formcdata">
   
   
   
   
   @if ($message = Session::get('message'))
       <div class="alert alert-success">
           <p>{{ $message }}</p>
       </div>
   @endif
   
   <form class="form-horizontal" action="{{ route('settingenv',1) }}" method="POST">
     @csrf
       
   
   <div class="form-group">
      @foreach($env as $key => $envdata)
   
     <label class="control-label col-sm-2" for="pwd">{{ $key }}:</label>
     <div class="col-sm-10">  
     <input type="text" class="form-control" name="envdetail[{{ $key }}]" value="{{ $envdata }}">          
     
     </div>
   
     @endforeach
   </div>
   <div class="form-group">        
     <div class="col-sm-offset-2 col-sm-10">
       <button type="submit" class="btn btn-primary">Save</button>
     </div>
   </div>
   </form>
   </div>
   
   
   </div>
   
     </div> -->
</div>
</div>
@endsection