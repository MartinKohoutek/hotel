@extends('frontend.main_master')
@section('main')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<div class="hero full-height jarallax" data-jarallax data-speed="0.2">
    <img class="jarallax-img kenburns" src="img/rooms/1.jpg" alt="">
    <div class="wrapper opacity-mask d-flex align-items-center  text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <small class="slide-animated one">Luxury Hotel Experience</small>
                    <h1 class="slide-animated two">Sierra Double Room</h1>
                    <p class="slide-animated three">Exquisite furnishings for a cosy ambience</p>
                </div>
            </div>
        </div>
        <div class="mouse_wp slide-animated four">
            <a href="#first_section" class="btn_explore">
                <div class="mouse"></div>
            </a>
        </div>
        <!-- / mouse -->
    </div>
</div>
<!-- /Background Img Parallax -->

<div class="container margin_120_95" id="booking_section">
    <div class="row justify-content-between gx-5">
        <div class="col-xl-4">
            <section class="checkout-area pb-70">
                <div class="card-body">
                    <div class="slideInUp" style="background-color: #f5f2ee; padding: 25px">
                        <div class="title">
                            <small>Paradise Hotel</small>
                            <h2>Booking Summary</h2>
                        </div>
                        <hr>
                        <div style="display: flex; justify-content: space-between;">
                            <img style="height:100px; width:120px;object-fit: cover" src="{{ (!empty($room->image)) ? url('upload/roomimg/'.$room->image) : url('upload/no_image.jpg') }}" alt="Images" alt="Images">
                            <div style="padding-left: 10px;">
                                <a href=" " style="font-size: 20px; color: #595959;font-weight: bold">{{ @$room->roomtype->name }}</a>
                                <p><b>${{ $room->price }}/ Night</b></p>
                            </div>
                        </div>
                        <br>
                        <table class="table" style="width: 100%">
                            <tr>
                                <td>
                                    <p>Total Night<br><b> ({{ $book_data['check_in'] }} - {{ $book_data['check_out'] }})</b></p>
                                </td>
                                <td style="text-align: right">
                                    <p>{{ $nights }} Days</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Total Room</p>
                                </td>
                                <td style="text-align: right">
                                    <p>{{ $book_data['number_of_rooms'] }}</p>
                                </td>
                            </tr>
                            @php
                            $subtotal = $room->price * $nights * $book_data['number_of_rooms'];
                            $discount = ($room->discount/100) * $subtotal;
                            $total = $subtotal - $discount;
                            @endphp
                            <tr>
                                <td>
                                    <p>Subtotal</p>
                                </td>
                                <td style="text-align: right">
                                    <p>$ {{ $subtotal }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Discount</p>
                                </td>
                                <td style="text-align:right">
                                    <p>-$ {{ $discount }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Total</p>
                                </td>
                                <td style="text-align:right">
                                    <p>$ {{ $total }}</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-xl-8">
            <div data-cue="slideInUp">
                <div id="message-booking"></div>
                <form method="post" action="{{ route('checkout.store') }}" role="form" class="stripe_form require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
                    @csrf
                    <div class="booking_wrapper">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="custom_select form-group">
                                    <label for="" class="form-label">Country</label>
                                    <select class="wide" name="country" id="country">
                                        <option value="">Select Country</option>
                                        <option value="1">Czech Republic</option>
                                        <option value="2">Slovakia</option>
                                        <option value="3">Germany</option>
                                        <option value="4">United Kingdom</option>
                                        <option value="5">Other Country</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Name <span class="required">*</span></label>
                                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Email Address <span class="required">*</span></label>
                                    <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Phone <span class="required">*</span></label>
                                    <input type="text" name="phone" class="form-control" value="{{ Auth::user()->phone }}">
                                </div>
                            </div>


                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Address <span class="required">*</span></label>
                                    <input type="text" name="address" class="form-control" value="{{ Auth::user()->address }}">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>State</label>
                                    <input type="text" name="state" class="form-control">
                                    @if ($errors->has('state'))
                                    <span class="text-danger">{{ $errors->first('state') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Zip Code <span class="required">*</span></label>
                                    <input type="text" name="zip_code" class="form-control">
                                    @if ($errors->has('zip_code'))
                                    <span class="text-danger">{{ $errors->first('zip_code') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / booking_wrapper -->
                    <div class="col-lg-12 col-md-12">
                        <div class="payment-box">
                            <div class="payment-method">
                                <p>
                                    <input type="radio" id="cash-on-delivery" name="payment_method" checked value="COD">
                                    <label for="cash-on-delivery">Cash On Delivery</label>
                                </p>
                                <p>
                                    <input type="radio" class="pay_method" id="stripe" name="payment_method" value="Stripe">
                                    <label for="stripe">Stripe</label>
                                </p>
                        
                                <div id="stripe_pay" class="d-none">
                                    <br>
                                    <div class="form-row row">
                                        <div class="col-xs-12 form-group required">
                                            <label class="control-label">Name on Card</label>
                                            <input class="form-control" size="4" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-row row">
                                        <div class="col-xs-12 form-group  required">
                                            <label class="control-label">Card Number</label>
                                            <input autocomplete="off" class="form-control card-number" size="20" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-row row">
                                        <div class="col-xs-12 col-md-4 form-group cvc required">
                                            <label class="control-label">CVC</label>
                                            <input autocomplete="off" class="form-control card-cvc" placeholder="ex. 311" size="4" type="text" />
                                        </div>
                                        <div class="col-xs-12 col-md-4 form-group expiration required">
                                            <label class="control-label">Expiration Month</label>
                                            <input class="form-control card-expiry-month" placeholder="MM" size="2" type="text" />
                                        </div>
                                        <div class="col-xs-12 col-md-4 form-group expiration required">
                                            <label class="control-label">Expiration Year</label>
                                            <input class="form-control card-expiry-year" placeholder="YYYY" size="4" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-row row">
                                        <div class="col-md-12 error form-group hide">
                                            <div class="alert-danger alert">Please correct the errors and try again.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="text-end mt-4"><input class="btn_1 outline" type="submit" value="Place Order" id="myButton"></p>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /data cue -->
        </div>
        <!-- /col -->
    </div>
    <!-- /row -->
</div>
<!-- /container -->
<style>
    .hide {
        display: none
    }
</style>


<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".pay_method").on('click', function() {
            var payment_method = $(this).val();
            if (payment_method == 'Stripe') {
                $("#stripe_pay").removeClass('d-none');
            } else {
                $("#stripe_pay").addClass('d-none');
            }
        });
    });

    $(function() {
        var $form = $(".require-validation");
        $('form.require-validation').bind('submit', function(e) {

            var pay_method = $('input[name="payment_method"]:checked').val();
            if (pay_method == undefined) {
                alert('Please select a payment method');
                return false;
            } else if (pay_method == 'COD') {

            } else {
                document.getElementById('myButton').disabled = true;

                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'
                    ].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {

                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }
            }
        });

        function stripeResponseHandler(status, response) {
            if (response.error) {
                document.getElementById('myButton').disabled = false;
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                document.getElementById('myButton').disabled = true;
                document.getElementById('myButton').value = 'Please Wait...';

                // token contains id, last4, and card type
                var token = response['id'];
                // insert the token into the form so it gets submitted to the server
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }

    });
</script>
@endsection