@extends('layouts.app')
@push('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-ecommerce.css')}}">
@endpush
@push('page-js')
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script> -->

<script src="{{ asset('app-assets/js/scripts/pages/app-ecommerce-checkout.js')}}"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
    // Create an instance of the Stripe object
    // Set your publishable API key
    var stripe = Stripe('{{ env("STRIPE_KEY_DEV") }}');

    // Create an instance of elements
    var elements = stripe.elements();

    var style = {
        base: {
            fontWeight: 400,
            fontFamily: '"DM Sans", Roboto, Open Sans, Segoe UI, sans-serif',
            fontSize: '16px',
            lineHeight: '1.4',
            color: '#1b1642',
            padding: '.75rem 1.25rem',
            '::placeholder': {
                color: '#ccc',
            },
        },
        invalid: {
            color: '#dc3545',
        }
    };

    var cardElement = elements.create('cardNumber', {
        style: style
    });
    cardElement.mount('#card_number');

    var exp = elements.create('cardExpiry', {
        'style': style
    });
    exp.mount('#card_expiry');

    var cvc = elements.create('cardCvc', {
        'style': style
    });
    cvc.mount('#card_cvc');

    // Validate input of the card elements
    var resultContainer = document.getElementById('paymentResponse');
    cardElement.addEventListener('change', function (event) {
        if (event.error) {
            resultContainer.innerHTML = '<p>' + event.error.message + '</p>';
        } else {
            resultContainer.innerHTML = '';
        }
    });

    // Get payment form element
    var form = document.getElementById('payment-form');

    // Create a token when the form is submitted.
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        createToken();
    });

    // Create single-use token to charge the user
    function createToken() {
        stripe.createToken(cardElement).then(function (result) {
            if (result.error) {
                // Inform the user if there was an error
                resultContainer.innerHTML = '<p>' + result.error.message + '</p>';
            } else {
                // Send the token to your server
                stripeTokenHandler(result.token);
            }
        });
    }

    // Callback to handle the response from stripe
    function stripeTokenHandler(token) {
        loader();
        // Insert the token ID into the form so it gets submitted to the server
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        console.log(token);
        var formData = new FormData(form);
            $.ajax({
            type: "POST",
            url: '/payments',
            data: formData, 
            processData: false,
            contentType: false,
            success: function(e)
            {
                loader();
                swal.fire({
                   title: e.title,
                   text: e.message,
                   icon: e.status,
                 }).then(function(isConfirm) {
                   if(e.callback){
                    eval(e.callback);
                   }
                 });
            },            
            error: function(e){
                loader();
                swal.fire({
                   title: e.title,
                   text: e.message,
                   icon: e.status,
                 });
            }
            });
    }
    function redirect(url){
  window.location.replace(url);
}

function reload()
{
     location.reload(true);
}
    $('.pay-via-stripe-btn').on('click', function () {
        var payButton   = $(this);
        var name        = $('#name').val();
        var email       = $('#email').val();

        if (name == '' || name == 'undefined') {
            $('.generic-errors').html('Name field required.');
            return false;
        }
        if (email == '' || email == 'undefined') {
            $('.generic-errors').html('Email field required.');
            return false;
        }

        if(!$('#terms_conditions').prop('checked')){
            $('.generic-errors').html('The terms conditions must be accepted.');
            return false;
        }
    });

</script>
@endpush

@section('content')

<div class="app-content content ecommerce-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Payment</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Sign-up</a>
                                    </li>
                                    <li class="breadcrumb-item active">Payment
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
            <div class="bs-stepper checkout-tab-steps">
                    <!-- Wizard starts -->
                    <div class="bs-stepper-header">
                        <div class="step" data-target="#step-cart">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-box">
                                    <i data-feather="shopping-cart" class="font-medium-3"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Cart</span>
                                    <span class="bs-stepper-subtitle">Your Cart Items</span>
                                </span>
                            </button>
                        </div>
                        <div class="line">
                            <i data-feather="chevron-right" class="font-medium-2"></i>
                        </div>
                        <div class="step" data-target="#step-address">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-box">
                                    <i data-feather="home" class="font-medium-3"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Address</span>
                                    <span class="bs-stepper-subtitle">Enter Your Address</span>
                                </span>
                            </button>
                        </div>
                        <div class="line">
                            <i data-feather="chevron-right" class="font-medium-2"></i>
                        </div>
                        <div class="step" data-target="#step-payment">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-box">
                                    <i data-feather="credit-card" class="font-medium-3"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Payment</span>
                                    <span class="bs-stepper-subtitle">Select Payment Method</span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <!-- Wizard ends -->

                    <div class="bs-stepper-content">
                        <!-- Checkout Place order starts -->
                        <div id="step-cart" class="content">
                            <div id="place-order" class="list-view product-checkout">
                                <!-- Checkout Place Order Left starts -->
                                <div class="checkout-items">
                                    <div class="card ecommerce-card">
                                        <div class="item-img">
                                            <a href="app-ecommerce-details.html">
                                                <img src="{{ asset('/uploads/images/plans/'.$plan->image)}}" alt="img-placeholder" />
                                            </a>
                                        </div>
                                        @php
                                            if($plan->type == 'Custom'){
                                              $total = number_format((float) Session::get('total_amount'), 2, '.', '');
                                            }else{
                                                $total = number_format((float)$plan->total_amount, 2, '.', '');
                                            }
                                        @endphp
                                        <div class="card-body">
                                            <div class="item-name">
                                                <h6 class="mb-0"><a href="app-ecommerce-details.html" class="text-body">{{$plan->name}}</a></h6>
                                                <span class="item-company"><a href="javascript:void(0)" class="company-name">{{$plan->badge}}</a></span>
                                                <div class="item-rating">
                                                    <ul class="unstyled-list list-inline">
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <ul class="list-group list-group-circle text-left">
                                                        @foreach($plan->plansfeatures as $features)
                                                        <li class="list-group-item">{{$features->title}}</li>
                                                        @endforeach
                                            </ul>
                                            <span class="text-success">17% off 4 offers Available</span>
                                        </div>
                                        <div class="item-options text-center">
                                            <div class="item-wrapper">
                                                <div class="item-cost">
                                                    <h4 class="item-price">${{$total}}</h4>
                                                    <p class="card-text shipping">
                                                        <span class="badge badge-pill badge-light-success"></span>
                                                    </p>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>

                                </div>
                                <!-- Checkout Place Order Left ends -->

                                <!-- Checkout Place Order Right starts -->
                                <div class="checkout-options">
                                    <div class="card">
                                        <div class="card-body">
                                            <label class="section-label mb-1">Options</label>
                                            <div class="coupons input-group input-group-merge">
                                                <input type="text" class="form-control" placeholder="Coupons" aria-label="Coupons" aria-describedby="input-coupons" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text text-primary" id="input-coupons">Apply</span>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="price-details">
                                                <h6 class="price-title">Price Details</h6>
                                                <ul class="list-unstyled">
                                                    <li class="price-detail">
                                                        <div class="detail-title">Total MRP</div>
                                                        <div class="detail-amt">{{$total}}</div>
                                                    </li>
                                                    <li class="price-detail">
                                                        <div class="detail-title">Bag Discount</div>
                                                        <div class="detail-amt discount-amt text-success">-0$</div>
                                                    </li>
                                                    <li class="price-detail">
                                                        <div class="detail-title">Estimated Tax</div>
                                                        <div class="detail-amt">$0</div>
                                                    </li>
                                                    <!-- <li class="price-detail">
                                                        <div class="detail-title">EMI Eligibility</div>
                                                        <a href="javascript:void(0)" class="detail-amt text-primary">Details</a>
                                                    </li> -->
                                                    <li class="price-detail">
                                                        <div class="detail-title">Delivery Charges</div>
                                                        <div class="detail-amt discount-amt text-success">Free</div>
                                                    </li>
                                                </ul>
                                                <hr />
                                                <ul class="list-unstyled">
                                                    <li class="price-detail">
                                                        <div class="detail-title detail-total">Total</div>
                                                        <div class="detail-amt font-weight-bolder">${{$total}}</div>
                                                    </li>
                                                </ul>
                                                <button type="button" class="btn btn-primary btn-block btn-next place-order">Place Order</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Checkout Place Order Right ends -->
                                </div>
                            </div>
                            <!-- Checkout Place order Ends -->
                        </div>
                        <!-- Checkout Customer Address Starts -->
                        <div id="step-address" class="content">
                        <form id="checkout-address" class="delivery-address-form list-view product-checkout" method="post" action="{{ url('admin/profiledata') }}" >
                                <!-- Checkout Customer Address Left starts -->
                                <div class="card">
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">Add New Address</h4>
                                        <p class="card-text text-muted mt-25">Be sure to check "Deliver to this address" when you have finished</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                         @csrf
                                         <input type="hidden" name="id" value="{{$user->id}}">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">First Name</label>
                                                    <input type="text" id="first-name-column" class="form-control" placeholder="First Name" name="name" value="{{ $user->name}}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Last Name</label>
                                                    <input type="text" id="last-name-column" class="form-control" placeholder="Last Name" name="lname" value="{{ $user->lname}}" />
                                                </div>
                                            </div>
                                             <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Email</label>
                                                    <input type="email" id="email-id-column" class="form-control" name="email" disabled placeholder="Email"value="{{ $user->email}}" />
                                                </div>
                                            </div>
                                              <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="company-column">Phone Number</label>
                                                    <input type="text" id="company-column" class="form-control" name="phone_number" placeholder="Phone Number" value="@if($user->profile){{ $user->profile->phone_number}}@endif" />
                                                </div>
                                            </div>
                                               <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="city-column">Address</label>
                                                    <input type="text" id="city-column" class="form-control" placeholder="Address" name="address" value="@if($user->profile){{ $user->profile->address}}@endif"/>
                                                </div>
                                            </div>
                                              <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="city-column">City</label>
                                                    <input type="text" id="city-column" class="form-control" placeholder="City" name="city" value="@if($user->profile){{ $user->profile->city}}@endif"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="city-column">State</label>
                                                    <input type="text" id="city-column" class="form-control" placeholder="State" name="state" value="@if($user->profile){{ $user->profile->state}}@endif"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="country-floating">Country</label>
                                                    <input type="text" id="country-floating" class="form-control" name="country" placeholder="Country" value="@if($user->profile){{ $user->profile->country}}@endif"/>
                                                </div>
                                            </div>
                                             <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="company-column">Zip</label>
                                                    <input type="text" id="company-column" class="form-control" name="zip" placeholder="Zip" value="@if($user->profile){{ $user->profile->zip}}@endif"/>
                                                </div>
                                            </div>
                                          
                                            
                                           
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary btn-next delivery-address waves-effect waves-float waves-light">Save And Deliver Here</button>
                                            </div>
                                        </div>
                                    
                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- Checkout Customer Address Left ends -->

                                <!-- Checkout Customer Address Right starts -->
                                <div class="customer-card">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">{{ucfirst($user->name)}} {{ucfirst($user->lname)}}</h4>
                                        </div>
                                        <div class="card-body actions">
                                        @if($user->profile)
                                            <p class="card-text mb-0">{{$user->profile->address}}</p>
                                            <p class="card-text">{{$user->profile->city ? $user->profile->city : ' — '}}, {{$user->profile->country ? $user->profile->country : ' — '}} {{$user->profile->zip}}</p>

                                        @endif
                                        <p class="card-text">{{$user->email}}</p>
                                    @if($user->profile) 
                                            <p class="card-text">{{$user->profile->phone_number}}</p>
                                        @endif
                                            <button type="button" class="btn btn-primary btn-block btn-next delivery-address mt-2">
                                                Deliver To This Address
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Checkout Customer Address Right ends -->
                            </form>
                        </div>
                        <!-- Checkout Customer Address Ends -->

                        <!-- Checkout Payment Starts -->
                        <div id="step-payment" class="content">
                                                            
                                    <form action="{{ url('payments') }}" method="post" class="list-view product-checkout" id="payment-form">
                                        <div class="card">
                                            <div class="card-header flex-column align-items-start">
                                                <h4 class="card-title">Payment options</h4>
                                                <p class="card-text text-muted mt-25">Be sure to click on correct payment option</p>
                                            </div>
                                            <div class="card-body">
                                            @csrf
                                            <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                            <div class="row form-group">
                                                <div class="col-md-12">
                                                    <label for="name">Card Holder Name</label>
                                                    @error('name')
                                                    <div class="text-danger font-italic">{{ $message }}</div>
                                                    @enderror
                                                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name.' '.$user->lname }}">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-12">
                                                    <label for="email">Card Holder Email</label>
                                                    @error('email')
                                                    <div class="text-danger font-italic">{{ $message }}</div>
                                                    @enderror
                                                    <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-12">
                                                    <label>Billing Amount in US Dollars</label> <br>
                                                    <h2 class="text-muted">${{$total}}</h2>
                                                    <input type='hidden' value='{{$total}}' name='amount'>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-12">
                                                    <!-- Display errors returned by createToken -->
                                                    <label>Card Number</label>
                                                    <div id="paymentResponse" class="text-danger font-italic"></div>
                                                    <div id="card_number" class="field form-control"></div>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-3">
                                                    <label>Expiry Date</label>
                                                    <div id="card_expiry" class="field form-control"></div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>CVC Code</label>
                                                    <div id="card_cvc" class="field form-control"></div>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-12">
                                                    <div class="form-check form-check-inline custom-control custom-checkbox">
                                                        <input type="checkbox" name="terms_conditions" id="terms_conditions" class="custom-control-input">
                                                        <label for="terms_conditions" class="custom-control-label">
                                                            I agree to terms & conditions
                                                        </label>
                                                    </div>
                                                    @error('terms_conditions')
                                                    <div class="text-danger font-italic">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-12 small text-muted">
                                                    <!-- <div class="alert alert-warning">
                                                        <strong>NOTE: </strong> All the payments are handled by <a target="_blank"
                                                            href="https://stripe.com">STRIPE</a>. We don't store any of your data.
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-12">
                                                    <div class="text-danger font-italic generic-errors"></div>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-6">
                                                    <input type="submit" value="Pay via Stripe" class="btn btn-primary pay-via-stripe-btn">
                                                </div>
                                            </div>
                                        
                                            </div>
                                        </div>
                                        <div class="customer-card">
                                        <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Price Details</h4>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-unstyled price-details">
                                                <!-- <li class="price-detail">
                                                    <div class="details-title">Price of 3 items</div>
                                                    <div class="detail-amt">
                                                        <strong>$699.30</strong>
                                                    </div>
                                                </li> -->
                                                <li class="price-detail">
                                                    <div class="details-title">Delivery Charges</div>
                                                    <div class="detail-amt discount-amt text-success">Free</div>
                                                </li>
                                            </ul>
                                            <hr />
                                            <ul class="list-unstyled price-details">
                                                <li class="price-detail">
                                                    <div class="details-title">Amount Payable</div>
                                                    <div class="detail-amt font-weight-bolder">${{$total}}</div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                        </div>
                                    </form>
                                    </div>
                                
                            </div>
                        </div>
                        <!-- Checkout Payment Ends -->
                        <!-- </div> -->
                   

    
    </div>
    </div>
    </div>
@endsection
@push('page-js')
<script>
$("body").on("submit", ".delivery-address-form", function(e) {
    e.preventDefault();
var form = $(this)[0];
  var formData = new FormData(form);

  $.ajax({
        type: "POST",
        url: $(this).attr('action'),
        data: formData, 
        processData: false,
        contentType: false,
        success: function(e)
        {
            toastr['Success']('Address Changed Successfully', 'Success!', {
                  closeButton: true,
                  tapToDismiss: false
                });
        },
        error: function(err, i, n){
                if (err.status == 422) { 
                console.log(err.responseJSON);
                $('#success_message').fadeIn().html(err.responseJSON.message);
                console.warn(err.responseJSON.errors);
                $.each(err.responseJSON.errors, function (i, error) {
                    var el = $(document).find('[name="'+i+'"]');
                      if(el.next('span.error-message').length > 0){
                        el.next('span.error-message').text(error[0]);
                      }else{
                        el.after($('<span class="error-message" style="color: #D65053;">'+error[0]+'</span>'));
                      }
                    el.addClass('error');
                });
                toastr['warning']('Please fill the all required fields!', 'Hmm!', {
                  closeButton: true,
                  tapToDismiss: false
                });
                return false;
              }
              toastr['error']('😖 '+ n+'!<br> Please contact Rohit!', 'Oops!', {
                closeButton: true,
                tapToDismiss: false
              });
        }
      });
});
</script>

@endpush