@extends('partial.master')



@section('content')
    <div class="row">

        <!-- Page Header -->

        <div class="d-md-flex d-block  align-items-center justify-content-between mt-2 page-header-breadcrumb">
            <div class="col-10 ms-0">
                {{-- @include('error_message') --}}
            </div>
            <h1 class="page-title fw-semibold fs-18 mb-0"></h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    &nbsp;
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Newsletter</a></li>
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
                        Newsletter
                    </div>
                </div>

                <div class="card-body">
                    <table id="NewsletterDatatable" class="table table-bordered text-nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Email</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('js')
    <script type="text/javascript">
        (function(window, jQuery) {
            window.LaravelDataTables = window.LaravelDataTables || {};
            window.LaravelDataTables["NewsletterDatatable"] = jQuery("#NewsletterDatatable").DataTable({
                "serverSide": true,
                "processing": true,
                "pageLength": 10,
                "searching": true,
                "responsive": true,

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
                        "name": "email",
                        "data": "email",
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
            window.LaravelDataTables["NewsletterDatatable"].draw();
            e.preventDefault();

        });

        jQuery('.datatable-form-filter select').on('change', function(e) {
            window.LaravelDataTables["NewsletterDatatable"].draw();
            e.preventDefault();

        });



        $(document).on("change", "#archive", function(e) {
            var archiveChecked = this.checked ? 1 : 0;
            $('#archive_status').val(archiveChecked);
            window.LaravelDataTables["NewsletterDatatable"].draw();
            e.preventDefault();
        });
    </script>
@endsection
