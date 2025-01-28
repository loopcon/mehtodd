<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Set the favicon -->
    <link rel="icon" type="image/png" href="{{ asset('uploads/fevicon/' . GetSetting('fevicon')) }}">

    @if (!request()->routeIs('front.physio.bio'))
        <title>
            {{ isset($site_title) ? $site_title . ' | ' . config('app.name') : config('app.name') }}
            {{-- {{ isset($site_title) ? $site_title . ' | ' . 'Mehtodd' : 'Mehtodd' }} --}}
        </title>
        <meta name="keywords" content="{{ $setings->meta_keyword }}">
        <meta name="description" content="{{ $setings->meta_description }}">
        <link rel="canonical" href="{{ $setings->canonical }}">
    @else
        <title>
            {{ isset($site_title) ? $site_title . ' | ' . config('app.name') : config('app.name') }}
            {{-- {{ isset($site_title) ? $site_title . ' | ' . 'Mehtodd' : 'Mehtodd' }} --}}
        </title>
        <meta name="keywords" content="{{ isset($meta_keyword) ? $meta_keyword : '' }}">
        <meta name="description" content="{{ isset($meta_description) ? $meta_description : '' }}">
        <link rel="canonical" href="{{ isset($canonical) ? $canonical : '' }}">
    @endif

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', "{{ GetSetting('googletagmanager') }}");
    </script>

    <!-- End Google Tag Manager -->
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">

    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css"> --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"
        integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Include Select2 CSS and JS files -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .profile-btnclick::after {
            display: none !important;
        }
        .toggle-click-btn, .navbar-search-btn, .nav-searchbar-close{
            display: inline-flex;
            justify-content: center;
            align-items: center;
        }

        /* for language change btn */
        .pac-container {
            z-index: 10000000 !important;
            position: absolute !important;
        }

        #profile-dropdown {
            /* inset: 0px 0px auto -50px !important; */
            inset: 0px 0px auto auto !important;
            min-width: 14rem !important;
        }

        .switch {
            position: relative;
            display: inline-block;
            margin: 0 5px;
        }

        .switch>span {
            position: absolute;
            top: 14px;
            pointer-events: none;
            font-family: 'Helvetica', Arial, sans-serif;
            font-weight: bold;
            font-size: 12px;
            text-transform: uppercase;
            text-shadow: 0 1px 0 rgba(0, 0, 0, .06);
            width: 50%;
            text-align: center;
        }

        input.check-toggle-round-flat:checked~.off {
            color: #198FD9;
        }

        input.check-toggle-round-flat:checked~.on {
            color: #fff;
        }

        .switch>span.on {
            left: 0;
            padding-left: 2px;
            color: #198FD9;
        }

        .switch>span.off {
            right: 0;
            padding-right: 4px;
            color: #fff;
        }

        .check-toggle {
            position: absolute;
            margin-left: -9999px;
            visibility: hidden;
        }

        .check-toggle+label {
            display: block;
            position: relative;
            cursor: pointer;
            outline: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        input.check-toggle-round-flat+label {
            padding: 2px;
            width: 97px;
            height: 35px;
            background-color: #198FD9;
            -webkit-border-radius: 60px;
            -moz-border-radius: 60px;
            -ms-border-radius: 60px;
            -o-border-radius: 60px;
            border-radius: 60px;
        }

        input.check-toggle-round-flat+label:before,
        input.check-toggle-round-flat+label:after {
            display: block;
            position: absolute;
            content: "";
        }

        input.check-toggle-round-flat+label:before {
            top: 2px;
            left: 2px;
            bottom: 2px;
            right: 2px;
            background-color: #198FD9;
            -webkit- -moz-border-radius: 60px;
            -ms-border-radius: 60px;
            -o-border-radius: 60px;
            border-radius: 60px;
        }

        input.check-toggle-round-flat+label:after {
            top: 4px;
            left: 4px;
            bottom: 4px;
            width: 48px;
            background-color: #fff;
            -webkit-border-radius: 52px;
            -moz-border-radius: 52px;
            -ms-border-radius: 52px;
            -o-border-radius: 52px;
            border-radius: 52px;
            -webkit-transition: margin 0.2s;
            -moz-transition: margin 0.2s;
            -o-transition: margin 0.2s;
            transition: margin 0.2s;
        }

        input.check-toggle-round-flat:checked+label {}

        input.check-toggle-round-flat:checked+label:after {
            margin-left: 44px;
        }



        .font-required {
            opacity: 1;
            font-size: .813rem;
        }

        .forgot-register-box {
            display: flex;
            margin-bottom: 40px;
        }

        button:disabled {
            background-color: #5897fb;
            color: #ccc;
            cursor: not-allowed;
        }

        .viewer-count {
            color: #198FD9;
        }
    </style>
    <style>
        .video-actions {
            position: relative;
            padding: 7px;
        }

        .viewer-count {
            cursor: pointer;
        }

        .bell-size {
            height: 1.3em;
            color: #198FD9;
        }

        .bell-size:hover {
            color: #007BFF;
        }

        .icon-button__badge {
            position: absolute;
            top: -8px;
            right: -8px;
            width: 15px;
            height: 15px;
            font-size: 11px;
            background: red;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
        }

        .main-div {
            position: relative;
        }

        .circle {
            /* display: inline; */
            position: absolute;
            vertical-align: center !important;
            border-radius: 50%;
            height: 10px;
            width: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #198FD9;
        }

        .li-divider {
            border-top: 1px solid rgba(70, 70, 70, 0.226);
        }

        .notification-click {
            padding-left: 20px;
            text-decoration: none;
            color: #000;
            font-size: 0.9rem;
        }

        .notification-click:hover {
            text-decoration: none;
            color: #000;
        }

        .notification-list {
            padding: 0.5rem 0.5rem;

        }

        .notification-list:hover {
            background-color: rgba(70, 70, 70, 0.253);
        }

        .search-container {
            display: flex;
            align-items: center;
            background-color: #fff;
            border-radius: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .search-input {
            border: none;
            padding: 10px 20px;
            outline: none;
            width: 300px;
            font-size: 16px;
            border-top-left-radius: 25px;
            border-bottom-left-radius: 25px;
        }

        .center-text {
            text-align: center;
        }

        .notification-readmore {
            text-decoration: none !important;
            color: #198FD9 !important;
            font-size: 0.8rem;
        }


        .video-menu {
            border-bottom: 1px solid #ccc;
            padding: 3px 0px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #333333;
            text-decoration: none;
            white-space: nowrap;
        }

        #subCategory {
            display: none;
        }



        /* Notification Modle css */


        .bell-size {
            font-size: 24px;
            position: relative;
        }

        .icon-button__badge {
            position: absolute;
            top: -5px;
            right: -5px;
            /* background-color: #d9534f; */
            color: white;
            padding: 2px 6px;
            border-radius: 50%;
            font-size: 12px;
        }

        .notification-style {
            width: 280px;
            max-height: 400px;
            overflow-y: auto;
            margin: -10px !important;
            padding: 0 !important;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .notification-list {
            padding: 10px;
            border-bottom: 1px solid #e0e0e0;
            transition: background-color 0.3s ease;
        }

        /* .notification-list.unread {
            background-color: #f8d7da;
        }

        .notification-list.read {
            background-color: #d4edda;
        } */

        .notification-item {
            display: flex;
            align-items: center;
        }

        .notification-item a {
            color: #333;
            text-decoration: none;
            flex-grow: 1;
        }

        .notification-item a:hover {
            text-decoration: underline;
        }

        .circle {
            width: 10px;
            height: 10px;
            /* background-color: #d9534f; */
            border-radius: 50%;
            margin-right: 10px;
        }

        .notification-readmore {
            color: #007bff;
            text-decoration: none;
        }

        .notification-readmore:hover {
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .navbar-searchbar-box > .input-group {
                flex-direction: column; /* Stack items vertically */
            }
            .navbar-searchbar-box > .input-group .form-control,
            .navbar-searchbar-box > .input-group .form-select {
                width: 100%; /* Make inputs full-width */
            }
            .navbar-searchbar-box > .input-group-append {
                width: 100%;
                text-align: center;
            }
            .navbar-searchbar-box > .input-group-append .btn {
                width: 100%; /* Make the button full-width */
            }
        }

        .fixed-form {
            position: fixed; /* Fixes the form on the screen */
            z-index: 1050; /* Keeps it above other elements */
        }

        @media (min-width: 992px) {
            .mb-lg-0-custom {
                margin-bottom: 0 !important;
            }
        }

        @media (max-width: 767.98px) {
            .w-100-mobile {
                width: 100%; /* Full width only on mobile */
            }
        }

        .navbar-sign-upbtn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    <link rel="canonical" href="{{ $setings->canonical_url ?? request()->url() }}">

    @yield('page-css')

</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ GetSetting('googletagmanager') }}"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    @php
        $helper = new App\Helpers\Helper();
        $is_subscribed = $helper->IsUserAccess('meeting');
    @endphp
    <nav class="navbar-bg desktop-menu">
        <div id="header-sticky">
            <div class="container">
                <div class="navbar-main">
                    <div style="width:10%">
                        <a class="logolink" href="{{ route('front.home') }}">
                            <img class="d-flex justify-content-center align-item-center"
                                src="{{ asset('uploads/logo/' . $setings['logo']) }}" alt="" width="45%;">
                        </a>
                        {{-- <a class="logolink" href="{{ route('front.home') }}">{{ ucwords(GetSetting('site_name')) }}
                            <img src="" alt="">
                        </a> --}}
                    </div>

                    <div>
                        <ul class="navbar-item">
                            <li><a href="{{ route('front.home') }}"
                                    class="navbar-{{ request()->routeIs('front.home') ? 'active' : '' }}">{{ __('messages.Home') }}</a>
                            </li>
                            <li><a href="{{ route('front.physio') }}"
                                    class="{{ request()->routeIs('front.physio') ? 'navbar-active' : '' }}">{{ __('messages.Become Physio') }}</a>
                            </li>
                            <li><a href="{{ route('front.professional-list') }}"
                                    class="{{ request()->routeIs('front.professional-list') ? 'navbar-active' : '' }}">{{ __('messages.Get a Coach') }}</a>
                            </li>

                            {{-- <li><a href="javascript:void(0);">{{ __('messages.Get a Coach') }}</a></li> --}}
                            <li>
                                <a
                                    href="{{ route('front.contactus') }}"class="navbar-{{ request()->routeIs('front.contactus') ? 'active' : '' }}">{{ __('messages.Contacts') }}</a>
                            </li>
                            {{-- @if (Auth::check() && Auth::user())
                                <li>
                                    <a href="javascript:void(0)" class="lesson-add-btn" id="onlineAppointment"
                                        data-bs-toggle="modal">Online Appointments</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="lesson-add-btn" data-bs-toggle="modal"
                                        data-bs-target="#scheduleModal">schedule</a>
                                </li>
                            @endif --}}
                            <li>
                                <a class="navbar-upgraded" style="display: none;">Upgraded</a>
                            </li>

                            <li>
                                <div id="google_translate_element"></div>
                            </li>
                        </ul>
                    </div>



                    <div class="searchsign-box">
                        <a class="navbar-search-btn" href="javascript:void(0)"><i
                                class="fa-solid fa-magnifying-glass"></i></a>
                        @if (!Auth::user())
                            <a class="navbar-sign-upbtn" href="javascript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#siguploginModal"
                                onclick=" clearErrors()">{{ __('messages.Sign Up / Sign In') }}</a>
                        @endif
                    </div>
                    @php
                        // Check if 'select_categories' is set and is an array
                        $selectedCategories =
                            isset($_GET['select_categories']) && is_array($_GET['select_categories'])
                                ? $_GET['select_categories']
                                : [];

                        // Check if 'selected_main_categories' is set and is an array
                        $selectedMainCategories =
                            isset($_GET['selected_main_categories']) && is_array($_GET['selected_main_categories'])
                                ? $_GET['selected_main_categories']
                                : [];
                    @endphp


                    <!-- <form method="get" id="frm_search_phisio" action="{{ route('front.video-list') }}"
                        class="navbar-searchbar-box"> -->

                    <!-- Form Main desktop -->
                    <!--- <form id="frm_search_phisio" method="get" class="navbar-searchbar-box" style="left: 0; width: 100%;">
                        <div>
                            <div class="category-searchitem">

                                <input type="hidden" id="selected_main_categories" name="selected_main_categories"
                                    value="">
                                <div class="category-selectbox">

                                    <div class="header-search-cat category-headersearch-box category-border-show">
                                        <a href="javascript:void(0)"
                                            class="header-search-cat-click header-search-category">{{ __('messages.Select') }}
                                            <span><i class="fa-solid fa-chevron-down"></i></span>
                                        </a>
                                        <ul class="category-show">
                                            <li class="form-check">
                                                <input class="form-check-input main_category_checked_inpt"
                                                    type="checkbox" value="professional-list" id="professional-list"
                                                    {{-- {{ in_array('professional-list', $selectedMainCategories) ? 'checked' : '' }} --}}>
                                                <label href="javascript:void(0)"
                                                    class="professional-category subcat-click-category"
                                                    for="professional-list">{{ __('messages.Professionals') }}</label>
                                            </li>
                                            <li class="form-check">
                                                <input class="form-check-input main_category_checked_inpt"
                                                    type="checkbox" value="video-list" id="video-list"
                                                    {{-- {{ in_array('video-list', $selectedMainCategories) ? 'checked' : '' }} --}}>
                                                <label href="javascript:void(0)" class="video-menu" for="video-list"
                                                    style="border: none;">{{ __('messages.Videos') }}</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <input type="hidden" id="selected_categories" name="select_categories[]"
                                    value="">

                                <div class="category-selectbox" style="display: none" id ="professional-selectbox">
                                    <div class="header-search-cat category-headersearch-box category-border-show">
                                        <a href="javascript:void(0)"
                                            class="header-search-cat-click header-search-category">{{ __('messages.Category') }}
                                            <span><i class="fa-solid fa-chevron-down"></i></span>
                                        </a>
                                        <ul class="category-show">
                                            <li class="form-check">
                                                <input class="form-check-input category_checked_inpt" type="checkbox"
                                                    value="1" {{-- {{ in_array('1', $selectedCategories) ? 'checked' : '' }} --}}
                                                    id="lbl-professtional-category1">
                                                <label class="form-check-label" for="lbl-professtional-category1">
                                                    {{ __('messages.sports') }}
                                                </label>
                                            </li>
                                            <li class="form-check">
                                                <input class="form-check-input category_checked_inpt" type="checkbox"
                                                    value="2" {{-- {{ in_array('2', $selectedCategories) ? 'checked' : '' }} --}}
                                                    id="lbl-professtional-category2">
                                                <label class="form-check-label" for="lbl-professtional-category2">
                                                    {{ __('messages.Kinésithérapie') }}
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="category-selectbox header-search-cat category-headersearch-box category-border-show"
                                    id="subCategory">
                                    <a href="javascript:void(0)"
                                        class="header-search-cat-click header-search-category">{{ __('messages.Category') }}
                                        <span><i class="fa-solid fa-chevron-down"></i></span>
                                    </a>
                                    <ul class="category-show">
                                        @php
                                            $data = GetCategoryTree();
                                            $level1 = '1';
                                        @endphp
                                        @foreach ($data['category_list'] as $key => $list)
                                            @php
                                                $level2 = '1';
                                                $expandLevel1 = in_array($list->id, request('category', []));
                                                $hasSubcategories1 = count($data['sub_category_list'][$list->id]) > 0;
                                            @endphp
                                            <li>
                                                <a href="javascript:void(0)" class="subcat-click-category">
                                                    <div class="form-check ">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="{{ $list->id }}"
                                                            id="video-category-main-{{ $level1 }}"
                                                            name="category[]"
                                                            {{ in_array($list->id, request('category', [])) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="video-category-main-{{ $level1 }}">{{ $list->name }}</label>
                                                    </div>
                                                    @if ($hasSubcategories1)
                                                        <span><i
                                                                class="fa-solid {{ $expandLevel1 ? 'fa-chevron-down' : 'fa-chevron-right' }}"></i></span>
                                                    @endif
                                                </a>
                                                <ul
                                                    style="{{ $expandLevel1 && $hasSubcategories1 ? 'display: block;' : 'display: none;' }}">
                                                    @if ($hasSubcategories1)
                                                        @foreach ($data['sub_category_list'][$list->id] as $key => $list1)
                                                            @php
                                                                $level3 = '1';
                                                                $expandLevel2 = in_array(
                                                                    $list1->id,
                                                                    request('category', []),
                                                                );
                                                                $hasSubcategories2 =
                                                                    count(
                                                                        $data['sub_category1_list'][$list->id][
                                                                            $list1->id
                                                                        ],
                                                                    ) > 0;
                                                            @endphp
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    class="subcat-click-category">
                                                                    <div class="form-check ">
                                                                        <input class="form-check-input"
                                                                            type="checkbox"
                                                                            value="{{ $list1->id }}"
                                                                            id="video-category-main-{{ $level1 }}-{{ $level2 }}"
                                                                            name="category[]"
                                                                            {{ in_array($list1->id, request('category', [])) ? 'checked' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="video-category-main-{{ $level1 }}-{{ $level2 }}">{{ $list1->name }}</label>
                                                                    </div>
                                                                    @if ($hasSubcategories2)
                                                                        <span><i
                                                                                class="fa-solid {{ $expandLevel2 ? 'fa-chevron-down' : 'fa-chevron-right' }}"></i></span>
                                                                    @endif
                                                                </a>
                                                                <ul
                                                                    style="{{ $expandLevel2 && $hasSubcategories2 ? 'display: block;' : 'display: none;' }}">
                                                                    @if ($hasSubcategories2)
                                                                        @foreach ($data['sub_category1_list'][$list->id][$list1->id] as $key => $list2)
                                                                            @php
                                                                                $level4 = '1';
                                                                                $expandLevel3 = in_array(
                                                                                    $list2->id,
                                                                                    request('category', []),
                                                                                );

                                                                                // prx(request('category'));
                                                                                $hasSubcategories3 =
                                                                                    count(
                                                                                        $data['sub_category2_list'][
                                                                                            $list->id
                                                                                        ][$list1->id][$list2->id],
                                                                                    ) > 0;
                                                                            @endphp
                                                                            <li>
                                                                                <a href="javascript:void(0)"
                                                                                    class="subcat-click-category">
                                                                                    <div class="form-check ">
                                                                                        <input class="form-check-input"
                                                                                            type="checkbox"
                                                                                            value="{{ $list2->id }}"
                                                                                            id="video-category-main-{{ $level1 }}-{{ $level2 }}-{{ $level3 }}"
                                                                                            name="category[]"
                                                                                            {{ in_array($list2->id, request('category', [])) ? 'checked' : '' }}>
                                                                                        <label class="form-check-label"
                                                                                            for="video-category-main-{{ $level1 }}-{{ $level2 }}-{{ $level3 }}">{{ $list2->category_name }}</label>
                                                                                    </div>
                                                                                    @if ($hasSubcategories3)
                                                                                        <span><i
                                                                                                class="fa-solid {{ $expandLevel3 ? 'fa-chevron-down' : 'fa-chevron-right' }}"></i></span>
                                                                                    @endif
                                                                                </a>
                                                                                <ul
                                                                                    style="{{ $expandLevel3 && $hasSubcategories3 ? 'display: block;' : 'display: none;' }}">
                                                                                    @if ($hasSubcategories3)
                                                                                        @foreach ($data['sub_category2_list'][$list->id][$list1->id][$list2->id] as $key => $list3)
                                                                                            <li>
                                                                                                <a href="javascript:void(0)"
                                                                                                    class="subcat-click-category">
                                                                                                    <div
                                                                                                        class="form-check ">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="checkbox"
                                                                                                            value="{{ $list3->id }}"
                                                                                                            id="video-category-main-{{ $level1 }}-{{ $level2 }}-{{ $level3 }}-{{ $level4 }}"
                                                                                                            name="category[]"
                                                                                                            {{ in_array($list3->id, request('category', [])) ? 'checked' : '' }}>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="video-category-main-{{ $level1 }}-{{ $level2 }}-{{ $level3 }}-{{ $level4 }}">{{ $list3->category_name }}</label>
                                                                                                    </div>
                                                                                                </a>
                                                                                            </li>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </ul>
                                                                            </li>
                                                                            @php
                                                                                $level3++;
                                                                            @endphp
                                                                        @endforeach
                                                                    @endif
                                                                </ul>
                                                            </li>
                                                            @php
                                                                $level2++;
                                                            @endphp
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </li>
                                            @php
                                                $level1++;
                                            @endphp
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="SEARCH PHYSIO THERAPY" aria-label="Recipient's username"
                                        aria-describedby="basic-addon2">
                                    <input type="text" name="address" id="address" class="form-control"
                                        placeholder="ADDRESS" aria-label="Address" aria-describedby="basic-addon2">
                                    
                                    <select class="form-select" name="distance" aria-label="distance"
                                        placeholder="SELECT DISTANCE" aria-describedby="Select distance">
                                        <option value="0-10">0-10 miles</option>
                                        <option value="0-50">0-50 miles</option>
                                        <option value="0-99">0-99 miles</option>
                                        <option value="100-">100+ miles</option>
                                    </select>
                                    <div class="input-group-append">
                                        <span class="input-group-text btn_search_phisio" id="basic-addon2"><i
                                                class="fa-solid fa-magnifying-glass"></i></span>
                                    </div>
                                </div>
                                <a class="nav-searchbar-close" href="javascript:void(0)"><i class="fa-solid fa-xmark mt-2"></i></a>

                            </div>
                        </div>
                    </form> -->





                    @if (Auth::user())

                        @php
                            $notifications = VideoNotification();
                            $unreadNotifications = $notifications->where('is_read', 0)->count();
                        @endphp

                        @if (count($notifications) > 0)
                            <div class="dropdown">
                                <i class="dropdown-toggle profile-btnclick fa-solid fa-bell bell-size" type="button"
                                    data-bs-toggle="dropdown" title="Notifications" aria-expanded="false">
                                </i>
                                <span class="icon-button__badge">{{ $unreadNotifications }}</span>

                                <ul class="dropdown-menu profile-menubox notification-style" id="notification-list">
                                    @foreach ($notifications as $notification)
                                        @php
                                            $notificationStatus = $notification->is_read ? 'read' : 'unread';
                                        @endphp

                                        <li data-id="{{ $notification->id }}"
                                            class="notification-list {{ $notificationStatus }}">
                                            <div class="d-flex flex-row align-items-center notification-item">
                                                <div class="circle" data-id="{{ $notification->id }}"
                                                    style="{{ $notification->is_read ? 'display: none;' : '' }}">
                                                </div>
                                                <a href="javascript:void(0)" class="notification-click">
                                                    <strong>{{ $notification->title }}</strong>
                                                    <p>{{ $notification->description }}</p>
                                                    <small
                                                        class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                                </a>
                                            </div>
                                        </li>
                                    @endforeach

                                    <li class="text-center p-2">
                                        <a href="{{ route('front.notifications', ['slug' => Auth::user()->slug]) }}"
                                            class="notification-readmore">{{ __('messages.View All') }}</a>
                                    </li>
                                </ul>
                            </div>
                        @endif



                        <div class="dropdown">
                            <button class="dropdown-toggle profile-btnclick" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                @if (Auth::user()->profile_photo)
                                    <img src="{{ asset('uploads/profilephoto/' . Auth::user()->profile_photo) }}"
                                        class="dropdown-profileimg d-flex" alt="">
                                @else
                                    <img src="{{ asset('frontend/img/default_image_1.png') }}"
                                        class="dropdown-profileimg d-flex" alt="Default Profile Image">
                                @endif
                            </button>
                            {{-- @php
                                dd(Auth::user());
                            @endphp --}}
                            <ul class="dropdown-menu" id="profile-dropdown">
                                <li>
                                    @if (Auth::user()->slug != null)
                                        <a class="dropdown-item"
                                            href="{{ route('front.physio.bio', ['slug' => Auth::user()->slug]) }}">{{ __('messages.Profile') }}</a>
                                    @else
                                        <a class="dropdown-item"
                                            href="javascript:void(0)">{{ __('messages.Profile') }}</a>
                                    @endif
                                </li>
                                <li>
                                    @if (Auth::user()->slug != null)
                                        <a class="dropdown-item"
                                            href="{{ route('my.favourites', ['slug' => Auth::user()->slug]) }}">{{ __('messages.My Favorites') }}</a>
                                    @else
                                        <a class="dropdown-item"
                                            href="javascript:void(0)">{{ __('messages.My Favorites') }}</a>
                                    @endif
                                </li>
                                <li>
                                    @if (Auth::user()->slug != null)
                                        <a class="dropdown-item"
                                            href="{{ route('front.notifications', ['slug' => Auth::user()->slug]) }}">{{ __('messages.All Notifications') }}</a>
                                    @else
                                        <a class="dropdown-item"
                                            href="javascript:void(0)">{{ __('messages.All Notifications') }}</a>
                                    @endif
                                </li>


                                @if (Auth::user()->slug != null)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('front.professional-list') }}">
                                            {{ __('messages.Professional List') }}
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a class="dropdown-item"
                                            href="javascript:void(0)">{{ __('messages.Professional List') }}</a>
                                    </li>
                                @endif

                                @if (Auth::user()->slug != null)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('front.video-list') }}">
                                            {{ __('messages.Video List') }}
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a class="dropdown-item"
                                            href="javascript:void(0)">{{ __('messages.Video List') }}</a>
                                    </li>
                                @endif



                                @if (Auth::user() && Auth::user()->role_id != 3)
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('my.plans') }}">{{ __('messages.My Plans') }}</a>
                                    </li>
                                @endif

                                @if (Auth::user() && Auth::user()->role_id != 3)
                                    @if ($is_subscribed == 'true')
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('front.get-appointment') }}">{{ __('messages.Appointments') }}</a>
                                        </li>
                                    @else
                                        <li>
                                            <a id="showSubscriptionModal" class="dropdown-item"
                                                href="#">{{ __('messages.Appointments') }}</a>
                                        </li>
                                    @endif
                                @endif
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('changepassword') }}">{{ __('messages.Change Password') }}</a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('logout') }}">{{ __('messages.Logout') }}</a>
                                </li>

                            </ul>
                        </div>

                    @endif
                    {{-- language change btn start --}}


                    {{-- <div> --}}
                    {{-- <div class="switch">

                            <input id="language-toggle" class="check-toggle check-toggle-round-flat" type="checkbox">
                            <label for="language-toggle"></label>
                            <span class="on">FR</span>
                            <span class="off">EN</span>
                        </div> --}}
                    {{-- <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="languageSwitch"
                                {{ session('locale', 'fr') == 'fr' ? 'checked' : '' }}
                                onchange="changeLanguage()">
                            <label class="form-check-label" for="languageSwitch">{{ session('locale', 'fr') == 'fr' ? 'Français' : 'English' }}</label>
                        </div> --}}

                    {{-- </div> --}}


                    {{-- language change btn end --}}
                </div>
            </div>
        </div>
    </nav>
    <form id="frm_search_phisio" method="get" class="navbar-searchbar-box fixed-form" style="left: 0; width: 100%;">
        <div>
            <div class="category-searchitem">

                <input type="hidden" id="selected_main_categories" name="selected_main_categories"
                    value="">
                <div class="category-selectbox">

                    <div class="header-search-cat category-headersearch-box category-border-show">
                        <a href="javascript:void(0)"
                            class="header-search-cat-click header-search-category">{{ __('messages.Select') }}
                            <span><i class="fa-solid fa-chevron-down"></i></span>
                        </a>
                        <ul class="category-show">
                            <li class="form-check">
                                <input class="form-check-input main_category_checked_inpt"
                                    type="checkbox" value="professional-list" id="professional-list"
                                    {{-- {{ in_array('professional-list', $selectedMainCategories) ? 'checked' : '' }} --}}>
                                <label href="javascript:void(0)"
                                    class="professional-category subcat-click-category"
                                    for="professional-list">{{ __('messages.Professionals') }}</label>
                            </li>
                            <li class="form-check">
                                <input class="form-check-input main_category_checked_inpt"
                                    type="checkbox" value="video-list" id="video-list"
                                    {{-- {{ in_array('video-list', $selectedMainCategories) ? 'checked' : '' }} --}}>
                                <label href="javascript:void(0)" class="video-menu" for="video-list"
                                    style="border: none;">{{ __('messages.Videos') }}</label>
                            </li>
                        </ul>
                    </div>
                </div>
                <input type="hidden" id="selected_categories" name="select_categories[]"
                    value="">

                <div class="category-selectbox" style="display: none" id ="professional-selectbox">
                    <div class="header-search-cat category-headersearch-box category-border-show">
                        <a href="javascript:void(0)"
                            class="header-search-cat-click header-search-category">{{ __('messages.Category') }}
                            <span><i class="fa-solid fa-chevron-down"></i></span>
                        </a>
                        <ul class="category-show">
                            <li class="form-check">
                                <input class="form-check-input category_checked_inpt" type="checkbox"
                                    value="1" {{-- {{ in_array('1', $selectedCategories) ? 'checked' : '' }} --}}
                                    id="lbl-professtional-category1">
                                <label class="form-check-label" for="lbl-professtional-category1">
                                    {{ __('messages.sports') }}
                                </label>
                            </li>
                            <li class="form-check">
                                <input class="form-check-input category_checked_inpt" type="checkbox"
                                    value="2" {{-- {{ in_array('2', $selectedCategories) ? 'checked' : '' }} --}}
                                    id="lbl-professtional-category2">
                                <label class="form-check-label" for="lbl-professtional-category2">
                                    {{ __('messages.Kinésithérapie') }}
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="category-selectbox header-search-cat category-headersearch-box category-border-show"
                    id="subCategory">
                    <a href="javascript:void(0)"
                        class="header-search-cat-click header-search-category">{{ __('messages.Category') }}
                        <span><i class="fa-solid fa-chevron-down"></i></span>
                    </a>
                    <ul class="category-show">
                        @php
                            $data = GetCategoryTree();
                            $level1 = '1';
                        @endphp
                        @foreach ($data['category_list'] as $key => $list)
                            @php
                                $level2 = '1';
                                $expandLevel1 = in_array($list->id, request('category', []));
                                $hasSubcategories1 = count($data['sub_category_list'][$list->id]) > 0;
                            @endphp
                            <li>
                                <a href="javascript:void(0)" class="subcat-click-category">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox"
                                            value="{{ $list->id }}"
                                            id="video-category-main-{{ $level1 }}"
                                            name="category[]"
                                            {{ in_array($list->id, request('category', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label"
                                            for="video-category-main-{{ $level1 }}">{{ $list->name }}</label>
                                    </div>
                                    @if ($hasSubcategories1)
                                        <span><i
                                                class="fa-solid {{ $expandLevel1 ? 'fa-chevron-down' : 'fa-chevron-right' }}"></i></span>
                                    @endif
                                </a>
                                <ul
                                    style="{{ $expandLevel1 && $hasSubcategories1 ? 'display: block;' : 'display: none;' }}">
                                    @if ($hasSubcategories1)
                                        @foreach ($data['sub_category_list'][$list->id] as $key => $list1)
                                            @php
                                                $level3 = '1';
                                                $expandLevel2 = in_array(
                                                    $list1->id,
                                                    request('category', []),
                                                );
                                                $hasSubcategories2 =
                                                    count(
                                                        $data['sub_category1_list'][$list->id][
                                                            $list1->id
                                                        ],
                                                    ) > 0;
                                            @endphp
                                            <li>
                                                <a href="javascript:void(0)"
                                                    class="subcat-click-category">
                                                    <div class="form-check ">
                                                        <input class="form-check-input"
                                                            type="checkbox"
                                                            value="{{ $list1->id }}"
                                                            id="video-category-main-{{ $level1 }}-{{ $level2 }}"
                                                            name="category[]"
                                                            {{ in_array($list1->id, request('category', [])) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="video-category-main-{{ $level1 }}-{{ $level2 }}">{{ $list1->name }}</label>
                                                    </div>
                                                    @if ($hasSubcategories2)
                                                        <span><i
                                                                class="fa-solid {{ $expandLevel2 ? 'fa-chevron-down' : 'fa-chevron-right' }}"></i></span>
                                                    @endif
                                                </a>
                                                <ul
                                                    style="{{ $expandLevel2 && $hasSubcategories2 ? 'display: block;' : 'display: none;' }}">
                                                    @if ($hasSubcategories2)
                                                        @foreach ($data['sub_category1_list'][$list->id][$list1->id] as $key => $list2)
                                                            @php
                                                                $level4 = '1';
                                                                $expandLevel3 = in_array(
                                                                    $list2->id,
                                                                    request('category', []),
                                                                );

                                                                // prx(request('category'));
                                                                $hasSubcategories3 =
                                                                    count(
                                                                        $data['sub_category2_list'][
                                                                            $list->id
                                                                        ][$list1->id][$list2->id],
                                                                    ) > 0;
                                                            @endphp
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    class="subcat-click-category">
                                                                    <div class="form-check ">
                                                                        <input class="form-check-input"
                                                                            type="checkbox"
                                                                            value="{{ $list2->id }}"
                                                                            id="video-category-main-{{ $level1 }}-{{ $level2 }}-{{ $level3 }}"
                                                                            name="category[]"
                                                                            {{ in_array($list2->id, request('category', [])) ? 'checked' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="video-category-main-{{ $level1 }}-{{ $level2 }}-{{ $level3 }}">{{ $list2->category_name }}</label>
                                                                    </div>
                                                                    @if ($hasSubcategories3)
                                                                        <span><i
                                                                                class="fa-solid {{ $expandLevel3 ? 'fa-chevron-down' : 'fa-chevron-right' }}"></i></span>
                                                                    @endif
                                                                </a>
                                                                <ul
                                                                    style="{{ $expandLevel3 && $hasSubcategories3 ? 'display: block;' : 'display: none;' }}">
                                                                    @if ($hasSubcategories3)
                                                                        @foreach ($data['sub_category2_list'][$list->id][$list1->id][$list2->id] as $key => $list3)
                                                                            <li>
                                                                                <a href="javascript:void(0)"
                                                                                    class="subcat-click-category">
                                                                                    <div
                                                                                        class="form-check ">
                                                                                        <input
                                                                                            class="form-check-input"
                                                                                            type="checkbox"
                                                                                            value="{{ $list3->id }}"
                                                                                            id="video-category-main-{{ $level1 }}-{{ $level2 }}-{{ $level3 }}-{{ $level4 }}"
                                                                                            name="category[]"
                                                                                            {{ in_array($list3->id, request('category', [])) ? 'checked' : '' }}>
                                                                                        <label
                                                                                            class="form-check-label"
                                                                                            for="video-category-main-{{ $level1 }}-{{ $level2 }}-{{ $level3 }}-{{ $level4 }}">{{ $list3->category_name }}</label>
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                        @endforeach
                                                                    @endif
                                                                </ul>
                                                            </li>
                                                            @php
                                                                $level3++;
                                                            @endphp
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </li>
                                            @php
                                                $level2++;
                                            @endphp
                                        @endforeach
                                    @endif
                                </ul>
                            </li>
                            @php
                                $level1++;
                            @endphp
                        @endforeach
                    </ul>
                </div>

                <div class="input-group flex-wrap flex-lg-nowrap w-100">
                    <input type="text" name="search" class="form-control mb-2 mb-md-0 w-auto"
                        placeholder="SEARCH PHYSIO THERAPY" aria-label="Recipient's username"
                        aria-describedby="basic-addon2">
                    <input type="text" name="address" id="address" class="form-control mb-2 mb-lg-0 w-auto"
                        placeholder="ADDRESS" aria-label="Address" aria-describedby="basic-addon2">
                    
                    <select class="form-select mb-2 mb-lg-0-custom w-auto" name="distance" aria-label="distance"
                        placeholder="SELECT DISTANCE" aria-describedby="Select distance">
                        <option value="0-10">0-10 miles</option>
                        <option value="0-50">0-50 miles</option>
                        <option value="0-99">0-99 miles</option>
                        <option value="100-">100+ miles</option>
                    </select>
                    <div class="input-group-append mb-2 w-100-mobile">
                        <span class="input-group-text btn_search_phisio w-100 justify-content-center" id="basic-addon2"><i
                                class="fa-solid fa-magnifying-glass"></i></span>
                    </div>
                </div>
                <a class="nav-searchbar-close d-none d-md-block" href="javascript:void(0)"><i class="fa-solid fa-xmark mt-2"></i></a>

            </div>
        </div>
    </form>
    {{-- mobile view navbar start --}}
    <nav class="navbar-bg mobile-menu">
        <div id="mobile-header-sticky">
            <div class="container">
                <div class="navbar-main mobile-menu">
                    <div>
                        <a href="#" class="toggle-click-btn"><i class="fa-solid fa-bars"></i></a>
                        <div class="mobile-menu-item">
                            <ul class="navbar-item">
                                {{-- <li><a href="#" class="navbar-active">{{ __('messages.Home') }}</a></li>
                                <li><a href="#">{{ __('messages.Become Physio') }}</a></li>
                                <li><a href="#">{{ __('messages.Get a Coach') }}</a></li>
                                <li><a href="#">{{ __('messages.Membership') }}</a></li>
                                <li><a href="#">{{ __('messages.Contacts') }}</a></li> --}}
                                <li><a href="{{ route('front.home') }}"
                                        class="navbar-{{ request()->routeIs('front.home') ? 'active' : '' }}">{{ __('messages.Home') }}</a>
                                </li>
                                <li><a href="{{ route('front.physio') }}"
                                        class="{{ request()->routeIs('front.physio') ? 'navbar-active' : '' }}">{{ __('messages.Become Physio') }}</a>
                                </li>
                                <li><a href="{{ route('front.professional-list') }}"
                                        class="{{ request()->routeIs('front.professional-list') ? 'navbar-active' : '' }}">{{ __('messages.Get a Coach') }}</a>
                                </li>

                                {{-- <li><a href="javascript:void(0);">{{ __('messages.Get a Coach') }}</a></li> --}}
                                <li>
                                    <a
                                        href="{{ route('front.contactus') }}"class="navbar-{{ request()->routeIs('front.contactus') ? 'active' : '' }}">{{ __('messages.Contacts') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <a class="logolink" href="{{ route('front.home') }}">{{ config('app.name') }}<img src=""
                                alt=""></a>
                    </div>

                    <div class="searchsign-box">
                        <a class="navbar-search-btn" href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
                        @if (!Auth::user())
                            <a class="navbar-sign-upbtn" href="javascript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#siguploginModal" onclick=" clearErrors()"><i
                                    class="fa-solid fa-circle-user"></i>
                            </a>
                        @endif
                        @if (Auth::user())
                            <div class="dropdown">
                                <button class="dropdown-toggle profile-btnclick" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('uploads/profilephoto/' . Auth::user()->profile_photo) }}"
                                        class="dropdown-profileimg d-flex" alt="">
                                </button>

                                <ul class="dropdown-menu profile-menubox">
                                    <li>
                                        @if (Auth::user()->slug != null)
                                            <a class="dropdown-item"
                                                href="{{ route('front.physio.bio', ['slug' => Auth::user()->slug]) }}">{{ __('messages.Profile') }}</a>
                                        @else
                                            <a class="dropdown-item"
                                                href="javascript:void(0)">{{ __('messages.Profile') }}</a>
                                        @endif
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="{{ route('logout') }}">{{ __('messages.Logout') }}</a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                    <!-- Form Responsive -->
                    <!-- <form method="get" id="frm_search_phisio" action="{{ route('front.video-list') }}"
                        class="navbar-searchbar-box">
                        <div>
                            <div class="category-searchitem">
                                <div class="category-selectbox">
                                    <div class="header-search-cat category-headersearch-box category-border-show">
                                        <a href="#"
                                            class="header-search-cat-click header-search-category">{{ __('messages.Category') }}
                                            <span><i class="fa-solid fa-chevron-down"></i></span>
                                        </a>
                                        <ul class="category-show">
                                            @php
                                                $data = GetCategoryTree();
                                                $level1 = '1';
                                            @endphp
                                            @foreach ($data['category_list'] as $key => $list)
                                                @php
                                                    $level2 = '1';
                                                    $expandLevel1 = in_array($list->id, request('category', []));
                                                    $hasSubcategories1 =
                                                        count($data['sub_category_list'][$list->id]) > 0;
                                                @endphp
                                                <li>
                                                    <a href="javascript:void(0)" class="subcat-click-category">
                                                        <div class="form-check ">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="{{ $list->id }}"
                                                                id="video-category-main-{{ $level1 }}"
                                                                name="category[]"
                                                                {{ in_array($list->id, request('category', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="video-category-main-{{ $level1 }}">{{ $list->name }}</label>
                                                        </div>
                                                        @if ($hasSubcategories1)
                                                            <span><i
                                                                    class="fa-solid {{ $expandLevel1 ? 'fa-chevron-down' : 'fa-chevron-right' }}"></i></span>
                                                        @endif
                                                    </a>
                                                    <ul
                                                        style="{{ $expandLevel1 && $hasSubcategories1 ? 'display: block;' : 'display: none;' }}">
                                                        @if ($hasSubcategories1)
                                                            @foreach ($data['sub_category_list'][$list->id] as $key => $list1)
                                                                @php
                                                                    $level3 = '1';
                                                                    $expandLevel2 = in_array(
                                                                        $list1->id,
                                                                        request('category', []),
                                                                    );
                                                                    $hasSubcategories2 =
                                                                        count(
                                                                            $data['sub_category1_list'][$list->id][
                                                                                $list1->id
                                                                            ],
                                                                        ) > 0;
                                                                @endphp
                                                                <li>
                                                                    <a href="javascript:void(0)"
                                                                        class="subcat-click-category">
                                                                        <div class="form-check ">
                                                                            <input class="form-check-input"
                                                                                type="checkbox"
                                                                                value="{{ $list1->id }}"
                                                                                id="video-category-main-{{ $level1 }}-{{ $level2 }}"
                                                                                name="category[]"
                                                                                {{ in_array($list1->id, request('category', [])) ? 'checked' : '' }}>
                                                                            <label class="form-check-label"
                                                                                for="video-category-main-{{ $level1 }}-{{ $level2 }}">{{ $list1->name }}</label>
                                                                        </div>
                                                                        @if ($hasSubcategories2)
                                                                            <span><i
                                                                                    class="fa-solid {{ $expandLevel2 ? 'fa-chevron-down' : 'fa-chevron-right' }}"></i></span>
                                                                        @endif
                                                                    </a>
                                                                    <ul
                                                                        style="{{ $expandLevel2 && $hasSubcategories2 ? 'display: block;' : 'display: none;' }}">
                                                                        @if ($hasSubcategories2)
                                                                            @foreach ($data['sub_category1_list'][$list->id][$list1->id] as $key => $list2)
                                                                                @php
                                                                                    $level4 = '1';
                                                                                    $expandLevel3 = in_array(
                                                                                        $list2->id,
                                                                                        request('category', []),
                                                                                    );

                                                                                    // prx(request('category'));
                                                                                    $hasSubcategories3 =
                                                                                        count(
                                                                                            $data['sub_category2_list'][
                                                                                                $list->id
                                                                                            ][$list1->id][$list2->id],
                                                                                        ) > 0;
                                                                                @endphp
                                                                                <li>
                                                                                    <a href="javascript:void(0)"
                                                                                        class="subcat-click-category">
                                                                                        <div class="form-check ">
                                                                                            <input
                                                                                                class="form-check-input"
                                                                                                type="checkbox"
                                                                                                value="{{ $list2->id }}"
                                                                                                id="video-category-main-{{ $level1 }}-{{ $level2 }}-{{ $level3 }}"
                                                                                                name="category[]"
                                                                                                {{ in_array($list2->id, request('category', [])) ? 'checked' : '' }}>
                                                                                            <label
                                                                                                class="form-check-label"
                                                                                                for="video-category-main-{{ $level1 }}-{{ $level2 }}-{{ $level3 }}">{{ $list2->category_name }}</label>
                                                                                        </div>
                                                                                        @if ($hasSubcategories3)
                                                                                            <span><i
                                                                                                    class="fa-solid {{ $expandLevel3 ? 'fa-chevron-down' : 'fa-chevron-right' }}"></i></span>
                                                                                        @endif
                                                                                    </a>
                                                                                    <ul
                                                                                        style="{{ $expandLevel3 && $hasSubcategories3 ? 'display: block;' : 'display: none;' }}">
                                                                                        @if ($hasSubcategories3)
                                                                                            @foreach ($data['sub_category2_list'][$list->id][$list1->id][$list2->id] as $key => $list3)
                                                                                                <li>
                                                                                                    <a href="javascript:void(0)"
                                                                                                        class="subcat-click-category">
                                                                                                        <div
                                                                                                            class="form-check ">
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="checkbox"
                                                                                                                value="{{ $list3->id }}"
                                                                                                                id="video-category-main-{{ $level1 }}-{{ $level2 }}-{{ $level3 }}-{{ $level4 }}"
                                                                                                                name="category[]"
                                                                                                                {{ in_array($list3->id, request('category', [])) ? 'checked' : '' }}>
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="video-category-main-{{ $level1 }}-{{ $level2 }}-{{ $level3 }}-{{ $level4 }}">{{ $list3->category_name }}</label>
                                                                                                        </div>
                                                                                                    </a>
                                                                                                </li>
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </ul>
                                                                                </li>
                                                                                @php
                                                                                    $level3++;
                                                                                @endphp
                                                                            @endforeach
                                                                        @endif
                                                                    </ul>
                                                                </li>
                                                                @php
                                                                    $level2++;
                                                                @endphp
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </li>
                                                @php
                                                    $level1++;
                                                @endphp
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="SEARCH PHYSIO THERAPY" aria-label="Recipient's username"
                                        aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text btn_search_phisio" id="basic-addon2"><i
                                                class="fa-solid fa-magnifying-glass"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form> -->
                </div>
            </div>
        </div>
    </nav>
    {{-- mobile view navbar end --}}
    {{-- search click  show  start  --}}

    {{-- search click  show  end  --}}




    @yield('content')

    <!-- footer start  -->

    <div class="footer-section-bg">
        <div class="newsletter-text-main">
            <div class="container">
                <div class="row ">
                    <div class="col-12 col-md-6">
                        <div class="newsletter-text">
                            <h5>{{ __('messages.Newsletter') }}</h5>
                            <p>{{ __('messages.Subscribe_for') }}</p>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <form action="javascript:void(0);" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="footer-email-input">
                                <input class="form-control" name="email" id="sub_email" type="email"
                                    placeholder="Email">
                                <button class="subscrib-footer" id="btn_subscribe"> {{ __('messages.SUBSCRIBE') }}
                                </button>
                            </div>
                            <div id="error_msg_sub_email">
                                @error('email')
                                    <span class="text-danger font-required ">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="alert alert-success mt-2" id="msg_subscribe" style="display:none">
                                {{ __('messages.Detail_send') }}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-menu-main">
            <div class="container">
                <div class="row ">
                    <div class="col-12 col-md-4 col-lg-6">
                        <div class="newsletter-text">
                            <h2 class="text-light">{{ config('app.name') }}</h2>
                            {{-- <h2 class="text-light">{{ GetSetting('site_name') }}</h2> --}}
                        </div>
                    </div>

                    <div class="col-12 col-md-8 col-lg-6">
                        <div class="footer-menu">

                            <ul>
                                <li> <a href="{{ route('front.home') }}"
                                        class="navbar-{{ request()->routeIs('front.home') ? 'active' : '' }}">{{ __('messages.Home') }}</a>
                                </li>
                                <li><a href="javascript:void(0);">{{ __('messages.About') }}</a></li>
                                <li><a href="{{ route('front.how-it-work') }}"
                                        class="navbar-{{ request()->routeIs('front.how-it-work') ? 'active' : '' }}">{{ __('messages.How It Work') }}</a>
                                </li>
                                <li> <a href="{{ route('front.contactus') }}"
                                        class="navbar-{{ request()->routeIs('front.contactus') ? 'active' : '' }}">{{ __('messages.Contacts') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="copyright-main">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-md-7">
                        <p class="copyright-text">{{ __('messages.Copyright ©') }}
                            {{ GetSetting('copyright_year') }}
                            {{ config('app.name') }}. {{ __('messages.All Rights Reserved') }}</p>
                        {{-- <p class="copyright-text">{{ __('messages.Copyright ©') }} {{ GetSetting('copyright_year') }}
                            {{ GetSetting('site_name') }}. {{ __('messages.All Rights Reserved') }}</p> --}}
                    </div>

                    <div class="col-12 col-md-5">
                        <div class="social-icon">
                            <a href="{{ GetSetting('fb') }}" target="_blank"><i
                                    class="fa-brands fa-facebook-f"></i></a>
                            <a href="{{ GetSetting('insta') }}" target="_blank"><i
                                    class="fa-brands fa-instagram"></i></a>
                            <a href="{{ GetSetting('twitter') }}" target="_blank"><i
                                    class="fa-brands fa-x-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- subscribe Modal -->
    <div class="modal fade" id="subscribelistModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog siguplogin-dailog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="padding: 0px;border-bottom: 0px;">
                    <button data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i></button>
                </div>

                <div class="modal-body">
                    <div class="row m-0">
                        <div class="container">
                            @php
                                $subscriptions = getsubscribelist();
                            @endphp
                            <div class="subscription-section">
                                <h2 class="subscription-head" style="margin-bottom: 0px !important;">
                                    {{ __('messages.subscriptions') }}
                                </h2>
                                <h6 class="text-danger text-center p-2">{{ __('messages.sorry_you') }}</h6>
                                <div class="grid-subscription">
                                    @foreach ($subscriptions as $key => $value)
                                        @if ($value->price != 0)
                                            <div class="home-subscrit-card-item">
                                                <div class="subscrit-card-item">
                                                    <p class="subscrit-free-btn">
                                                        {{ $value->title }}
                                                    </p>
                                                    <div class="subscrit-free-datatext">
                                                        <span class="free-month-text"><span class="euro-text"><i
                                                                    class="fa-solid fa-euro-sign"></i>
                                                                {{ $value->price }}</span>
                                                            {{ $value->model_type == '1' ? 'Month' : 'Year' }}</span>

                                                        @foreach ($value->SubscriptionDescription as $list)
                                                            @if ($list->description != '')
                                                                <p> {{ $list->description }}</p>
                                                            @endif
                                                        @endforeach
                                                        @auth
                                                            @php
                                                                $user = Auth::user();
                                                            @endphp

                                                            <a href="{{ route('payment', ['subscription' => $value->id]) }}"
                                                                class="card-subscription-btn
                                                                {{ $user->is_subscribe == '1' ? ($user->subscription_id == $value->id ? 'btn-disabled' : '') : '' }}">
                                                                {{ $user->is_subscribe == '1' ? ($user->subscription_id == $value->id ? 'SUBSCRIBED' : 'SUBSCRIBE NOW') : 'SUBSCRIBE NOW' }}
                                                            </a>
                                                        @else
                                                            <a class="navbar-sign-upbtn unlog-subscription-btn"
                                                                href="javascript:void(0);" data-bs-toggle="modal"
                                                                data-bs-target="#siguploginModal"
                                                                onclick=" clearErrors()">{{ __('messages.subscribe_now') }}</a>
                                                        @endauth

                                                    </div>

                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="siguploginModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog siguplogin-dailog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="padding: 0px;border-bottom: 0px;">
                    <button data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i></button>
                    <!-- <button type="button" class="btn-close"  aria-label="Close"></button> -->
                </div>

                <div class="modal-body">
                    <div class="row m-0">
                        <div class="col-12 col-md-5 p-0">
                            <img class="img-fluid login-img-popup"
                                src="{{ asset('frontend/img/our-clients-img.png') }}" alt="">
                        </div>

                        <div class="col-12 col-md-7 p-0">
                            <div class="login-register-form-box">
                                <div class="login-register-box">
                                    <a href="javascript:void(0);"
                                        class="login-text login-active">{{ __('messages.login') }}</a>
                                    <a href="javascript:void(0);"
                                        class="register-text">{{ __('messages.register') }}</a>
                                </div>

                                <div>

                                    {{-- <form action="{{ route('login') }}" method="POST" class="login-form"
                                        id="loginForm">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="fa-solid fa-user-plus"></i></span>
                                            <input type="text" class="form-control" placeholder="EMAIL"
                                                name="email" id="email" aria-label="email"
                                                aria-describedby="basic-addon1"
                                                value="{{ old('email') ?: Cookie::get('email') }}">
                                        </div>
                                        <div style="margin-bottom: 20px">
                                            <span class="input-error text-danger font-required" role="alert">
                                                <!-- Error handling for email -->
                                            </span>
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon2"><i
                                                    class="fa-solid fa-key"></i></span>
                                            <input type="password" class="form-control" placeholder="PASSWORD"
                                                name="password" id="password" aria-label="Password"
                                                aria-describedby="basic-addon2"
                                                value="{{ old('password') ?: Cookie::get('password') }}">
                                        </div>
                                        <div style="margin-bottom: 20px">
                                            <span class="input-error text-danger font-required" role="alert">
                                                <!-- Error handling for password -->
                                            </span>
                                        </div>

                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" name="remember"
                                                id="remember" {{ Cookie::has('email') ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="remember">{{ __('messages.remember_me') }}</label>
                                        </div>

                                        <button type="submit" class="login-form-signin"
                                            id="BtnSignin">{{ __('messages.sign_in') }}</button>

                                        <div class="row">
                                            <div class="col">
                                                <div class="d-flex justify-content-end align-items-center"
                                                    style="margin-top: 20px">
                                                    <span>{{ __('messages.forgot_password') }}</span> &nbsp; &nbsp;
                                                    <a href="javascript:void(0);" class="reset-password-link"
                                                        id="resetpassword">{{ __('messages.reset') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form> --}}

                                    <form action="{{ route('login') }}" method="POST" class="login-form"
                                        id="loginForm">
                                        @csrf
                                        <div id="errorBox" class="alert alert-danger d-none" role="alert"
                                            style="display: none;">
                                            <!-- Error messages will be injected here -->
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="fa-solid fa-user-plus"></i></span>
                                            <input type="text" class="form-control" placeholder="EMAIL"
                                                name="email" id="email" aria-label="email"
                                                aria-describedby="basic-addon1"
                                                value="{{ old('email') ?: Cookie::get('email') }}">
                                        </div>
                                        <div style="margin-bottom: 20px">
                                            <span class="input-error text-danger font-required" role="alert">
                                                <!-- Error handling for email -->
                                            </span>
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon2"><i
                                                    class="fa-solid fa-key"></i></span>
                                            <input type="password" class="form-control" placeholder="PASSWORD"
                                                name="password" id="password" aria-label="Password"
                                                aria-describedby="basic-addon2"
                                                value="{{ old('password') ?: Cookie::get('password') }}">
                                        </div>
                                        <div style="margin-bottom: 20px">
                                            <span class="input-error text-danger font-required" role="alert">
                                                <!-- Error handling for password -->
                                            </span>
                                        </div>

                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" name="remember"
                                                id="remember" {{ Cookie::has('email') ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="remember">{{ __('messages.remember_me') }}</label>
                                        </div>

                                        <button type="submit" class="login-form-signin"
                                            id="BtnSignin">{{ __('messages.sign_in') }}</button>

                                        <div class="row">
                                            <div class="col">
                                                <div class="d-flex justify-content-end align-items-center"
                                                    style="margin-top: 20px">
                                                    <span>{{ __('messages.forgot_password') }}</span> &nbsp; &nbsp;
                                                    <a href="javascript:void(0);" class="reset-password-link"
                                                        id="resetpassword">{{ __('messages.reset') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>



                                    <form action="javascript:void(0);" class="register-form" id="registerForm">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="input-group mb-0">
                                                <span class="input-group-text" id="basic-addon1"><i
                                                        class="fa-solid fa-user-tie"></i></span>
                                                <select class="form-select" name="role_id" id="role_id"
                                                    aria-label="Username" placeholder="SELECT TYPE"
                                                    aria-describedby="basic-addon1">
                                                    <option value="" selected>
                                                        {{ __('messages.please_select') }}</option>
                                                    <option value="2">{{ __('messages.i_am_a_professional') }}
                                                    </option>
                                                    <option value="3">
                                                        {{ __('messages.looking_for_professional_support') }}
                                                    </option>
                                                </select>
                                            </div>
                                            <div>
                                                <span class="input-error text-danger font-required" role="alert">
                                                    <normal register-data-input-error="role_id"></normal>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row mb-3 d-none" id="row_user_category_id">
                                            <div class="input-group mb-0">
                                                <span class="input-group-text" id="basic-addon1"><i
                                                        class="fa-solid fa-user-tie"></i></span>
                                                <select class="form-select" name="user_category_id"
                                                    id="user_category_id" aria-label="Username"
                                                    placeholder="SELECT TYPE" aria-describedby="basic-addon1">
                                                    <option value="" selected>
                                                        {{ __('messages.select_profession_type') }}</option>
                                                    @php
                                                        $front_category_list = GetCategoryList();
                                                        // prx($front_category_list);
                                                    @endphp
                                                    @foreach ($front_category_list as $list)
                                                        <option value="{{ $list->id }}">{{ $list->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div>
                                                <span class="input-error text-danger font-required" role="alert">
                                                    <normal register-data-input-error="user_category_id"></normal>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="row mb-3 d-none" id="row_sport_category_id">
                                            <div class="input-group mb-0">
                                                <span class="input-group-text" id="basic-addon1"><i
                                                        class="fa-solid fa-futbol"></i></span>
                                                <span class="sub-multiple-catepopbox" id="basic-addon1"></span>
                                                <select class="form-select selectpicker" name="sport_category_id[]"
                                                    id="choices-multiple-remove-button" aria-label="Sport"
                                                    placeholder="SELECT SPORT" aria-describedby="basic-addon2"
                                                    multiple>
                                                    {{-- <option value="">SELECT SPORT</option> --}}
                                                    @php
                                                        $sport_list = GetSportList();
                                                    @endphp
                                                    @foreach ($sport_list as $list)
                                                        <option value="{{ $list->id }}">{{ $list->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div>
                                                <span class="input-error text-danger font-required" role="alert">
                                                    <normal register-data-input-error="sport_category_id"></normal>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="input-group mb-3 mb-sm-0">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="fa-regular fa-user"></i></span>
                                                    <input type="text" class="form-control" name="fullname"
                                                        id="fullname" placeholder="Full Name" aria-label="Username"
                                                        aria-describedby="basic-addon1">
                                                </div>
                                                <div>
                                                    <span class="input-error text-danger font-required"
                                                        role="alert">
                                                        <normal register-data-input-error="fullname"></normal>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6">
                                                <div class="input-group mb-3 md-sm-0">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="fa-regular fa-user"></i></span>
                                                    <input type="text" class="form-control" name="displayname"
                                                        id="displayname" placeholder="User Name"
                                                        aria-label="Username" aria-describedby="basic-addon1">
                                                </div>

                                                <div style="margin-bottom: 20px">
                                                    <span class="input-error text-danger font-required"
                                                        role="alert">
                                                        <normal register-data-input-error="displayname"></normal>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="input-group mb-0">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="fa-solid fa-at"></i></span>
                                            <input type="email" class="form-control" placeholder="EMAIL"
                                                name="email" id="email" aria-label="Username"
                                                aria-describedby="basic-addon1">
                                        </div>
                                        <div style="margin-bottom: 20px">
                                            <span class="input-error text-danger font-required" role="alert">
                                                <normal register-data-input-error="email"></normal>
                                            </span>
                                        </div>



                                        <div class="input-group mb-0">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="fa-solid fa-key"></i></span>
                                            <input type="password" class="form-control" placeholder="PASSWORD"
                                                name="password" id="password" aria-label="Username"
                                                aria-describedby="basic-addon1">
                                        </div>
                                        <div style="margin-bottom: 20px">
                                            <span class="input-error text-danger font-required" role="alert">
                                                <normal register-data-input-error="password"></normal>
                                            </span>
                                        </div>



                                        <div class="input-group mb-0">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="fa-solid fa-key"></i></span>
                                            <input type="password" class="form-control"
                                                placeholder="CONFIRM PASSWORD" aria-label="Username"
                                                name="password_confirmation" id="password_confirmation"
                                                aria-describedby="basic-addon1">
                                        </div>
                                        <div style="margin-bottom: 20px">
                                            <span class="input-error text-danger font-required" role="alert">
                                                <normal register-data-input-error="password_confirmation"></normal>
                                            </span>
                                        </div>


                                        {{-- <div class="input-group mb-0">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="fa-solid fa-city"></i></span>
                                            <input type="text" class="form-control" placeholder="YOUR CITY"
                                                aria-label="Username" name="city" id="city"
                                                aria-describedby="basic-addon1">
                                        </div>
                                        <div style="margin-bottom: 20px">
                                            <span class="input-error text-danger font-required" role="alert">
                                                <normal register-data-input-error="city"></normal>
                                            </span>
                                        </div>


                                        <div class="input-group mb-0">
                                            <span class="input-group-text" id="basic-addon1"></span>
                                            <input type="text" class="form-control" placeholder="YOUR STATE"
                                                aria-label="Username" name="state" id="state"
                                                aria-describedby="basic-addon1">
                                        </div>
                                        <div style="margin-bottom: 20px">
                                            <span class="input-error text-danger font-required" role="alert">
                                                <normal register-data-input-error="state"></normal>
                                            </span>
                                        </div>


                                        <div class="input-group mb-0">
                                            <span class="input-group-text" id="basic-addon1"></span>
                                            <input type="text" class="form-control" placeholder="YOUR COUNTRY"
                                                aria-label="Username" name="country" id="country"
                                                aria-describedby="basic-addon1">
                                        </div>
                                        <div style="margin-bottom: 20px">
                                            <span class="input-error text-danger font-required" role="alert">
                                                <normal register-data-input-error="country"></normal>
                                            </span>
                                        </div> --}}


                                        <div class="mb-1 form-check">
                                            <input type="checkbox" name="newslatter" class="form-check-input"
                                                id="exampleCheck1" checked>
                                            <label class="form-check-label"
                                                for="exampleCheck1">{{ __('messages.subscribe_to_newsletter') }}</label>
                                        </div>


                                        {{-- <div class="mb-0 form-check">
                                            <input type="checkbox" class="form-check-input" id="privacy_policy"
                                                name="privacy_policy">
                                            <label class="form-check-label" for="exampleCheck1">I accept the Terms
                                                of
                                                Service and Privacy Policy</label>
                                        </div> --}}
                                        <div class="mb-0 form-check">
                                            <input type="checkbox" class="form-check-input" id="privacy_policy"
                                                name="privacy_policy">
                                            <label class="form-check-label" for="privacy_policy">
                                                {{ __('messages.i_accept_the') }}
                                                <a
                                                    href="{{ route('pages', ['slug' => 'terms-of-service']) }}">{{ __('messages.terms_of_service') }}</a>
                                                {{ __('messages.and') }}
                                                <a
                                                    href="{{ route('pages', ['slug' => 'privacy-policy']) }}">{{ __('messages.privacy_policy') }}</a>
                                            </label>
                                        </div>

                                        <div style="margin-bottom: 20px">
                                            <span class="input-error text-danger font-required" role="alert">
                                                <normal register-data-input-error="privacy_policy"></normal>
                                            </span>
                                        </div>


                                        <button type="submit" class="register-sign-up"
                                            id="btnSignUp">{{ __('messages.sign_up') }}
                                        </button>

                                    </form>
                                    <div class="alert alert-success mt-5 d-none" id="msg_sign_up">
                                        "{{ __('messages.registration_success') }}"
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
             <button type="button" class="btn btn-primary">Save changes</button>
             </div> -->
            </div>
        </div>
    </div>

    <div class="modal fade" id="forgotpasswordmodal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog siguplogin-dailog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row m-0">
                        <div class="col-5 p-0">
                            <img class="img-fluid login-img-popup"
                                src="{{ asset('frontend/img/our-clients-img.png') }}" alt="">
                        </div>

                        <div class="col-7 p-0">

                            <div class="login-register-form-box">
                                <div class="forgot-register-box">
                                    <a href="javascript:void(0);" class="forgotpassword-text login-active"
                                        id="forgotpasswordtab">{{ __('messages.forgot_password') }}</a>
                                    <a href="javascript:void(0);" class="reset-text"
                                        id="InputOtpTab">{{ __('messages.input_otp') }}</a>
                                    <a href="javascript:void(0);" class="reset-text"
                                        id="UpdatePasswordTabe">{{ __('messages.update_password') }}</a>
                                </div>


                                <form action="javascript:void(0);" class="login-form forget-password-form"
                                    id="forgotpasswordform">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa-solid fa-user-plus"></i>
                                        </span>
                                        <input type="email" class="form-control" placeholder="EMAIL"
                                            name="email" id="otp_email" aria-label="email"
                                            aria-describedby="basic-addon1">
                                    </div>
                                    <div id="otp_msg_email" class="mb-3">
                                        <span class="input-error text-danger font-required" role="alert">
                                            <normal sendotp-data-input-error="email"></normal>
                                        </span>

                                    </div>
                                    <button class="login-form-signin"
                                        id="sendotp">{{ __('messages.send_otp') }}</button>

                                    <div class="row">
                                        <div class="col">
                                            <div class="d-flex justify-content-end align-items-center"
                                                style="margin-top: 20px">
                                                <span>{{ __('messages.return_back_to') }}</span> &nbsp; &nbsp;
                                                <a href="javascript:void(0);" class="login-password-link"
                                                    id="loginpassword">{{ __('messages.login') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="alert alert-danger mt-3" id="error-message" style="display: none;">
                                    </div>
                                </form>


                                <form action="javascript:void(0);" class="input-otp-form d-none" id="verifyOtpForm">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon2"><i
                                                class="fa-solid fa-key"></i></span>
                                        <input type="text" class="form-control" placeholder="INPUT OTP"
                                            name="otp" id="input_otp" aria-label="OTP"
                                            aria-describedby="basic-addon2">
                                    </div>
                                    <div id="otp_msg_email" class="mb-3">
                                        <span class="input-error text-danger font-required" role="alert">
                                            <normal verifyOtp-data-input-error="otp"></normal>
                                        </span>

                                    </div>

                                    <button type="submit" class="register-sign-up"
                                        id="submitotp">{{ __('messages.submit') }}</button>
                                </form>

                                <div class="alert alert-success mt-5" id="successMessage" style="display: none;">
                                    {{ __('messages.otp_submission_success') }}
                                </div>


                                <form action="javascript:void(0);" class="update-password-form d-none"
                                    id="updatepasswordform">

                                    <input type="hidden" value="" name="otp" id="UpdatePasswordOptFild">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon3"><i
                                                class="fa-solid fa-lock"></i></span>
                                        <input type="password" class="form-control" placeholder="Password"
                                            name="password" id="update_password" aria-label="Password"
                                            aria-describedby="basic-addon3">

                                    </div>

                                    <div id="otp_msg_email" class="mb-3">
                                        <span class="input-error text-danger font-required" role="alert">
                                            <normal updatepassword-data-input-error="password"></normal>
                                        </span>

                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon4"><i
                                                class="fa-solid fa-lock"></i></span>
                                        <input type="password" class="form-control" placeholder="Confirm Password"
                                            name="confirmpassword" id="confirmpassword" aria-label="Confirm Password"
                                            aria-describedby="basic-addon4">

                                    </div>
                                    <div id="otp_msg_email" class="mb-3">
                                        <span class="input-error text-danger font-required" role="alert">
                                            <normal updatepassword-data-input-error="confirmpassword"></normal>
                                        </span>
                                    </div>



                                    <div class="alert alert-success mt-3" id="password-success"
                                        style="display: none;"></div>

                                    <button type="submit" class="register-sign-up"
                                        id="updatepassword">{{ __('messages.update_password') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- footer start  -->



    <!-- subscribe Modal -->
    <div class="modal fade" id="subscribelistModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog siguplogin-dailog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="padding: 0px; border-bottom: 0px;">
                    <button data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row m-0">
                        <div class="container">
                            <div class="subscription-section">
                                <h2 class="subscription-head">{{ __('messages.upgrade') }}</h2>
                                <div class="grid-subscription">
                                    @foreach ($subscriptions as $key => $value)
                                        @if ($value->price != 0)
                                            <div class="home-subscrit-card-item">
                                                <div class="subscrit-card-item">
                                                    <p class="subscrit-free-btn">
                                                        {{ $value->title }}
                                                    </p>
                                                    <div class="subscrit-free-datatext">
                                                        <span class="free-month-text"><span class="euro-text"><i
                                                                    class="fa-solid fa-euro-sign"></i>
                                                                {{ $value->price }}</span>
                                                            {{ $value->model_type == '1' ? 'Month' : 'Year' }}</span>

                                                        @foreach ($value->SubscriptionDescription as $list)
                                                            @if ($list->description != '')
                                                                <p> {{ $list->description }}</p>
                                                            @endif
                                                        @endforeach
                                                        @auth
                                                            @php
                                                                $user = Auth::user();
                                                            @endphp

                                                            <a href="{{ route('payment', ['subscription' => $value->id]) }}"
                                                                class="card-subscription-btn
                                                                {{ $user->is_subscribe == '1' ? ($user->subscription_id == $value->id ? 'btn-disabled' : '') : '' }}">
                                                                {{ $user->is_subscribe == '1' ? ($user->subscription_id == $value->id ? 'SUBSCRIBED' : 'SUBSCRIBE NOW') : 'SUBSCRIBE NOW' }}
                                                            </a>
                                                        @else
                                                            <a class="navbar-sign-upbtn unlog-subscription-btn"
                                                                href="javascript:void(0);" data-bs-toggle="modal"
                                                                data-bs-target="#siguploginModal"
                                                                onclick=" clearErrors()">{{ __('messages.subscribe_now') }}</a>
                                                        @endauth

                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade add-video-to-lesson-modal" id="addVideoToLessonModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md"> <!-- Set max-height property -->
            <div class="modal-content">
                <div class="modal-header">
                    <h2>{{ __('messages.add_to_lessons') }}</h2>
                    <button data-bs-dismiss="modal" class="custom-modal-closebtn"><i
                            class="fa-regular fa-circle-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <div class="add-lesson-video-container">

                    </div>
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary video-add-to-lesson-submit-button']) !!} <!-- Submit button -->
                </div>
                <div class="alert alert-success add_video_to_lesson_msg d-none mt-2">
                    <strong>{{ __('messages.success') }}</strong> {{ __('messages.video_added_to_lessons') }}
                </div>
                <div class="alert alert-danger add_video_to_lesson_error_msg d-none mt-2">
                    <strong>{{ __('messages.oops') }}</strong> {{ __('messages.check_details') }}
                </div>
            </div>
        </div>
    </div>

    <!-- footer end  -->
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/all.min.js') }}"></script>
    {{-- <script src="{{ asset('frontend/js/masonry.min.js') }}"></script> --}}
    <script src="{{ asset('frontend/js/wookmark.min.js') }}"></script>
    {{-- <script src="{{ asset('frontend/js/jquery.wallyti.js') }}"></script> --}}

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"
        integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('assets/js/choices.js') }}"></script>
    <script src="{{ asset('backend/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
        integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />



    <script defer src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_api_key') }}" async
        defer></script>

    <script>
        // Initialize the Google Maps Places Autocomplete
        function initAutocomplete(box_id = 'address') {
            const input = document.getElementById(box_id);
            const options = {
                types: ["geocode"], // Allows full address
            };

            const autocomplete = new google.maps.places.Autocomplete(input, options);

            autocomplete.addListener("place_changed", function() {
                const place = autocomplete.getPlace();

                if (!place.geometry) {
                    return;
                }

                let fullAddress = "";
                let city = "";
                let state = "";
                let country = "";

                // Extract city, state, and country from address components
                place.address_components.forEach(function(component) {
                    const types = component.types;
                    if (types.includes("locality")) {
                        city = component.long_name;
                    }
                    if (types.includes("administrative_area_level_1")) {
                        state = component.long_name;
                    }
                    if (types.includes("country")) {
                        country = component.long_name;
                    }
                });

                // Combine city, state, and country into one full address string
                fullAddress = `${city ? city + ", " : ""}${state ? state + ", " : ""}${
                        country ? country : ""
                        }`;


                // Set the full address in the input field
                document.getElementById("address").value = fullAddress;
                // Set the values in the input fields
                document.getElementById("city").value = city;
                document.getElementById("state").value = state;
                document.getElementById("country").value = country;
            });
        }

        // Load Google Maps API and initialize autocomplete on load
        window.onload = function() {
            initAutocomplete();
        };
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const professionalCategorySelect = document.querySelector('.header-search-category');
            const professionalCheckboxes = document.querySelectorAll(
                '#professional-list, #video-list'); // Target the professional checkboxes
            const professionalLabels = document.querySelectorAll(
                '.professional-category, .video-menu'); // Labels corresponding to the checkboxes

            professionalCheckboxes.forEach((checkbox, index) => {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        // Update the display label with the selected category
                        const selectedLabel = professionalLabels[index].innerText;
                        professionalCategorySelect.innerHTML = selectedLabel +
                            ' <span><i class="fa-solid fa-chevron-down"></i></span>';

                        // Uncheck other checkboxes to ensure only one category is selected at a time
                        professionalCheckboxes.forEach(cb => {
                            if (cb !== this) {
                                cb.checked = false;
                            }
                        });
                    } else {
                        // Reset to default 'Select' when no category is selected
                        professionalCategorySelect.innerHTML = '{{ __('messages.Select') }}' +
                            ' <span><i class="fa-solid fa-chevron-down"></i></span>';
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categorySelectBox = document.querySelector('#professional-selectbox');
            const categorySelect = categorySelectBox.querySelector('.header-search-category');
            const categoryCheckboxes = categorySelectBox.querySelectorAll('.category_checked_inpt');
            const categoryLabels = categorySelectBox.querySelectorAll('.form-check label');

            categoryCheckboxes.forEach((checkbox, index) => {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        // Update the category select label with the selected category
                        const selectedLabel = categoryLabels[index].innerText;
                        categorySelect.innerHTML = selectedLabel +
                            ' <span><i class="fa-solid fa-chevron-down"></i></span>';

                        // Uncheck other checkboxes to ensure single selection
                        categoryCheckboxes.forEach(cb => {
                            if (cb !== this) {
                                cb.checked = false;
                            }
                        });
                    } else {
                        // Reset to default 'Category' label when deselected
                        categorySelect.innerHTML = '{{ __('messages.Category') }}' +
                            ' <span><i class="fa-solid fa-chevron-down"></i></span>';
                    }
                });
            });
        });
    </script>

    <script>
        var base_url = "{{ url('/') }}";
    </script>

    <script>
        // Function to change language
        function changeLanguage() {
            let currentLang = '{{ session('locale') }}';
            let newLang = currentLang === 'en' ? 'fr' : 'en';
            window.location.href = base_url + '/public/lang/' + newLang;
        }
    </script>


    {{-- Onchange value store in hidden field --}}

    <script>
        $(document).ready(function() {


            // main category onchange
            $('.main_category_checked_inpt').on('change', function() {
                var selectedMainCategories = [];
                $('.main_category_checked_inpt:checked').each(function() {
                    selectedMainCategories.push($(this).val());
                });

                $('#selected_main_categories').val(selectedMainCategories.join(','));
            });
            $('.main_category_checked_inpt').trigger('change');


            // sub category onchange

            $('.category_checked_inpt').on('change', function() {
                var selectedCategories = [];
                $('.category_checked_inpt:checked').each(function() {
                    selectedCategories.push($(this).val());
                });

                $('#selected_categories').val(selectedCategories.join(','));
            });
            $('.category_checked_inpt').trigger('change');

        });
    </script>
    {{-- Form submit for slected category --}}
    <script>
        $(document).ready(function() {
            $('.video-menu').click(function() {
                $('#professional-selectbox').hide();
                $('#professional-list').prop('checked', false);
                var isChecked = $('#video-list').prop('checked');
                $('#subCategory').toggle();


            });



            $('.professional-category').click(function() {
                var isChecked = $('#professional-list').prop('checked');
                $('#subCategory').hide();
                $('#video-list').prop('checked', false);
                // if (!isChecked) {
                $('#professional-selectbox').toggle();
                // }
            });





        });

        $(document).ready(function() {
            $('.category_checked_inpt').click(function() {
                var isChecked = $(this).prop('checked');
                var isChecked = $(this).attr('checked') !== undefined;
                if (isChecked) {
                    $(this).removeAttr('checked');
                } else {
                    $(this).attr('checked', 'checked');
                }
                $(this).prop(isChecked);

            });
            $('.btn_search_phisio').click(function() {

                // var selectCat = $('.currentlyActive').text();
                var selectCat = $('.main_category_checked_inpt:checked').val();


                // var isChecked = $('.category-selectbox').prop('checked');

                var formAction = "{{ route('front.video-list') }}";
                if (selectCat === 'professional-list') {
                    formAction = "{{ route('front.professional-list') }}";
                } else {

                    formAction = "{{ route('front.video-list') }}";

                }


                $('#frm_search_phisio').attr('action', formAction);
                $('#frm_search_phisio').submit();
            });


        });
    </script>

    <script>
        var watchedVideoesIds = [];
        $(document).ready(function() {
            $('.register-text').click(function() {
                $('.login-form').hide();
                $('.register-form').show();
                $('.login-text').removeClass('login-active');
                $(this).addClass('login-active');
            });
            $('.login-text').click(function() {
                $('.login-form').show();
                $('.register-form').hide();
                $(this).addClass('login-active');
                $('.register-text').removeClass('login-active');
            });

            $(".play-bt").click(function() {
                $('.play-bt').show();
                $('.pause-bt').hide();
                $('.videotag-play video').each(function() {
                    this.pause();
                });
                var nearestId = $(this).closest('.videotag-play').find('video').attr('id');
                $(this).hide();
                $(this).closest('.video-titile-group').find('.pause-bt').show();
                var ban_video = document.getElementById(nearestId);
                ban_video.play();
                var id = $(this).data('id');
                var videoActionsElement = $(this).closest('.videotag-play').find('.video-actions');

                if (watchedVideoesIds.indexOf(id) === -1) {
                    watchedVideoesIds.push(id);
                    var currentCount = parseInt(videoActionsElement.attr('data-bs-original-title'), 10);
                    addVideoCount(id);
                    if (!isNaN(currentCount)) {
                        var newCount = currentCount + 1;
                        videoActionsElement.attr('data-bs-original-title', newCount);

                    } else {
                        console.error('Invalid count value in title attribute');
                    }
                }

            });

            $(".pause-bt").click(function() {
                var nearestId = $(this).closest('.videotag-play').find('video').attr('id');
                $(this).hide();
                $(this).closest('.video-titile-group').find('.play-bt').show();
                var ban_video = document.getElementById(nearestId);
                ban_video.pause();
                tabView("#wookmark4");
            });

            $('.header-search-category').click(function() {
                $(this).siblings('.category-show').toggle();
                $(this).find('svg').toggleClass('fa-chevron-down fa-chevron-right');
            });

        });

        function addVideoCount(video_id) {
            var formData = new FormData();
            formData.append('video_id', video_id);

            $.ajax({
                type: 'POST',
                url: "{{ route('add.video.watch-count') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.warn('Success:', response);

                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error('Error:', error);
                }
            });

        }
    </script>

    <script>
        $(document).ready(function() {

            //Frontend Header Code
            $(window).scroll(function() {
                if ($(window).scrollTop() > 50) {
                    $('#header-sticky').addClass('sticky');
                }
                if ($(window).scrollTop() < 51) {
                    $('#header-sticky').removeClass('sticky');
                }
            });

            $(window).scroll(function() {
                if ($(window).scrollTop() > 50) {
                    $('#mobile-header-sticky').addClass('sticky');
                }
                if ($(window).scrollTop() < 51) {
                    $('#mobile-header-sticky').removeClass('sticky');
                }
            });

            let mainNavLinks = document.querySelectorAll(".left-side li a");
            let mainSections = document.querySelectorAll(".right div");

            let lastId;
            let cur = [];

            window.addEventListener("scroll", event => {
                let fromTop = window.scrollY;

                mainNavLinks.forEach(link => {
                    let section = document.querySelector(link.hash);

                    if (
                        section.offsetTop <= fromTop &&
                        section.offsetTop + section.offsetHeight > fromTop
                    ) {
                        link.classList.add("current");
                    } else {
                        link.classList.remove("current");
                    }
                });
            });


            $('#btn_subscribe').click(function(event) {
                var email = $('#sub_email').val();
                $('#error_msg_sub_email').html('');
                if (email == '') {
                    $('#error_msg_sub_email').html('Please input email').css('color', 'red');
                }
                var formData = new FormData();
                formData.append('email', email);

                $('#btn_subscribe').click(function(event) {
                    var email = $('#sub_email').val();
                    $('#error_msg_sub_email').html('');
                    if (email == '') {
                        $('#error_msg_sub_email').html('Please input email').css('color', 'red');
                    }
                    var formData = new FormData();
                    formData.append('email', email);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        method: 'post',
                        url: "{{ route('store-news-letter') }}",
                        data: formData,
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            $('#msg_subscribe').html('Detail sent successfully!')
                                .addClass(
                                    'alert-success').show();
                            $('#sub_email').val('');
                            setTimeout(function() {
                                $('#msg_subscribe').hide();
                            }, 5000);
                        },
                        error: function(xhr, status, error) {
                            // Handle error
                        }
                    });
                });
            });



            $(document).ready(function() {
                $('#registerForm').submit(function() {
                    $('#btnSignUp').prop('disabled', true).html('Signing Up...');
                    $('#msg_sign_up').addClass('d-none');

                    clearErrors();
                    var formData = new FormData(this);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "post",
                        url: "{{ route('store-register-form') }}",
                        dataType: "json",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            $('#msg_sign_up').removeClass('d-none');
                            $('.login-text').addClass('login-active');
                            $('.register-text').removeClass('login-active');
                            $('#loginForm').show();
                            $('#registerForm').hide();
                            resetForm('#registerForm');
                            $('#btnSignUp').prop('disabled', false).html('SIGN UP');
                        },
                        error: function(response, status, error) {
                            manageErrors(response.responseText, 'registerForm',
                                'register');
                            $('#btnSignUp').prop('disabled', false).html('SIGN UP');
                        }
                    });
                });
            });

            // $(document).ready(function() {
            //     $('#loginForm').submit(function() {
            //         clearErrors();

            //         $('#msg_sign_up').addClass('d-none');
            //         $('#BtnSignin').prop('disabled', true).html('Authenticating...');

            //         var formData = new FormData(this);


            //         $.ajaxSetup({
            //             headers: {
            //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //             }
            //         });

            //         $.ajax({
            //             type: "post",
            //             url: "{{ route('login') }}",
            //             dataType: "json",
            //             data: formData,
            //             contentType: false,
            //             processData: false,
            //             success: function(response) {
            //                 console.log(response);
            //                 // window.location.reload();
            //                 window.location.href = response.redirect_url;

            //             },
            //             error: function(response, status, error) {
            //                 manageErrors(response.responseText, 'loginForm', 'login');
            //                 $('#BtnSignin').prop('disabled', false).html('SIGN IN');


            //             }
            //         });
            //     });
            // });

            $(document).ready(function() {
                $('#loginForm').submit(function(event) {
                    event.preventDefault(); // Prevent the default form submission

                    clearErrors();
                    $('#errorBox').hide().text(''); // Clear and hide the error box initially

                    $('#BtnSignin').prop('disabled', true).html('Authenticating...');

                    var formData = new FormData(this);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "post",
                        url: "{{ route('login') }}",
                        dataType: "json",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            // Redirect to the specified URL upon successful login
                            window.location.href = response.redirect_url;
                        },
                        error: function(response) {
                            // Display error in the red box if there's a login failure
                            console.log(response.responseJSON);
                            $('#errorBox').text(response.responseJSON.message);
                            $('#errorBox').removeClass('d-none');
                            $('#errorBox').show();

                            if (response.status === 401) {

                            } else {
                                $('#errorBox').text(
                                    'An error occurred. Please try again.').show();
                            }

                            $('#BtnSignin').prop('disabled', false).html('SIGN IN');
                        }
                    });
                });
            });



            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#GetInTouchForm').submit(function() {
                clearErrors();
                var formData = new FormData(this);
                $.ajax({
                    method: 'post',
                    url: "{{ route('store-get-in-touch') }}",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#msg_request_information').html('Details sent successfully!')
                            .addClass('alert-success').show();
                        setTimeout(function() {
                            $('#msg_request_information').hide();
                        }, 5000);
                        resetForm('#GetInTouchForm');
                    },
                    error: function(response, status, error) {
                        manageErrors(response.responseText, 'GetInTouchForm', 'add');
                    }
                });
            });

        });
    </script>

    <script>
        $('#resetpassword').on('click', function(e) {
            e.preventDefault();
            $('#siguploginModal').modal('hide').on('hidden.bs.modal', function() {
                $('#forgotpasswordmodal').modal('show');
                $("#forgotpasswordform").show();
                $('#siguploginModal').off('hidden.bs.modal');
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#loginpassword").click(function() {
                $("#siguploginModal").modal('show');
                $("#forgotpasswordmodal").modal('hide');
                FormHide('forget-password-form', 'forgotpasswordtab');
            });

            $(document).on("click", ".navbar-search-btn", function(event) {
                event.stopPropagation();
                $('.mobile-menu-item').hide();

                $('.navbar-searchbar-box').show();
                $(".navbar-search-btn").find('svg').removeClass('fa-magnifying-glass').addClass('fa-xmark');
                $(".navbar-search-btn").addClass('nav-searchbar-close').removeClass('navbar-search-btn');

                // $(this).find('svg').removeClass('fa-magnifying-glass').addClass('fa-xmark');
                // $(this).addClass('nav-searchbar-close').removeClass('navbar-search-btn');
            });

            $(document).on("click", ".nav-searchbar-close", function() {
                $('.navbar-searchbar-box').hide();
                $(".nav-searchbar-close").find('svg').removeClass('fa-xmark').addClass('fa-magnifying-glass');
                $(".nav-searchbar-close").removeClass('nav-searchbar-close').addClass('navbar-search-btn');

                // $(this).find('svg').removeClass('fa-xmark').addClass('fa-magnifying-glass');
                // $(this).removeClass('nav-searchbar-close').addClass('navbar-search-btn');
            });

            // $(document).on("click", ".header-search-cat-click", function() {
            //     $(this).siblings('.category-show').toggleClass("list-active").next().toggle();
            //     $(this).find('svg').toggleClass('fa-chevron-down fa-chevron-right');
            // });

            // $(document).on("click", ".header-search-cat ul li a span", function() {
            //     $(this).closest('a').siblings('ul').toggle();
            //     $(this).find('svg').toggleClass('fa-chevron-right fa-chevron-down');
            // });

            $(document).on("click", ".header-search-cat-click", function(event) {
                event.stopPropagation(); // Prevent the click event from propagating to the document
                $(this).siblings('.category-show').toggleClass("list-active").next().toggle();
                $(this).find('svg').toggleClass('fa-chevron-down fa-chevron-right');
            });

            // Close dropdown after selecting an option
            $(document).on("click", ".category-show .form-check-input", function (event) {
                event.stopPropagation();
                $(this).closest('.category-show').removeClass('list-active').slideUp();
                $(this).closest('.category-show').siblings('.header-search-cat-click').find('i').removeClass('fa-chevron-down').addClass('fa-chevron-right');
            });

            $(document).on("click", ".header-search-cat ul li a span", function(event) {
                event.stopPropagation(); // Prevent the click event from propagating to the document
                $(this).closest('a').siblings('ul').toggle();
                $(this).find('svg').toggleClass('fa-chevron-right fa-chevron-down');
            });

            $(document).on("click", function(event) {
                if (!$(event.target).closest(
                        '.header-search-cat-click, .category-show, .header-search-cat ul li a span')
                    .length) {
                    // Close the elements and reset the chevron icons
                    $('.category-show').removeClass('list-active').hide();
                    $('.header-search-cat ul').hide();
                    $('.header-search-cat-click svg').removeClass('fa-chevron-down').addClass(
                        'fa-chevron-right');
                    $('.header-search-cat ul li a span svg').removeClass('fa-chevron-down').addClass(
                        'fa-chevron-right');
                }
            });

            // $('.click-category').click(function() {
            //     $(this).siblings('.category-show').toggleClass("list-active").next().toggle();
            //     $(this).find('svg').toggleClass('fa-chevron-down fa-chevron-right');
            // });

            // $('.category-itembox ul li a span').click(function() {
            //     $(this).closest('a').siblings('ul').toggle();
            //     $(this).find('svg').toggleClass('fa-chevron-right fa-chevron-down');
            // });


            $(".toggle-click-btn").on('click', function(event) {
                event.stopPropagation();

                $('.navbar-searchbar-box').hide();
                $(".nav-searchbar-close").find('svg').removeClass('fa-xmark').addClass('fa-magnifying-glass');
                $(".nav-searchbar-close").removeClass('nav-searchbar-close').addClass('navbar-search-btn');

                //    $("#dropdown").toggle();
                $('.mobile-menu-item').toggle();
                // $(this).find('svg').toggleClass('fa-bars fa-xmark');
                // if($(this).find('svg').hasClass('fa-bars')){
                //     $(this).find('span').text('Menu');
                // }else{
                //     $(this).find('span').text('Close');
                // };
            });

        });
    </script>

    <script>
        function FormHide(classname, BtnId) {
            $(".forget-password-form").addClass('d-none');
            $(".input-otp-form").addClass('d-none');
            $(".update-password-form").addClass('d-none');


            $("#InputOtpTab").removeClass('login-active');
            $("#forgotpasswordtab").removeClass('login-active');
            $("#UpdatePasswordTabe").removeClass('login-active');

            $("#" + BtnId).addClass('login-active');
            $('.' + classname).removeClass('d-none');
        }

        $(document).ready(function() {
            $("#forgotpasswordform").submit(function() {
                clearErrors();
                var formData = new FormData(this);

                $.ajax({
                    method: 'post',
                    url: "{{ route('user.send.otp') }}",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        FormHide('input-otp-form', 'InputOtpTab');
                    },
                    error: function(response, status, error) {
                        manageErrors(response.responseText, 'forgotpasswordform', 'sendotp');

                    }
                });
            });

            $("#verifyOtpForm").submit(function() {
                clearErrors();
                var formData = new FormData(this);

                $.ajax({
                    method: 'post',
                    url: "{{ route('user.otp.verify') }}",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        FormHide('update-password-form', 'UpdatePasswordTabe');
                        $("#UpdatePasswordOptFild").val(response.data.otp)
                    },
                    error: function(response, status, error) {
                        manageErrors(response.responseText, 'verifyOtpForm', 'verifyOtp');

                    }
                });
            });

            $("#updatepasswordform").submit(function() {
                clearErrors();
                var formData = new FormData(this);

                $.ajax({
                    method: 'post',
                    url: "{{ route('user.set.password') }}",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(response) {

                        $('#password-success').html(response.message).css('color', 'green')
                            .show();

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    },
                    error: function(response, status, error) {
                        manageErrors(response.responseText, 'updatepasswordform',
                            'updatepassword');

                    }
                });
            });

            $('.forgotpassword-text').click(function() {
                FormHide('forget-password-form', 'forgotpasswordtab')
            });
        });

        function manageErrors(errors, containerId, param) {
            $(`[${param}-data-input-error]`).html("");
            var validation = JSON.parse(errors);
            $.each(validation.errors, function(key, value) {

                $(`[${param}-data-input-error="${key}"]`).html(value);

            })
        }

        function clearErrors() {
            $('.input-error normal').text("");
        }

        function resetForm(formId, param) {
            $(`${formId}`).trigger('reset');
            $(`${formId} .custom-file-label`).html('Choose file');
            $(`[${param}-data-input-error]`).text('');
        }
    </script>

    <script>
        $(document).ready(function() {
            $("#role_id").on("change", function() {

                var selectedRoleId = $(this).val();
                // Check if the selected role_id is equal to 2
                if (selectedRoleId === '2') {
                    // If role_id is 2, remove 'd-none' class
                    $('#row_user_category_id').removeClass('d-none');
                } else {
                    // If role_id is not 2, add 'd-none' class
                    $('#row_user_category_id').addClass('d-none');
                    $('#row_sport_category_id').addClass('d-none');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#user_category_id").on("change", function() {
                var selectedProfessionType = $(this).val();
                $('#row_sport_category_id').removeClass('d-none');
                // alert(selectedProfessionType);

            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#searchBtn').click(function() {
                $('#searchForm').submit(); // Submit the form when the search button is clicked
                $('#searchForm')[0].reset(); // Clear the form fields
            });

            $('#showSubscriptionModal').click(function() {
                event.preventDefault();
                $('#subscribelistModal').modal('show');
            });




        });
    </script>

    <script>
        function filterUsers() {
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById('user-search-input');
            filter = input.value.toLowerCase();
            ul = document.querySelector('.drp_lesson_users_list');
            li = ul.getElementsByTagName('li');

            for (i = 1; i < li.length; i++) { // Start from 1 to skip the search input field
                a = li[i].getElementsByTagName('a')[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('.notification-list').click(function(event) {
                event.preventDefault();
                var $notification = $(this).closest('li');
                var notificationId = $notification.data('id');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('update.notification.status') }}",
                    method: 'POST',
                    data: {
                        id: notificationId
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            $notification.css('background-color', '#d3d3d3');
                            $notification.find('.circle').css('display', 'none');
                            $('#msg_subscribe').html('Notification marked as read.');
                            // location.reload();
                            var slug = response.slug; // Slug response mein se le rahe hain

                            if (slug) {
                                // Notification ke slug ke saath redirect karenge
                                window.location.href =
                                    "{{ route('front.physio.bio', ['slug' => ':slug']) }}"
                                    .replace(':slug', slug);
                            } else {
                                $('#msg_subscribe').html('Slug not found for the user.');
                            }
                        } else {
                            $('#msg_subscribe').html('Failed to update notification.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                        $('#msg_subscribe').html('Error occurred while updating notification.');
                    }
                });
            });
        });
    </script>



    @yield('js')


    {{-- <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script> --}}


    {{-- <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'gu,en,es',
                // layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
            }, 'google_translate_element');
        }

        $(window).bind("load", function() {
            setTimeout(function() {

                var selectElement = document.querySelector('#google_translate_element select');
                selectElement.value = 'gu';
                selectElement.dispatchEvent(new Event('change'));
            }, 1000);
        });
    </script> --}}




</body>

</html>
