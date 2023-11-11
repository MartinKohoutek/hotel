@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Restaurant Menu</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Menu Items</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                @if (Auth::user()->can('blog.post.add'))
                <a href="{{ route('add.menu.item') }}" role="button" class="btn btn-primary">Add Menu Item</a>
                @endif
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">All Menu Items</h6>
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Ingredients</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $key => $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td><img src="{{ asset($item->image) }}" alt="" style="width: 60px; height: 50px"></td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->ingredients }}</td>
                            <td>${{ $item->price }}</td>
                            <td>{{ $item['category']['category_name'] }}</td>
                            <td>
                                @if (Auth::user()->can('blog.post.edit'))
                                <a href="{{ route('edit.menu.item', $item->id) }}" class="btn btn-primary px-3 radius-30">Edit</a>
                                @endif
                                @if (Auth::user()->can('blog.post.delete'))
                                <a href="{{ route('delete.menu.item', $item->id) }}" class="btn btn-danger px-3 radius-30" id="delete">Delete</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Ingredients</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection