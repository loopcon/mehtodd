@extends('partial.master')
@section('page-css')
    <style>
        .clear-link {
            text-decoration: none;
            padding: 10px 12px;
            /* border: 1px solid #007bff; */
            border-radius: 5px;
            color: #23B7E5;
            transition: background-color 0.3s, color 0.3s;
            font-size: 14px;

        }

        .model-video-approve .main-label {
            float: left;
            margin-right: 5px;
        }


        .clear-link:hover {
            background-color: #23B7E5;
            font-size: .85rem;
            border-radius: 0.35rem;
            padding: 0.7rem 0.85rem;
            color: #FFF;
            box-shadow: none;
            font-weight: 500;
        }

        .ml {
            margin-left: 10px;
            /* Adjust the value as needed */
        }
    </style>
@section('content')
    <div class="row mt-2">
        <!-- Page Header -->
        <div class="d-md-flex d-block  align-items-center justify-content-between mt-2 page-header-breadcrumb">
            <div class="col-10 ms-0">
                @include('error_message')
            </div>
            <h1 class="page-title fw-semibold fs-18 mb-0"></h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    {{-- <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Videos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detalis</li>
                    </ol> --}}
                </nav>
            </div>
        </div>
        @include('backend.GetCategoryDropDown.VideoCategoryFilter')

    </div>
    <!-- Page Header Close -->

    <!-- Start::row-1 -->



    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Videos
                    </div>
                </div>
                <div class="card-body">
                    <table id="VideoDatatable" class="table table-bordered text-nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>User Name</th>
                                <th>Category Name</th>
                                <th>Video Title</th>
                                <th>Video</th>
                                <th>Share home</th>
                                <th>Status</th>
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
                    <div class="row">
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
                    </div>
                    <div class="row mt-2">
                        <video width="100%" height="100%" controls id="myVideo">
                        </video>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" id="FrmStatusUpdate" action="{{ route('change-status-video') }}">
        @csrf
        <input type="hidden" value="" name="value" id="value">
        <input type="hidden" value="" name="row_id" id="row_id">
    </form>
@endsection



@section('js')
    <script type="text/javascript">
        (function(window, jQuery) {
            window.LaravelDataTables = window.LaravelDataTables || {};
            window.LaravelDataTables["VideoDatatable"] = jQuery("#VideoDatatable").DataTable({
                "serverSide": true,
                "processing": true,
                "pageLength": 10,
                "responsive": true,
                "order": [
                    [0, "desc"]
                ],
                "ajax": {
                    data: function(d) {
                        d.name = jQuery(
                                ".datatable-form-filter input[name='filter_name']")
                            .val();

                    }

                },

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

                        "name": "fullname ",
                        "data": "fullname",
                        "searchable": true,
                        "orderable": true,
                        "defaultContent": "",

                    },
                    {

                        "name": "category_name",
                        "data": "category_name",
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

                        "name": "profile_video ",
                        "data": "profile_video",
                        "searchable": true,
                        "orderable": true,
                        "defaultContent": "",

                    },
                    {
                        "name": "share_home_page ",
                        "data": "share_home_page",
                        "searchable": true,
                        "orderable": true,
                        "defaultContent": "",
                    },
                    {

                        "name": "status",
                        "data": "status",
                        "searchable": true,
                        "orderable": true,
                        "defaultContent": "",
                    },

                ],

                "searching": true,
                "buttons": [],
                "order": [],

            });

        })(window, jQuery);

        jQuery('.datatable-form-filter input').on('keyup', function(e) {
            window.LaravelDataTables["VideoDatatable"].draw();
            e.preventDefault();

        });

        jQuery('.datatable-form-filter select').on('change', function(e) {
            window.LaravelDataTables["VideoDatatable"].draw();
            e.preventDefault();

        });



        $(document).on("change", "#archive", function(e) {
            var archiveChecked = this.checked ? 1 : 0;
            $('#archive_status').val(archiveChecked);
            window.LaravelDataTables["VideoDatatable"].draw();
            e.preventDefault();

        });
    </script>
    <script>
        $(document).on("change", ".change-status", function() {
            var value = $(this).val();
            var row_id = $(this).data("id");

            var formData = new FormData();
            formData.append('value', value);
            formData.append('row_id', row_id);

            $.ajax({
                type: "POST",
                url: "{{ route('change-status-video') }}",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status == 200) {
                        window.LaravelDataTables["VideoDatatable"].draw();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });


        });
        $(document).on("change", ".is-home-switch", function() {
            var id = $(this).data('id')


            var id = $(this).data('id');
            var formData = new FormData();
            formData.append('id', id);

            $.ajax({
                type: "POST",
                url: "{{ route('change.home.share.status') }}",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status == 200) {
                        window.LaravelDataTables["VideoDatatable"].draw();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);


                }

            });

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
                        url: "{{ route('videos.destroy', ':id') }}".replace(':id', id),
                        data: formData,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        headers: {

                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },

                        success: function(response) {
                            if (response.status == 200) {
                                window.LaravelDataTables["VideoDatatable"].draw();
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
    </script>
    <script>
        $(document).ready(function() {
            $('#VideoDatatable').on('click', '.alert-modal', function() {
                var videoSrc = $(this).data('src');
                $('#myVideo').attr('src', videoSrc);
                var category = $(this).data('category');
                var username = $(this).data('username');
                $(".video-user-name").text(username);
                // var str = "Category Name : " + category;
                $(".video-category-name").text(category);
                $('#myModal').modal('show');
                // $('#myVideo')[0].play();
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
            $('.get_category_data').change(function() {
                var data_level = $(this).data('level');
                var id = $(this).find('select').val();
                var option_html = '<option value="">--Select--</option>';

                if (data_level == 0) {
                    $('#select_sub_category_1').html(option_html);
                    $('#select_sub_category_2').html(option_html);
                    $('#select_sub_category_3').html(option_html);
                    $('#select_sub_category_4').html(option_html);
                } else if (data_level == 1) {
                    $('#select_sub_category_2').html(option_html);
                    $('#select_sub_category_3').html(option_html);
                    $('#select_sub_category_4').html(option_html);
                } else if (data_level == 2) {
                    $('#select_sub_category_3').html(option_html);
                    $('#select_sub_category_4').html(option_html);
                } else if (data_level == 3) {
                    $('#select_sub_category_4').html(option_html);
                }


                var formData = new FormData();
                formData.append('data_level', data_level);
                formData.append('category_id', id);

                var next_level = data_level + 1;

                $.ajax({
                    type: "POST",
                    url: "{{ route('get.category.data') }}",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    success: function(response) {
                        $('#sub_category_' + next_level).html(response.html_data);

                    },
                    error: function(response, status, error) {}
                });

            });
        });
    </script>


@endsection
