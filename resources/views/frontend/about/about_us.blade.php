@extends('frontend.main_master')
@section('main')
<style>
    img {
        max-width: 100%;
    }

    .pt-100 {
        padding-top: 100px;
    }

    .pt-45 {
        padding-top: 45px;
    }

    .pb-70 {
        padding-bottom: 70px;
    }

    .team-style-area .section-title h2 {
        max-width: 640px;
        margin-left: auto;
        margin-right: auto;
    }



    .team-item {
        position: relative;
        margin-bottom: 30px;
        overflow: hidden;
    }

    .team-item:hover .content {
        bottom: 0;
    }

    .team-item:hover .content .social-link {
        opacity: 1;
    }

    .team-item a {
        display: block;
    }

    .team-item a img {
        border-radius: 15px;
    }

    .team-item .content {
        background-color: #978667;
        padding: 20px;
        position: absolute;
        bottom: -45px;
        left: 0;
        right: 0;
        border-radius: 15px;
        -webkit-transition: 0.7s;
        transition: 0.7s;
        text-align: center;
    }

    .team-item .content h3 {
        margin-bottom: 0px;
        font-size: 24px;
    }

    .team-item .content h3 a {
        color: white;
    }

    .team-item .content span {
        color: white;
    }

    .team-item .content .social-link {
        margin: 10px 0 0;
        padding: 0;
        list-style: none;
        opacity: 0;
        -webkit-transition: 0.9s;
        transition: 0.9s;
    }

    .team-item .content .social-link li {
        display: inline-block;
        margin-right: 5px;
    }

    .team-item .content .social-link li a {
        border-radius: 50px;
        width: 35px;
        height: 35px;
        line-height: 37px;
        text-align: center;
        color: #ffffff;
    }

    .team-item .content .social-link li:nth-child(1) a {
        background-color: #3b5998;
    }

    .team-item .content .social-link li:nth-child(1) a:hover {
        background-color: #292323;
        -webkit-animation: tada 1s linear;
        animation: tada 1s linear;
    }

    .team-item .content .social-link li:nth-child(2) a {
        background-color: #55acee;
    }

    .team-item .content .social-link li:nth-child(2) a:hover {
        background-color: #292323;
        -webkit-animation: tada 1s linear;
        animation: tada 1s linear;
    }

    .team-item .content .social-link li:nth-child(3) a {
        background-color: #3f729b;
    }

    .team-item .content .social-link li:nth-child(3) a:hover {
        background-color: #292323;
        -webkit-animation: tada 1s linear;
        animation: tada 1s linear;
    }

    .team-item .content .social-link li:nth-child(4) a {
        background-color: #ff0000;
    }

    .team-item .content .social-link li:nth-child(4) a:hover {
        background-color: #292323;
        -webkit-animation: tada 1s linear;
        animation: tada 1s linear;
    }

    .pagination-area {
  margin-top: 10px;
  margin-bottom: 30px;
  text-align: center;
}

.pagination-area .page-numbers {
  width: 40px;
  height: 40px;
  line-height: 40px;
  color: white;
  background-color: #978667;
  text-align: center;
  display: inline-block;
  position: relative;
  margin-left: 3px;
  margin-right: 3px;
  font-size: 18px;
  border-radius: 50px;
}

.pagination-area .page-numbers:hover {
  background-color: #4b514d;
  color: #ffffff;
}

.pagination-area .page-numbers i {
  position: relative;
  font-size: 25px;
  top: 5px;
}

.pagination-area .page-numbers.current {
  background-color: #4b514d;
  color: #ffffff;
}
</style>
@include('frontend.home.booking_one')
<div class="team-style-area pt-100 pb-70">
    <div class="container">
        <div class="title text-center mb-5">
            <small data-cue="slideInUp">Paradise Hotel</small>
            <h2 data-cue="slideInUp" data-delay="100">Our Team</h2>
        </div>
        <div class="row pt-45">
            @foreach ($members as $member)
            <div class="col-lg-4 col-md-6">
                <div class="team-item">
                    <a>
                        <img src="{{ asset($member->photo) }}" alt="Images">
                    </a>
                    <div class="content">
                        <h3><a>{{ $member->name }}</a></h3>
                        <span>{{ $member->position }}</span>
                        <ul class="social-link">
                            @if ($member->facebook)
                            <li>
                                <a href="{{ $member->facebook }}" target="_blank"><i class='bx bxl-facebook'></i></a>
                            </li>                                
                            @endif
                            @if ($member->twitter)
                            <li>
                                <a href="{{ $member->twitter }}" target="_blank"><i class='bx bxl-twitter'></i></a>
                            </li>
                            @endif
                            @if ($member->instagram)
                            <li>
                                <a href="{{ $member->instagram }}" target="_blank"><i class='bx bxl-instagram'></i></a>
                            </li>
                            @endif
                            @if ($member->pinterest)
                            <li>
                                <a href="{{ $member->pinterest }}" target="_blank"><i class='bx bxl-pinterest-alt'></i></a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="col-lg-12 col-md-12">
                <div class="pagination-area">
                    <a href="#" class="prev page-numbers">
                        <i class='bx bx-chevrons-left'></i>
                    </a>

                    <span class="page-numbers current" aria-current="page">1</span>
                    <a href="#" class="page-numbers">2</a>
                    <a href="#" class="page-numbers">3</a>

                    <a href="#" class="next page-numbers">
                        <i class='bx bx-chevrons-right'></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection