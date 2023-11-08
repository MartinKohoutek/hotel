@extends('admin.admin_dashboard')
@section('admin')
<style>
    .form-check-label {
        text-transform: capitalize;
    }
</style>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Roles & Permissions</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Roles in Permission</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                                </div>
                                <h5 class="mb-0 text-primary">Add Roles in Permission</h5>
                            </div>
                            <hr>
                            <form class="row g-3" method="post" action="{{ route('role.permission.store') }}">
                                @csrf
                                <div class="col-md-6">
                                    <label for="inputFirstName" class="form-label">Permission Group</label>
                                    <select name="role_id" class="form-select mb-3" aria-label="Default select example">
									    <option selected="" disabled>Select Role</option>
                                        @foreach ($roles as $role)
									        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
								    </select>
                                </div>  
                                <div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="checkAll">
									<label class="form-check-label" for="checkAll">Select All Permissions</label>
								</div>
                                <hr>
                                @foreach ($permission_groups as $group)
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">{{ $group->group_name }}</label>
                                        </div>                 
                                    </div>
                                    <div class="col-9">
                                        @php
                                            $permissions = App\Models\User::getPermissionsByGroupName($group->group_name);
                                        @endphp
                                        @foreach ($permissions as $permission)
                                        <div class="form-check">
                                            <input class="form-check-input" name="permission[]" type="checkbox" id="id{{ $permission->id }}" value="{{ $permission->id }}">
                                            <label class="form-check-label" for="id{{ $permission->id }}">{{ $permission->name }}</label>
                                        </div>
                                        @endforeach
                                        <br>
                                    </div>
                                </div>
                                @endforeach

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-5">Store Role</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#checkAll').click(function(){
        if ($(this).is(':checked')) {
            $('input[type=checkbox]').prop('checked', true);
        } else {
            $('input[type=checkbox]').prop('checked', false);
        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                name: {
                    required: true,
                },
                position: {
                    required: true,
                },
                photo: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: 'Please Enter Name',
                },
                position: {
                    required: 'Please Enter Position'
                },
                photo: {
                    required: 'Please Enter Photo'
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>
@endsection