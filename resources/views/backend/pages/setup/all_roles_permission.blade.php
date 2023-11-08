@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Roles & Permissions</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Roles In Permission</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.roles.permission') }}" role="button" class="btn btn-primary">Add Role in Permission</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">All Roles In Permission</h6>
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Role Name</th>
                            <th>Permission</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $item)
                        <tr>
                            <td>{{ $key+1 }}</td>                           
                            <td>{{ $item->name }}</td>                         
                            <td>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($item->permissions as $perm)
                                    <span class="badge bg-danger">{{ $perm->name }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('edit.roles.permission', $item->id) }}" class="btn btn-primary px-3 radius-30">Edit</a>
                                <a href="{{ route('delete.roles', $item->id) }}" class="btn btn-danger px-3 radius-30" id="delete">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                             <th>Id</th>
                            <th>Role Name</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection