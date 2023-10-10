@extends('frontend.main_master')
@section('main')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<div class="hero small-height jarallax" data-jarallax data-speed="0.2">
    <img class="jarallax-img" src="{{ asset('frontend/img/hero_home_1.jpg') }}" alt="">
    <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
        <div class="container">
            <small class="slide-animated one">Luxury Hotel Experience</small>
            <h1 class="slide-animated two">Change Password</h1>
        </div>
    </div>
</div>
<div class="service-details-area pt-100 pb-70 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                @include('frontend.dashboard.user_sidebar')
            </div>
            <div class="col-lg-9">
                <div class="service-article p-3">
                    <section class="checkout-area pb-70">
                        <div class="container">
                            <form action="{{ route('user.password.update') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="billing-details">
                                            <h3 class="title">User Change Password </h3>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="old_password">Old Password <span class="required">*</span></label>
                                                        <input type="password" name="old_password" id="old_password" class="form-control @error('old_password') is-invalid @enderror">
                                                        @error('old_password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="new_password">New Password<span class="required">*</span></label>
                                                        <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror">
                                                        @error('new_password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="new_password_confirmation">Confirm New Password <span class="required">*</span></label>
                                                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-profile">Update Password </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
</script>
@endsection