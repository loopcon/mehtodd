@extends('partial.master')
@section('content')
    <div class="container-fluid">
        <!-- Start::page-header -->

        <div class="d-md-flex d-block align-items-center justify-content-between my-3 page-header-breadcrumb">
            {{-- <div>

                <p class="fw-semibold fs-18 mb-0">Welcome back, Json Taylor !</p>

                <span class="fs-semibold text-muted">Track your sales activity, leads and deals here.</span>

            </div> --}}
            <div class="btn-list mt-md-0 ">
            </div>
        </div>

        <!-- Start::page-header -->

        <div class="row">
            <div class="col-xl-4">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div class="d-flex align-items-top justify-content-between">
                                    <div>
                                        <span class="avatar avatar-md avatar-rounded bg-primary">
                                            <i class="fa-solid fa-users"></i>
                                        </span>
                                    </div>

                                    <div class="flex-fill ms-3">
                                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                                            <div>
                                                <p class="text-muted mb-0">Total Users</p>
                                                <h4 class="fw-semibold mt-1">{{$totalCount}}</h4>
                                            </div>

                                            <div id="crm-total-customers" style="min-height: 40px;">

                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-1">
                                            <div>
                                                {{-- <a class="text-primary" href="javascript:void(0);">View All<i
                                                        class="fa-solid fa-arrow-right ms-2 fw-semibold d-inline-block"></i></a> --}}
                                            </div>

                                            <div class="text-end">
                                                <p class="mb-0 text-success fw-semibold">{{$totalthismonthCount}}</p>
                                                <span class="text-muted op-7 fs-11">{{ $currentMonthName }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="row">
                    <div class="col-xxl-6 col-lg-6 col-md-6">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div class="d-flex align-items-top justify-content-between">
                                    <div>
                                        <span class="avatar avatar-md avatar-rounded bg-primary">
                                            <i class="fa-solid fa-user-large"></i>
                                        </span>
                                    </div>

                                    <div class="flex-fill ms-3">
                                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                                            <div>
                                                <p class="text-muted mb-0">Professional Users
                                                </p>
                                                <h4 class="fw-semibold mt-1">{{$totalprofessionuserCount}}</h4>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-1">
                                            <div>
                                                <a class="text-primary" href="{{ route('user.index') }}">View All<i
                                                        class="fa-solid fa-arrow-right ms-2 fw-semibold d-inline-block"></i></a>
                                            </div>

                                            <div class="text-end">
                                                <p class="mb-0 text-success fw-semibold">{{$thismonthprofessionuserCount}}</p>
                                                <span class="text-muted op-7 fs-11">{{ $currentMonthName }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-6 col-lg-6 col-md-6">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div class="d-flex align-items-top justify-content-between">
                                    <div>
                                        <span class="avatar avatar-md avatar-rounded bg-secondary">
                                            <i class="fa-regular fa-eye"></i>
                                        </span>
                                    </div>

                                    <div class="flex-fill ms-3">
                                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                                            <div>
                                                <p class="text-muted mb-0">Visitor Users
                                                </p>
                                                <h4 class="fw-semibold mt-1">{{$totalvistioruserCount}}</h4>
                                            </div>

                                            <div id="crm-total-revenue" style="min-height: 40px;">

                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-1">
                                            <div>
                                                <a class="text-secondary" href="{{ route('user.visitor.index') }}">View All<i
                                                        class="fa-solid fa-arrow-right ms-2 fw-semibold d-inline-block"></i></a>
                                            </div>

                                            <div class="text-end">
                                                <p class="mb-0 text-success fw-semibold">{{$totalthismonthvistioruserCount}}</p>
                                                <span class="text-muted op-7 fs-11">{{ $currentMonthName }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xxl-6 col-lg-4 col-md-6">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div class="d-flex align-items-top justify-content-between">
                                    <div>
                                        <span class="avatar avatar-md avatar-rounded bg-success">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                    </div>

                                    <div class="flex-fill ms-3">
                                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                                            <div>
                                                <p class="text-muted mb-0">Videos categories
                                                </p>
                                                <h4 class="fw-semibold mt-1">{{$videocategoriescount}}</h4>
                                            </div>

                                            <div id="crm-conversion-ratio" style="min-height: 40px;">
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-1">
                                            <div>
                                                <a class="text-success" href="{{ route('video-category.index') }}">View All<i
                                                        class="fa-solid fa-arrow-right ms-2 fw-semibold d-inline-block"></i></a>
                                            </div>

                                            <div class="text-end">
                                                <p class="mb-0 text-danger fw-semibold">{{$thismonthvideocategoryCount}}</p>
                                                <span class="text-muted op-7 fs-11">{{ $currentMonthName }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-6 col-lg-4 col-md-6">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div class="d-flex align-items-top justify-content-between">
                                    <div>
                                        <span class="avatar avatar-md avatar-rounded bg-warning">
                                            <i class="fa-solid fa-video"></i>
                                        </span>
                                    </div>

                                    <div class="flex-fill ms-3">
                                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                                            <div>
                                                <p class="text-muted mb-0">Videos
                                                </p>
                                                <h4 class="fw-semibold mt-1">{{$videocount}}</h4>
                                            </div>

                                            <div id="crm-total-deals" style="min-height: 40px;">

                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-1">
                                            <div>
                                                <a class="text-warning"  href="{{ route('videos.index') }}">View All<i
                                                        class="fa-solid fa-arrow-right ms-2 fw-semibold d-inline-block"></i></a>
                                            </div>

                                            <div class="text-end">
                                                <p class="mb-0 text-success fw-semibold">{{$thismonthvideoCount}}</p>
                                                <span class="text-muted op-7 fs-11">{{ $currentMonthName }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xxl-6 col-lg-4 col-md-6">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div class="d-flex align-items-top justify-content-between">
                                    <div>
                                        <span class="avatar avatar-md avatar-rounded bg-danger">
                                            <i class="fa-solid fa-user-minus"></i>
                                        </span>
                                    </div>

                                    <div class="flex-fill ms-3">
                                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                                            <div>
                                                <p class="text-muted mb-0">Malicious Professionals
                                                </p>
                                                <h4 class="fw-semibold mt-1">{{$maliciousprofilecount}}</h4>
                                            </div>

                                            <div id="crm-total-deals" style="min-height: 40px;">

                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-1">
                                            <div>
                                                <a class="text-warning"  href="{{ route('malicious.professionals') }}">View All<i
                                                        class="fa-solid fa-arrow-right ms-2 fw-semibold d-inline-block"></i></a>
                                            </div>

                                            <div class="text-end">
                                                <p class="mb-0 text-success fw-semibold">{{$thismonthvideoCount}}</p>
                                                <span class="text-muted op-7 fs-11">{{ $currentMonthName }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-6 col-lg-4 col-md-6">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div class="d-flex align-items-top justify-content-between">
                                    <div>
                                        <span class="avatar avatar-md avatar-rounded bg-danger">
                                            <i class="fa-solid fa-video-slash"></i>
                                        </span>
                                    </div>

                                    <div class="flex-fill ms-3">
                                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                                            <div>
                                                <p class="text-muted mb-0">Malicious Videos
                                                </p>
                                                <h4 class="fw-semibold mt-1">{{$maliciousvideocount}}</h4>
                                            </div>

                                            <div id="crm-total-deals" style="min-height: 40px;">

                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-1">
                                            <div>
                                                <a class="text-warning"  href="{{ route('malicious.videos') }}">View All<i
                                                        class="fa-solid fa-arrow-right ms-2 fw-semibold d-inline-block"></i></a>
                                            </div>

                                            <div class="text-end">
                                                <p class="mb-0 text-success fw-semibold">{{$thismonthvideoCount}}</p>
                                                <span class="text-muted op-7 fs-11">{{ $currentMonthName }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
