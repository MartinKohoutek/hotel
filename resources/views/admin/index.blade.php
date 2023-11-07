@extends('admin.admin_dashboard')
@section('admin')

@php
$today = Carbon\Carbon::now()->toDateString();
$bookings = \App\Models\Booking::latest()->get();
$pendingBookings = \App\Models\Booking::where('status', '0')->get();
$completeBookings = \App\Models\Booking::where('status', '1')->get();
$totalPrice = \App\Models\Booking::sum('total_price');

$todayPrice = App\Models\Booking::whereDate('created_at', $today)->sum('total_price');
$messages = \App\Models\Contact::latest()->get();
$todayMessages = \App\Models\Contact::whereDate('created_at', $today)->get();

$users = \App\Models\User::latest()->get();
$todayUsers = \App\Models\User::whereDate('created_at', $today)->get();

$todayBooking = \App\Models\Booking::whereDate('created_at', $today)->get();

$allData = \App\Models\Booking::orderBy('id', 'DESC')->limit(10)->get();

$dates = collect();
foreach( range( -6, 0 ) AS $i ) {
    $date = Carbon\Carbon::now()->addDays( $i )->format( 'Y-m-d' );
    $dates->put( $date, 0);
}

$perWeekRevenue = App\Models\Booking::where( 'created_at', '>=', $dates->keys()->first() )
             ->groupBy( 'date' )
             ->orderBy( 'date' )
             ->get( [
                 DB::raw( 'DATE( created_at ) as date' ),
                 DB::raw( 'SUM( total_price ) as "price"' )
             ] )
             ->pluck( 'price', 'date' );
$perWeekRevenue = $dates->merge($perWeekRevenue);

// Get the post counts
$posts = App\Models\Contact::where( 'created_at', '>=', $dates->keys()->first() )
             ->groupBy( 'date' )
             ->orderBy( 'date' )
             ->get( [
                 DB::raw( 'DATE( created_at ) as date' ),
                 DB::raw( 'COUNT( * ) as "count"' )
             ] )
             ->pluck( 'count', 'date' );

$perWeekBooking = \App\Models\Booking::where('created_at', '>=', $dates->keys()->first())
                ->groupBy('date')
                ->orderBy('date')
                ->get([
                        DB::raw('DATE(created_at) as date'),
                        DB::raw('COUNT(*) as "count"')
                    ])
                ->pluck('count', 'date');
$perWeekBooking = $dates->merge($perWeekBooking);

$newUsers = App\Models\User::where( 'created_at', '>=', $dates->keys()->first() )
             ->groupBy( 'date' )
             ->orderBy( 'date' )
             ->get( [
                 DB::raw( 'DATE( created_at ) as date' ),
                 DB::raw( 'COUNT( * ) as "count"' )
             ] )
             ->pluck( 'count', 'date' );
$newUsers = $dates->merge($newUsers);

// Merge the two collections; any results in `$posts` will overwrite the zero-value in `$dates`
$dates = $dates->merge( $posts );

@endphp
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- <script src="{{ asset('backend/assets/js/index.js') }}"></script> -->
<div class="page-content">

    <div class="dash-wrapper bg-dark">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 row-cols-xxl-5">
            <div class="col border-end border-light-2">
                <div class="card bg-transparent shadow-none mb-0">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Total Booking</p>
                        <h3 class="mb-3 text-white">{{ count($bookings) }}</h3>
                        <p class="font-13 text-white">Today Booking: <span class="text-success">{{ count($todayBooking) }}</span></p>
                        <div id="chart4"></div>
                    </div>
                </div>
            </div>
            <div class="col border-end border-light-2">
                <div class="card bg-transparent shadow-none mb-0">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Total Revenue</p>
                        <h3 class="mb-3 text-white">${{ $totalPrice }}</h3>
                        <p class="font-13 text-white">Today Revenue: <span class="text-success">${{ $todayPrice }}</span></p>
                        <div id="chart1"></div>
                    </div>
                </div>
            </div>
            <div class="col border-end border-light-2">
                <div class="card bg-transparent shadow-none mb-0">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Registered Users</p>
                        <h3 class="mb-3 text-white">{{ count($users) }}</h3>
                        <p class="font-13 text-white">Today users: <span class="text-success">{{ count($todayUsers) }}</span></p>
                        <div id="chart3"></div>
                    </div>
                </div>
            </div>
            <div class="col border-end border-light-2">
                <div class="card bg-transparent shadow-none mb-0">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Messages</p>
                        <h3 class="mb-3 text-white">{{ count($messages) }}</h3>
                        <p class="font-13 text-white">Today Messagess: <span class="text-danger">{{ count($todayMessages) }}</span></p>
                        <div id="chart5"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-transparent shadow-none mb-0">
                    <div class="card-body text-center">
                        <p class="mb-1 text-white">Pending Booking</p>
                        <h3 class="mb-3 text-danger">{{ count($pendingBookings) }}</h3>
                        <p class="mb-1 text-white">Complete Booking</p>
                        <h3 class="mb-3 text-success">{{ count($pendingBookings) }}</h3>
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
                            <h6 class="mb-0">Messages Overview</h6>
                        </div>
                        <div class="dropdown ms-auto">
                            <span class="btn btn-white btn-sm radius-10" style="cursor:default;">
                                This Week
                            </button>
                        </div>
                    </div>
                    <div id="myChart"></div>
                </div>
            </div>
        </div>
        <div class="col d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Daily Revenue</h6>
                        </div>
                        <div class="d-flex align-items-center ms-auto font-13 gap-2">
                           
                        </div>
                    </div>
                    <canvas id="bookingChart"></canvas>
                   
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
<script>
    var ctx = document.getElementById('bookingChart').getContext('2d');
    var bookings = @json($bookings);
    bookings = bookings.slice(0, 7);

    // Extract the required data from the bookings
    var labels = bookings.map(function(booking) {
        return booking.check_in; 
    });

    var data = bookings.map(function(booking) {
        return booking.total_price;
    });

    var bookingChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Daily Revenue ($)',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });


    var messages =  @json($dates);
   
    var options = {
        series: [{
            name: 'Messages',
            data: Object.values(messages),
        }],
        chart: {
            type: 'area',
            foreColor: '#9a9797',
            height: 250,
            toolbar: {
                show: false
            },
            zoom: {
                enabled: false
            },
            dropShadow: {
                enabled: false,
                top: 3,
                left: 14,
                blur: 4,
                opacity: 0.12,
                color: '#8833ff',
            },
            sparkline: {
                enabled: false
            }
        },
        markers: {
            size: 0,
            colors: ["#8833ff"],
            strokeColors: "#fff",
            strokeWidth: 2,
            hover: {
                size: 7,
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '45%',
                endingShape: 'rounded'
            },
        },

        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 3,
            curve: 'straight'
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: 'vertical',
                shadeIntensity: 0.5,
                gradientToColors: ['#fff'],
                inverseColors: false,
                opacityFrom: 0.8,
                opacityTo: 0.5,
                stops: [0, 100]
            }
        },
        colors: ["#8833ff"],
        grid: {
            show: true,
            borderColor: '#ededed',
            //strokeDashArray: 4,
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return (value).toFixed(1) + " Messages";
                }
            },
        },
        xaxis: {
            categories: Object.keys(messages),
            tooltip: {
                enabled: false,
            }
        },

        tooltip: {
            theme: 'dark',
            y: {
                formatter: function (value) {
                    return "" + value + " Messages"
                }
            }
        }
    };
    var chart = new ApexCharts(document.querySelector("#myChart"), options);
    chart.render();


    console.log(Object.values(messages));
    // chart 5
    var options = {
        series: [{
            name: 'Messages',
            data: Object.values(messages)
        }],
        chart: {
            type: 'line',
            height: 60,
            toolbar: {
                show: false
            },
            zoom: {
                enabled: false
            },
            dropShadow: {
                enabled: false,
                top: 3,
                left: 14,
                blur: 4,
                opacity: 0.12,
                color: '#29cc39',
            },
            sparkline: {
                enabled: true
            }
        },
        markers: {
            size: 0,
            colors: ["#29cc39"],
            strokeColors: "#fff",
            strokeWidth: 2,
            hover: {
                size: 7,
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '45%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2.5,
            curve: 'smooth'
        },
        colors: ["#29cc39"],
        xaxis: {
            categories: Object.keys(messages),
        },
        yaxis: {
            labels: {
                formatter: function (val) {
                    return val.toFixed(0);
                }
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            theme: 'dark',
            fixed: {
                enabled: false
            },
            x: {
                title: {
                    formatter: function (value) {
                        return '' + value;
                    }
                }
            },
            y: {
                title: {
                    formatter: function (value) {
                        return '' + value;
                    }
                }
            },
            marker: {
                show: false
            }
        }
    };
    var chart = new ApexCharts(document.querySelector("#chart5"), options);
    chart.render();

    // chart 4
    var perWeekBooking =  @json($perWeekBooking);

    var options = {
        series: [{
            name: 'Booking',
            data: Object.values(perWeekBooking)
        }],
        chart: {
            type: 'bar',
            height: 60,
            toolbar: {
                show: false
            },
            zoom: {
                enabled: false
            },
            dropShadow: {
                enabled: false,
                top: 3,
                left: 14,
                blur: 4,
                opacity: 0.12,
                color: '#0dcaf0',
            },
            sparkline: {
                enabled: true
            }
        },
        markers: {
            size: 0,
            colors: ["#0dcaf0"],
            strokeColors: "#fff",
            strokeWidth: 2,
            hover: {
                size: 7,
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '40%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2.4,
            curve: 'smooth'
        },
        colors: ["#0dcaf0"],
        
        xaxis: {
            categories: Object.keys(perWeekBooking),
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            theme: 'dark',
            y: {
                formatter: function (val) {
                    return "" + val;
                }
            }
        }
    };
    var chart = new ApexCharts(document.querySelector("#chart4"), options);
    chart.render();

     // chart 1
     var perWeekRevenue = @json($perWeekRevenue);
     var options = {
        series: [{
            name: 'Revenue',
            data: Object.values(perWeekRevenue),
        }],
        chart: {
            type: 'line',
            height: 60,
            toolbar: {
                show: false
            },
            zoom: {
                enabled: false
            },
            dropShadow: {
                enabled: false,
                top: 3,
                left: 14,
                blur: 4,
                opacity: 0.12,
                color: '#8833ff',
            },
            sparkline: {
                enabled: true
            }
        },
        markers: {
            size: 0,
            colors: ["#8833ff"],
            strokeColors: "#fff",
            strokeWidth: 2,
            hover: {
                size: 7,
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '45%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2.5,
            curve: 'smooth'
        },
        colors: ["#8833ff"],
        xaxis: {
            categories: Object.keys(perWeekRevenue),

        },
        fill: {
            opacity: 1
        },
        tooltip: {
            theme: 'dark',
            fixed: {
                enabled: false
            },
            x: {
                show: false
            },
            y: {
                title: {
                    formatter: function (seriesName) {
                        return seriesName;
                    }
                },
                formatter: function (val) {
                    console.log(val);
                    return "$" + val;
                }
            },
            marker: {
                show: false
            }
        }
    };
    var chart = new ApexCharts(document.querySelector("#chart1"), options);
    chart.render();

    // chart 3
    var newUsers = @json($newUsers);
    var options = {
        series: [{
            name: 'Registered Users',
            data: Object.values(newUsers),
        }],
        chart: {
            type: 'area',
            height: 60,
            toolbar: {
                show: false
            },
            zoom: {
                enabled: false
            },
            dropShadow: {
                enabled: false,
                top: 3,
                left: 14,
                blur: 4,
                opacity: 0.12,
                color: '#ffc107',
            },
            sparkline: {
                enabled: true
            }
        },
        markers: {
            size: 0,
            colors: ["#ffc107"],
            strokeColors: "#fff",
            strokeWidth: 2,
            hover: {
                size: 7,
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '45%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2.5,
            curve: 'smooth'
        },
        colors: ["#ffc107"],
        xaxis: {
            categories: Object.keys(newUsers),
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            theme: 'dark',
            fixed: {
                enabled: false
            },
            x: {
                show: true
            },
            y: {
                title: {
                    formatter: function (seriesName) {
                        return '' + seriesName;
                    }
                },
                formatter: function (val) {
                    return parseInt(val);
                }
            },
            marker: {
                show: false
            }
        }
    };
    var chart = new ApexCharts(document.querySelector("#chart3"), options);
    chart.render();

</script>
@endsection