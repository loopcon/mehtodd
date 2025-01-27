@extends('partial.master')
@section('css')
    <style>
        @media (max-width:575px){
            .manage-tbl-responsive span{
                white-space: break-spaces;
                word-break: break-all;
            }
            .manage-tbl-responsive ul{
                width:100%;
            }
        }
    </style>
@endsection
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
                        <li class="breadcrumb-item"><a href="#">Mange Badge</a></li>
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
                        Mange Badge
                    </div>
                </div>
                <div class="card-body">
                    <table id="MangeBadgeDatatable" class="table table-bordered text-nowrap manage-tbl-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>User Name</th>
                                <th>Category Name</th>
                                <th>Sub Category Name</th>
                                <th>Apply Date</th>
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
{{-- 
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
    </div> --}}
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
            window.LaravelDataTables["MangeBadgeDatatable"] = jQuery("#MangeBadgeDatatable").DataTable({
                "serverSide": true,
                "processing": true,
                "pageLength": 10,
                "responsive": true,
                "searching": true,
                "ajax": {
                    data: function(d) {
                        d.email = jQuery(
                                ".datatable-form-filter input[name='filter_email']")
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

                        "name": "username",
                        "data": "username",
                        "searchable": true,
                        "orderable": true,
                        "defaultContent": "",
                    },
                    {

                        "name": "category_name ",
                        "data": "category_name ",
                        "searchable": true,
                        "orderable": true,
                        "defaultContent": "",

                    },
                    {

                        "name": "description",
                        "data": "description",
                        "searchable": true,
                        "orderable": true,
                        "defaultContent": "",

                    },

                    {

                        "name": "photo",
                        "data": "photo",
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


                dom: "<'row'l<'col-sm-12'tr>>" + "<'row'<'col-sm-6'i><'col-sm-6 dt-footer-right'p>>",
                "buttons": [],
                "order": [],

            });
        })(window, jQuery);

        jQuery('.datatable-form-filter input').on('keyup', function(e) {
            window.LaravelDataTables["MangeBadgeDatatable"].draw();
            e.preventDefault();

        });

        jQuery('.datatable-form-filter select').on('change', function(e) {

            window.LaravelDataTables["MangeBadgeDatatable"].draw();

            e.preventDefault();

        });



        $(document).on("change", "#archive", function(e) {

            var archiveChecked = this.checked ? 1 : 0;

            $('#archive_status').val(archiveChecked);

            window.LaravelDataTables["MangeBadgeDatatable"].draw();

            e.preventDefault();

        });
    </script>
  
    
@endsection
