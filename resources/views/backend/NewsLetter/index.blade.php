@extends('partial.master')

<style>
    .btn_delete {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border: 1px solid #000;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        z-index: 1000;
    }
</style>


@section('content')
    <div class="row">

        <!-- Page Header -->

        <div class="d-md-flex d-block  align-items-center justify-content-between mt-2 page-header-breadcrumb">
            {{-- <div class="col-10 ms-0"> --}}
            <div class="col-6 ms-0">
                {{-- @include('error_message') --}}
            </div>
            <h1 class="page-title fw-semibold fs-18 mb-0"></h1>
            <div class="col-2 ms-md-1 ms-0 mb-2">
                <h5 class="btn_delete">Processing... </h5>
                <button type="button" class="btn btn-danger btn_delete_subscribe" data-type='1'>Delete</button>
                <button type="button" class="btn btn-danger btn_delete_subscribe" data-type='2'>Delete All</button>
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
                        "name": "select",
                        "data": "select",
                        "searchable": true,
                        "orderable": true,
                        // "defaultContent": "<input type='checkbox'>",

                    }, {
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






        $(document).on("click", ".btn_delete_subscribe", function() {

            let type = $(this).data('type');
            let ids = [];
            if (type == 1) {
                $('input:checkbox[class^="form-check-input"]:checked').each(function() {
                    ids.push($(this).val());
                });
            }

            if (type == 1 && ids.length == 0) {
                Swal.fire({
                    title: 'Warning',
                    text: 'Please select at least one record to delete',
                    icon: 'warning'
                });
                return false
            }



            Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })
                .then((result) => {

                    if (result.isConfirmed) {
                        $(".btn_delete").show();
                        $.ajax({
                            type: "POST",
                            url: "{{ route('delete.news-letters') }}", // Adjust route as per your setup
                            data: {
                                ids: ids,
                                type: type,
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType: "json",
                            success: function(response) {
                                $(".btn_delete").hide();
                                window.LaravelDataTables["NewsletterDatatable"].draw();
                                Swal.fire('Deleted!', 'Your data have been deleted.',
                                    'success');
                            },
                            error: function(xhr, status, error) {
                                $(".btn_delete").hide();
                                console.error(xhr.responseText);
                                Swal.fire('Error!', 'Failed to make the request', 'error');
                            }
                        });
                    } else {
                        // alert('error');
                    }
                });

        });
    </script>
@endsection
