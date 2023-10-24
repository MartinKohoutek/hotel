@extends('admin.admin_dashboard')
@section('admin')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Room List</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Room List</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                                </div>
                                <h5 class="mb-0 text-primary">Add Room List</h5>
                            </div>
                            <hr>
                            <form class="row g-3" action="{{ route('store.room.list') }}" method="post">
                                @csrf
                                <div class="col-md-4">
                                    <label for="roomtype_id" class="form-label">Room Type</label>
                                    <select name="room_id" id="room_id" class="form-select">
                                        <option selected="">Select Room Type ...</option>
                                        @foreach ($roomtypes as $roomtype)
                                        <option value="{{ $roomtype->room->id }}" {{ collect(old('roomtype_id'))->contains($roomtype->id) ? 'selected' : '' }}>{{ $roomtype->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="check_in" class="form-label">Check In</label>
                                    <input type="date" name="check_in" class="form-control" id="check_in">
                                </div>
                                <div class="col-md-4">
                                    <label for="check_out" class="form-label">Check Out</label>
                                    <input type="date" name="check_out" class="form-control" id="check_out">
                                </div>
                                <div class="col-md-6">
                                    <label for="number_of_room" class="form-label">Number of Rooms</label>
                                    <input type="number" name="number_of_room" class="form-control" id="number_of_room">
                                    <input type="hidden" name="available_rooms" id="available_rooms" class="form-control">
                                    <div class="mt-2">
                                        <label>Availability: <span class="text-success availability"></span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="number_of_guests" class="form-label">Number of Guests</label>
                                    <input type="text" name="number_of_guests" class="form-control" id="number_of_guests">
                                </div>
                                <h3 class="mt-3 mb-5">Customer Information</h3>
                                <div class="col-md-4">
                                    <label for="name" class="form-label">User Name</label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" name="country" class="form-control" id="country" value="{{ old('country') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" name="state" class="form-control" id="state" value="{{ old('state') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="zip_code" class="form-label">Zip Code</label>
                                    <input type="text" name="zip_code" class="form-control" id="zip_code" value="{{ old('zip_code') }}">
                                </div>
                                <div class="col-12">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" name="address" id="address" rows="3">{{ old('address') }}</textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-5">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                name: {
                    required: true,
                },
                position: {
                    required: true,
                },
                photo: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: 'Please Enter Name',
                },
                position: {
                    required: 'Please Enter Position'
                },
                photo: {
                    required: 'Please Enter Photo'
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>
<script>
$(document).ready(function() {
        $('#room_id').on('change', function(){
            $('#check_in').val('');
            $('#check_out').val('');
            $('.availability').text(0);
            $('#available_rooms').val(0);
        });

        $('#check_out').on('change', function(){
            getAvailability();
        });


    });

    function getAvailability() {
        var check_in = $('#check_in').val();
        check_in = check_in.split("-").reverse().join("-");

        var check_out = $('#check_out').val();
        check_out = check_out.split("-").reverse().join("-");

        var room_id = $('#room_id').val();
        var startDate = new Date(check_in);
        var endDate = new Date(check_out);

        if (startDate > endDate) {
            alert('Invalid Date');
            $('#check_out').val('');
            return false;
        }

        if (check_in != '' && check_out != '' && room_id != '') {
            $.ajax({
                url: "/check_room_availability",
                data: {
                    check_in: check_in,
                    check_out: check_out,
                    room_id: room_id,
                },
                success: function(data) {
                    $('.availability').text(data['available_rooms']);
                    $('#available_rooms').val(data['available_rooms']);
                },
            });
        } else {
            alert('Fields must not be empty!');
        }
    }
</script>
@endsection