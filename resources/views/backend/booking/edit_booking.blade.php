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
                        <p class="font-13 text-white"><span class="text-success"><i class="lni lni-arrow-up"></i>2.1%</span> vs last 7 days</p>
                        <div id="chart1"></div>
                    </div>
                </div>
            </div>
            <div class="col border-end border-light-2">
                <div class="card bg-transparent shadow-none mb-0">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Booking Date</p>
                        <h3 class="mb-3 text-white">{{ \Carbon\Carbon::parse($booking->created_at)->format('d/m/Y') }}</h3>
                        <p class="font-13 text-white"><span class="text-success"><i class="lni lni-arrow-up"></i> 4.2% </span> last 7 days</p>
                        <div id="chart2"></div>
                    </div>
                </div>
            </div>
            <div class="col border-end border-light-2">
                <div class="card bg-transparent shadow-none mb-0">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Payment Method</p>
                        <h3 class="mb-3 text-white">{{ $booking->payment_method }}</h3>
                        <p class="font-13 text-white"><span class="text-danger"><i class="lni lni-arrow-down"></i> 3.6%</span> vs last 7 days</p>
                        <div id="chart3"></div>
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
                        <p class="font-13 text-white"><span class="text-success"><i class="lni lni-arrow-up"></i> 2.5%</span> vs last 7 days</p>
                        <div id="chart4"></div>
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
                        <p class="font-13 text-white"><span class="text-danger"><i class="lni lni-arrow-down"></i> 5.2%</span> vs last 7 days</p>
                        <div id="chart5"></div>
                    </div>
                </div>
            </div>
        </div><!--end row-->
    </div>

    <div class="row row-cols-1 row-cols-xl-1">
        <div class="col d-flex">
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
                                    <td>{{ $booking->actual_price }}</td>
                                    <td>
                                        <span class="badge bg-primary">{{ $booking->check_in }}</span><br>
                                        <span class="badge bg-warning text-dark">{{ $booking->check_out }}</span>
                                    </td>
                                    <td>{{ $booking->total_night }}</td>
                                    <td>${{ $booking->actual_price * $booking->total_night }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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