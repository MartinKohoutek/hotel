@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Manage Employees</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Employees</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                @if (Auth::user()->can('employee.add'))
                <a href="{{ route('add.admin') }}" role="button" class="btn btn-primary">Add Employee</a>
                @endif
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">All Employees</h6>
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
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $key => $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td><img src="{{ (!empty($item->photo)) ? url('upload/admin_images/'.$item->photo) : url('upload/no_image.jpg')}}" alt="" style="width: 60px; height: 60px"></td>                      
                            <td>{{ $item->name }}</td>  
                            <td>{{ $item->email }}</td>                       
                            <td>{{ $item->phone }}</td>
                            <td>
                                @foreach ($item->roles as $role)
                                    <span class="badge bg-danger">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @if (Auth::user()->can('employee.edit'))
                                <a href="{{ route('edit.admin', $item->id) }}" class="btn btn-primary px-3 radius-30">Edit</a>
                                @endif
                                @if (Auth::user()->can('employee.delete'))
                                <a href="{{ route('delete.admin', $item->id) }}" class="btn btn-danger px-3 radius-30" id="delete">Delete</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection