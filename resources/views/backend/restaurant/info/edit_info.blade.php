@extends('admin.admin_dashboard')
@section('admin')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Restaurant Info</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Restaurant Info</li>
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
                                <h5 class="mb-0 text-primary">Edit Restaurant Info</h5>
                            </div>
                            <hr>
                            <form class="row g-3" method="post" action="{{ route('update.menu.info') }}">
                                @csrf
                                <div class="col-6">
                                    <label for="inputAddress" class="form-label">Title 1</label>
                                    <input type="text" name="title1" class="form-control" id="inputFirstName" value="{{ $info->title1 }}">
                                </div>
                                <div class="col-6">
                                    <label for="inputFirstName" class="form-label">Title 2</label>
                                    <input type="text" name="title2" class="form-control" id="inputFirstName" value="{{ $info->title2 }}">
                                </div>
                                <div class="col-6">
                                    <label for="inputAddress" class="form-label">Footer</label>
                                    <input type="text" name="footer" class="form-control" id="inputFirstName" value="{{ $info->footer }}">
                                </div>
                                <div class="col-6">
                                    <label for="inputAddress" class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control" id="inputFirstName" value="{{ $info->phone }}">
                                </div>
                                <div class="col-4">
                                    <label for="inputFirstName" class="form-label">Breakfast Time</label>
                                    <input type="text" name="breakfast_time" class="form-control" id="inputFirstName" value="{{ $info->breakfast_time }}">
                                </div>
                                <div class="col-4">
                                    <label for="inputAddress" class="form-label">Launch Time</label>
                                    <input type="text" name="lunch_time" class="form-control" id="inputFirstName" value="{{ $info->lunch_time }}">
                                </div>
                                <div class="col-4">
                                    <label for="inputFirstName" class="form-label">Dinner Time</label>
                                    <input type="text" name="dinner_time" class="form-control" id="inputFirstName" value="{{ $info->dinner_time }}">
                                </div>
                                <hr style="margin-top: 30px;">
                                <div class="col-12">
                                    <label for="inputAddress" class="form-label">Short Description</label>
                                    <textarea class="form-control" name="short_description" id="short_description" rows="3">{{ $info->short_description }}</textarea>
                                </div>
                                <div class="col-12">
                                    <label for="inputFirstName" class="form-label">Long Description</label>
                                    <textarea class="form-control" name="long_description" id="long_description" rows="3">{{ $info->long_description }}</textarea>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-5">Update Restaurant Info</button>
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
    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
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