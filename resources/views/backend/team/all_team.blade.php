@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Team</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Team Members</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.team') }}" role="button" class="btn btn-primary">Add Team Member</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">All CheapHotel Team Members</h6>
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
                            <th>Position</th>
                            <th>Social Media</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($team as $key => $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td><img src="{{ asset($item->photo) }}" alt="" style="width: 60px; height: 50px"></td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->position }}</td>
                            <td>
                                @if ($item->facebook)
                                <button type="button" class="btn btn-success"><i class="bx bxl-facebook-square me-0"></i></button>
                                @else
                                <button type="button" class="btn btn-dark"><i class="bx bxl-facebook-square me-0"></i></button>    
                                @endif

                                @if ($item->twitter)
                                <button type="button" class="btn btn-success"><i class="bx bxl-twitter me-0"></i></button>
                                @else
                                <button type="button" class="btn btn-dark"><i class="bx bxl-twitter me-0"></i></button>
                                @endif

                                @if ($item->instagram)
                                <button type="button" class="btn btn-success"><i class="bx bxl-linkedin-square me-0"></i></button>
                                @else
                                <button type="button" class="btn btn-dark"><i class="bx bxl-linkedin-square me-0"></i></button>
                                @endif

                                @if ($item->pinterest)
                                <button type="button" class="btn btn-success"><i class="bx bxl-pinterest me-0"></i></button>
                                @else
                                <button type="button" class="btn btn-dark"><i class="bx bxl-pinterest me-0"></i></button>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('edit.team', $item->id) }}" class="btn btn-primary px-3 radius-30">Edit</a>
                                <a href="{{ route('delete.team', $item->id) }}" class="btn btn-danger px-3 radius-30" id="delete">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Social Media</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection