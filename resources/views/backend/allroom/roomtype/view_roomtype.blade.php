@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Room Types</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Room Type List</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                @if (Auth::user()->can('room.type.add'))
                <a href="{{ route('add.room.type') }}" role="button" class="btn btn-primary">Add Room Type</a>
                @endif
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">All Room Type List</h6>
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roomTypes as $key => $item)
                        @php
                            $rooms = \App\Models\Room::where('roomtype_id', $item->id)->get();
                        @endphp
                        <tr>
                            <td>{{ $key+1 }}</td>
                           
                            <td><img src="{{ (!empty($item->room->image)) ? url('upload/roomimg/'.$item->room->image) : url('upload/no_image.jpg') }}" alt="" style="width: 50px; height: 40px"></td>
                            <td>{{ $item->name }}</td>
                            <td>
                                @foreach ($rooms as $room)
                                @if (Auth::user()->can('room.type.edit'))
                                <a href="{{ route('edit.room', $room->id) }}" class="btn btn-primary px-3 radius-30">Edit</a>
                                @endif
                                @if (Auth::user()->can('room.type.delete'))
                                <a href="{{ route('delete.room', $room->id) }}" class="btn btn-danger px-3 radius-30" id="delete">Delete</a>
                                @endif
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection