@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Room List</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Room List</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                @if (Auth::user()->can('booking.add'))
                <a href="{{ route('add.room.list') }}" role="button" class="btn btn-primary">Add Booking</a>
                @endif
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">All Room List</h6>
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Room Type</th>
                            <th>Room #</th>
                            <th>Booking Status</th>
                            <th>Check In/Out</th>
                            <th>Booking #</th>
                            <th>Customer</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($room_number_list as $key => $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->room_number }}</td>
                            <td>
                                @if ($item->booking_id != '')
                                    @if ($item->booking_status == 1)
                                    <span class="badge bg-danger">Booked</span>
                                    @else
                                    <span class="badge bg-warning">Pending</span>
                                    @endif
                                @else
                                    <span class="badge bg-success">Free Room</span>
                                @endif
                            </td>
                            <td>
                                @if ($item->booking_id != '' )
                                    <span class="badge rounded-pill bg-secondary">{{ date('d-m-Y', strtotime($item->check_in)) }}</span>
                                    to
                                    <span class="badge rounded-pill bg-info">{{ date('d-m-Y', strtotime($item->check_out)) }}   
                                @endif
                            </td>
                            <td>
                                @if ($item->booking_id != '')
                                    {{ $item->booking_number }}
                                @endif
                            </td>
                            <td>
                                @if ($item->booking_id != '')
                                    {{ $item->customer_name }}
                                @endif
                            </td>
                            <td>
                                @if ($item->status == 'Active')
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-danger">InActive</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Room Type</th>
                            <th>Room #</th>
                            <th>Booking Status</th>
                            <th>Check In/Out</th>
                            <th>Booking #</th>
                            <th>Customer</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection