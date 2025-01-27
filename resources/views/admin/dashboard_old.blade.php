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
                                            <i class="ti ti-users fs-16"></i>
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
                                                        class="ti ti-arrow-narrow-right ms-2 fw-semibold d-inline-block"></i></a> --}}
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
                                            <i class="ti ti-users fs-16"></i>
                                        </span>
                                    </div>

                                    <div class="flex-fill ms-3">
                                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                                            <div>
                                                <p class="text-muted mb-0">Professional Users
                                                </p>
                                                <h4 class="fw-semibold mt-1">{{$totalprofessionuserCount}}</h4>
                                            </div>

                                            <div id="crm-total-customers" style="min-height: 40px;">
                                                {{-- <div id="apexchartsu0pxfxjw"
                                                    class="apexcharts-canvas apexchartsu0pxfxjw apexcharts-theme-light"
                                                    style="width: 100px; height: 40px;"><svg id="SvgjsSvg3004"
                                                        width="100" height="40" xmlns="http://www.w3.org/2000/svg"
                                                        version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                        xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg"
                                                        xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                        style="background: transparent;">
                                                        <g id="SvgjsG3006" class="apexcharts-inner apexcharts-graphical"
                                                            transform="translate(0, 0)">
                                                            <defs id="SvgjsDefs3005">
                                                                <clipPath id="gridRectMasku0pxfxjw">
                                                                    <rect id="SvgjsRect3011" width="105.5"
                                                                        height="41.5" x="-2.75" y="-0.75" rx="0"
                                                                        ry="0" opacity="1" stroke-width="0"
                                                                        stroke="none" stroke-dasharray="0"
                                                                        fill="#fff"></rect>
                                                                </clipPath>
                                                                <clipPath id="forecastMasku0pxfxjw"></clipPath>
                                                                <clipPath id="nonForecastMasku0pxfxjw"></clipPath>
                                                                <clipPath id="gridRectMarkerMasku0pxfxjw">
                                                                    <rect id="SvgjsRect3012" width="104"
                                                                        height="44" x="-2" y="-2" rx="0"
                                                                        ry="0" opacity="1" stroke-width="0"
                                                                        stroke="none" stroke-dasharray="0"
                                                                        fill="#fff"></rect>
                                                                </clipPath>

                                                                <linearGradient id="SvgjsLinearGradient3017"
                                                                    x1="0" y1="1" x2="1"
                                                                    y2="1">
                                                                    <stop id="SvgjsStop3018" stop-opacity="0.9"
                                                                        stop-color="rgba(66,45,112,0.9)" offset="0">
                                                                    </stop>

                                                                    <stop id="SvgjsStop3019" stop-opacity="0.9"
                                                                        stop-color="rgba(132,90,223,0.9)" offset="0.98">
                                                                    </stop>

                                                                    <stop id="SvgjsStop3020" stop-opacity="0.9"
                                                                        stop-color="rgba(132,90,223,0.9)" offset="1">
                                                                    </stop>
                                                                </linearGradient>
                                                            </defs>

                                                            <line id="SvgjsLine3010" x1="0" y1="0"
                                                                x2="0" y2="40" stroke="#b6b6b6"
                                                                stroke-dasharray="3" stroke-linecap="butt"
                                                                class="apexcharts-xcrosshairs" x="0" y="0" width="1"
                                                                height="40" fill="#b1b9c4" filter="none"
                                                                fill-opacity="0.9" stroke-width="1"></line>
                                                            <g id="SvgjsG3022" class="apexcharts-grid">
                                                                <g id="SvgjsG3023" class="apexcharts-gridlines-horizontal"
                                                                    style="display: none;">
                                                                    <line id="SvgjsLine3036" x1="0"
                                                                        y1="4" x2="100" y2="4"
                                                                        stroke="#e0e0e0" stroke-dasharray="0"
                                                                        stroke-linecap="butt" class="apexcharts-gridline">
                                                                    </line>

                                                                    <line id="SvgjsLine3037" x1="0"
                                                                        y1="8" x2="100" y2="8"
                                                                        stroke="#e0e0e0" stroke-dasharray="0"
                                                                        stroke-linecap="butt" class="apexcharts-gridline">
                                                                    </line>

                                                                    <line id="SvgjsLine3038" x1="0"
                                                                        y1="12" x2="100" y2="12"
                                                                        stroke="#e0e0e0" stroke-dasharray="0"
                                                                        stroke-linecap="butt" class="apexcharts-gridline">
                                                                    </line>

                                                                    <line id="SvgjsLine3039" x1="0"
                                                                        y1="16" x2="100" y2="16"
                                                                        stroke="#e0e0e0" stroke-dasharray="0"
                                                                        stroke-linecap="butt" class="apexcharts-gridline">
                                                                    </line>

                                                                    <line id="SvgjsLine3040" x1="0"
                                                                        y1="20" x2="100" y2="20"
                                                                        stroke="#e0e0e0" stroke-dasharray="0"
                                                                        stroke-linecap="butt" class="apexcharts-gridline">
                                                                    </line>

                                                                    <line id="SvgjsLine3041" x1="0"
                                                                        y1="24" x2="100" y2="24"
                                                                        stroke="#e0e0e0" stroke-dasharray="0"
                                                                        stroke-linecap="butt" class="apexcharts-gridline">
                                                                    </line>

                                                                    <line id="SvgjsLine3042" x1="0"
                                                                        y1="28" x2="100" y2="28"
                                                                        stroke="#e0e0e0" stroke-dasharray="0"
                                                                        stroke-linecap="butt" class="apexcharts-gridline">
                                                                    </line>

                                                                    <line id="SvgjsLine3043" x1="0"
                                                                        y1="32" x2="100" y2="32"
                                                                        stroke="#e0e0e0" stroke-dasharray="0"
                                                                        stroke-linecap="butt" class="apexcharts-gridline">
                                                                    </line>

                                                                    <line id="SvgjsLine3044" x1="0"
                                                                        y1="36" x2="100" y2="36"
                                                                        stroke="#e0e0e0" stroke-dasharray="0"
                                                                        stroke-linecap="butt" class="apexcharts-gridline">
                                                                    </line>
                                                                </g>

                                                                <g id="SvgjsG3024" class="apexcharts-gridlines-vertical"
                                                                    style="display: none;">
                                                                    <line id="SvgjsLine3026" x1="0"
                                                                        y1="0" x2="0" y2="40"
                                                                        stroke="#e0e0e0" stroke-dasharray="0"
                                                                        stroke-linecap="butt" class="apexcharts-gridline">
                                                                    </line>

                                                                    <line id="SvgjsLine3027" x1="12.5"
                                                                        y1="0" x2="12.5" y2="40"
                                                                        stroke="#e0e0e0" stroke-dasharray="0"
                                                                        stroke-linecap="butt" class="apexcharts-gridline">
                                                                    </line>

                                                                    <line id="SvgjsLine3028" x1="25"
                                                                        y1="0" x2="25" y2="40"
                                                                        stroke="#e0e0e0" stroke-dasharray="0"
                                                                        stroke-linecap="butt" class="apexcharts-gridline">
                                                                    </line>

                                                                    <line id="SvgjsLine3029" x1="37.5"
                                                                        y1="0" x2="37.5" y2="40"
                                                                        stroke="#e0e0e0" stroke-dasharray="0"
                                                                        stroke-linecap="butt" class="apexcharts-gridline">
                                                                    </line>

                                                                    <line id="SvgjsLine3030" x1="50"
                                                                        y1="0" x2="50" y2="40"
                                                                        stroke="#e0e0e0" stroke-dasharray="0"
                                                                        stroke-linecap="butt" class="apexcharts-gridline">
                                                                    </line>

                                                                    <line id="SvgjsLine3031" x1="62.5"
                                                                        y1="0" x2="62.5" y2="40"
                                                                        stroke="#e0e0e0" stroke-dasharray="0"
                                                                        stroke-linecap="butt" class="apexcharts-gridline">
                                                                    </line>

                                                                    <line id="SvgjsLine3032" x1="75"
                                                                        y1="0" x2="75" y2="40"
                                                                        stroke="#e0e0e0" stroke-dasharray="0"
                                                                        stroke-linecap="butt" class="apexcharts-gridline">
                                                                    </line>

                                                                    <line id="SvgjsLine3033" x1="87.5"
                                                                        y1="0" x2="87.5" y2="40"
                                                                        stroke="#e0e0e0" stroke-dasharray="0"
                                                                        stroke-linecap="butt" class="apexcharts-gridline">
                                                                    </line>

                                                                    <line id="SvgjsLine3034" x1="100"
                                                                        y1="0" x2="100" y2="40"
                                                                        stroke="#e0e0e0" stroke-dasharray="0"
                                                                        stroke-linecap="butt" class="apexcharts-gridline">
                                                                    </line>
                                                                </g>

                                                                <line id="SvgjsLine3047" x1="0" y1="40"
                                                                    x2="100" y2="40" stroke="transparent"
                                                                    stroke-dasharray="0" stroke-linecap="butt"></line>
                                                                <line id="SvgjsLine3046" x1="0" y1="1"
                                                                    x2="0" y2="40" stroke="transparent"
                                                                    stroke-dasharray="0" stroke-linecap="butt"></line>
                                                            </g>

                                                            <g id="SvgjsG3025" class="apexcharts-grid-borders"
                                                                style="display: none;">
                                                                <line id="SvgjsLine3035" x1="0" y1="0"
                                                                    x2="100" y2="0" stroke="#e0e0e0"
                                                                    stroke-dasharray="0" stroke-linecap="butt"
                                                                    class="apexcharts-gridline"></line>
                                                                <line id="SvgjsLine3045" x1="0" y1="40"
                                                                    x2="100" y2="40" stroke="#e0e0e0"
                                                                    stroke-dasharray="0" stroke-linecap="butt"
                                                                    class="apexcharts-gridline"></line>
                                                            </g>

                                                            <g id="SvgjsG3013"
                                                                class="apexcharts-line-series apexcharts-plot-series">
                                                                <g id="SvgjsG3014" class="apexcharts-series"
                                                                    seriesName="Value" data:longestSeries="true"
                                                                    rel="1" data:realIndex="0">
                                                                    <path id="SvgjsPath3021"
                                                                        d="M 0 5.217391304347828C 4.375 5.217391304347828 8.125 15.65217391304348 12.5 15.65217391304348C 16.875 15.65217391304348 20.625 6.956521739130437 25 6.956521739130437C 29.375 6.956521739130437 33.125 22.608695652173914 37.5 22.608695652173914C 41.875 22.608695652173914 45.625 7.105427357601002e-15 50 7.105427357601002e-15C 54.375 7.105427357601002e-15 58.125 5.217391304347828 62.5 5.217391304347828C 66.875 5.217391304347828 70.625 1.7391304347826164 75 1.7391304347826164C 79.375 1.7391304347826164 83.125 24.347826086956523 87.5 24.347826086956523C 91.875 24.347826086956523 95.625 19.1304347826087 100 19.1304347826087"
                                                                        fill="none" fill-opacity="1"
                                                                        stroke="url(#SvgjsLinearGradient3017)"
                                                                        stroke-opacity="1" stroke-linecap="butt"
                                                                        stroke-width="1.5" stroke-dasharray="0"
                                                                        class="apexcharts-line" index="0"
                                                                        clip-path="url(#gridRectMasku0pxfxjw)"
                                                                        pathTo="M 0 5.217391304347828C 4.375 5.217391304347828 8.125 15.65217391304348 12.5 15.65217391304348C 16.875 15.65217391304348 20.625 6.956521739130437 25 6.956521739130437C 29.375 6.956521739130437 33.125 22.608695652173914 37.5 22.608695652173914C 41.875 22.608695652173914 45.625 7.105427357601002e-15 50 7.105427357601002e-15C 54.375 7.105427357601002e-15 58.125 5.217391304347828 62.5 5.217391304347828C 66.875 5.217391304347828 70.625 1.7391304347826164 75 1.7391304347826164C 79.375 1.7391304347826164 83.125 24.347826086956523 87.5 24.347826086956523C 91.875 24.347826086956523 95.625 19.1304347826087 100 19.1304347826087"
                                                                        pathFrom="M 0 5.217391304347828C 4.375 5.217391304347828 8.125 15.65217391304348 12.5 15.65217391304348C 16.875 15.65217391304348 20.625 6.956521739130437 25 6.956521739130437C 29.375 6.956521739130437 33.125 22.608695652173914 37.5 22.608695652173914C 41.875 22.608695652173914 45.625 7.105427357601002e-15 50 7.105427357601002e-15C 54.375 7.105427357601002e-15 58.125 5.217391304347828 62.5 5.217391304347828C 66.875 5.217391304347828 70.625 1.7391304347826164 75 1.7391304347826164C 79.375 1.7391304347826164 83.125 24.347826086956523 87.5 24.347826086956523C 91.875 24.347826086956523 95.625 19.1304347826087 100 19.1304347826087"
                                                                        fill-rule="evenodd"></path>
                                                                    <g id="SvgjsG3015"
                                                                        class="apexcharts-series-markers-wrap"
                                                                        data:realIndex="0"></g>
                                                                </g>
                                                                <g id="SvgjsG3016" class="apexcharts-datalabels"
                                                                    data:realIndex="0"></g>
                                                            </g>

                                                            <line id="SvgjsLine3048" x1="0" y1="0"
                                                                x2="100" y2="0" stroke="#b6b6b6"

                                                                stroke-dasharray="0" stroke-width="1"

                                                                stroke-linecap="butt" class="apexcharts-ycrosshairs">

                                                            </line>

                                                            <line id="SvgjsLine3049" x1="0" y1="0"

                                                                x2="100" y2="0" stroke-dasharray="0"

                                                                stroke-width="0" stroke-linecap="butt"

                                                                class="apexcharts-ycrosshairs-hidden"></line>

                                                            <g id="SvgjsG3050" class="apexcharts-yaxis-annotations"></g>

                                                            <g id="SvgjsG3051" class="apexcharts-xaxis-annotations"></g>

                                                            <g id="SvgjsG3052" class="apexcharts-point-annotations"></g>

                                                            <g id="SvgjsG3053" class="apexcharts-xaxis"

                                                                transform="translate(0, 0)">

                                                                <g id="SvgjsG3054" class="apexcharts-xaxis-texts-g"

                                                                    transform="translate(0, -4)"></g>

                                                            </g>

                                                        </g>

                                                        <g id="SvgjsG3007" class="apexcharts-annotations"></g>

                                                        <g id="SvgjsG3064" class="apexcharts-yaxis" rel="0"

                                                            transform="translate(-18, 0)"></g>

                                                        <rect id="SvgjsRect3009" width="0" height="0" x="0"

                                                            y="0" rx="0" ry="0" opacity="1"

                                                            stroke-width="0" stroke="none" stroke-dasharray="0"

                                                            fill="#fefefe"></rect>

                                                    </svg>
                                                    <div class="apexcharts-legend" style="max-height: 20px;"></div>
                                                </div> --}}
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-1">
                                            <div>
                                                <a class="text-primary" href="{{ route('user.index') }}">View All<i
                                                        class="ti ti-arrow-narrow-right ms-2 fw-semibold d-inline-block"></i></a>
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
                                            <i class="ti ti-wallet fs-16"></i>
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
                                                        class="ti ti-arrow-narrow-right ms-2 fw-semibold d-inline-block"></i></a>
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



            <div class="col-xl-8">
                <div class="row">
                    <div class="col-xxl-6 col-lg-6 col-md-6">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div class="d-flex align-items-top justify-content-between">
                                    <div>
                                        <span class="avatar avatar-md avatar-rounded bg-success">
                                            <i class="ti ti-wave-square fs-16"></i>
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
                                                        class="ti ti-arrow-narrow-right ms-2 fw-semibold d-inline-block"></i></a>
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

                    <div class="col-xxl-6 col-lg-6 col-md-6">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div class="d-flex align-items-top justify-content-between">
                                    <div>
                                        <span class="avatar avatar-md avatar-rounded bg-warning">
                                            <i class="ti ti-briefcase fs-16"></i>
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
                                                        class="ti ti-arrow-narrow-right ms-2 fw-semibold d-inline-block"></i></a>
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
