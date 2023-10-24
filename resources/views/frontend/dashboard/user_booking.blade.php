@extends('frontend.main_master')
@section('main')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<div class="hero small-height jarallax" data-jarallax data-speed="0.2">
    <img class="jarallax-img" src="{{ asset('frontend/img/hero_home_1.jpg') }}" alt="">
    <div class="wrapper opacity-mask d-flex align-items-center justify-content-center text-center animate_hero" data-opacity-mask="rgba(0, 0, 0, 0.5)">
        <div class="container">
            <small class="slide-animated one">Luxury Hotel Experience</small>
            <h1 class="slide-animated two">User Booking List</h1>
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
                                            <h3 class="title">User Booking List </h3>
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">First</th>
                                                        <th scope="col">Last</th>
                                                        <th scope="col">Handle</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>Mark</td>
                                                        <td>Otto</td>
                                                        <td>@mdo</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">2</th>
                                                        <td>Jacob</td>
                                                        <td>Thornton</td>
                                                        <td>@fat</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">3</th>
                                                        <td colspan="2">Larry the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                </tbody>
                                            </table>
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