@extends('admin.admin_dashboard')
@section('admin')
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/index.js') }}"></script>
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
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="">Check In</label>
                                <input type="date" name="check_in" class="form-control" required value="{{ $booking->check_in }}">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="">Check Out</label>
                                <input type="date" name="check_out" class="form-control" required value="{{ $booking->check_out }}">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="">Number Of Rooms</label>
                                <input type="number" name="number_of_rooms" class="form-control" required value="{{ $booking->number_of_rooms }}">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="">Availability: <span class="text-success availability"></span></label>
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

    <div class="row">
        <div class="col">
            <div class="card radius-10 mb-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-1">Recent Orders</h5>
                        </div>
                        <div class="ms-auto">
                            <a href="javscript:;" class="btn btn-primary btn-sm radius-30">View All Products</a>
                        </div>
                    </div>

                    <div class="table-responsive mt-3">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Tracking ID</th>
                                    <th>Products Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#55879</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="recent-product-img">
                                                <img src="assets/images/products/15.png" alt="">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">Light Red T-Shirt</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>22 Jun, 2020</td>
                                    <td class=""><span class="badge bg-light-success text-success w-100">Completed</span></td>
                                    <td>#149.25</td>
                                    <td>
                                        <div class="d-flex order-actions"> <a href="javascript:;" class="text-danger bg-light-danger border-0"><i class='bx bxs-trash'></i></a>
                                            <a href="javascript:;" class="ms-4 text-primary bg-light-primary border-0"><i class='bx bxs-edit'></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#88379</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="recent-product-img">
                                                <img src="assets/images/products/16.png" alt="">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">Grey Headphone</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>22 Jun, 2020</td>
                                    <td class=""><span class="badge bg-light-danger text-danger w-100">Cancelled</span></td>
                                    <td>#149.25</td>
                                    <td>
                                        <div class="d-flex order-actions"> <a href="javascript:;" class="text-danger bg-light-danger border-0"><i class='bx bxs-trash'></i></a>
                                            <a href="javascript:;" class="ms-4 text-primary bg-light-primary border-0"><i class='bx bxs-edit'></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#68823</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="recent-product-img">
                                                <img src="assets/images/products/19.png" alt="">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">Grey Hand Watch</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>22 Jun, 2020</td>
                                    <td class=""><span class="badge bg-light-warning text-warning w-100">Pending</span></td>
                                    <td>#149.25</td>
                                    <td>
                                        <div class="d-flex order-actions"> <a href="javascript:;" class="text-danger bg-light-danger border-0"><i class='bx bxs-trash'></i></a>
                                            <a href="javascript:;" class="ms-4 text-primary bg-light-primary border-0"><i class='bx bxs-edit'></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#54869</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="recent-product-img">
                                                <img src="assets/images/products/07.png" alt="">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">Brown Sofa</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>22 Jun, 2020</td>
                                    <td class=""><span class="badge bg-light-success text-success w-100">Completed</span></td>
                                    <td>#149.25</td>
                                    <td>
                                        <div class="d-flex order-actions"> <a href="javascript:;" class="text-danger bg-light-danger border-0"><i class='bx bxs-trash'></i></a>
                                            <a href="javascript:;" class="ms-4 text-primary bg-light-primary border-0"><i class='bx bxs-edit'></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#22536</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="recent-product-img">
                                                <img src="assets/images/products/17.png" alt="">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">Black iPhone 11</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>22 Jun, 2020</td>
                                    <td class=""><span class="badge bg-light-success text-success w-100">Completed</span></td>
                                    <td>#149.25</td>
                                    <td>
                                        <div class="d-flex order-actions"> <a href="javascript:;" class="text-danger bg-light-danger border-0"><i class='bx bxs-trash'></i></a>
                                            <a href="javascript:;" class="ms-4 text-primary bg-light-primary border-0"><i class='bx bxs-edit'></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#25796</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="recent-product-img">
                                                <img src="assets/images/products/14.png" alt="">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">Men Yellow T-Shirt</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>22 Jun, 2020</td>
                                    <td class=""><span class="badge bg-light-warning text-warning w-100">Pending</span></td>
                                    <td>#149.25</td>
                                    <td>
                                        <div class="d-flex order-actions"> <a href="javascript:;" class="text-danger bg-light-danger border-0"><i class='bx bxs-trash'></i></a>
                                            <a href="javascript:;" class="ms-4 text-primary bg-light-primary border-0"><i class='bx bxs-edit'></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#98754</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="recent-product-img">
                                                <img src="assets/images/products/08.png" alt="">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">Grey Stand Table</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>22 Jun, 2020</td>
                                    <td class=""><span class="badge bg-light-danger text-danger w-100">Cancelled</span></td>
                                    <td>#149.25</td>
                                    <td>
                                        <div class="d-flex order-actions"> <a href="javascript:;" class="text-danger bg-light-danger border-0"><i class='bx bxs-trash'></i></a>
                                            <a href="javascript:;" class="ms-4 text-primary bg-light-primary border-0"><i class='bx bxs-edit'></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div><!--end row-->
</div>
@endsection