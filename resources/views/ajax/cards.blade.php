<div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Cards</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
</div>

<div class="modal-body flex-grow-1 ecommerce-application">
<div id="place-order" class="list-view">
<div class="checkout-items">
                                    <div class="card ecommerce-card">
                                        <div class="item-img">
                                            <a href="app-ecommerce-details.html">
                                                <img src="../../../app-assets/images/pages/eCommerce/1.png" alt="img-placeholder">
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="item-name">
                                                <h6 class="mb-0"><a href="app-ecommerce-details.html" class="text-body">Apple Watch Series 5</a></h6>
                                                <span class="item-company">By <a href="javascript:void(0)" class="company-name">Apple</a></span>
                                                <div class="item-rating">
                                                    <ul class="unstyled-list list-inline">
                                                        <li class="ratings-list-item"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star filled-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></li>
                                                        <li class="ratings-list-item"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star filled-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></li>
                                                        <li class="ratings-list-item"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star filled-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></li>
                                                        <li class="ratings-list-item"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star filled-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></li>
                                                        <li class="ratings-list-item"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star unfilled-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-options text-center">
                                            <div class="item-wrapper">
                                                <div class="item-cost">
                                                    <h4 class="item-price">$19.99</h4>
                                                    <p class="card-text shipping">
                                                        <span class="badge badge-pill badge-light-success">Free Shipping</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-light mt-1 remove-wishlist waves-effect waves-float waves-light">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x align-middle mr-25"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                <span>Remove</span>
                                            </button>
                                        </div>
                                    </div>
                                    
                                </div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary waves-effect waves-float waves-light" data-toggle="modal" data-target="#create_card">
<i data-feather='plus'></i> Add More</button>
</div>

<div class="modal fade text-left" id="create_card" tabindex="-1" aria-labelledby="myModalLabel17">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel1">Add New Card</h4>
                        <button type="button" class="close" onclick="$('#create_card').modal('hide');" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="col-12">
                        <div class="card card-payment">
                            <div class="card-header">
                                <h4 class="card-title">Card Detail</h4>
                                <h4 class="card-title text-primary">$455.60</h4>
                            </div>
                            <div class="card-body">
                                <form id="add_card" action="javascript:void(0);" class="form">
                                @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group mb-2">
                                                <label for="payment-card-number">Card Number</label>
                                                <div id="paymentResponse" class="text-danger font-italic"></div>
                                                    <div id="card_number" class="field form-control"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="payment-expiry">Expiry</label>
                                                <div id="card_expiry" class="field form-control"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="payment-cvv">CVV / CVC</label>
                                                <div id="card_cvc" class="field form-control"></div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-2">
                                                <label for="payment-input-name">Card Holder Name</label>
                                                <input type="text" name="name" id="payment-input-name" class="form-control" placeholder="John">

                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary btn-block waves-effect waves-float waves-light">Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>  
                    </div>
            </div>
    </div>
    <script>
    $(".modal .modal").on("hidden.bs.modal", function () {
                setTimeout(function(){$('body').addClass('modal-open');}, 1000);
            });
    </script>

  
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
    var form = document.getElementById('add_card');

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
            url: '/admin/add/card',
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

    });

</script>