@extends('admin.admin_dashboard')
@section('admin')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<style>
    .large-checkbox {
        transform: scale(1.5);
    }
</style>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Blog Comments</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Blog Comments</li>
                </ol>
            </nav>
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
                            <th>User Name</th>
                            <th>Post Name</th>
                            <th>Message</th>
                            <th>Approve Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $key => $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ Str::limit($item->post->post_title, 40) }}</td>
                            <td>{{ Str::limit($item->message, 50) }}</td>
                            <td>
                                <div class="form-check-danger form-check form-switch">
									<input class="form-check-input large-checkbox status-toggle" type="checkbox" id="flexSwitchCheckCheckedDanger" data-comment-id="{{ $item->id }}" {{ $item->status ? 'checked' : '' }}>
									<label class="form-check-label" for="flexSwitchCheckCheckedDanger"></label>
								</div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>User Name</th>
                            <th>Post Name</th>
                            <th>Message</th>
                            <th>Approve Comment</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.status-toggle').on('change', function(){
            var comment_id = $(this).data('comment-id');
            var is_checked = $(this).is(':checked');
            
            $.ajax({
               url: "{{ route('update.comment.status') }}",
               method: "post",
               data: {
                 comment_id: comment_id,
                 is_checked: is_checked ? 1 : 0,
                 _token: "{{ csrf_token() }}",
               },
               success: function(response) {
                 toastr.success(response.message);
               },
               error: function() {

               }
            });
        });
    });
</script>
@endsection