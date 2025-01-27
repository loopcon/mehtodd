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
    <div class="row mt-4">
        <div class="col-11">
            <!-- Page Header -->
            @include('backend.GetCategoryDropDown.VideoCategoryFilter')
        </div>
        <div class="col-1 text-right">
            <h1 class="page-title fw-semibold fs-18 mb-0"></h1>
            <div class="ms-md-1 ms-0 mt-3">
                <nav>
                    <ol class="breadcrumb ">
                        {{-- <li class="breadcrumb-item"><a href="#">Tables</a></li> --}}
                        <a href="{{ route('video-category.create') }}"> <button type="button"
                                class="btn btn-outline-secondary btn-wave ">
                                {{-- <i class="ri-arrow-left-line "></i> --}}
                                Add 
                            </button></a>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="d-md-flex d-block  align-items-center justify-content-between mt-2 page-header-breadcrumb">
            <div class="col-10 ms-0">
                @include('error_message')
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Video Categories
                    </div>
                </div>

                <div class="card-body">
                    <table id="VideoCategoryDatatable" class="table table-bordered text-nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category</th>
                                <th>Sub Category 1</th>
                                <th>Sub Category 2</th>
                                <th>Sub Category 3</th>
                                {{-- <th>Sub Category 4</th> --}}
                                <th>Category Name</th>
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

    <form method="POST" id="FrmStatusUpdate" action="{{ route('change-status-video-category') }}">
        @csrf
        <input type="hidden" value="" name="value" id="value">
        <input type="hidden" value="" name="row_id" id="row_id">
    </form>
@endsection



@section('js')
    <script type="text/javascript">
        (function(window, jQuery) {
            window.LaravelDataTables = window.LaravelDataTables || {};
            window.LaravelDataTables["VideoCategoryDatatable"] = jQuery("#VideoCategoryDatatable").DataTable({
                "serverSide": true,
                "processing": true,
                "pageLength": 10,
                "responsive": true,

                "ajax": {
                    data: function(d) {
                        d.category = jQuery(".datatable-form-filter input[name='filter_category']")
                            .val();
                        d.sub_category_1 = jQuery(
                                ".datatable-form-filter input[name='filter_sub_category_1']")
                            .val();
                        d.sub_category_2 = jQuery(
                                ".datatable-form-filter input[name='filter_sub_category_2']")
                            .val();
                        d.sub_category_3 = jQuery(
                                ".datatable-form-filter input[name='filter_sub_category_3']")
                            .val();
                        d.sub_category_4 = jQuery(
                                ".datatable-form-filter input[name='filter_sub_category_4']")
                            .val();
                        d.category_name = jQuery(
                            ".datatable-form-filter input[name='filter_category_name']").val() || null;

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

                        "name": "category",
                        "data": "category",
                        "searchable": true,
                        "orderable": true,
                        "defaultContent": "",

                    },

                    {

                        "name": "sub_category",
                        "data": "sub_category",
                        "searchable": true,
                        "orderable": true,
                    },

                    {

                        "name": "sub_category2",
                        "data": "sub_category2",
                        "searchable": true,
                        "orderable": true,

                    },

                    {

                        "name": "sub_category3",
                        "data": "sub_category3",
                        "searchable": true,
                        "orderable": true,

                    },

                    // {

                    //     "name": "sub_category4",
                    //     "data": "sub_category4",
                    //     "searchable": true,
                    //     "orderable": true,

                    // },

                    {

                        "name": "category_name",
                        "data": "category_name",
                        "searchable": true,
                        "orderable": true,
                        "defaultContent": "",

                    },

                    {

                        "name": "status",
                        "data": "status",
                        "searchable": true,
                        "orderable": true,
                    },

                    {

                        "name": "action",
                        "data": "action",
                        "class": "text-center",
                        "render": null,
                        "searchable": false,
                        "orderable": false,

                        // "width": "80px"

                    },

                ],

                "searching": true,
                // dom: "<'row'l<'col-sm-12'tr>>" + "<'row'<'col-sm-6'i><'col-sm-6 dt-footer-right'p>>",
                "buttons": [],
                "order": [],
            });
        })(window, jQuery);


        jQuery('.datatable-form-filter input').on('keyup', function(e) {
            window.LaravelDataTables["VideoCategoryDatatable"].draw();
            e.preventDefault();
        });

        jQuery('.datatable-form-filter select').on('change', function(e) {
            window.LaravelDataTables["VideoCategoryDatatable"].draw();
            e.preventDefault();
        });



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
                        url: "{{ route('video-category.destroy', ':id') }}".replace(':id', id),
                        data: formData,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },
                        success: function(response) {
                            if (response.status == 200) {
                                window.LaravelDataTables["VideoCategoryDatatable"].draw();

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
@endsection
