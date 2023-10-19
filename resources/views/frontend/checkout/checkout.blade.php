@extends('frontend.main_master')
@section('main')
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
                            <img style="height:100px; width:120px;object-fit: cover" src=" " alt="Images" alt="Images">
                            <div style="padding-left: 10px;">
                                <a href=" " style="font-size: 20px; color: #595959;font-weight: bold">Room Name</a>
                                <p><b>120 / Night</b></p>
                            </div>
                        </div>
                        <br>
                        <table class="table" style="width: 100%">
                            <tr>
                                <td>
                                    <p>Total Night ( 4)</p>
                                </td>
                                <td style="text-align: right">
                                    <p>Room Name</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Total Room</p>
                                </td>
                                <td style="text-align: right">
                                    <p>3</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Subtotal</p>
                                </td>
                                <td style="text-align: right">
                                    <p>200</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Discount</p>
                                </td>
                                <td style="text-align:right">
                                    <p>Discount</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Total</p>
                                </td>
                                <td style="text-align:right">
                                    <p>Total</p>
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
                <form method="post" action="phpmailer/reserve_template_email.php" id="bookingform" autocomplete="off">
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
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>First Name <span class="required">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Last Name <span class="required">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>Company Name</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-6">
                                <div class="form-group">
                                    <label>Address <span class="required">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-6">
                                <div class="form-group">
                                    <label>Town / City <span class="required">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>State / County <span class="required">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Postcode / Zip <span class="required">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Email Address <span class="required">*</span></label>
                                    <input type="email" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Phone <span class="required">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="create-an-account">
                                    <label class="form-check-label" for="create-an-account">Create an account?</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / booking_wrapper -->
                    <div class="col-lg-12 col-md-12">
							<div class="payment-box">
                                <div class="payment-method">
                                    <p>
                                        <input type="radio" id="direct-bank-transfer" name="radio-group" checked>
                                        <label for="direct-bank-transfer">Direct Bank Transfer</label>
                                        Make your payment directly into our bank account. Please use your Order
                                        ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.
                                    </p>
                                    <p>
                                        <input type="radio" id="paypal" name="radio-group">
                                        <label for="paypal">PayPal</label>
                                    </p>
                                    <p>
                                        <input type="radio" id="cash-on-delivery" name="radio-group">
                                        <label for="cash-on-delivery">Cash On Delivery</label>
                                    </p>
                                </div>

                                <p class="text-end mt-4"><input class="btn_1 outline" type="submit" value="Place Order" id="submit-booking"></p>
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
@endsection