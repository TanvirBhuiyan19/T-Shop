@extends('layouts.frontendMaster')


@php
$settings = App\Models\Setting::where('id', 1)->first();
@endphp
@section('title')  
@if(session()->get('language') == 'bangla') স্ট্রাইপ পেমেন্ট @else Stripe Payment @endif 
@if($settings->site_name) | {{$settings->site_name}} @else | {{config('app.name')}}  @endif
@endsection



@section('content')

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                @if(session()->get('language') == 'bangla')
                <li><a href="{{url('/')}}">হোম</a></li>
                <li><a href="{{url('/')}}">চেকআউট</a></li>
                <li class='active'>স্ট্রাইপ</li>
                @else
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('checkout')}}">Checkout</a></li>
                <li class='active'>Stripe</li>
                @endif
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<style>
    /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
    .StripeElement {
        box-sizing: border-box;
        height: 40px;
        padding: 10px 12px;
        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }
    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }
    .StripeElement--invalid {
        border-color: #fa755a;
    }
    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;}
    </style>

    <div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 col-sm-12">
                    <div class="panel-group checkout-steps" >

                        <!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">

                            <div id="collapseOne" class="panel-collapse collapse in">

                                <!-- panel-body  -->
                                <div class="panel-body">
                                    <br><br><br><br><br>
                                    <div class="row">		
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10 col-sm-12 guest-login">
                                            
                                            <form action="{{ route('stripe.payment') }}" method="post" id="payment-form">
                                                @csrf
                                                <div class="form-row">
                                                    <label for="card-element">
                                                        Credit or debit card
                                                    </label>
                                                    <input type="hidden" name="name" value="{{ $data['shipping_name'] }}">
                                                    <input type="hidden" name="email" value="{{ $data['shipping_email'] }}">
                                                    <input type="hidden" name="phone" value="{{ $data['shipping_phone'] }}">
                                                    <input type="hidden" name="post_code" value="{{ $data['post_code'] }}">
                                                    <input type="hidden" name="division_id" value="{{ $data['division_id'] }}">
                                                    <input type="hidden" name="district_id" value="{{ $data['district_id'] }}">
                                                    <input type="hidden" name="state_id" value="{{ $data['state_id'] }}">
                                                    <input type="hidden" name="notes" value="{{ $data['notes'] }}">
                                                    <div id="card-element">
                                                        <!-- A Stripe Element will be inserted here. -->
                                                    </div>
                                                    <!-- Used to display form errors. -->
                                                    <div id="card-errors" role="alert"></div>
                                                </div>
                                                <br>
                                                <button class="btn btn-primary center-block"><strong> Pay ${{$cartTotal}} </strong></button>
                                            </form>   
                                            
                                        </div>
                                        <div class="col-md-1"></div>		
                                    </div>
                                    <br><br><br><br><br>
                                </div>
                                <!-- panel-body  -->

                            </div><!-- row -->
                        </div><!-- checkout-step-01  -->


                    </div><!-- /.checkout-steps -->
                </div>
                <div class="col-md-2"></div>

            </div><!-- /.row -->
        </div><!-- /.checkout-box -->




        <script type="text/javascript">
            // Create a Stripe client.
            var STRIPE_PUBLISHED_KEY = '{{ config('app.STRIPE_PUBLISHED_KEY') }}';
            var stripe = Stripe(STRIPE_PUBLISHED_KEY);
        // Create an instance of Elements.
            var elements = stripe.elements();
        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
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
        // Create an instance of the card Element.
            var card = elements.create('card', {style: style});
        // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');
        // Handle real-time validation errors from the card Element.
            card.on('change', function (event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });
        // Handle form submission.
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                stripe.createToken(card).then(function (result) {
                    if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.token);
                    }
                });
            });
        // Submit the form with the token ID.
            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
                // Submit the form
                form.submit();
            }
        </script>    



        @endsection