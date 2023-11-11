@extends('admin.admin_dashboard')
@section('admin')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Restaurant Menu</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Menu Item</li>
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
                                <h5 class="mb-0 text-primary">Add Menu Item</h5>
                            </div>
                            <hr>
                            <form class="row g-3" method="post" action="{{ route('store.menu.item') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <label for="inputState" class="form-label">Menu Category</label>
                                    <select name="category_id" id="inputState" class="form-select">
                                        <option selected="">Choose Category...</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputFirstName" class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" id="inputFirstName">
                                </div>
                                <div class="col-6">
                                    <label for="inputAddress" class="form-label">Ingredients</label>
                                    <input type="text" name="ingredients" class="form-control" id="inputFirstName">
                                </div>
                                <div class="col-6">
                                    <label for="inputAddress" class="form-label">Price ($)</label>
                                    <input type="text" name="price" class="form-control" id="inputFirstName">
                                </div>
                                <div class="col-12">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control" id="image" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label"></label>
                                    <img id="showImage" src="{{ url('upload/no_image.jpg') }}" alt="" style="width: 140px; height: 140px;" class="p-1 bg-primary">
                                </div>
                                
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-5">Store Menu Item</button>
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