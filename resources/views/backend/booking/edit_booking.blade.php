@extends('admin.admin_dashboard')
@section('admin')
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
<!-- <script src="{{ asset('backend/assets/js/index.js') }}"></script> -->
<div class="page-content">

    <div class="dash-wrapper bg-dark">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 row-cols-xxl-5">
            <div class="col border-end border-light-2">
                <div class="card bg-transparent shadow-none mb-0">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Booking Number</p>
                        <h3 class="mb-3 text-white">{{ $booking->code }}</h3>
                    </div>
                </div>
            </div>
            <div class="col border-end border-light-2">
                <div class="card bg-transparent shadow-none mb-0">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Booking Date</p>
                        <h3 class="mb-3 text-white">{{ \Carbon\Carbon::parse($booking->created_at)->format('d/m/Y') }}</h3>
                    </div>
                </div>
            </div>
            <div class="col border-end border-light-2">
                <div class="card bg-transparent shadow-none mb-0">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Payment Method</p>
                        <h3 class="mb-3 text-white">{{ $booking->payment_method }}</h3>
                    </div>
                </div>
            </div>
            <div class="col border-end border-light-2">
                <div class="card bg-transparent shadow-none mb-0">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Payment Status</p>
                        <h3 class="mb-3 text-white">
                            @if ($booking->payment_status == '1')
                            <span class="text-success">Complete</span>
                            @else
                            <span class="text-danger">Pending</span>
                            @endif
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-transparent shadow-none mb-0">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Booking Status</p>
                        <h3 class="mb-3 text-white">
                            @if ($booking->status == '1')
                            <span class="text-success">Active</span>
                            @else
                            <span class="text-danger">Pending</span>
                            @endif
                        </h3>
                    </div>
                </div>
            </div>
        </div><!--end row-->
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-8 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Room Type</th>
                                    <th>Number of Rooms</th>
                                    <th>Price</th>
                                    <th>Check In/Out Date</th>
                                    <th>Total Nights</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $booking['room']['roomtype']['name'] }}</td>
                                    <td>{{ $booking->number_of_rooms }}</td>
                                    <td>${{ $booking->actual_price }}</td>
                                    <td>
                                        <span class="badge bg-primary">{{ $booking->check_in }}</span><br>
                                        <span class="badge bg-warning text-dark">{{ $booking->check_out }}</span>
                                    </td>
                                    <td>{{ $booking->total_night }}</td>
                                    <td>${{ $booking->actual_price * $booking->total_night }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-md-6 mt-3" style="float: right;">
                            <style>
                                .test_table td {
                                    text-align: right;
                                }
                            </style>
                            <table class="table table-bordered test_table" style="float: right;">
                                <tr>
                                    <th>Subtotal</th>
                                    <td>${{ $booking->subtotal }}</td>
                                </tr>
                                <tr>
                                    <th>Discount</th>
                                    <td>- ${{ $booking->discount }}</td>
                                </tr>
                                <tr>
                                    <th>Total Price</th>
                                    <td>${{ $booking->total_price }}</td>
                                </tr>
                            </table>
                        </div>
                        <div style="clear: both">
                            <div style="margin-top: 40px; margin-bottom: 20px">
                                <a href="javascript::void(0)" class="btn btn-primary assign_room">Assign Room</a>
                            </div>
                        </div>
                        @php
                            $assigned_rooms = \App\Models\BookingRoomList::with('room_number')->where('booking_id', $booking->id)->get();
                        @endphp

                        @if (count($assigned_rooms) > 0)
                        <table class="table table-bordered">
                                <tr>
                                    <th>Room Number</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($assigned_rooms as $room)
                                <tr>
                                    <td>{{ $room->room_number->room_number }}</td>
                                    <td><a href="{{ route('assign_room_delete', $room->id) }}" id="delete">Delete</a></td>
                                </tr>
                                @endforeach
                        </table>
                        @else
                        <div class="alert alert-danger text-center">
                            No Room Assigned Yet!
                        </div>
                        @endif
                    </div>
                    <form action="{{ route('update.booking.status', $booking->id) }}" method="post">
                        @csrf
                        <div class="row" style="margin-top: 40px;">
                            <div class="col-md-6">
                                <label for="">Payment Status</label>
                                <select name="payment_status" id="payment_status" class="form-select">
                                    <option selected="">Select Status...</option>
                                    <option value="0" {{ $booking->status == '0' ? 'selected' : '' }}>Pending</option>
                                    <option value="1" {{ $booking->status == '1' ? 'selected' : '' }}>Complete</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Booking Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option selected="">Select Booking Status...</option>
                                    <option value="0" {{ $booking->status == '0' ? 'selected' : '' }}>Pending</option>
                                    <option value="1" {{ $booking->status == '1' ? 'selected' : '' }}>Active</option>
                                </select>
                            </div>
                            <div class="com-md-12" style="margin-top: 20px;">
                                <button type="submit" class="btn btn-primary">Update Booking</button>
                                <a href="{{ route('download.invoice', $booking->id) }}" class="btn btn-warning px-3 radius-10 text-white"><i class="lni lni-download"></i>Download Invoice</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-4">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0 font-weight-bold">Manage Room and Date</h6>
                    </div>
                    <form action="{{ route('update.booking', $booking->id) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="">Check In</label>
                                <input type="date" id="check_in" name="check_in" class="form-control" required value="{{ $booking->check_in }}">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="">Check Out</label>
                                <input type="date" id="check_out" name="check_out" class="form-control" required value="{{ $booking->check_out }}">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="">Number Of Rooms</label>
                                <input type="number" name="number_of_rooms" class="form-control" required value="{{ $booking->number_of_rooms }}">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="">Availability: <span class="text-success availability"></span></label>
                                <input type="hidden" name="available_room" id="available_room" class="form-control">
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0 font-weight-bold">Customer Information</h6>
                    </div>
                    <style>
                        strong {
                            font-weight: normal;
                        }
                    </style>
                    <ul class="list-group mt-4 list-group-flush">
                        <li class="list-group-item d-flex align-items-center">
                            <i class="bx bxs-circle me-1 text-success"></i>
                            <span>Name:</span>
                            <strong class="ms-auto">{{ $booking['user']['name'] }}</strong>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="bx bxs-circle me-1 text-danger"></i>
                            <span>Email:</span>
                            <strong class="ms-auto">{{ $booking['user']['email'] }}</strong>
                        </li>
                        @if (!empty($booking['user']['country']))
                        <li class="list-group-item d-flex align-items-center">
                            <i class="bx bxs-circle me-1 text-primary"></i>
                            <span>Country:</span>
                            <strong class="ms-auto">{{ $booking['user']['country'] }}</strong>
                        </li>
                        @endif
                        @if (!empty($booking['user']['state']))
                        <li class="list-group-item d-flex align-items-center">
                            <i class="bx bxs-circle me-1 text-warning"></i>
                            <span>State:</span>
                            <strong class="ms-auto">{{ $booking['user']['state'] }}</strong>
                        </li>
                        @endif
                        <li class="list-group-item d-flex align-items-center">
                            <i class="bx bxs-circle me-1 text-warning"></i>
                            <span>Address:</span>
                            <strong class="ms-auto">{{ $booking['user']['address'] }}</strong>
                        </li>
                        @if (!empty($booking['user']['zip_code']))
                        <li class="list-group-item d-flex align-items-center">
                            <i class="bx bxs-circle me-1 text-warning"></i>
                            <span>Zip Code:</span>
                            <strong class="ms-auto">{{ $booking['user']['zip_code'] }}</strong>
                        </li>
                        @endif
                        <li class="list-group-item d-flex align-items-center">
                            <i class="bx bxs-circle me-1 text-warning"></i>
                            <span>Phone:</span>
                            <strong class="ms-auto">{{ $booking['user']['phone'] }}</strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-xl-2">
        <div class="col d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Sales Overview</h6>
                        </div>
                        <div class="dropdown ms-auto">
                            <button class="btn btn-white btn-sm radius-10 dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                This Month
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="#">This Week</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div>
                    </div>
                    <div id="chart6"></div>
                </div>
            </div>
        </div>
        <div class="col d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Visitor Status</h6>
                        </div>
                        <div class="d-flex align-items-center ms-auto font-13 gap-2">
                            <span class="border px-1 rounded cursor-pointer"><i class='bx bxs-circle text-primary me-1'></i>New Visitor</span>
                            <span class="border px-1 rounded cursor-pointer"><i class='bx bxs-circle text-sky-light me-1'></i>Old Visitor</span>
                        </div>
                    </div>
                    <div id="chart7"></div>
                </div>
            </div>
        </div>
    </div><!--end row-->

</div>

<div class="modal fade myModal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Available Rooms</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        getAvailability();

        $('.assign_room').on('click', function(){
            $.ajax({
                url: "{{ route('assign_room', $booking->id) }}",
                success: function(data) {
                    $('.myModal .modal-body').html(data);
                    $('.myModal').modal('show');
                }, 
            })
            return false;
        });
    });

    function getAvailability() {
        var check_in = $('#check_in').val();
        check_in = check_in.split("-").reverse().join("-");

        var check_out = $('#check_out').val();
        check_out = check_out.split("-").reverse().join("-");

        var room_id = "{{ $booking->rooms_id }}";

        $.ajax({
            url: "/check_room_availability",
            data: {
                check_in: check_in,
                check_out: check_out,
                room_id: room_id,
            },
            success: function(data) {
                $('.availability').text(data['available_rooms']);
                $('#available_room').val(data['available_rooms']);
            },
        });
    }
</script>
@endsection