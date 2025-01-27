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
                        <li class="breadcrumb-item"><a href="#">Badge</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update</li>
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
                        Badge
                    </div>
                </div>
                <div class="card-body">
                    <table id="BadgeDatatable" class="table table-bordered text-nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>User Name</th>
                                <th>Category Name</th>
                                <th>Documents</th>
                                <th>Applied Date</th>
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

    <form method="POST" id="FrmStatusUpdate" action="{{ route('change-status-badge') }}">
        @csrf
        <input type="hidden" value="" name="value" id="value">
        <input type="hidden" value="" name="row_id" id="row_id">
    </form>
@endsection

@section('js')
    <script type="text/javascript">
        (function(window, jQuery) {
            window.LaravelDataTables = window.LaravelDataTables || {};
            window.LaravelDataTables["BadgeDatatable"] = jQuery("#BadgeDatatable").DataTable({
                "serverSide": true,
                "processing": true,
                "pageLength": 10,
                "responsive": true,
                "searching": true,
                "ajax": {
                    data: function(d) {
                        d.username = jQuery(
                                ".datatable-form-filter input[name='filter_username']")
                            .val();
                        d.username = jQuery(
                                ".datatable-form-filter input[name='filter_user_category_id']")
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

                        "name": "displayname",
                        "data": "displayname",
                        "searchable": true,
                        "orderable": true,
                        "defaultContent": "",
                    },
                    {

                        "name": "user_category_id ",
                        "data": "user_category_id ",
                        "searchable": true,
                        "orderable": true,
                        "defaultContent": "",

                    },
                    {

                        "name": "document_name",
                        "data": "document_name",
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
                // dom: "<'row'l<'col-sm-12'tr>>" + "<'row'<'col-sm-6'i><'col-sm-6 dt-footer-right'p>>",
                "buttons": [],
                "order": [],

            });
        })(window, jQuery);

        jQuery('.datatable-form-filter input').on('keyup', function(e) {
            window.LaravelDataTables["BadgeDatatable"].draw();
            e.preventDefault();

        });

        jQuery('.datatable-form-filter select').on('change', function(e) {

            window.LaravelDataTables["BadgeDatatable"].draw();

            e.preventDefault();

        });



        $(document).on("change", "#archive", function(e) {

            var archiveChecked = this.checked ? 1 : 0;

            $('#archive_status').val(archiveChecked);

            window.LaravelDataTables["BadgeDatatable"].draw();

            e.preventDefault();

        });
    </script>
    <script>
        // $(document).on("change", ".change-status", function() {
        //     var value = $(this).val();
        //     var row_id = $(this).data("id");
        //     var $dropdown = $(this);
        //     var confirm = window.confirm("Are you sure you want to proceed?");
        //     if (!confirm) {
        //         return false;
        //     }
        //     $('#value').val(value);
        //     $('#row_id').val(row_id);
        //     $('#FrmStatusUpdate').submit();
        // });


         $(document).on("change", ".change-status", function() {

            var value = $(this).val();
            var row_id = $(this).data("id");
            var $dropdown = $(this);

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, proceed!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user confirms
                    $('#value').val(value);
                    console.log(value);
                    $('#row_id').val(row_id);
                    $('#FrmStatusUpdate').submit();
                } else {
                    // If user cancels
                    location.reload();
                }
            });
        });
    </script>


    <script>
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        // $(document).on('click', '.download-document', function(e) {
        //     // alert('10');
        //     e.preventDefault();


        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': csrfToken
        //         }
        //     });

        //     var userId = $(this).data('document-id');

        //     var formData = new FormData();
        //     formData.append('userId', userId);
        //     // alert('10');
        //     $.ajax({
        //         type: "POST",
        //         url: "{{ route('bagde.download.document') }}",
        //         dataType: "json",
        //         data: formData,
        //         contentType: false,
        //         processData: false,
        //         success: function(response) {
        //             // $('#myModal .modal-body').html('');
        //             $('#myModal').modal('show');
        //             // $('#myModal .modal-body').html(response.data);
        //         },
        //         error: function(xhr, status, error) {
        //             console.error(xhr.responseText);
        //         }
        //     });



        // });
    </script>
@endsection
