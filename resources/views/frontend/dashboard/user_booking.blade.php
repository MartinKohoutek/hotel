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
                                                        <th scope="col">Booking #</th>
                                                        <th scope="col">Booking Date</th>
                                                        <th scope="col">Customer</th>
                                                        <th scope="col">Room</th>
                                                        <th scope="col">Check In/Out</th>
                                                        <th scope="col"># of Rooms</th>
                                                        <th scope="col"># of Guests</th>
                                                        <th scope="col">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($bookings as $booking)
                                                    <tr>
                                                        <style>
                                                            a:link {
                                                                color: blue;
                                                            }
                                                        </style>
                                                        <td><a href="{{ route('user.invoice', $booking->id) }}">{{ $booking->code }}</a></td>
                                                        <td>{{ $booking->created_at->format('d-m-Y') }}</td>
                                                        <td>{{ $booking->user->name }}</td>
                                                        <td>{{ $booking->room->roomtype->name }}</td>
                                                        <td>
                                                            <span class="badge bg-primary">{{ $booking->check_in }}</span>
                                                            <span class="badge bg-warning text-dark">{{ $booking->check_out }}</span>
                                                        </td>
                                                        <td>{{ $booking->number_of_rooms }}</td>
                                                        <td>{{ $booking->person }}</td>
                                                        <td>
                                                            @if ($booking->status == 1)
                                                                <span class="badge bg-success">Complete</span>
                                                            @else
                                                                <span class="badge bg-warning text-dark">Pending</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
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