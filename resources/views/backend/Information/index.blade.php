@extends('partial.master')
@section('content')
    <!-- Page Header -->

    <div class="row">
        <div class="d-md-flex d-block  align-items-center justify-content-between mt-2 page-header-breadcrumb">
            <div class="col-10 ms-0">
                @include('error_message')
            </div>
            <h1 class="page-title fw-semibold fs-18 mb-0"></h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    &nbsp;
                    {{-- <ol class="breadcrumb">
                        <a href="#"> <button type="button" class="btn btn-outline-secondary btn-wave">
                        </a>
                    </ol> --}}
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Getin Touch</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detalis</li>
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
                        Informations
                    </div>
                </div>
                <div class="card-body">
                    <table id="InformationDatatable" class="table table-bordered text-nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Message</th>
                                <th>Received Date</th>
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
                    <h5 class="modal-title" id="myModalLabel">Description</h5>
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
            window.LaravelDataTables["InformationDatatable"] = jQuery("#InformationDatatable").DataTable({
                "serverSide": true,
                "processing": true,
                "pageLength": 10,
                "responsive": true,

                "ajax": {

                    data: function(d) {
                        d.email = jQuery(
                                ".datatable-form-filter input[name='filter_email']")
                            .val();

                            d.email = jQuery(
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

                        "name": "email",
                        "data": "email",
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

                        "name": "message",
                        "data": "message",
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
                ],

                "searching": true,
                // dom: "<'row'l<'col-sm-12'tr>>" + "<'row'<'col-sm-6'i><'col-sm-6 dt-footer-right'p>>",
                "buttons": [],
                "order": [],

            });

        })(window, jQuery);





        jQuery('.datatable-form-filter input').on('keyup', function(e) {
            window.LaravelDataTables["InformationDatatable"].draw();
            e.preventDefault();

        });

        jQuery('.datatable-form-filter select').on('change', function(e) {
            window.LaravelDataTables["InformationDatatable"].draw();
            e.preventDefault();

        });



        $(document).on("change", "#archive", function(e) {
            var archiveChecked = this.checked ? 1 : 0;
            $('#archive_status').val(archiveChecked);
            window.LaravelDataTables["InformationDatatable"].draw();
            e.preventDefault();

        });
    </script>
    <script>
        // Retrieve CSRF token from the meta tag

        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            $('#InformationDatatable').on('click', '.alert-confirm', function() {
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
                    url: "{{ route('get.information') }}",
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
