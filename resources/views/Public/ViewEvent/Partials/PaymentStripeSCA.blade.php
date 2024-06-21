<form class="online_payment" action="<?php echo route('postCreateOrder', ['event_id' => $event->id]); ?>" method="post" id="stripe-sca-payment-form">
    <div class="form-row">
        <label for="card-element">
            @lang("Public_ViewEvent.stripe_credit_or_debit_card")
        </label>
        <div id="card-element">

        </div>

        <div id="card-errors" role="alert"></div>
    </div>
    {!! Form::token() !!}

    <input class="btn btn-lg btn-success card-submit" style="width:100%;" type="submit" value="@lang("Public_ViewEvent.complete_payment")"
    onclick="document.getElementById('loader').style.display = 'block';">

    <style>
        .loading-container {
            position: relative;
            height: 12rem;
            width: 12rem;
            z-index: 100;
            margin-top: -150px;
            margin-left: 250px;
        }

        .loading-progress {
            position: absolute;
            height: 100%;
            width: 100%;
        }
        .loading-progress::before {
            content: "";
            position: absolute;
            height: 100%;
            width: 100%;
            border-radius: 50%;
            border: 5px solid transparent;
            border-top-color: #ACCAFF;
            top: -5px;
            left: -5px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        
        100% {
            transform: rotate(360deg);
        }
        }
    </style>
    <div class="loading-container" id="loader" style="display: none">
        <div class="loading-progress"></div>
    </div>

</form>
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">

    var stripe = Stripe('<?php echo $account_payment_gateway->config['publishableKey']; ?>');
    var elements = stripe.elements();

    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    var cardElement = elements.create('card', {hidePostalCode: true, style: style});
    cardElement.mount('#card-element');

    cardElement.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
            document.getElementById('loader').style.display = 'none';
        } else {
            displayError.textContent = '';
        }
    });


</script>
<style type="text/css">

    .StripeElement {
        box-sizing: border-box;

        height: 40px;

        padding: 10px 12px;

        border: 1px solid #e0e0e0 !important;
        border-radius: 4px;
        background-color: white;

        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
        margin-bottom: 20px;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>