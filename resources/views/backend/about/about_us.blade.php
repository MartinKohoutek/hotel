@extends('admin.admin_dashboard')
@section('admin')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Section About Us</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Update About Us</li>
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
                            <form action="{{ route('about.us.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Short Title</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="short_title" class="form-control" value="{{ $data->short_title }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Main Title</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="main_title" class="form-control" value="{{ $data->main_title }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Short Description</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="short_description" class="form-control" value="{{ $data->short_description }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Long Description</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <textarea class="form-control" name="long_description" rows="3">{{ $data->long_description }}</textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Author</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="author" class="form-control" value="{{ $data->author }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Link URL</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="link_url" class="form-control" value="{{ $data->link_url }}"  />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="form-group col-sm-3">
                                        <h6 class="mb-0">Small Photo (600 x 830)</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="file" name="small_image" class="form-control" id="image1" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="form-group col-sm-3">
                                        <h6 class="mb-0"></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <img id="showImage1" src="{{ (!empty($data->small_image)) ? url($data->small_image) : url('upload/no_image.jpg') }}" alt="" style="width: 80px; height: 80px;" class="p-1 bg-primary">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="form-group col-sm-3">
                                        <h6 class="mb-0">Big Photo (600 x 750)</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="file" name="big_image" class="form-control" id="image2" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="form-group col-sm-3">
                                        <h6 class="mb-0"></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <img id="showImage2" src="{{ (!empty($data->big_image)) ? url($data->big_image) : url('upload/no_image.jpg') }}" alt="" style="width: 80px; height: 80px;" class="p-1 bg-primary">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Update About Us Section" />
                                    </div>
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
        $('#image1').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage1').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
        $('#image2').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage2').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection