@extends('partial.master')
@section('content')
    <div class="row">
        <!-- Page Header -->

        <div class="d-md-flex d-block  align-items-center justify-content-between mt-2 page-header-breadcrumb">



            {{-- <div class="col-10 ms-0"> --}}
            <div class="col-8 ms-0">
                @include('error_message')
            </div>

            <h1 class="page-title fw-semibold fs-18 mb-0"></h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Video Ads</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>



    <!-- Page Header Close -->

    <!-- Start::row-1 -->



    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="col-4 ms-0 ">
                        <div class="card-title">
                            Video Ads
                        </div>
                    </div>
                    <div class="ms-auto">
                        <button class="btn btn-primary btn-sm"
                            onclick="window.location.href='{{ route('video.ads.export') }}'">
                            <i class="fas fa-download"></i> Download Report
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="VideoAdsDatatable" class="table table-bordered text-nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Order Id</th>
                                <th>Username</th>
                                <th>Contact Number</th>
                                <th>Title</th>
                                <th>Video</th>
                                <th>Purchase Date</th>
                                <th>Amount</th>
                                <th>Download</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


    <!--  modal content -->

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Videos</h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" id="closeModalBtn" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                </div>
                <div class="modal-body model-video-approve">
                    {{-- <div class="row">
                        <div class="col-4">
                            <h7 class="">Username : </h7>
                        </div>
                        <div class="col-8">
                            <h7 class="video-user-name"> </h7>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <h7 class="">Category Name : </h7>
                        </div>
                        <div class="col-8">
                            <h7 class="video-category-name"> </h7>
                        </div>
                    </div> --}}
                    <div class="row mt-2">
                        <video width="100%" controls id="modalVideo">
                            <source id="modalVideoSource" src="" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('js')
    <script type="text/javascript">
        var generatePdfRoute = @json(route('invoice.generate_pdf', ':id'));
        (function(window, jQuery) {
            window.LaravelDataTables = window.LaravelDataTables || {};
            window.LaravelDataTables["VideoAdsDatatable"] = jQuery("#VideoAdsDatatable").DataTable({
                "serverSide": true,
                "processing": true,
                "pageLength": 10,
                "responsive": true,
                "columns": [{
                        "name": "row_number",
                        "data": null,
                        "searchable": false,
                        "orderable": false,
                        "render": function(data, type, full, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }

                    },
                    {
                        "name": "id",
                        "data": "id",
                        "searchable": true,
                        "orderable": true,
                        "defaultContent": "",
                    },
                    {
                        "name": "name",
                        "data": "name",
                        "searchable": true,
                        "orderable": true,
                        "defaultContent": "",
                    },
                    {
                        "name": "mobile_number",
                        "data": "mobile_number",
                        "searchable": true,
                        "orderable": true,
                        "defaultContent": "",

                    },
                    {
                        "name": "title",
                        "data": "title",
                        "searchable": true,
                        "orderable": true,
                        "defaultContent": "",

                    },
                    {
                        "name": "video",
                        "data": "video",
                        "searchable": true,
                        "orderable": true,
                        "defaultContent": "",

                    },
                    {
                        "name": "created_at",
                        "data": "created_at",
                        "searchable": true,
                        "orderable": true,
                        "defaultContent": "",
                        "render": function(data, type, row) {
                            // Assuming data is in the format YYYY-MM-DD HH:MM:SS
                            if (data) {
                                var date = new Date(data);
                                var day = ("0" + date.getDate()).slice(-2);
                                var month = ("0" + (date.getMonth() + 1)).slice(-2);
                                var year = date.getFullYear();
                                return day + "-" + month + "-" + year;
                            }
                            return "";
                        }
                    },
                    {
                        "name": "amount",
                        "data": "amount",
                        "searchable": true,
                        "orderable": true,
                        "defaultContent": "",

                    },
                    {
                        data: 'video_id',
                        name: 'video_id',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            // Replace ':id' with actual video ID
                            var url = generatePdfRoute.replace(':id', data);
                            return `
                            <a href="` + url + `" target="_blank">
                                <i class="fa-regular fa-file-lines" style="font-size: 30px; color: red;"></i>
                            </a>`;
                        }
                    },
                    {
                        "name": "detail",
                        "data": "detail",
                        "searchable": true,
                        "orderable": true,
                        "defaultContent": "",

                    },

                ],

                "searching": true,
                "buttons": [],
                "order": [
                    [6, 'desc']
                ],
            });
        })(window, jQuery);
    </script>






    {{-- <script>
        $(document).on("change", ".change-status", function() {
            var value = $(this).val();
            var row_id = $(this).data("id");
            var $dropdown = $(this);
            var confirm = window.confirm("Are you sure you want to proceed?");
            if (!confirm) {
                return false;
            }
            $('#value').val(value);
            $('#row_id').val(row_id);
            $('#FrmStatusUpdate').submit();
        });

        $(document).on("click", ".alert-confirm", function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    );
                    var id = $(this).data('id');
                    var formData = new FormData();
                    formData.append('id', id);
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('user.destroy', ':id') }}".replace(':id', id),
                        data: formData,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status == 200) {
                                window.LaravelDataTables["VideoAdsDatatable"].draw();
                            } else {
                                Swal.fire('Oops!', 'Something went wrong', 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            Swal.fire('Error!', 'Failed to make the request', 'error');
                        }
                    });
                }
            });
        });
    </script> --}}



    {{-- <script>
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $(document).ready(function() {
            $('#VideoAdsDatatable').on('click', '.alert-modal', function() {
                var namesString = $(this).data('names');
                var namesArray = namesString.split(',');
                var html = '';
                namesArray.forEach(function(name) {
                    var videoSrc = "{{ asset('uploads/profilemedia/') }}/" + name;

                    html += `<div class="carousel-item active" data-bs-interval="10000">
                            <video width="100%" height="100%" controls>
                                <source src="${videoSrc}" type="video/mp4">
                            </video>
                        </div>`;
                });

                $('.slider_video_image').html(html);
                $('#myModal').modal('show');
            });

            $('#closeModalBtn').on('click', function() {
                $('#myModal .modal-body').html('');
                $('#myModal').modal('hide');
                return true;
            });
        });
    </script> --}}


    <script>
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $(document).ready(function() {
            $('#VideoAdsDatatable').on('click', '.alert-modal', function() {

                var user_id = $(this).data('id');
                var formData = new FormData();
                formData.append('user_id', user_id);

                $.ajax({
                    method: 'POST',
                    url: "{{ route('user.profile.slider') }}",
                    data: formData,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    success: function(response) {

                        $('#myModal').modal('show');
                        $(".slider_video_image").html(response.data)

                    },
                    error: function(error) {
                        console.error('Error fetching video content:', error);
                    }
                });
            });

            $('#closeModalBtn').on('click', function() {
                $('#myModal .modal-body').html('');
                $('#myModal').modal('hide');
                return true;
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#VideoAdsDatatable').on('click', '.alert-modal', function() {
                var videoUrl = $(this).data('video-url');
                var videoTitle = $(this).data('video-title');

                $('#myModalLabel').text(videoTitle);
                $('#modalVideoSource').attr('src', videoUrl);
                $('#modalVideo')[0].load(); // Add this line to load the new video source
                $('#myModal').modal('show');
            });

            $('#closeModalBtn').on('click', function() {
                $('#modalVideoSource').attr('src', ''); // Clear the video source
                $('#myModal').modal('hide');
                return true;
            });
        });
    </script>
@endsection
