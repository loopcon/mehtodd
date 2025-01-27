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
            <div class="col-9 ms-0">
                @include('error_message')
            </div>
            <h1 class="page-title fw-semibold fs-18 mb-0"></h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Malicious</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Professionals</li>
                    </ol>
                </nav>
            </div>
        </div>
        {{-- @include('backend.GetCategoryDropDown.VideoCategoryFilter') --}}

    </div>
    <!-- Page Header Close -->

    <!-- Start::row-1 -->



    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Malicious Professionals
                    </div>
                </div>
                <div class="card-body">
                    <table id="MaliciousProfessionalDatatable" class="table table-bordered text-nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Professional Name</th>
                                <th>Reported By</th>
                                <th>Description</th>
                                <th>Reported Date</th>
                                <th>Note</th>
                                <th>status</th>
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
                    <h5 class="modal-title" id="myModalLabel">Details</h5>
                    <button type="button" class="close" data-dismiss="modal" id="closeModalBtn" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add your modal content here -->

                    <p>Modal Content</p>
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
        (function(window, jQuery) {
            window.LaravelDataTables = window.LaravelDataTables || {};
            window.LaravelDataTables["MaliciousProfessionalDatatable"] = jQuery("#MaliciousProfessionalDatatable")
                .DataTable({
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
                            "name": "fullname",
                            "data": "fullname",
                            "searchable": true,
                            "orderable": true,
                            "defaultContent": "",
                        },
                        {
                            "name": "report_by",
                            "data": "report_by",
                            "searchable": true,
                            "orderable": true,
                            "defaultContent": "",
                        },
                        {
                            "name": "descriptions",
                            "data": "descriptions",
                            "searchable": true,
                            "orderable": true,
                            "defaultContent": "",

                        },
                        {
                            "name": "reported_date",
                            "data": "reported_date",
                            "searchable": true,
                            "orderable": true,
                            "defaultContent": "",
                            "render": function(data, type, row) {
                                // Assuming the data is in a format that JavaScript Date can parse
                                var date = new Date(data);
                                var options = {
                                    day: 'numeric',
                                    month: 'long',
                                    year: 'numeric'
                                };
                                return date.toLocaleDateString('en-GB', options);
                            }
                        },
                        {
                            "name": "note",
                            "data": "note",
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


                });

        })(window, jQuery);

        jQuery('.datatable-form-filter input').on('keyup', function(e) {
            window.LaravelDataTables["MaliciousProfessionalDatatable"].draw();
            e.preventDefault();

        });

        jQuery('.datatable-form-filter select').on('change', function(e) {
            window.LaravelDataTables["MaliciousProfessionalDatatable"].draw();
            e.preventDefault();

        });



        $(document).on("change", "#archive", function(e) {
            var archiveChecked = this.checked ? 1 : 0;
            $('#archive_status').val(archiveChecked);
            window.LaravelDataTables["MaliciousProfessionalDatatable"].draw();
            e.preventDefault();

        });
    </script>

    <script>
        $(document).on("change", ".change-status", function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                input: 'textarea',
                inputPlaceholder: 'Add a note here...',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, sure!',
                // preConfirm: (note) => {
                //     if (!note) {
                //         Swal.showValidationMessage('Please add a note before proceeding');
                //     }
                //     return note;
                // }
            }).then((result) => {
                if (result.isConfirmed) {
                    var id = $(this).data('id');
                    var status = $(this).val();
                    var note = result.value; // Yeh value se note le raha hai

                    var formData = new FormData();
                    formData.append('user_id', id);
                    formData.append('status', status);
                    formData.append('note', note); // Note ko bhi AJAX mein send karenge

                    $.ajax({
                        type: "POST",
                        url: "{{ route('update.status.malicious.professional') }}",
                        data: formData,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status == 200) {
                                window.LaravelDataTables["MaliciousProfessionalDatatable"]
                                    .draw();
                            }

                            var message, text;
                            if (status == 0) {
                                message = "Professional has been Active.";
                                text = "Active";
                            } else if (status == 1) {
                                text = "Inactive";
                                message = "Professional has been Inactive.";
                            } else {
                                text = "Block";
                                message = "Professional has been Blocked.";
                            }
                            Swal.fire(
                                text,
                                message,
                                'success'
                            );
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                text,
                                xhr.responseText,
                                'error'
                            );
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>


<script>
    // Retrieve CSRF token from the meta tag

    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function() {
        $('#MaliciousProfessionalDatatable').on('click', '.alert-confirm', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }

            });

            var dataId = $(this).data('id');
            var formData = new FormData();
            formData.append('id', dataId);
            $.ajax({
                type: "POST",
                url: "{{ route('get.descriptions') }}",
                dataType: "json",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#myModal .modal-body').html('');
                    $('#myModal').modal('show');
                    $('#myModal .modal-body').html(response.data);

                },

                error: function(xhr, status, error) {
                    console.error(xhr.responseText);

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
    // Retrieve CSRF token from the meta tag

    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function() {
        $('#MaliciousProfessionalDatatable').on('click', '.alert-confirm-two', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }

            });

            var dataId = $(this).data('id');
            var formData = new FormData();
            formData.append('id', dataId);
            $.ajax({
                type: "POST",
                url: "{{ route('get.notes') }}",
                dataType: "json",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#myModal .modal-body').html('');
                    $('#myModal').modal('show');
                    $('#myModal .modal-body').html(response.data);

                },

                error: function(xhr, status, error) {
                    console.error(xhr.responseText);

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
