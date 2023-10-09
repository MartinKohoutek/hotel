@extends('frontend.main_master')
@section('main')
<div class="hero medium-height jarallax" data-jarallax data-speed="0.2">
    <img class="jarallax-img" src="{{ asset('frontend/img/hero_home_2.jpg') }}" alt="">
    <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
        <div class="container">
            <small class="slide-animated one">Luxury Hotel Experience</small>
            <h1 class="slide-animated two">Sign Up</h1>
        </div>
    </div>
</div>
<div class="container margin_120_95">
    <div class="contact-form">
        <div class="section-title text-center">
            <span class="sp-color">Sign Up</span>
            <h2 class="mb-5 text-center">Create an Account!</h2>
        </div>
        <div id="message-contact"></div>
        <form method="post" action="{{ route('register') }}" autocomplete="off">
            @csrf
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-floating mb-4">
                        <input class="form-control @error('name') is-invalid @enderror" type="text" id="name_contact" name="name" placeholder="Name">
                        <label for="name_contact">Name</label>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-floating mb-4">
                        <input class="form-control" type="email" id="email_contact" name="email" placeholder="Email">
                        <label for="email_contact">Email</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-floating mb-4">
                        <input class="form-control" type="password" id="password" name="password" placeholder="Password">
                        <label for="password">Password</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-floating mb-4">
                        <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="Password">
                        <label for="password_confirmation">Confirm Password</label>
                    </div>
                </div>
            </div>
           
            <p class="mt-3">
                <input type="submit" value="Submit" class="btn_1 outline w-100 d-block mx-auto">
            </p>
            <div class="col-12">
                <p class="account-desc">Already have an account?<a href="{{ route('login') }}">Sign In</a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection
