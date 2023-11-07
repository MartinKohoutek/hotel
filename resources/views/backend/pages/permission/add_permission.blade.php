@extends('admin.admin_dashboard')
@section('admin')
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
                    <li class="breadcrumb-item active" aria-current="page">Add Permission</li>
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
                                <h5 class="mb-0 text-primary">Add Permission</h5>
                            </div>
                            <hr>
                            <form class="row g-3" method="post" action="{{ route('store.permission') }}">
                                @csrf
                                <div class="col-md-6">
                                    <label for="inputFirstName" class="form-label">Permission</label>
                                    <input type="text" name="name" class="form-control" >
                                </div> 
                                <div class="col-md-6">
                                    <label for="inputFirstName" class="form-label">Permission Group</label>
                                    <select name="group_name" class="form-select mb-3" aria-label="Default select example">
									<option selected="">Select Permission Group</option>
									<option value="Team">Team</option>
									<option value="Book Area">Book Area</option>
									<option value="Manage Room">Manage Room</option>
									<option value="Booking">Booking</option>
									<option value="Room List">Room List</option>
									<option value="Setting">Setting</option>
									<option value="Testimonial">Testimonial</option>
									<option value="Blog">Blog</option>
									<option value="Manage Comment">Manage Comment</option>
									<option value="Booking Report">Booking Report</option>
									<option value="Hotel Gallery">Hotel Gallery</option>
									<option value="Contact Message">Contact Message</option>
									<option value="Role and Permission">Role and Permission</option>
								</select>
                                </div>     
                                
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-5">Store Permission</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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