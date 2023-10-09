@extends('frontend.main_master')
@section('main')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<div class="hero small-height jarallax" data-jarallax data-speed="0.2">
    <img class="jarallax-img" src="{{ asset('frontend/img/hero_home_1.jpg') }}" alt="">
    <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
        <div class="container">
            <small class="slide-animated one">Luxury Hotel Experience</small>
            <h1 class="slide-animated two">About Paradise</h1>
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
                            <form action="{{ route('user.profile.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="billing-details">
                                            <h3 class="title">User Profile </h3>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Name <span class="required">*</span></label>
                                                        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Email<span class="required">*</span></label>
                                                        <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Address <span class="required">*</span></label>
                                                        <input type="text" name="address" class="form-control" value="{{ $user->address }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Phone <span class="required">*</span></label>
                                                        <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-6">
                                                    <div class="form-group">
                                                        <label>Photo</label>
                                                        <input type="file" name="photo" class="form-control form-control-lg" id="image">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-6">
                                                    <div class="form-group">
                                                        <label></label>
                                                        <img src="{{ (!empty($user->photo)) ? url('upload/user_images/'.$user->photo) : url('upload/no_image.jpg') }}" id="showImage" alt="" style="width: 120px; height: 120px">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-profile">Update Profile </button>
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
<script>
    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection