@extends('partial.master')

@section('page-css')
    <style>
        .required {

            color: red;

        }
    </style>
@endsection
@section('content')
    <div class="row">

        <div class="d-md-flex d-block align-items-center justify-content-between mt-2 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0"></h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb">
                        <a href="{{ route('video.ads') }}">
                            <button type="button" class="btn btn-outline-secondary btn-wave">
                                <i class="fa-solid fa-arrow-left"></i>
                                Back
                            </button>
                        </a>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
    <!-- Page Header Close -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header d-md-flex d-block">
                    <div class="h5 mb-0 d-sm-flex d-bllock align-items-center">
                        <div class="ms-sm-2 ms-0 mt-sm-0 mt-2">
                            <div class="h5 fw-semibold mb-0 card-title">ORDER ID : <span
                                    class="text-primary">#{{ $getData->id }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-xl-12">
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                    <p class="text-muted mb-2">
                                        Billing From :
                                    </p>
                                    <p class="fw-bold mb-1">
                                        Herodicus
                                    </p>
                                    {{-- <p class="mb-1 text-muted">
                                        Mig-1-11,Manroe street
                                    </p> --}}
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 ms-auto mt-sm-0 mt-3">
                                    <p class="text-muted mb-2">
                                        Billing To :
                                    </p>
                                    <p class="fw-bold mb-1">
                                        {{ $userData->fullname }}
                                    </p>
                                    <p class="text-muted mb-1">
                                        {{ $userData->email }}
                                    </p>
                                    <p class="text-muted">
                                        <span>+91 {{ $userData->mobile_number }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <p class="fw-semibold text-muted mb-1">Order ID :</p>
                            <p class="fs-15 mb-1">#{{ $getData->id }}</p>
                        </div>
                        <div class="col-xl-3">
                            <p class="fw-semibold text-muted mb-1">Date :</p>
                            <p class="fs-15 mb-1">{{ $getData->created_at->format('d-m-Y') }}</p>
                        </div>
                        <div class="col-xl-3">
                            <p class="fw-semibold text-muted mb-1">Amount :</p>
                            <p class="fs-16 mb-1 fw-semibold">Rs.{{ $getData->amount }}</p>
                        </div>
                        <div class="col-xl-12">
                            <div class="table-responsive">
                                <table class="table nowrap text-nowrap border mt-4">
                                    <thead>
                                        <tr>
                                            <th>VIDEO TITLE</th>
                                            <th>DESCRIPTION</th>
                                            <th>QUANTITY</th>
                                            <th>PRICE</th>
                                            <th>TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="fw-semibold">
                                                    {{ $videoData->title }}
                                                </div>
                                            </td>
                                            <td style="white-space: normal;">
                                                <div class="text-muted" style="word-wrap: break-word;">
                                                    {{ $videoData->description }}
                                                </div>
                                            </td>
                                            <td class="product-quantity-container">
                                                1
                                            </td>
                                            <td>
                                                {{ $getData->amount }}
                                            </td>
                                            <td>
                                                {{ $getData->amount }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2">
                                                <table class="table table-sm text-nowrap mb-0 table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">
                                                                <p class="mb-0">Sub Total :</p>
                                                            </th>
                                                            <td>
                                                                <p class="mb-0 fw-semibold fs-15">{{ $getData->amount }}
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                                <p class="mb-0">Discount <span
                                                                        class="text-success">(0%)</span> :</p>
                                                            </th>
                                                            <td>
                                                                <p class="mb-0 fw-semibold fs-15">0</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                                <p class="mb-0">Date :</p>
                                                            </th>
                                                            <td>
                                                                <p class="mb-0 fw-semibold fs-15">
                                                                    {{ $getData->created_at->format('d-m-Y') }}</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                                <p class="mb-0 fs-14">Total :</p>
                                                            </th>
                                                            <td>
                                                                <p class="mb-0 fw-semibold fs-16 text-success">
                                                                    {{ $getData->amount }}
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        //  button event
        $(document).ready(function() {
            $('form').submit(function() {
                $('#submitBtn').val('Adding...').prop('disabled', true);

            });
            $(document).on("click", ".delete-btn", function() {
                $(this).closest('.form-group').remove();
            });

        });
        $(document).on("click", ".add-director-btn", function() {
            var html = $(".professional-container-clone").html();
            $(".professional_section").append(html);
        });
        $(document).on("click", ".add-education-btn", function() {
            var html = $(".education-container-clone").html();
            $(".education-container").append(html);
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#profilePhotoInput').on('change', function(e) {
                var fileInput = e.target;
                var imgElement = $('.img_profile_photo');
                // alert('10');
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        imgElement.attr('src', e.target.result);
                        imgElement.show(); // Display the image
                    };
                    reader.readAsDataURL(fileInput.files[0]);
                }
            });
        });
    </script>
@endsection
