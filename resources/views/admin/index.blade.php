@extends('admin.admin_dashboard')
@section('admin')

@php
$bookings = \App\Models\Booking::latest()->get();
$pendingBookings = \App\Models\Booking::where('status', '0')->get();
$completeBookings = \App\Models\Booking::where('status', '1')->get();
$totalPrice = \App\Models\Booking::sum('total_price');

$today = Carbon\Carbon::now()->toDateString();
$todayPrice = App\Models\Booking::where('created_at', $today)->sum('total_price');
$messages = \App\Models\Contact::latest()->get();
$todayMessages = \App\Models\Contact::whereDate('created_at', $today)->get();

$allData = \App\Models\Booking::orderBy('id', 'DESC')->limit(10)->get();
@endphp
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/index.js') }}"></script>
<div class="page-content">

    <div class="dash-wrapper bg-dark">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 row-cols-xxl-5">
            <div class="col border-end border-light-2">
                <div class="card bg-transparent shadow-none mb-0">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Total Booking</p>
                        <h3 class="mb-3 text-white">{{ count($bookings) }}</h3>
                        <p class="font-13 text-white">Today Sell: <span class="text-success">{{ $todayPrice }}</span></p>
                        <div id="chart1"></div>
                    </div>
                </div>
            </div>
            <div class="col border-end border-light-2">
                <div class="card bg-transparent shadow-none mb-0">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Pending Booking</p>
                        <h3 class="mb-3 text-white">{{ count($pendingBookings) }}</h3>
                        <p class="font-13 text-white"><span class="text-success"><i class="lni lni-arrow-up"></i> 4.2% </span> last 7 days</p>
                        <div id="chart2"></div>
                    </div>
                </div>
            </div>
            <div class="col border-end border-light-2">
                <div class="card bg-transparent shadow-none mb-0">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Complete Booking</p>
                        <h3 class="mb-3 text-white">{{ count($completeBookings) }}</h3>
                        <p class="font-13 text-white"><span class="text-danger"><i class="lni lni-arrow-down"></i> 3.6%</span> vs last 7 days</p>
                        <div id="chart3"></div>
                    </div>
                </div>
            </div>
            <div class="col border-end border-light-2">
                <div class="card bg-transparent shadow-none mb-0">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Total Price</p>
                        <h3 class="mb-3 text-white">${{ $totalPrice }}</h3>
                        <p class="font-13 text-white"><span class="text-success"><i class="lni lni-arrow-up"></i> 2.5%</span> vs last 7 days</p>
                        <div id="chart4"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-transparent shadow-none mb-0">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Messages</p>
                        <h3 class="mb-3 text-white">{{ count($messages) }}</h3>
                        <p class="font-13 text-white">Today Messagess: <span class="text-danger">{{ count($todayMessages) }}</span></p>
                        <div id="chart5"></div>
                    </div>
                </div>
            </div>
        </div><!--end row-->
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
                            <h5 class="mb-1">Recent Booking</h5>
                        </div>
                    </div>

                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Code</th>
                                    <th>Booking Date</th>
                                    <th>Customer</th>
                                    <th>Room</th>
                                    <th>Check In/Out</th>
                                    <th># Rooms</th>
                                    <th>Guest</th>
                                    <th>Payment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allData as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td><a href="{{ route('edit_booking', $item->id) }}">{{ $item->code }}</a></td>
                                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $item['user']['name'] }}</td>
                                    <td>{{ $item['room']['roomtype']['name'] }}</td>
                                    <td>
                                        <span class="badge bg-primary">{{ $item->check_in }}</span><br>
                                        <span class="badge bg-warning text-dark">{{ $item->check_out }}</span>
                                    </td>
                                    <td>{{ $item->number_of_rooms }}</td>
                                    <td>{{ $item->person }}</td>
                                    <td>
                                        @if ($item->payment_status == '1')
                                        <span class="text-success">Complete</span>
                                        @else
                                        <span class="text-danger">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Booking Number</th>
                                    <th>Booking Date</th>
                                    <th>Customer</th>
                                    <th>Room</th>
                                    <th>Check In/Out</th>
                                    <th>Total Room</th>
                                    <th>Guest</th>
                                    <th>Payment</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div><!--end row-->
</div>
@endsection