@extends('admin.admin_dashboard')
@section('admin')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Manage Rooms</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Room</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-primary" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="true">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><i class="bx bxs-home font-18 me-1"></i>
                                            </div>
                                            <div class="tab-title">Manage Room</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="false">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><i class="bx bxs-user-pin font-18 me-1"></i>
                                            </div>
                                            <div class="tab-title">Room Number</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content py-3">
                                <div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
                                    <div class="col">
                                        <div class="card border border-0 border-4 border-primary">
                                            <div class="card-body p-5">
                                                <form class="row g-3">
                                                    <div class="col-md-4">
                                                        <label for="inputFirstName" class="form-label">Room Type</label>
                                                        <input type="text" class="form-control" id="inputFirstName" value="{{ $room->roomtype->name }}">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="inputLastName" class="form-label">Total Adult</label>
                                                        <input type="text" name="total_adult" class="form-control" id="inputLastName" value="{{ $room->total_adult }}">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="inputEmail" class="form-label">Total Child</label>
                                                        <input type="text" name="total_child" class="form-control" id="inputEmail" value="{{ $room->total_child }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputPassword" class="form-label">Main Image</label>
                                                        <input type="file" name="image" class="form-control mb-2" id="image">
                                                        <img id="showImage" src="{{ (!empty($room->image)) ? url('upload/rooms/'.$room->image) : url('upload/no_image.jpg') }}" alt="" style="width: 100px; height: 80px">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="multiImg" class="form-label">Gallery Images</label>
                                                        <input type="file" name="multi_image[]" class="form-control" id="multiImg" accept="image/jpeg, image/jpg, image/gif, image/png" multiple>
                                                        <div class="row mt-2" id="previewImg">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="inputFirstName" class="form-label">Room Price</label>
                                                        <input type="text" name="price" class="form-control" id="inputFirstName" value="{{ $room->price }}">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="inputLastName" class="form-label">Discount (%)</label>
                                                        <input type="text" name="discount" class="form-control" id="inputLastName" value="{{ $room->discount }}">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="inputEmail" class="form-label">Room Capacity</label>
                                                        <input type="text" name="room_capacity" class="form-control" id="inputEmail" value="{{ $room->room_capacity }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputState" class="form-label">Room View</label>
                                                        <select name="view" id="inputState" class="form-select">
                                                            <option selected="">Choose...</option>
                                                            <option value="Sea View">Sea View</option>
                                                            <option value="Hill View">Hill View</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputState" class="form-label">Bed Style</label>
                                                        <select name="bed_style" id="inputState" class="form-select">
                                                            <option selected="">Choose...</option>
                                                            <option value="Queen Bed">Queen Bed</option>
                                                            <option value="Twin Bed">Twin Bed</option>
                                                            <option value="King Bed">King Bed</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="inputAddress2" class="form-label">Short Description</label>
                                                        <textarea name="short_description" class="form-control" id="inputAddress2" rows="3">{{ $room->short_description }}</textarea>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="inputAddress2" class="form-label">Description</label>
                                                        <textarea name="description" class="form-control" id="tinymce" rows="3">{!! $room->short_description !!}</textarea>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary px-5">Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
                                    <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
                                </div>
                            </div>
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

<script>
    $(document).ready(function() {
        $('#multiImg').on('change', function() { //on file input change
            $('#previewImg').empty();
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data

                $.each(data, function(index, file) { //loop though each file
                    if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) { //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file) { //trigger function on successful read
                            return function(e) {
                                var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(100)
                                    .height(80); //create image element 
                                $('#previewImg').append(img); //append image to output element
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });

            } else {
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
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