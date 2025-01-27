@extends('partial.master')
@section('content')
    <div class="row">
        <!-- Page Header -->

        <div class="d-md-flex d-block  align-items-center justify-content-between mt-2 page-header-breadcrumb">
            <div class="col-10 ms-0">
                @include('error_message')
            </div>
            <h1 class="page-title fw-semibold fs-18 mb-0"></h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb">
                        <a href="{{ route('user.create') }}"> <button type="button"
                                class="btn btn-outline-secondary btn-wave">
                                Add User
                            </button></a>
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
                    <div class="card-title">
                        Users
                    </div>
                </div>
                <div class="card-body">
                    <table id="UserDatatable" class="table table-bordered text-nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Email</th>
                                <th>Category</th>
                                <th>Full Name</th>
                                <th>Display Name</th>
                                <th>Mobile Number</th>
                                <th>Profile Video/Slider</th>
                                <th>Is Top</th>
                                <th>Status</th>
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
                    <button type="button" class="close" data-dismiss="modal" id="closeModalBtn" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="card-body">
                    <div id="carouselExampleDark" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                                aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                        </div>

                        <div class="carousel-inner slider_video_image">

                        </div>


                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <form method="POST" id="FrmStatusUpdate" action="{{ route('change-status-user') }}">
        @csrf
        <input type="hidden" value="" name="value" id="value">
        <input type="hidden" value="" name="row_id" id="row_id">
    </form>
@endsection



@section('js')
    <script type="text/javascript">
        (function(window, jQuery) {
            window.LaravelDataTables = window.LaravelDataTables || {};
            window.LaravelDataTables["UserDatatable"] = jQuery("#UserDatatable").DataTable({
                "serverSide": true,
                "processing": true,
                "pageLength": 10,
                "responsive": true,

                "ajax": {
                    data: function(d) {
                        d.email = jQuery(
                                ".datatable-form-filter input[name='filter_email']")
                            .val();
                        d.fullname = jQuery(
                                ".datatable-form-filter input[name='filter_fullname']")
                            .val();
                        d.displayname = jQuery(
                                ".datatable-form-filter input[name='filter_displayname']")
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
                        "name": "email",
                        "data": "email",
                        "searchable": true,
                        "orderable": true,
                        "defaultContent": "",
                    },

                    {
                        "name": "categoryid",
                        "data": "categoryid",
                        "searchable": true,
                        "orderable": true,
                        "defaultContent": "",
                    },
                    {
                        "name": "fullname",
                        "data": "fullname",
                        "searchable": true,
                        "orderable": true,
                        "defaultContent": "",

                    },
                    {
                        "name": "displayname",
                        "data": "displayname",
                        "searchable": true,
                        "orderable": true,
                        "defaultContent": "",

                    },
                    {
                        "name": "mobile_number ",
                        "data": "mobile_number ",
                        "searchable": true,
                        "orderable": true,
                        "defaultContent": "",

                    },


                    {
                        "name": "profile_video",
                        "data": "profile_video",
                        "searchable": true,
                        "orderable": true,
                        "defaultContent": "",
                    },
                    {
                        "name": "is_top",
                        "data": "is_top",
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

                    {
                        "name": "action",
                        "data": "action",
                        "searchable": true,
                        "orderable": true,
                        "defaultContent": "",
                    },
                ],

                "searching": true,
                // dom: "<'row'l<'col-sm-12'tr>>" + "<'row'<'col-sm-6'i><'col-sm-6 dt-footer-right'p>>",
                "buttons": [],
                "order": [],
            });
        })(window, jQuery);

        jQuery('.datatable-form-filter input').on('keyup', function(e) {
            window.LaravelDataTables["UserDatatable"].draw();
            e.preventDefault();
        });
        jQuery('.datatable-form-filter select').on('change', function(e) {
            window.LaravelDataTables["UserDatatable"].draw();
            e.preventDefault();
        });

        $(document).on("change", "#archive", function(e) {
            var archiveChecked = this.checked ? 1 : 0;
            $('#archive_status').val(archiveChecked);
            window.LaravelDataTables["UserDatatable"].draw();
            e.preventDefault();
        });
    </script>





    <script>
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
                                window.LaravelDataTables["UserDatatable"].draw();
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
    {{-- <script>
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $(document).ready(function() {
            $('#UserDatatable').on('click', '.alert-modal', function() {
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
            $('#UserDatatable').on('click', '.alert-modal', function() {

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
@endsection
