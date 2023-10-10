@extends('frontend.main_master')
@section('main')
<div class="hero medium-height jarallax" data-jarallax data-speed="0.2">
    <img class="jarallax-img" src="{{ asset('frontend/img/hero_home_2.jpg') }}" alt="">
    <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
        <div class="container">
            <small class="slide-animated one">Luxury Hotel Experience</small>
            <h1 class="slide-animated two">Sign In</h1>
        </div>
    </div>
</div>
<div class="container margin_120_95">
    <div class="contact-form">
        <div class="section-title text-center">
            <span class="sp-color">Sign In</span>
            <h2 class="mb-5 text-center">Sign In to Your Account!</h2>
        </div>
        <div id="message-contact"></div>
        <form method="post" action="{{ route('login') }}" autocomplete="off">
            @csrf
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-floating mb-4">
                        <input class="form-control @error('login') is-invalid @enderror" type="text" id="name_contact" name="login" placeholder="Name/Email/Phone">
                        <label for="name_contact">Name/Email/Phone</label>
                        @error('login')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-floating mb-4">
                        <input class="form-control" type="password" id="email_contact" name="password" placeholder="Password">
                        <label for="email_contact">Password</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-6 form-condition">
                    <div class="agree-label">
                        <input type="checkbox" id="chb1">
                        <label for="chb1">Remember Me</label>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-6">
                    <a class="forget" href="{{ route('password.request') }}">Forgot My Password?</a>
                </div>
            </div>
            <p class="mt-3">
                <input type="submit" value="Sign In" class="btn_1 outline w-100 d-block mx-auto">
            </p>
            <div class="col-12">
                <p class="account-desc">
                    Not a Member?
                    <a href="{{ route('register') }}">Sign Up</a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection