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
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Subscription</a></li>
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
                    <div class="col-12 col-md-4 ms-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="card-title">
                                Subscriptions
                            </div>
                        </div>
                    </div>
                    <div class="ms-auto">
                        <button class="btn btn-primary btn-sm" onclick="window.location.href='{{ route('subscription.export') }}'">
                            <i class="fas fa-download"></i> Download Report
                        </button>                        
                    </div>
                </div>

                <div class="card-body">
                    <table id="SubscriptionHestoryDatatable" class="table table-bordered text-nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Contact Number</th>
                                <th>Purchase Date</th>
                                <th>Subscription Type</th>
                                <th>Amount</th>
                                {{-- <th>Action</th> --}}
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
        (function(window, jQuery) {

            
            window.LaravelDataTables = window.LaravelDataTables || {};
            window.LaravelDataTables["SubscriptionHestoryDatatable"] = jQuery("#SubscriptionHestoryDatatable")
                .DataTable({
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
                            "name": "name",
                            "data": "name",
                            "searchable": true,
                            "orderable": true,
                            "defaultContent": "",
                        },
                        {
                            "name": "email",
                            "data": "email",
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
                            "name": "subscription_type",
                            "data": "subscription_type",
                            "searchable": true,
                            "orderable": true,
                            "defaultContent": "",

                        },
                        {
                            "name": "amount",
                            "data": "amount",
                            "searchable": true,
                            "orderable": true,
                            "defaultContent": "",

                        },

                        // {
                        //     "name": "detail",
                        //     "data": "detail",
                        //     "searchable": true,
                        //     "orderable": true,
                        //     "defaultContent": "",

                        // },

                    ],

                    "searching": true,
                    "buttons": [],
                    "order": [
                        [4, 'desc']
                    ],
                });
        })(window, jQuery);
    </script>


@endsection
