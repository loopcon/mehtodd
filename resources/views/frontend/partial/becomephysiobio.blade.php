@extends('frontend.partial.master')

@php
    $helper = new App\Helpers\Helper();
    $is_subscribed = $helper->IsUserAccess();
@endphp
@section('page-css')
    <style>
        .pac-container {
            z-index: 20000 !important;
            position: absolute !important;
        }

        .address-title {
            font-size: 1.3rem !important;
            /* padding-bottom: 5px; */
            opacity: 0.7;
            font-weight: 700;
            display: block;
        }

        .address-p {
            font-size: 1.2rem !important;
            padding-bottom: 5px;
            opacity: 0.5;
            font-weight: 600;
            display: block;
        }

        .video-custom-professional {
            /* width: fit-content ; */
            /* height: 50%; */
            object-fit: cover;
            /* Ensures that the poster covers the video size */
        }

        .video-custom-professional::-webkit-media-controls-panel {
            display: none !important;
            /* Hide video controls if needed */
        }

        @media only screen and (max-width: 768px) {
            .video-custom-professional {
                width: 100%;
                height: auto;
                /* Responsive on mobile */
            }
        }

        .videotag-play {
            position: relative;
        }

        .blocked-video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* Semi-transparent background */
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            z-index: 1;
            /* Ensure the overlay is above the video */
            pointer-events: none;
            /* Allow interaction with the video */
        }

        .blocked-video {
            text-align: center;
        }

        video {
            width: 100%;
            height: auto;
        }

        .video-titile-group {
            /* Your existing styles */
        }

        .edit-deletegroupbox {
            /* Your existing styles */
        }

        .btn-disabled {
            pointer-events: none;
            opacity: 0.5;
            /* You can adjust the opacity to visually indicate that the button is disabled */
            cursor: not-allowed;
        }

        .float-right {
            float: right;
            margin-bottom: 1%;
        }

        .video-li-mergin-top {
            top: 109px;
            color: #aba9a9;
        }

        .dropdown-menu .show {
            position: sticky !important;
            /* inset: 0px auto auto 0px; */
            margin: 0px;
            width: 100% transform: translate(0px, 40px);
            max-height: 500.609px;
            overflow: hidden;
            min-height: 162px;
        }


        #profileditModal .modal-body .seo-tab-text {
            width: 50%;
            background-color: #eeeeee;
            padding: 0px 20px;
            height: 45px;
            line-height: 40px;
            text-align: center;
            color: #000;
            text-decoration: none;
            font-size: 18px;
            font-weight: 600;
        }

        .lessoneditbtn {
            color: #198FD9;
            margin-bottom: 45px;

        }

        #lessionAddModal .modal-body .seo-tab-text {
            width: 50%;
            background-color: #eeeeee;
            padding: 0px 20px;
            height: 45px;
            line-height: 40px;
            text-align: center;
            color: #000;
            text-decoration: none;
            font-size: 18px;
            font-weight: 600;
        }

        .no-videos {
            text-align: center;
            /* Center the content horizontally */
            opacity: 0.39;
            /* Set the desired opacity value */
        }

        .shareandlikedgroup .lessonbtn,
        .chatbtn {
            background-color: #f6f6f6;
            display: inline-block;
            height: 45px;
            width: 150px;
            text-align: center;
            line-height: 45px;
            text-decoration: none;
            color: #333333;
            display: block;
        }

        .shareandlikedgroup .lessonbtn:hover,
        .chatbtn:hover {
            color: unset;
            text-decoration: unset;
        }
    </style>
    <style>
        .video-actions {
            /* position: relative; */
            /* Other styles for the container */

            .ads {
                margin-top: 8px;
            }

            .viewer-count {
                /* Your original styles for the viewer count */

                /* Add cursor pointer to indicate interactivity */
                cursor: pointer;
            }
        }
    </style>
    <style>
        .folder-icon {
            font-size: 70px;
            /* Increased size */
            color: #ffc107b0;
        }

        .folder-name {
            text-align: center;
            font-weight: bold;
            margin-top: 5px;
            color: #000;
        }

        .folder-list-item {
            text-align: center;
            cursor: pointer;
            margin-bottom: 5px;
        }

        .folder-section {
            display: none;
            padding: 20px;
        }

        .back-btn {
            margin-top: 10px;
            cursor: pointer;
            background-color: #198FD9 !important;
            float: right;
            margin-top: -30px;
            margin-right: 29px;
        }

        .img-folder-icon {
            height: 50%;
            width: 30%
        }

        .add-lessions-button {
            margin-left: 80px;
            margin-top: 35px;
        }

        .add-video-btn {
            background-color: #198FD9;
            color: #fff;
            line-height: 50px;
            width: 15%;
            text-align: center;
            border-radius: 10px;
            margin-left: 75%;
        }

        #user-list li {
            cursor: pointer;
        }
    </style>
    <style>

        .bg-primary-custom {
            background-color: #198fd9 !important;
            border-color: #198fd9 !important;
        }

        .list-group-item.active {
            background-color: #198fd9 !important;
            border-color: #198fd9 !important;
        }

        /* Ensure message container scrolls */
        #message-container {
            max-height: calc(55vh - 170px);
            overflow-y: auto;
            min-height: 20vh;
        }

        /* Chat bubbles */
        .message {
            max-width: 75%;
            word-wrap: break-word;
        }

        #user-list-block {
            height: 100%; /* Make it span the full container height */
            display: flex;
            flex-direction: column;
        }

        #user-list {
            max-height: 60vh; /* Adjust the height of the scrollable area */
            overflow-y: auto; /* Enable vertical scrolling */
        }



        /* Adjust input box for small screens */
        @media (max-width: 768px) {
            #message-container {
                padding: 1rem;
            }

            #user-list {
                max-height: 40vh; /* Smaller height for smaller screens */
            }

        }

    </style>
@endsection

@section('content')
    <div class="become-physiotherbg">

        {{-- @if ($user->role_id === 3) --}}
        {{-- Professional Users section start  --}}
        @if ($user->role_id != 3)
            <div class="physio-profile">
                <div class="container">
                    <div class="row profile-docacc-main">
                        <div class="col-12 col-md-4">
                            <div class="blue-tick-main">
                                @if ($user->profile_photo)
                                    <img class="acc-docter-img"
                                        src="{{ asset('uploads/profilephoto/' . $user->profile_photo) }}" alt="Profile Photo">
                                @else
                                    <img class="acc-docter-img" src="{{ asset('uploads/profilephoto/download (2).png') }}"
                                        alt="Default Photo">
                                @endif

                                @if ($user->apply_base === '1')
                                    <img class="blue-tick-img" src="{{ asset('frontend/img/blue-tick.png') }}"
                                        alt="">
                                @endif

                                @if (Auth::user() && $user->id === Auth::user()->id)
                                    @if ($user->apply_base === '0' || $user->apply_base === null)
                                        <a href="#" class="apply-badge-profile"
                                            id="btn-model-apply-badge">{{ __('messages.apply_badge') }}</a>




                                        @if ($user->is_ads == '1')
                                            <!-- You need to implement this method in your Video model -->
                                            <a class="m-2 mr-2"><i class="fas fa-ad" style="font-size:1.5em;"></i></a>
                                        @else
                                            <a class="m-2 mr-2" name="AdForPurchase" title="Ads Purchase"
                                                href="{{ route('profile.payment', ['ads' => $ads->id, 'profile' => $user->id]) }}">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        @endif
                                    @endif
                                @endif

                                @if (Auth::user() && $user->id !== Auth::user()->id)
                                    @if ($user->apply_base === '0' || $user->apply_base === null)
                                        <a href="#" class="apply-badge-profile"
                                            id="btn-model-report-user">{{ __('messages.report_malicious') }}
                                        </a>
                                    @endif
                                @endif


                                <div id="container-like-unlike-professinal">
                                    @if ($isproLiked > 0)
                                        <button
                                            class="btn btn-info profile-liked-btn btn-unlike-professional like-float-right"
                                            data-user-id="{{ $user->id }}">
                                            <i class="fa-solid fa-heart"></i>

                                        </button>
                                    @else
                                        {{-- <button
                                            class="btn btn-info-btn profile-liked-btn btn-like-professional   like-float-right"
                                            data-user-id="{{ $user->id }}">
                                            <i class="fa-regular fa-heart"></i>
                                        </button> --}}
                                        @auth
                                            @if (Auth::id() !== $user->id)
                                                <button
                                                    class="btn btn-info-btn profile-liked-btn btn-like-professional like-float-right"
                                                    data-user-id="{{ $user->id }}">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            @endif
                                        @endauth
                                    @endif
                                </div>





                            </div>
                            {{-- <h4 class="do-name-bio">{{ $user->first_name . $user->last_name }} </h4> --}}
                            <span class="do-name-bio profile-full-nametext" role="alert">
                                {{ $user->fullname }}
                            </span>
                            <h4 class="font-required profile-full-nametext" style="opacity: 0.5;">{{ $user->displayname }}
                            </h4>
                            <div class="twi-insta-accidmain">
                                @if ($user->twittername)
                                    <span class="twitter-accid">
                                        <i class="fa-brands fa-x-twitter"></i>
                                        <a href="{{ $user->twitterlink }}" target="_blank">{{ $user->twittername }}</a>
                                    </span>
                                @endif
                                @if ($user->instaname)
                                    <span class="insta-accid">
                                        <i class="fa-brands fa-instagram"></i>
                                        <a href="{{ $user->instalink }}" target="_blank">{{ $user->instaname }}</a>
                                    </span>
                                @endif
                            </div>
                            @if ($user->city || $user->state || $user->country)
                                <div class="row">
                                    <div>
                                        <strong class="address-title">Address</strong>
                                        <p class="address-p">
                                            @if ($user->city)
                                                {{ $user->city }}
                                            @endif
                                            @if ($user->state)
                                                {{ $user->city ? ', ' : '' }}{{ $user->state }}
                                            @endif
                                            @if ($user->country)
                                                {{ $user->city || $user->state ? ', ' : '' }}{{ $user->country }}
                                            @endif
                                            .
                                        </p>
                                    </div>
                                </div>
                            @endif




                            <div class="acc-followers-main flex-column flex-md-row">
                                <p><span>{{ $follower }}</span> {{ __('messages.followers') }}</p>
                                <p><span>{{ $profession_following_count }}</span> {{ __('messages.following') }}</p>
                                <p><span id="like_professinal_count">{{ $like_professional_count }}</span>
                                    {{ __('messages.liked') }}</p>
                            </div>

                            <div class="follow-btnmain">
                                @if (Auth::user())
                                    @if ($my_following_count > 0)
                                        <a href="javascript:void(0)"
                                            class="follow-profile-main unfollow-btn btn_unfollow">{{ __('messages.following') }}</a>
                                        </a>
                                    @else
                                        <a href="javascript:void(0)" onclick="Follow()"
                                            class="follow-profile-main follow-btn{{ $user->id === Auth::user()->id ? ' btn-disabled' : '' }} ">{{ __('messages.follow') }}
                                        </a>
                                    @endif
                                @else
                                    {{-- User is not authenticated, display the Follow button --}}
                                    <a class="follow-profile-main" href="javascript:void(0);" data-bs-toggle="modal"
                                        data-bs-target="#siguploginModal">{{ __('messages.follow') }}</a>
                                @endif
                                @if (Auth::user() && $user->id === Auth::user()->id)
                                    <a href="javascript:void(0)" class="profile-upload-btn" data-bs-toggle="modal"
                                        data-bs-target="#profileditModal">{{ __('messages.edit') }}</a>
                                @endif
                            </div>
                            <span class="follow-success-message" style="display: none; color:green; font-size:18px">
                                {{ __('messages.following_professional_redirect') }}
                            </span>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="profileditModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2>{{ __('messages.profile_edit') }}</h2>
                                        <button data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"
                                                id="profileclosebtn"></i></button>

                                    </div>
                                    <div class="modal-body">
                                        <div class="profile-tab-box">
                                            <a href="#"
                                                class="profile-tab-text profile-active">{{ __('messages.profile') }}</a>
                                            <a href="#" class="seo-tab-text">{{ __('messages.seo') }}</a>
                                            <a href="#" class="video-tab-text">{{ __('messages.video') }}</a>
                                        </div>
                                        <div class="profile-update-box">
                                            {!! Form::model($user, [
                                                'route' => ['update.professional.profile', 'slug' => $user->slug],
                                                'method' => 'PUT',
                                                'enctype' => 'multipart/form-data',
                                                'id' => 'frm_updateprofile',
                                            ]) !!}
                                            @csrf
                                            <div class="row mt-3">
                                                <div class="col-12 col-md-6 mb-3">

                                                    {!! Form::label('category', __('messages.category')) !!}
                                                    <span class="required">*</span>

                                                    {!! Form::select('category', $categories, $user->user_category_id, [
                                                        'class' => 'form-select',
                                                        'disabled' => true,
                                                    ]) !!}
                                                    {!! $errors->first('category', '<span class="text-danger">:message</span>') !!}
                                                </div>
                                                <div class="col-12 col-md-6 mb-3 sub-multiple-catepopbox">

                                                    {!! Form::label('subcategories', __('messages.sub_category')) !!}

                                                    {!! Form::select('subcategories[]', $sub_category_list, $user_category, [
                                                        'class' => 'selectpicker w-100',
                                                        'id' => '   ',
                                                        'multiple' => 'multiple',
                                                        'data-none-selected-text' => __('messages.nothing_selected'),
                                                    ]) !!}
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal register-data-input-error="subcategories"></normal>
                                                    </span>

                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    {!! Form::label('fullname', __('messages.name')) !!}
                                                    <span class="required">*</span>
                                                    {!! Form::text('fullname', $user->fullname, [
                                                        'placeholder' => __('messages.enter_name'),
                                                        'class' => 'form-control mb-2',
                                                    ]) !!}
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal register-data-input-error="fullname"></normal>
                                                    </span>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    {!! Form::label('displayname', __('messages.user_name')) !!}
                                                    <span class="required">*</span>
                                                    {!! Form::text('displayname', $user->displayname, [
                                                        'placeholder' => __('messages.enter_user_name'),
                                                        'class' => 'form-control mb-2',
                                                    ]) !!}
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal register-data-input-error="displayname"></normal>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6 mb-3">
                                                    {!! Form::label('email', __('messages.email')) !!}
                                                    <span class="required">*</span>
                                                    {!! Form::email('email', $user->email, ['placeholder' => __('messages.enter_email'), 'class' => 'form-control mb-2']) !!}
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal register-data-input-error="email"></normal>
                                                    </span>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    {!! Form::label('mobile_number', __('messages.mobile_number')) !!}
                                                    <span class="required">*</span>
                                                    {!! Form::text('mobile_number', $user->mobile_number, [
                                                        'placeholder' => __('messages.enter_mobile_number'),
                                                        'class' => 'form-control mb-2',
                                                    ]) !!}
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal register-data-input-error="mobile_number"></normal>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12 col-md-4 mb-3">
                                                    {!! Form::label('city', __('messages.city')) !!}
                                                    <span class="required">*</span>
                                                    {!! Form::text('city', $user->city, [
                                                        'placeholder' => __('messages.enter_city'),
                                                        'class' => 'form-control mb-2',
                                                        'id' => 'city',
                                                    ]) !!}
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal register-data-input-error="city"></normal>
                                                    </span>
                                                </div>
                                                {{-- <div class="col-12 col-md-4 mb-3">
                                                    {!! Form::label('state', 'State') !!}
                                                    <span class="required">*</span>
                                                    {!! Form::text('state', $user->state, [
                                                        'placeholder' => 'Enter State',
                                                        'class' => 'form-control mb-2',
                                                        'id' => 'state',
                                                    ]) !!}
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal register-data-input-error="state"></normal>
                                                    </span>
                                                </div> --}}
                                                <div class="col-12 col-md-4 mb-3">
                                                    {!! Form::label('country', __('messages.country')) !!}
                                                    <span class="required">*</span>
                                                    {!! Form::text('country', $user->country, [
                                                        'placeholder' => __('messages.enter_country'),
                                                        'class' => 'form-control mb-2',
                                                        'id' => 'country',
                                                    ]) !!}
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal register-data-input-error="country"></normal>
                                                    </span>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-12 col-md-6 mb-3">
                                                    {!! Form::label('instaname', __('messages.instagram_name')) !!}
                                                    <span class="required">*</span>
                                                    {!! Form::text('instaname', $user->name, [
                                                        'placeholder' => __('messages.enter_instagram_name'),
                                                        'class' => 'form-control mb-2',
                                                    ]) !!}
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal register-data-input-error="instaname"></normal>
                                                    </span>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    {!! Form::label('instalink', __('messages.instagram_link')) !!}
                                                    <span class="required">*</span>
                                                    {!! Form::text('instalink', $user->instalink, [
                                                        'placeholder' => 'https://www.instagram.com/your_username',
                                                        'class' => 'form-control mb-2',
                                                    ]) !!}
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal register-data-input-error="instalink"></normal>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6 mb-3">
                                                    {!! Form::label('twittername', __('messages.X_name')) !!}
                                                    <span class="required">*</span>
                                                    {!! Form::text('twittername', $user->twittername, [
                                                        'placeholder' => __('messages.enter_X_name'),
                                                        'class' => 'form-control mb-2',
                                                    ]) !!}
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal register-data-input-error="twittername"></normal>
                                                    </span>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    {!! Form::label('twitterlink', __('messages.X_link')) !!}
                                                    <span class="required">*</span>
                                                    {!! Form::text('twitterlink', $user->twitterlink, [
                                                        'placeholder' => 'https://x.com/your_username',
                                                        'class' => 'form-control mb-2',
                                                    ]) !!}
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal register-data-input-error="twitterlink"></normal>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6 mb-3">
                                                    {!! Form::label('profile_photo', __('messages.profile_photo')) !!}
                                                    {!! Form::file('profile_photo', ['class' => 'form-control mb-2', 'id' => 'profilePhotoInput']) !!}
                                                    {!! $errors->first('profile_photo', '<span class="text-danger">:message</span>') !!}
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    @if ($user->profile_photo != null)
                                                        <div class="col-md-4 text-left">
                                                            <div class="image">
                                                                <img src="{{ asset('uploads/profilephoto/' . $user->profile_photo) }}"
                                                                    class="rounded elevation-2 img_profile_photo"
                                                                    alt="Profile Photo" style="max-width: 80%;">
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="row ">
                                                <div class="col-12 col-md-6 mb-3">
                                                    @php
                                                        $helper = new App\Helpers\Helper();
                                                        $profile_video = $helper->IsUserAccess('profile_video');
                                                    @endphp
                                                    {!! Form::label('profile_video', __('messages.slider_image_video')) !!}
                                                    @if (!$profile_video)
                                                        <a href="javascript:void(0);" data-bs-target="#subscribelistModal"
                                                            data-bs-toggle="modal">{{ __('messages.upgrade_to_pro') }}</a>

                                                        {!! Form::file('profile_video[]', [
                                                            'class' => 'form-control mb-2',
                                                            'id' => 'profile_video',
                                                            'multiple' => true,
                                                            'disabled' => 'disabled',
                                                        ]) !!}
                                                    @else
                                                        {!! Form::file('profile_video[]', ['class' => 'form-control mb-2', 'id' => 'profile_video', 'multiple' => true]) !!}
                                                    @endif
                                                    {!! $errors->first('profile_video', '<span class="text-danger">:message</span>') !!}
                                                    <span class="font-required" role="alert" style="opacity: 0.5;">
                                                        {{ __('messages.max_video_size') }}
                                                    </span>
                                                    <br>
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal register-data-input-error="profile_video"></normal>
                                                    </span>
                                                </div>

                                                <div class="col-12 col-md-6 mb-3">
                                                    {!! Form::label('year_of_experience', __('messages.year_of_experience')) !!}
                                                    <span class="required">*</span>
                                                    @php
                                                        $yearofexperience = Getyearofexperience();
                                                    @endphp
                                                    {!! Form::select('year_of_experience', $yearofexperience, null, [
                                                        'class' => 'form-select ',
                                                    ]) !!}
                                                    {!! $errors->first('year_of_experience', '<span class="text-danger">:message</span>') !!}
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-12 mb-3 sub-multiple-catepopbox">
                                                    {!! Form::label('services', __('messages.services')) !!}
                                                    {!! Form::select('services[]', $services_list, $user_services, [
                                                        'class' => 'selectpicker w-100',
                                                        'id' => 'choices-multiple-remove-button',
                                                        'multiple' => 'multiple',
                                                        'data-none-selected-text' => __('messages.nothing_selected'),
                                                    ]) !!}
                                                </div>

                                            </div>


                                            <div class="row">

                                                <div class="col-12 col-md-6 mb-3">
                                                    {!! Form::label('about_sort', __('messages.about_me_short')) !!}
                                                    <span class="required">*</span>
                                                    {!! Form::textarea('about_sort', $user->about_sort, [
                                                        'placeholder' => __('messages.enter_about_me_short'),
                                                        'class' => 'form-control mb-2',
                                                        'rows' => 5,
                                                    ]) !!}
                                                    <span class="font-required" role="alert" style="opacity: 0.5;">
                                                        {{ __('messages.max_characters') }}
                                                    </span>
                                                    <br>
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal register-data-input-error="about_sort"></normal>
                                                    </span>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    {!! Form::label('about_long', __('messages.about_me_long')) !!}
                                                    <span class="required">*</span>
                                                    {!! Form::textarea('about_long', $user->about_long, [
                                                        'placeholder' => __('messages.enter_about_me_long'),
                                                        'class' => 'form-control mb-2',
                                                        'rows' => 5,
                                                    ]) !!}
                                                    <span class="font-required" role="alert" style="opacity: 0.5;">
                                                        {{ __('messages.max_characters_200') }}
                                                    </span>
                                                    <br>
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal register-data-input-error="about_long"></normal>
                                                    </span>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="row m-0">
                                                        <div class="col-8 p-0">
                                                            {!! Form::label('professionaldetalis', __('messages.professional_details_label')) !!}
                                                        </div>
                                                        <div class="col-4">
                                                            <a href="javascript:void(0)" id="addProfessionalLink"
                                                                class="float-right btn_addProfessionalLink">
                                                                {{ __('messages.add_more') }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="row mt-2 professional_section profession-inputaddbox  me-0 ms-0">
                                                        @foreach ($userProfessionals as $professional)
                                                            <div
                                                                class="d-flex align-items-center container-clone-section p-0">
                                                                {!! Form::text('professionaldetalis[]', $professional->details, [
                                                                    'placeholder' => 'Enter Professional Details',
                                                                    'class' => 'form-control mb-1',
                                                                ]) !!}
                                                                <a href="javascript:void(0)" id="delete-btn"
                                                                    class="btn btn-link btn-wave delete-btn  text-danger">
                                                                    {{ __('messages.delete') }}
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="row m-0">
                                                        <div class="col-8 p-0">
                                                            {!! Form::label('education_detalis', __('messages.education_details_label')) !!}
                                                        </div>
                                                        <div class="col-4">
                                                            <a href="javascript:void(0)" id="addEducationLink"
                                                                class="float-right add-education-btn">
                                                                {{ __('messages.add_more') }}</a>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="row mt-1 education-container profession-inputaddbox me-0 ms-0">
                                                        @foreach ($userEducations as $education)
                                                            <div
                                                                class="d-flex align-items-center  container-clone-section  p-0">
                                                                {!! Form::text('education_details[]', $education->details, [
                                                                    'placeholder' => 'Enter Education Details',
                                                                    'class' => 'form-control mb-2',
                                                                ]) !!}
                                                                {!! $errors->first('education_section', '<span class="text-danger">:message</span>') !!}
                                                                <a href="javascript:void(0)" id="delete-btn"
                                                                    class="btn btn-link btn-wave delete-btn  text-danger">
                                                                    {{ __('messages.delete') }}
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-group text-center">
                                                <div class="row mt-4">
                                                    <div class="col-md-4 offset-md-3 mx-auto my-auto">
                                                        <div class="form-group">
                                                            {{-- <label>&nbsp;</label> --}}
                                                            {!! Form::submit(__('messages.update_profile'), ['class' => 'btn btn-primary bg-primary-custom', 'id' => 'btn_profile_update']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="alert alert-success profile_update_msg d-none mt-2">
                                                        <strong>{{ __('messages.success') }}</strong>
                                                        {{ __('messages.profile_updated_successfully') }}
                                                    </div>
                                                    <div class="alert alert-danger profile_update_error_msg d-none mt-2">
                                                        <strong>{{ __('messages.oops') }}</strong>
                                                        {{ __('messages.check_details') }}

                                                    </div>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>

                                        <div class="seo-box" style="display: none">
                                            {!! Form::model(null, [
                                                'route' => ['update.seo', 'slug' => $user->slug],
                                                'method' => 'PUT',
                                                'enctype' => 'multipart/form-data',
                                                'id' => 'frm_updateseo',
                                            ]) !!}
                                            @csrf
                                            <div class="row mb-3">
                                                <div class="col-12 mt-3">
                                                    {!! Form::label('seo_title', __('messages.seo_title')) !!}
                                                    <span class="required">*</span>
                                                    {!! Form::text('seo_title', $user->seo_title, [
                                                        'placeholder' => __('messages.enter_seo_title'),
                                                        'class' => 'form-control mb-2',
                                                    ]) !!}
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal seo-data-input-error="seo_title"></normal>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    {!! Form::label('meta_keyword', __('messages.meta_keywords')) !!}
                                                    <span class="required">*</span>
                                                    {!! Form::text('meta_keyword', $user->meta_keyword, [
                                                        'placeholder' => __('messages.enter_meta_keywords'),
                                                        'class' => 'form-control mb-2',
                                                    ]) !!}
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal seo-data-input-error="meta_keyword"></normal>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    {!! Form::label('meta_description', __('messages.meta_description')) !!}
                                                    <span class="required">*</span>
                                                    {!! Form::textarea('meta_description', $user->meta_description, [
                                                        'placeholder' => __('messages.enter_meta_description'),
                                                        'class' => 'form-control mb-2',
                                                    ]) !!}
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal seo-data-input-error="meta_description"></normal>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    {!! Form::label('canonical', 'Canonical') !!}
                                                    {!! Form::text('canonical', $user->canonical, [
                                                        'placeholder' => 'Enter Canonical',
                                                        'class' => 'form-control mb-2',
                                                    ]) !!}
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal seo-data-input-error="canonical"></normal>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="form-group text-center">
                                                <div class="row mt-4">
                                                    <div class="col-md-4 offset-md-3 mx-auto my-auto">
                                                        <div class="form-group">
                                                            <label>&nbsp;</label>
                                                            {!! Form::submit('Update', ['class' => 'profile-video-submitbtn', 'id' => 'btn_seo_update']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="alert alert-success update_seo_msg d-none mt-2">
                                                        <strong>{{ __('messages.success') }}</strong>
                                                        {{ __('messages.seo_info_updated_successfully') }}
                                                    </div>
                                                    <div class="alert alert-danger update_seo_error_msg d-none mt-2">
                                                        <strong>{{ __('messages.oops') }}</strong>
                                                        {{ __('messages.check_details') }}
                                                    </div>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>

                                        <div class="profile-video-box">
                                            {!! Form::model(null, [
                                                'route' => ['add.video', 'slug' => $user->slug],
                                                'method' => 'PUT',
                                                'enctype' => 'multipart/form-data',
                                                'id' => 'addVideoForm',
                                            ]) !!}
                                            @csrf
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    {!! Form::label('videotitle', __('messages.video_title') ) !!}
                                                    <span class="required">*</span>
                                                    {!! Form::text('title', null, [
                                                        'placeholder' => __('messages.enter_video_title'),
                                                        'class' => 'form-control mb-2',
                                                    ]) !!}
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal addvideo-data-input-error="title"></normal>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <div class="profile-editmodal-cat category-border-show">
                                                        <div style="font-weight: bold !important;">
                                                            {!! Form::label('category_id', __('messages.category')) !!}
                                                            <span class="required">*</span>
                                                        </div>
                                                        <a href="javascript:void(0)" class="profile-editmodal-cat-click"
                                                            data-bs-toggle="profile-editmodal-cat" aria-expanded="false"
                                                            id="lbl_add_video_category">{{ __('messages.select_category') }}
                                                            <i class="fa-solid fa-chevron-down"></i> </a>
                                                        <ul class="category-show dropdowncatgory_list">
                                                            @if (count($phisio_user_sub_category_list) > 0)
                                                                @foreach ($phisio_user_sub_category_list as $key => $list)
                                                                    <li>
                                                                        <a href="javascript:void(0)"
                                                                            class="subcat-click-category">
                                                                            <div class="form-check">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox"
                                                                                    id="modal-category-1-{{ $list->id }}"
                                                                                    name="category_id[]"
                                                                                    value="{{ $list->id }}">
                                                                                <label class="form-check-label"
                                                                                    for="modal-category-1-{{ $list->id }}">{{ $list->name }}
                                                                                    {{-- {{ $level1 }} --}}
                                                                                </label>
                                                                            </div>
                                                                            @if (count($sub_category1_list[$key]))
                                                                                <span>
                                                                                    <i
                                                                                        class="fa-solid fa-chevron-right"></i></span>
                                                                            @endif

                                                                        </a>
                                                                        <ul>
                                                                            @if (isset($sub_category1_list[$key]))
                                                                                @foreach ($sub_category1_list[$key] as $key1 => $list1)
                                                                                    <li>
                                                                                        <a href="#"
                                                                                            class="subcat-click-category">
                                                                                            <div class="form-check">
                                                                                                <input
                                                                                                    class="form-check-input"
                                                                                                    type="checkbox"
                                                                                                    id="modal-category-2-{{ $list1->id }}"
                                                                                                    name="category_id[]"
                                                                                                    value="{{ $list1->id }}">
                                                                                                <label
                                                                                                    class="form-check-label"
                                                                                                    for="modal-category-2-{{ $list1->id }}">{{ $list1->category_name }}
                                                                                                    {{-- {{ $list1->category_name }} --}}
                                                                                                </label>
                                                                                            </div>
                                                                                            @if (count($sub_category2_list[$key][$list1->id]))
                                                                                                <span>
                                                                                                    <i
                                                                                                        class="fa-solid fa-chevron-right"></i></span>
                                                                                            @endif
                                                                                        </a>
                                                                                        <ul>
                                                                                            @if (count($sub_category2_list[$key][$list1->id]))
                                                                                                @foreach ($sub_category2_list[$key][$list1->id] as $key2 => $list2)
                                                                                                    <li><a href="#"
                                                                                                            class="subcat-click-category">
                                                                                                            <div
                                                                                                                class="form-check">
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="checkbox"
                                                                                                                    name="category_id[]"
                                                                                                                    id="modal-category-3-{{ $list2->id }}">

                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="modal-category-3-{{ $list2->id }}">{{ $list2->category_name }}
                                                                                                                </label>

                                                                                                            </div>
                                                                                                            @if (count($sub_category3_list[$key][$list1->id][$list2->id]))
                                                                                                                <span><i
                                                                                                                        class="fa-solid fa-chevron-right"></i></span>
                                                                                                            @endif
                                                                                                        </a>

                                                                                                        <ul>
                                                                                                            @if (count($sub_category3_list[$key][$list1->id][$list2->id]))
                                                                                                                @foreach ($sub_category3_list[$key][$list1->id][$list2->id] as $key3 => $list3)
                                                                                                                    <li><a href="#"
                                                                                                                            class="subcat-click-category">
                                                                                                                            <div
                                                                                                                                class="form-check">
                                                                                                                                <input
                                                                                                                                    class="form-check-input"
                                                                                                                                    type="checkbox"
                                                                                                                                    value="{{ $list3->id }}"
                                                                                                                                    name="category_id[]"
                                                                                                                                    id="modal-category-4-{{ $list3->id }}">
                                                                                                                                <label
                                                                                                                                    class="form-check-label"
                                                                                                                                    for="modal-category-4-{{ $list3->id }}">{{ $list3->category_name }}</label>
                                                                                                                            </div>

                                                                                                                        </a>
                                                                                                                    </li>
                                                                                                                @endforeach
                                                                                                            @endif
                                                                                                        </ul>
                                                                                                    </li>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </ul>
                                                                                    </li>
                                                                                @endforeach
                                                                            @endif

                                                                        </ul>

                                                                    </li>
                                                                @endforeach
                                                            @else
                                                                <!-- Display message if count is 0 -->
                                                                <div class="alert alert-warning text-danger"
                                                                    role="alert">
                                                                    {{ __('messages.update_category_from_profile') }}
                                                                </div>
                                                            @endif
                                                        </ul>
                                                        <span class="input-error text-danger font-required"
                                                            role="alert">
                                                            <normal addvideo-data-input-error="category_id"></normal>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-12 col-md-6 mb-3 sub-multiple-catepopbox">
                                                    {!! Form::label('difficulty', __('messages.difficulty')) !!}
                                                    <span class="required">*</span>
                                                    {!! Form::select('difficulty_id', $difficulty, null, [
                                                        'class' => 'selectpicker w-100 difficultyname_video',
                                                        'id' => 'choices-multiple-remove-button',
                                                    ]) !!}
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal addvideo-data-input-error="difficulty"></normal>
                                                    </span>
                                                </div>

                                                <div class="col-12 col-md-6 mb-3 sub-multiple-catepopbox">
                                                    {!! Form::label('tags', __('messages.tags')) !!}
                                                    <span class="required">*</span>

                                                    {!! Form::select('tags[]', $tags, null, [
                                                        'class' => 'selectpicker w-100',
                                                        'id' => 'choices-multiple-remove-button',
                                                        'multiple' => true,
                                                        'data-none-selected-text' => __('messages.nothing_selected'),
                                                    ]) !!}

                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal addvideo-data-input-error="tags"></normal>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-12 sub-multiple-catepopbox">
                                                    {!! Form::label('sports', 'Sports') !!}
                                                    <span class="required">*</span>

                                                    {!! Form::select('sports[]', $sports, null, [
                                                        'class' => 'selectpicker w-100',
                                                        'id' => 'choices-multiple-remove-button',
                                                        'multiple' => true,
                                                        'data-none-selected-text' => __('messages.nothing_selected'),
                                                    ]) !!}

                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal addvideo-data-input-error="sports"></normal>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    {!! Form::label('description', 'Description') !!}
                                                    <span class="required">*</span>
                                                    {!! Form::textarea('description', null, [
                                                        'placeholder' => __('messages.enter_description'),
                                                        'class' => 'form-control mb-2',
                                                    ]) !!}
                                                </div>
                                                <span class="input-error text-danger font-required" role="alert">
                                                    <normal editvideo-data-input-error="description"></normal>
                                                </span>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-3 sub-multiple-catepopbox user-is-private">
                                                    <div class="pl-4">

                                                        {!! Form::checkbox('is_private', 1, false, ['class' => 'form-check-input ', 'id' => 'isPrivateCheckbox']) !!}
                                                        {!! Form::label('isPrivateCheckbox', __('messages.is_video_private'), ['class' => 'form-check-label ml-1']) !!}
                                                    </div>
                                                </div>

                                                {{-- <div class="col-md-6 mb-3 user-select-box d-none">
                                                    {!! Form::label('user', 'Users') !!}
                                                    <span class="required">*</span>

                                                    {!! Form::select('users[]', $users, null, [
                                                        'class' => 'selectpicker w-100',
                                                        'id' => 'choices-multiple-remove-button',
                                                        'multiple' => true,
                                                        'placeholder' => 'Select Users', // Add placeholder text here
                                                    ]) !!}

                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal addvideo-data-input-error="users"></normal>
                                                    </span>
                                                </div> --}}


                                                <div class="col-md-6 mb-3 user-select-box d-none">
                                                    {!! Form::label('user', 'Users') !!}
                                                    <span class="required">*</span>

                                                    <!-- Select Picker with Search -->
                                                    {!! Form::select('users[]', $users, null, [
                                                        'class' => 'selectpicker w-100 selectpicker-container',
                                                        'id' => 'choices-multiple-remove-button',
                                                        'multiple' => true,
                                                        // 'placeholder' => 'Select Users',
                                                        'data-live-search' => 'true',
                                                        'style' => 'overflow: hidden; max-height: 100px; positon:sticky;',
                                                        // Enable search functionality in the selectpicker
                                                    ]) !!}

                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal addvideo-data-input-error="users"></normal>
                                                    </span>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-6">
                                                    {!! Form::label('thumbnail', __('messages.video')) !!}
                                                    {!! Form::file('thumbnail', [
                                                        'class' => 'form-control mb-2',
                                                        'id' => 'addVideoThumbnail',
                                                        'accept' => 'image/jpeg, image/png, image/jpg, image/gif',
                                                    ]) !!}

                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal addvideo-data-input-error="thumbnail"></normal>
                                                    </span>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="image">
                                                        <img src=""
                                                            class="rounded elevation-2 add-video-image d-none mt-3"
                                                            alt="Thumbnail" style="max-width: 80%;">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    {!! Form::label('video',  __('messages.video')) !!}
                                                    <span class="required">*</span>

                                                    {!! Form::file('video', ['class' => 'form-control mb-2', 'accept' => 'video/*', 'id' => 'video']) !!}
                                                    <span class="font-required" role="alert" style="opacity: 0.5;">
                                                        {{-- The File should not be greater than 30 Mb. --}}
                                                        {{ $description }}
                                                    </span>
                                                    <br>
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal addvideo-data-input-error="video"></normal>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="form-group text-center">
                                                <div class="row mt-4">
                                                    <div class="col-md-4 offset-md-3 mx-auto my-auto">
                                                        <div class="form-group">
                                                            <label>&nbsp;</label>

                                                            {!! Form::submit(__('messages.add_video'), ['class' => 'profile-video-submitbtn', 'id' => 'addVideoBtn']) !!}
                                                            {{-- @if ($helper->IsUserAccess('video'))
                                                            @else
                                                                {!! Form::button('Add Video', [
                                                                    'class' => 'profile-video-submitbtn',
                                                                    'data-bs-target' => '#subscribelistModal',
                                                                    'data-bs-toggle' => 'modal',
                                                                ]) !!}
                                                            @endif --}}
                                                        </div>
                                                    </div>
                                                    <div class="alert alert-success add_video_msg d-none mt-2">
                                                        <strong>{{ __('messages.success') }}</strong>
                                                        {{ __('messages.video_added_successfully') }}
                                                    </div>
                                                    <div class="alert alert-danger add_video_error_msg d-none mt-2">
                                                        <strong>{{ __('messages.oops') }}</strong>
                                                        {{ __('messages.check_details') }}
                                                    </div>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-12 col-md-5 profile-videoimgmainbox">
                            <!-- Delete button -->
                            <div id="profile-videoimg-carousel" class="owl-carousel owl-theme">
                                @foreach ($slider as $key => $slide)
                                    <div class="item">
                                        @if (Auth::check() && Auth::user()->id == $user->id)
                                            <button class="btn delete-slide-btn" data-id="{{ $slide->id }}">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        @endif

                                        @if ($slide->type === 'image')
                                            <img src="{{ asset('uploads/profilemedia/' . $slide->name) }}"
                                                class="img-fluid profile-imgbox" alt="">
                                        @else
                                            <div class="docprofile-videoimg-box videotag-play-slider">
                                                <video width="100%" height="50%"
                                                    id="video-custom-main-slider-{{ $slide->id }}"
                                                    @if ($slide->thumbnail != null) poster="{{ asset('uploads/thumbnail/' . $slide->thumbnail) }}" @endif>
                                                    <source src="{{ asset('uploads/profilemedia/' . $slide->name) }}"
                                                        type="video/mp4">
                                                    {{ __('messages.browser_not_support_video') }}
                                                </video>
                                                <div class="video-titile-group">
                                                    <div class="play-bt  play-bt-slider"><i class="fa-solid fa-play"></i>
                                                    </div>
                                                    <div class="pause-bt  pause-bt-slider" style="display:none;"><i
                                                            class="fa-solid fa-pause"></i></div>
                                                    <p class="profilevideo-text">&nbsp;</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>


                    </div>
                </div>

                <!--Professional User Edit video Modal -->
                <div class="modal fade edit-video-modal" id="profileditModal" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog  modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2>{{ __('messages.update_video') }}</h2>
                                <button data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i></button>
                            </div>
                            <div class="modal-body">
                                <div class="edit-video-container">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!--Delete Modal -->
                <div class="modal delete-video-modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ __('messages.delete_video') }}</h5>
                            </div>
                            <div class="modal-body">
                                <p>{{ __('messages.confirm_delete_video') }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary"
                                    id="finalDeleteBtn">{{ __('messages.confirm_delete_action') }}</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                    onclick="$('.delete-video-modal').modal('hide');">{{ __('messages.cancel') }}</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Delete slider Modal -->
                <div class="modal delete-slider-modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ __('messages.delete_slider_video') }}</h5>
                            </div>
                            <div class="modal-body">
                                <p>{{ __('messages.confirm_delete_video') }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary"
                                    id="finalSliderDeleteBtn">{{ __('messages.confirm_delete_action') }}</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                    onclick="$('.delete-slider-modal').modal('hide');">{{ __('messages.cancel') }}</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal delete-video-info" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ __('messages.video_deleted') }}</h5>
                            </div>
                            <div class="modal-body">
                                <p>{{ __('messages.video_deleted_successfully') }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                    onclick="window.location.reload();">{{ __('messages.close') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- doctor account  detail  end -->
                <!-- bio detail  doctor start  -->
                <div class="container">
                    <div class="row education-detail-bg">
                        <div class="col-12 col-md-4 profenall-education-main">
                            <div class="education-cap-detail">
                                <img src="{{ asset('frontend/img/user-cap.png') }}" alt="">
                                <h4>{{ __('messages.education_details') }}</h4>
                            </div>
                            <ul class="do-education-detail">
                                @if (count($userEducations) > 0)
                                    @foreach ($userEducations as $key => $value)
                                        <li><i class="fa-solid fa-chevron-right"></i>{{ $value->details }}</li>
                                    @endforeach
                                @else
                                    <h5 class="eduction-nofilltext">{{ __('messages.no_details_available') }}</h5>
                                @endif
                            </ul>
                        </div>
                        <div class="col-12 col-md-4 profenall-education-main">
                            <div class="education-cap-detail">
                                <img src="{{ asset('frontend/img/user-bag.png') }}" alt="">
                                <h4>{{ __('messages.professional_details') }}</h4>
                            </div>
                            <ul class="do-education-detail">
                                @if (count($userProfessionals) > 0)
                                    @foreach ($userProfessionals as $key => $value)
                                        <li><i class="fa-solid fa-chevron-right"></i>{{ $value->details }} </li>
                                    @endforeach
                                @else
                                    <h5 class="eduction-nofilltext">{{ __('messages.no_details_available') }}</h5>
                                @endif
                            </ul>
                        </div>
                        <div class="col-12 col-md-4 profenall-education-main">
                            <div class="education-cap-detail">
                                <img src="{{ asset('frontend/img/user-headphone.png') }}" alt="">
                                <h4>{{ __('messages.services') }}</h4>
                            </div>
                            @if (count($services) > 0)
                                @foreach ($services as $key => $value)
                                    <a href="#"
                                        class="service-boibtn">{{ isset($value->service) ? $value->service->name : '' }}</a>
                                @endforeach
                            @else
                                <h5 class="eduction-nofilltext">{{ __('messages.no_services_available') }}</h5>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="shareandlikedgroup">
                        <a href="javascript:void(0)" class="sharebtn share-active">{{ __('messages.shared') }}</a>
                        @if (Auth::check() && Auth::user()->id == $user->id)
                        <a href="javascript:void(0)" class="likedbtn">{{ __('messages.liked') }}</a>
                        @endif
                        <a href="javascript:void(0)" class="lessonbtn ">{{ __('messages.lessons') }}</a>

                        @if (Auth::check() && Auth::user()->id == $user->id)
                            <a href="javascript:void(0)" class="chatbtn">{{ __('messages.discussion') }}</a>
                        @endif
                    </div>
                    <div class="share-video-box" id="tab-share-video-box">

                        @if (Auth::check() && Auth::user()->id == $user->id)
                            <div class="d-flex justify-content-center justify-content-md-end">
                                <a href="javascript:void(0)" class="btn btn-primary mr-md-5" id="addVideoLink"
                                    style="background-color: #198FD9; border: #198FD9">+
                                    {{ __('messages.add_video') }}</a>
                            </div>
                        @endif
                        <ul class="tiles-wrap animated" id="wookmark1" data-masonry='{"percentPosition": true }'>
                            @if (count($video) === 0)
                                <div class="no-videos">
                                    <h5>{{ __('messages.no_videos_available') }}</h5>
                                </div>
                            @else
                                @foreach ($video as $key => $value)
                                    @if ($value->is_private == 1 && !$value->userVideoShowOrNot())
                                        @continue
                                    @endif

                                    <li>
                                        <div class="edit-deletegroupbox">
                                            {{-- Actions for the video owner --}}

                                            <div class="video-actions" data-placement="top"
                                                title="{{ $value->videoViewCount() }}">
                                                <span class="viewer-count">
                                                    <i class="fa-regular fa-eye"></i>
                                                </span>
                                            </div>

                                            @if (Auth::check() && Auth::user()->id == $value->user_id)
                                                @if ($value->status != 0)
                                                    @if ($value->isVideoPurchased())
                                                        <a class="m-2 mr-2"><i class="fas fa-ad"></i></a>
                                                    @else
                                                        <a class="m-2 mr-2" name="AdForPurchase"
                                                            title="{{ __('messages.ads_purchase') }}"
                                                            href="{{ route('video.payment', ['ads' => $ads->id, 'video' => $value->id]) }}">
                                                            <i class="fas fa-shopping-cart"></i>
                                                        </a>
                                                    @endif
                                                @endif

                                                <a href="javascript:void(0)" class="btn-add-video-to-lesson mt-2"
                                                    data-toggle="tooltip" data-bs-toggle="modal"
                                                    data-id="{{ $value->id }}"
                                                    title="{{ __('messages.add_to_lesson') }}"
                                                    data-bs-target="#video-lesson-model-test">
                                                    <i class="fas fa-plus"></i>
                                                </a>

                                                <button class="btn btn-info edit-video-btn profile-editpage-btn"
                                                    data-id="{{ $value->id }}">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>

                                                <button
                                                    class="btn btn-info delete-video-btn profile-deletpage-btn btn_delete_video"
                                                    data-id="{{ $value->id }}">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            @else
                                                {{-- Like or Unlike video for non-owners --}}
                                                @php
                                                    $isLiked = in_array($value->id, $likes_videos_ids);
                                                @endphp
                                                @if ($isLiked)
                                                    <button
                                                        class="btn btn-info-btn profile-liked-btn unlike-like-video-btn like-float-right"
                                                        data-video-id="{{ $value->id }}">
                                                        <i class="fa-solid fa-heart"></i>
                                                    </button>
                                                @else
                                                    <button
                                                        class="btn btn-info profile-liked-btn btn_like_video like-float-right"
                                                        data-video-id="{{ $value->id }}">
                                                        <i class="fa-regular fa-heart"></i>
                                                    </button>
                                                @endif
                                            @endif

                                            {{-- Ban button for other users --}}
                                            @if (Auth::user() && $user->id !== Auth::user()->id)
                                                <a class="m-2 mr-2 video-ban-btn" data-id="{{ $value->id }}">
                                                    <i class="fa-regular fa-ban"
                                                        title="{{ __('messages.malicious') }}"></i>
                                                </a>
                                            @endif
                                        </div>

                                        <div class="videotag-play">
                                            {{-- Video element with conditional poster --}}


                                            {{-- <video id="video-custom-professional-like-{{ $key }}"
                                                @if ($value->thumbnail != null) poster="{{ asset('uploads/thumbnail/' . $value->thumbnail) }}" @endif>
                                                <source src="{{ asset('uploads/videos/' . $value->video) }}"
                                                    type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video> --}}

                                            <video id="video-custom-professional-like-{{ $key }}"
                                                class="video-custom-professional"
                                                @if ($value->status == 0) poster="{{ asset('frontend/img/block3.jfif') }}" controls
                                                @elseif ($value->thumbnail != null)
                                                poster="{{ asset('uploads/thumbnail/' . $value->thumbnail) }}" @endif>
                                                <source src="{{ asset('uploads/videos/' . $value->video) }}"
                                                    type="video/mp4">
                                                {{ __('messages.browser_not_support_video') }}
                                            </video>


                                            {{-- Overlay for blocked videos --}}
                                            {{-- @if ($value->status == 0)
                                                <div class="blocked-video-overlay">
                                                    <div class="blocked-video">
                                                        <i class="fa-solid fa-video-slash" style="font-size: 2em;"></i>
                                                        <p>This video is blocked by admin</p>
                                                    </div>
                                                </div>
                                            @endif --}}

                                            <div class="video-titile-group">
                                                <div class="play-bt" data-id="{{ $value->id }}">
                                                    <i class="fa-solid fa-play"></i>
                                                </div>
                                                <div class="pause-bt" style="display:none;">
                                                    <i class="fa-solid fa-pause"></i>
                                                </div>
                                                <p class="docpro-therapy-title">{{ $value->title }}</p>
                                                <p class="docpro-therapy-name">
                                                    @if (isset($value['user']['displayname']) && $value['user']['displayname'] !== null)
                                                        {{ $value['user']['displayname'] }}
                                                    @else
                                                        &nbsp;
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>


                        <div class="mansory-box-bgmain">
                            <div class="msrItems">
                            </div>
                        </div>
                    </div>

                    <div class="liked-video-box" id="tab-liked-video-box">
                        <ul class="tiles-wrap animated" id="wookmark2">

                            @if (count($like) === 0)
                                <div class="no-videos">
                                    <h5>{{ __('messages.no_videos_available') }}</h5>
                                </div>
                            @else
                                @foreach ($like as $key => $value)
                                    <li>
                                        <div class="edit-deletegroupbox">
                                            @if ($value->video)
                                                <!-- Check if $value->video is not null -->
                                                <div class="video-actions"
                                                    title="{{ $value->video->videoViewCount() }}">
                                                    <span class="viewer-count">
                                                        <i class="fa-regular fa-eye"></i>
                                                    </span>
                                                </div>
                                            @endif
                                            <button
                                                class="btn btn-info profile-liked-btn unlike-like-video-btn btn_profile_liked"
                                                data-video-id="{{ $value->video_id }}">
                                                <i class="fa-solid fa-heart"></i>
                                            </button>
                                        </div>
                                        <div class="videotag-play">
                                            @if (isset($value->video))
                                                <video id="video-custom-{{ $key }}" controls
                                                    @if ($value['video']['thumbnail']) != null) poster="{{ asset('uploads/thumbnail/' . $value['video']['thumbnail']) }} @endif">
                                                    @if (!is_null($value->video->thumbnail))
                                                        <source
                                                            src="{{ asset('uploads/videos/' . $value['video']['video']) }}"
                                                            type="video/mp4">
                                                        <img src="{{ asset('uploads/thumbnail/' . $value->video->thumbnail) }}"
                                                            alt="Video Thumbnail">
                                                    @else
                                                        <source
                                                            src="{{ asset('uploads/videos/' . $value['video']['video']) }}"
                                                            type="video/mp4">
                                                    @endif
                                                    {{ __('messages.browser_not_support_video') }}.
                                                </video>

                                                <div class="video-titile-group">
                                                    <div class="play-bt"><i class="fa-solid fa-play"></i></div>
                                                    <div class="pause-bt" style="display:none;"><i
                                                            class="fa-solid fa-pause"></i></div>
                                                    <p class="docpro-therapy-title">{{ $value['video']['title'] }}</p>
                                                    <p class="docpro-therapy-name">
                                                        @if (isset($value['user']['displayname']) && $value['user']['displayname'] !== null)
                                                            {{ $value['user']['displayname'] }}
                                                        @else
                                                            &nbsp;
                                                        @endif
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        <div class="mansory-box-bgmain">
                        </div>
                    </div>


                    <div class="lesson-video-box" id="tab-lesson-video-box" style="display: none">
                        <button type="button" class="btn btn-secondary back-btn  btn-folder-back " onclick="goBack()"
                            style="display: none">
                            <i class="fas fa-arrow-left"></i> {{ __('messages.back') }}
                        </button>

                        <div id="main-section">
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <div class="follow-btnmain add-lessions-button">
                                        @if (Auth::user() && $user->id === Auth::user()->id)
                                            <a href="javascript:void(0)" class="follow-profile-main lesson-add-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target=".lessionAddModal">{{ __('messages.add_lesson') }}</a>
                                        @endif
                                    </div>
                                </div>
                                @forelse ($lessons as $key => $value)
                                    @if ($value->is_private == 1 && !$value->userLessonShowOrNot())
                                        @continue;
                                    @endif
                                    <div class="col-md-3 mb-2">
                                        <div class="folder-list-item">
                                            <img class="img-folder-icon"
                                                onclick="toggleFolder('folder{{ $value->id }}')"
                                                src="{{ asset('frontend/img/folder-icon.jpg') }}">
                                            @if (Auth::user() && $user->id === Auth::user()->id)
                                                <button class="fa-regular fa-pen-to-square edit-lesson lessoneditbtn"
                                                    data-id={{ $value->id }}>
                                                </button>
                                            @endif
                                            <p class="folder-name">{{ $value->name }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-md-2 mb-4"></div>
                                    <div class="col-md-3 mb-4">
                                        <h5 class="eduction-nofilltext">{{ __('messages.no_lessons_available') }}</h5>
                                    </div>
                                @endforelse

                                <!-- Add more folders as needed -->
                            </div>
                        </div>

                        {{-- <!-- Folder Sections -->
                        <div class="folder-section" id="folder1">
                            <div class="video-list">
                                <div class="lesson-video-box" id="tab-lesson-video-box">
                                    <ul class="tiles-wrap animated" id="wookmark4">
                                        @if (count($video) === 0)
                                            <div class="no-videos">
                                                <h5>No Videos Available.</h5>
                                            </div>
                                        @else
                                            @foreach ($video as $key => $value)
                                                @if ($value->is_private == 1 && !$value->userVideoShowOrNot())
                                                    @continue
                                                @endif
                                                <li>
                                                    <div class="videotag-play">
                                                        <div class="edit-deletegroupbox">
                                                            <div class="video-actions" data-placement="top"
                                                                data-toggle="tooltip"
                                                                title="{{ $value->videoViewCount() }}">
                                                                <span class="viewer-count">
                                                                    <i class="fa-regular fa-eye"></i>
                                                                </span>
                                                            </div>

                                                            @if (Auth::check() && Auth::user()->id == $value->user_id)
                                                                <button
                                                                    class="btn btn-info edit-video-btn profile-editpage-btn"
                                                                    data-id="{{ $value->id }}">
                                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                                </button>
                                                                <button
                                                                    class="btn btn-info delete-video-btn profile-deletpage-btn btn_delete_video"
                                                                    data-id="{{ $value->id }}">
                                                                    <i class="fa-regular fa-trash-can"></i>
                                                                </button>
                                                            @else
                                                                @php
                                                                    $isLiked = in_array($value->id, $likes_videos_ids);
                                                                @endphp
                                                                @if ($isLiked)
                                                                    <button
                                                                        class="btn btn-info-btn profile-liked-btn unlike-like-video-btn like-float-right"
                                                                        data-video-id="{{ $value->id }}">
                                                                        <i class="fa-solid fa-heart"></i>
                                                                    </button>
                                                                @else
                                                                    <button
                                                                        class="btn btn-info profile-liked-btn btn_like_video like-float-right"
                                                                        data-video-id="{{ $value->id }}">
                                                                        <i class="fa-regular fa-heart"></i>
                                                                    </button>
                                                                @endif
                                                            @endif
                                                        </div>
                                                        <video id="video-custom-professional-like-{{ $key }}"
                                                            @if ($value->thumbnail != null) poster="{{ asset('uploads/thumbnail/' . $value->thumbnail) }} @endif">
                                                            <source src="{{ asset('uploads/videos/' . $value->video) }}"
                                                                type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>

                                                        <div class="video-titile-group">
                                                            <div class="play-bt" data-id="{{ $value->id }}">
                                                                <i class="fa-solid fa-play"></i>
                                                            </div>
                                                            <div class="pause-bt" style="display:none;"><i
                                                                    class="fa-solid fa-pause"></i></div>
                                                            <p class="docpro-therapy-title">{{ $value->title }}</p>
                                                            <p class="docpro-therapy-name">
                                                                @if (isset($value['user']['displayname']) && $value['user']['displayname'] !== null)
                                                                    {{ $value['user']['displayname'] }}
                                                                @else
                                                                    &nbsp;
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    <div class="mansory-box-bgmain">
                                        <!-- Additional content for the box if needed -->
                                    </div>
                                </div>
                                <!-- Place your video list code here for folder 1 -->
                                <!-- Your existing video list code goes here -->
                            </div>
                        </div> --}}

                        @foreach ($lessons as $key => $value)
                            @if ($value->is_private == 1 && !$value->userLessonShowOrNot())
                                @continue;
                            @endif

                            {{-- <div class="folder-section" id="folder{{ $value->id }}">
                                <ul class="tiles-wrap animated lesson_id" wallyti-block-margin="10"  id="wookmark{{ $value->id }}">
                                    @if ($value->videos->isEmpty())
                                        <div class="col-md-12">
                                            <p class="novideo-text">No videos available</p>
                                        </div>
                                    @else
                                        @foreach ($value->videos as $key => $val)
                                            <li class="">
                                                <div class="video-list">
                                                    <video id="video-custom-{{ $key }}" controls width="100%">
                                                        @if (!is_null($val->video->thumbnail))
                                                            <source
                                                                src="{{ asset('uploads/videos/' . $val->video->video) }}"
                                                                type="video/mp4">
                                                            <img src="{{ asset('uploads/thumbnail/' . $val->video->thumbnail) }}"
                                                                alt="Video Thumbnail">
                                                        @else
                                                            <source
                                                                src="{{ asset('uploads/videos/' . $val->video->video) }}"
                                                                type="video/mp4">
                                                        @endif
                                                        Your browser does not support the video tag.
                                                    </video>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div> --}}

                            <div class="folder-section" id="folder{{ $value->id }}">
                                <div class="lesson_data_id" id="wookmark{{ $value->id }}">
                                    @if ($value->videos->isEmpty())
                                        <div class="col-md-12 text-center">
                                            <p>{{ __('messages.no_videos_available') }}</p>
                                        </div>
                                    @else
                                        <div class="masonry"
                                            style="webkit-column-count: 4;-moz-column-count: 4;column-count: 4;-webkit-column-gap: 1em;-moz-column-gap: 1em;column-gap: 1em;/* margin: 1.5em; */padding: 0;">

                                            @foreach ($value->videos as $key => $val)
                                                <div class="">
                                                    <div class="video-list">
                                                        <video id="video-custom-{{ $key }}" controls
                                                            width="100%"
                                                            @if ($val->video->thumbnail != null) poster="{{ asset('uploads/thumbnail/' . $val->video->thumbnail) }}" @endif>
                                                            @if (!is_null($val->video->thumbnail))
                                                                <source
                                                                    src="{{ asset('uploads/videos/' . $val->video->video) }}"
                                                                    type="video/mp4">
                                                                <img src="{{ asset('uploads/thumbnail/' . $val->video->thumbnail) }}"
                                                                    alt="Video Thumbnail">
                                                            @else
                                                                <source
                                                                    src="{{ asset('uploads/videos/' . $val->video->video) }}"
                                                                    type="video/mp4">
                                                            @endif
                                                            {{ __('messages.browser_not_support_video') }}
                                                        </video>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <div class="chat-box bg-white py-3" id="tab-chat-box" style="display: none;">
                        <div class="container-fluid d-flex flex-column h-auto">
                            <!-- Header Section -->

                            <div class="row bg-primary-custom text-white p-3">
                                <div class="col">
                                    <h5>Messages</h5>
                                </div>
                                <div class="col text-end d-md-none">
                                    <button id="toggle-user-list" class="btn btn-outline-light btn-sm">Users</button>
                                </div>
                            </div>
                            
                        
                            <!-- Main Chat Section -->
                            <div class="row flex-grow-1">
                                <!-- User List Section -->
                                <div class="col-md-4 border-end p-3 d-none d-md-block" id="user-list-block">
                                    <div class="mb-3">
                                        <input
                                            type="text"
                                            id="user-search"
                                            class="form-control"
                                            placeholder="Search users..."
                                            aria-label="Search Users"
                                        />
                                    </div>
                                    <ul class="list-group" id="user-list">
                                        <!-- Dynamically loaded user items -->
                                    </ul>
                                </div>
                        
                                <!-- Chat Section -->
                                <div class="col-md-8 d-flex flex-column">
                                    <div id="selected-user-info" class="bg-light p-3 d-flex align-items-center border-bottom">
                                        <img
                                            id="selected-user-image"
                                            src="{{ asset('uploads/profilephoto/download (2).png') }}"
                                            alt="User Avatar"
                                            class="rounded-circle me-3"
                                            width="50"
                                            height="50"
                                        />
                                        <h6 id="selected-user-name" class="mb-0">Select a User</h6>
                                    </div>

                                    <div class="flex-grow-1 overflow-auto p-3" id="message-container">
                                        <!-- Dynamically loaded messages -->
                                    </div>
                                                
                                    <!-- Input Section -->
                                    <div class="input-group p-3 border-top">
                                        <input type="hidden" id="sender_id" value="{{auth()->id()}}"> <!-- Replace with actual sender ID -->
                                        <input type="hidden" id="receiver_id" value="{{($user->id != auth()->id()) ? $user->id : ''}}"> <!-- Replace with actual receiver ID -->

                                        <input
                                            type="text"
                                            id="message-input"
                                            class="form-control"
                                            placeholder="Type a message"
                                            aria-label="Message"
                                        />
                                        <button id="send-message" class="btn btn-primary">Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Professional Users section completed  --}}
        @else
            {{-- visitor Users section start  --}}
            <div class="visitor-user-profile">
                <div class="container">
                    <div class="row profile-docacc-main profile-visiter-box">
                        <div class="col-12 col-md-4">
                            <div class="blue-tick-main">
                                @if ($user->profile_photo && $user->profile_photo != "")
                                    <img class="acc-docter-img"
                                        src="{{ asset('uploads/profilephoto/' . $user->profile_photo) }}"
                                        alt="Profile Photo">
                                @else
                                    <img class="acc-docter-img"
                                        src="{{ asset('uploads/profilephoto/download (2).png') }}" alt="Default Photo">
                                @endif

                                @if ($user->apply_base === '1')
                                    <img class="blue-tick-img" src="{{ asset('frontend/img/blue-tick.png') }}"
                                        alt="">
                                @endif

                            </div>
                            {{-- <h4 class="do-name-bio">{{ $user->first_name . $user->last_name }} </h4> --}}
                            <h4 class="do-name-bio">{{ $user->displayname }}</h4>
                            <span class="font-required profile-full-nametext" role="alert" style="opacity: 0.5;">
                                {{ $user->fullname }}
                            </span>



                            <div class="twi-insta-accidmain">
                                <span class="twitter-accid">
                                    <i class="fa-brands fa-x-twitter"></i>
                                    <a href="{{ $user->twitterlink }}" target="_blank">{{ $user->twittername }}</a>
                                </span>
                                <span class="insta-accid">
                                    <i class="fa-brands fa-instagram"></i>
                                    <a href="{{ $user->instalink }}" target="_blank">{{ $user->instaname }}</a>
                                </span>
                            </div>

                            <div class="acc-followers-main">
                                {{-- <p><span>{{ $follower }}</span> Followers</p> --}}
                                <p><span>{{ $profession_following_count }}</span> {{ __('messages.following') }}</p>
                            </div>
                            <div class="follow-btnmain">
                                @if (Auth::user())
                                    @if ($my_following_count > 0)
                                        <a href="#"
                                            class="follow-profile-main unfollow-btn btn_unfollow">{{ __('messages.unfollow') }}</a>
                                        </a>
                                    @else
                                        {{-- <a href="javascript:void(0)" onclick="Follow()"
                                            class="follow-profile-main follow-btn{{ $user->id === Auth::user()->id ? ' btn-disabled' : '' }} ">Follow
                                        </a> --}}
                                    @endif
                                @else
                                    {{-- User is not authenticated, display the Follow button --}}
                                    {{-- <a href="#" class="follow-profile-main open-login-modal">Follow</a> --}}
                                    <a class="follow-profile-main" href="javascript:void(0);" data-bs-toggle="modal"
                                        data-bs-target="#siguploginModal">{{ __('messages.follow') }}</a>
                                @endif
                                @if (Auth::user() && $user->id === Auth::user()->id)
                                    <a href="#" class="profile-upload-btn" data-bs-toggle="modal"
                                        data-bs-target="#profileditModal">{{ __('messages.edit') }}</a>
                                @endif
                            </div>
                            <span class="follow-success-message" style="display: none; color:green; font-size:18px">
                                {{ __('messages.following_professional_redirect') }}
                            </span>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="profileditModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2>{{ __('messages.profile_edit') }}</h2>
                                        <button data-bs-dismiss="modal"><i
                                                class="fa-regular fa-circle-xmark"></i></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="profile-tab-box">
                                            <a href="#"
                                                class="profile-tab-text profile-active">{{ __('messages.profile') }}</a>
                                        </div>
                                        <div class="profile-update-box">
                                            {!! Form::model($user, [
                                                'route' => ['update.professional.profile', 'slug' => $user->slug],
                                                'method' => 'PUT',
                                                'enctype' => 'multipart/form-data',
                                                'id' => 'frm_updateprofile',
                                            ]) !!}
                                            @csrf
                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    {!! Form::label('fullname', 'Full Name') !!}
                                                    <span class="required">*</span>
                                                    {!! Form::text('fullname', $user->fullname, [
                                                        'placeholder' => 'Enter Full Name',
                                                        'class' => 'form-control mb-2',
                                                    ]) !!}
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal register-data-input-error="fullname"></normal>
                                                    </span>
                                                </div>
                                                <div class="col-6">
                                                    {!! Form::label('displayname', 'User Name') !!}
                                                    <span class="required">*</span>
                                                    {!! Form::text('displayname', $user->displayname, [
                                                        'placeholder' => 'Enter User Name',
                                                        'class' => 'form-control mb-2',
                                                    ]) !!}
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal register-data-input-error="displayname"></normal>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    {!! Form::label('email', 'Email') !!}
                                                    <span class="required">*</span>
                                                    {!! Form::email('email', $user->email, ['placeholder' => 'Enter Email', 'class' => 'form-control mb-2']) !!}
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal register-data-input-error="email"></normal>
                                                    </span>
                                                </div>
                                                <div class="col-6">
                                                    {!! Form::label('mobile_number', 'Mobile Number') !!}
                                                    <span class="required">*</span>
                                                    {!! Form::text('mobile_number', $user->mobile_number, [
                                                        'placeholder' => 'Enter Mobile Number',
                                                        'class' => 'form-control mb-2',
                                                    ]) !!}
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal register-data-input-error="mobile_number"></normal>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    {!! Form::label('instaname', 'Instagram Name') !!}
                                                    <span class="required">*</span>
                                                    {!! Form::text('instaname', $user->name, [
                                                        'placeholder' => 'Enter Instagram Name',
                                                        'class' => 'form-control mb-2',
                                                    ]) !!}
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal register-data-input-error="instaname"></normal>
                                                    </span>
                                                </div>
                                                <div class="col-6">
                                                    {!! Form::label('instalink', 'Instagram Link') !!}
                                                    <span class="required">*</span>
                                                    {!! Form::text('instalink', $user->instalink, [
                                                        'placeholder' => 'https://www.instagram.com/your_username',
                                                        'class' => 'form-control mb-2',
                                                    ]) !!}
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal register-data-input-error="instalink"></normal>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    {!! Form::label('twittername', 'Twitter Name') !!}
                                                    <span class="required">*</span>
                                                    {!! Form::text('twittername', $user->twittername, [
                                                        'placeholder' => 'Enter Twitter Name',
                                                        'class' => 'form-control mb-2',
                                                    ]) !!}
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal register-data-input-error="twittername"></normal>
                                                    </span>
                                                </div>
                                                <div class="col-6">
                                                    {!! Form::label('twitterlink', 'Twitter Link') !!}
                                                    <span class="required">*</span>
                                                    {!! Form::text('twitterlink', $user->twitterlink, [
                                                        'placeholder' => 'https://twitter.com/your_username',
                                                        'class' => 'form-control mb-2',
                                                    ]) !!}
                                                    <span class="input-error text-danger font-required" role="alert">
                                                        <normal register-data-input-error="twitterlink"></normal>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    {!! Form::label('profile_photo', 'Profile Photo') !!}
                                                    {!! Form::file('profile_photo', ['class' => 'form-control mb-2', 'id' => 'profilePhotoInput']) !!}
                                                    {!! $errors->first('profile_photo', '<span class="text-danger">:message</span>') !!}
                                                </div>
                                                <div class="col-md-6">
                                                    @if ($user->profile_photo != null)
                                                        <div class="col-md-4 text-left">
                                                            <div class="image">
                                                                <img src="{{ asset('uploads/profilephoto/' . $user->profile_photo) }}"
                                                                    class="rounded elevation-2 img_profile_photo"
                                                                    alt="Profile Photo" style="max-width: 80%;">
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group text-center">
                                                <div class="row mt-4">
                                                    <div class="col-md-4 offset-md-3 mx-auto my-auto">
                                                        <div class="form-group">
                                                            <label>&nbsp;</label>
                                                            {!! Form::submit('Update Profile', ['class' => 'profile-video-submitbtn', 'id' => 'updateVideoBtn']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="alert alert-success profile_update_msg d-none mt-2">
                                                        <strong>{{ __('messages.success') }}</strong>
                                                        {{ __('messages.profile_updated_successfully') }}
                                                    </div>
                                                    <div class="alert alert-danger profile_update_error_msg d-none mt-2">
                                                        <strong>{{ __('messages.oops') }}</strong>
                                                        {{ __('messages.check_details') }}
                                                    </div>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="customer-listed-box">
                        <div class="customer-liked-group">
                            <button class="customer-liked-button">{{ __('messages.liked_videos') }}</button>
                        </div>
                        @if (count($like) > 0)
                            <ul class="tiles-wrap animated" id="wookmark3">
                                @foreach ($like as $key => $value)
                                    <li>

                                        <div class="edit-deletegroupbox">
                                            <button
                                                class="btn btn-info profile-liked-btn unlike-like-video-btn btn_profile_liked"
                                                data-video-id="{{ $value->video_id }}"><i
                                                    class="fa-solid fa-heart"></i></button>
                                        </div>
                                        <div class="videotag-play">
                                            <video id="video-custom-{{ $key }}"
                                                @if ($value->thumbnail != null) poster="{{ asset('uploads/thumbnail/' . $value->thumbnail) }}" @endif>
                                                <source src="{{ asset('uploads/videos/' . $value['video']['video']) }}"
                                                    type="video/mp4">
                                                {{ __('messages.browser_not_support_video') }}
                                            </video>
                                            <div class="video-titile-group">
                                                <div class="play-bt"><i class="fa-solid fa-play"></i></div>
                                                <div class="pause-bt" style="display:none;"><i
                                                        class="fa-solid fa-pause"></i></div>
                                                <p class="docpro-therapy-title">{{ $value['video']['title'] }}</p>
                                                <p class="docpro-therapy-name">
                                                    @if (isset($value['user']['displayname']) && $value['user']['displayname'] !== null)
                                                        {{ $value['user']['displayname'] }}
                                                    @else
                                                        &nbsp;
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="no-videos">
                                <p>{{ __('messages.no_videos_available') }}</p>
                            </div>
                        @endif
                        </ul>
                    </div>
                </div>

                

                <div class="container d-flex flex-column h-auto">
                    <div class="bg-white p-4" style="border-top: 2px dashed #707070">

                        <!-- Header Section -->

                        <div class="row bg-primary-custom text-white p-3">
                            <div class="col">
                                <h5>Messages</h5>
                            </div>
                            <div class="col text-end d-md-none">
                                <button id="toggle-user-list" class="btn btn-outline-light btn-sm">Users</button>
                            </div>
                        </div>
                        
                    
                        <!-- Main Chat Section -->
                        <div class="row flex-grow-1">
                            <!-- User List Section -->
                            <div class="col-md-4 border-end p-3 d-none d-md-block" id="user-list-block">
                                <div class="mb-3">
                                    <input
                                        type="text"
                                        id="user-search"
                                        class="form-control"
                                        placeholder="Search users..."
                                        aria-label="Search Users"
                                    />
                                </div>
                                <ul class="list-group" id="user-list">
                                    <!-- Dynamically loaded user items -->
                                </ul>
                            </div>
                    
                            <!-- Chat Section -->
                            <div class="col-md-8 d-flex flex-column">
                                <div id="selected-user-info" class="bg-light p-3 d-flex align-items-center border-bottom">
                                    @php
                                        $profile_photo = 'download (2).png';
                                        $displayname = 'Select a user to chat';
                                        if (isset($chat_user) && $chat_user != "") {
                                            $profile_photo = ($chat_user->profile_photo != "") ? $chat_user->profile_photo : 'download (2).png';
                                            $displayname = $chat_user->displayname;
                                        }
                                    @endphp
                                    <img
                                        id="selected-user-image"
                                        src="{{ asset('uploads/profilephoto/' . $profile_photo) }}"
                                        alt="User Avatar"
                                        class="rounded-circle me-3"
                                        width="50"
                                        height="50"
                                    />
                                    <h6 id="selected-user-name" class="mb-0">{{$displayname}}</h6>
                                </div>

                                <div class="flex-grow-1 overflow-auto p-3" id="message-container">
                                    <!-- Dynamically loaded messages -->
                                </div>
                                            
                                <!-- Input Section -->
                                <div class="input-group p-3 border-top">
                                    <input type="hidden" id="sender_id" value="{{auth()->id()}}"> <!-- Replace with actual sender ID -->
                                    <input type="hidden" id="receiver_id" value="{{(isset($chat_user) && $chat_user != "") ? $chat_user->id : ''}}"> <!-- Replace with actual receiver ID -->

                                    <input
                                        type="text"
                                        id="message-input"
                                        class="form-control"
                                        placeholder="Type a message"
                                        aria-label="Message"
                                    />
                                    <button id="send-message" class="btn btn-primary bg-primary-custom">Send</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            {{-- visitor Users section completed  --}}
        @endif
    </div>
    {{-- </div> --}}


    {{-- professional detail clon container --}}

    <div class="row professional-container-clone  d-none ">
        <div class="d-flex align-items-center container-clone-section p-0">
            {!! Form::text('professionaldetalis[]', null, [
                'placeholder' => 'Enter Professional Detalis',
                'class' => 'form-control mb-2',
            ]) !!}
            <a href="javascript:void(0)" id="delete-btn" class="btn btn-link btn-wave delete-btn  text-danger">
                {{ __('messages.delete') }}
            </a>
            {!! $errors->first('professionaldetalis', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>

    <div class="row education-container-clone  d-none ">
        <div class="d-flex align-items-center container-clone-section p-0">
            {!! Form::text('education_details[]', null, [
                'placeholder' => 'Enter Education Detalis',
                'class' => 'form-control mb-2',
            ]) !!}
            <a href="javascript:void(0)" id="delete-btn" class="btn btn-link btn-wave delete-btn  text-danger">
                {{ __('messages.delete') }}
            </a>
            {!! $errors->first('professionaldetalis', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>

    @if (Session::has('video_purchase'))
        @php
            $video_purchase = Session::get('video_purchase');
            Session::forget('video_purchase');
        @endphp
        @if ($video_purchase == 1)
            <!-- Modal -->
            <div class="modal fade" id="videoPurchaseSuccessModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2>{{ __('messages.ads_purchased') }}</h2>
                            <button data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i></button>
                        </div>
                        <div class="modal-body">
                            {{ __('messages.video_purchase_description') }}
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="modal fade" id="videoPurchaseSuccessModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2>{{ __('messages.video_purchase_fail') }}</h2>
                            <button data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i></button>
                        </div>
                        <div class="modal-body">
                            {{ __('messages.video_purchase_description') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
    {{-- <div class="modal fade" id="subscribelistModal" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                <h2 class="subscription-head">subscriptions </h2>
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
                                                                onclick=" clearErrors()">SUBSCRIBE NOW</a>
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
    </div> --}}


    {{-- <div class="modal fade" id="subscribelistModal" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                <h2 class="subscription-head">Upgrade Your Plan </h2>
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
                                                                onclick=" clearErrors()">SUBSCRIBE NOW</a>
                                                        @endauth
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <h6 class="text-danger text-center">Sorry, you don't have access to this feature with your
                                    current plan. Upgrade now to unlock it!</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Upload Documents Modal -->
    <div class="modal fade" id="UploadDocumentModel" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>{{ __('messages.upload_document_for_badge') }}</h2>
                    <button data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <div class="profile-update-box p-0">
                        {!! Form::model($user, [
                            'route' => ['update.document.professional.user', 'slug' => $user->slug],
                            'method' => 'PUT',
                            'enctype' => 'multipart/form-data',
                            'id' => 'frm_upload_document',
                        ]) !!}
                        @csrf
                        <div class="mb-3">
                            {{-- <div class="col-md-9"> --}}
                                {{-- {!! Form::label('apply_base', 'Upload Document') !!} --}}
                                {!! Form::file('base_documents[]', [
                                    'class' => 'form-control',
                                    'id' => 'profilePhotoInput',
                                    'multiple' => true,
                                    'accept' => '.pdf,.doc,.docx,.txt,.zip',
                                ]) !!}
                                {!! $errors->first('apply_base', '<span class="text-danger">:message</span>') !!}
                            {{-- </div> --}}
                        </div>
                        <div class="form-group text-center">
                            <div>
                                {{-- <div> --}}
                                    {{-- <div> --}}
                                        {!! Form::submit('Upload Document', ['class' => 'profile-video-submitbtn', 'id' => 'btn_update_document']) !!}
                                    {{-- </div> --}}
                                {{-- </div> --}}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="alert alert-success update_document_msg d-none mt-2">
                        <strong>{{ __('messages.success') }}</strong>
                        {{ __('messages.document_uploaded_successfully') }}
                    </div>
                    <div class="alert alert-danger update_document_error_msg d-none mt-2">
                        <strong>{{ __('messages.oops') }}</strong> {{ __('messages.error_uploading_document') }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Submit Report Modal -->

    <div class="modal fade" id="SubmitReportModel" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>{{ __('messages.report_for_malicious') }}</h2>
                    <button data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <div class="profile-update-box">
                        {!! Form::model($user, [
                            'route' => ['malicious.report.user', 'user_id' => $user->id],
                            'enctype' => 'multipart/form-data',
                            'id' => 'frm_submit_report',
                        ]) !!}
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-12">
                                {!! Form::label('description', 'Description') !!}
                                {!! Form::textarea('description', null, [
                                    'class' => 'form-control',
                                    'rows' => 4,
                                    'id' => 'Userdescription',
                                    'placeholder' => 'Enter description here...',
                                ]) !!}
                                {!! $errors->first('description', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="row mt-4">
                                <div class="col-md-4 offset-md-3 mx-auto my-auto">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        {!! Form::submit('Submit', ['class' => 'profile-video-submitbtn', 'id' => 'btn_malicious_report']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="alert alert-success d-none mt-2" id="malicious_report_msg">
                        <strong>{{ __('messages.success') }}</strong> {{ __('messages.report_submitted_successfully') }}
                    </div>
                    <div class="alert alert-danger d-none mt-2" id="malicious_report_error_msg">
                        <strong>{{ __('messages.oops') }}</strong> {{ __('messages.error_submitting_report') }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Submit Report Video Modal -->


    <div class="modal fade" id="SubmitReportVideoModel" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>{{ __('messages.report_for_malicious_video') }}</h3>
                    <button data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <div class="profile-update-box">
                        {!! Form::model($user, [
                            'route' => ['malicious.report.video'],
                            // 'route' => ['malicious.report.video', 'user_id' => $user->id],
                            'enctype' => 'multipart/form-data',
                            'id' => 'submit_form_report_video',
                        ]) !!}
                        @csrf
                        <input type="hidden" name="malicious_video_id" value=" " id="malicious_video_id">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                {!! Form::label('description', 'Video Description') !!}
                                {!! Form::textarea('description', null, [
                                    'class' => 'form-control',
                                    'rows' => 4,
                                    'id' => 'Userdescription',
                                    'placeholder' => 'Enter description here...',
                                ]) !!}
                                {!! $errors->first('description', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="row mt-4">
                                <div class="col-md-4 offset-md-3 mx-auto my-auto">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        {!! Form::submit('Submit', ['class' => 'profile-video-submitbtn', 'id' => 'btn_malicious_video_report']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="alert alert-success d-none mt-2" id="malicious_video_report_msg">
                        <strong>{{ __('messages.success') }}</strong> {{ __('messages.report_submitted_successfully') }}
                    </div>
                    <div class="alert alert-danger d-none mt-2" id="malicious_video_report_error_msg">
                        <strong>{{ __('messages.oops') }}</strong> {{ __('messages.error_submitting_report') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.profile.lession-video-add-model')


@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('js')
    <script src="https://cdn.socket.io/4.6.0/socket.io.min.js" integrity="sha384-c79GN5VsunZvi+Q/WObgk2in0CbZsHnjEqvFxC5DxHn9lTfNce2WW6h2pH6u/kF+" crossorigin="anonymous"></script>

    <script>
        var senderId = '';
        var receiverId = '';
        $(document).ready(function() {
            $('#user-search').on('input', function () {
                const query = $(this).val().toLowerCase(); // Get the search query
                $('#user-list .user-item').each(function () {
                    const userName = $(this).data('user-name').toLowerCase(); // Get the user name
                    if (userName.includes(query)) {
                        $(this).removeClass('d-none'); // Show matching user
                    } else {
                        $(this).addClass('d-none'); // Hide non-matching user
                    }
                });
            });

            $('#toggle-user-list').on('click', function () {
                $('#user-list-block').toggleClass('d-none');
            });

            senderId = $('#sender_id').val();
            receiverId = $('#receiver_id').val();

            $('#message-input').on('keydown', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault(); // Prevent default behavior of Enter
                    $('#send-message').click(); // Trigger send message button click
                }
            });

            // get user chat

            function fetchChatUsers() {
                $.ajax({
                    url: "{{ route('get.chat.users') }}",
                    method: "GET",
                    success: function (users) {
                        const userList = $("#user-list");
                        userList.empty(); // Clear the current list

                        users.forEach((user) => {
                            const isActive = user.id == receiverId ? 'active' : '';

                            const userItem = `
                                <li class="list-group-item d-flex align-items-center user-item ${isActive}" 
                                    data-user-id="${user.id}" 
                                    data-user-name="${user.displayname}" 
                                    data-user-photo="${user.profile_photo}">
                                    <img src="${user.profile_photo}"
                                        alt="User Avatar" class="rounded-circle me-3" width="40" height="40">
                                    <div>
                                        <h6 class="mb-0">${user.displayname}</h6>
                                    </div>
                                </li>
                            `;

                            userList.append(userItem);
                        });
                    },
                    error: function (err) {
                        console.error("Error fetching users with chats:", err);
                    },
                });
            }

            fetchChatUsers();

            
            // Handle user click to open chat (same as before)
            $(document).on("click", ".user-item", function () {
                receiverId = $(this).data("user-id");
                const userName = $(this).data("user-name");
                const userPhoto = $(this).data("user-photo");

                // Leave the previous room if it exists
                if (socket) {
                    socket.emit('leaveRoom', senderId); // Leave sender's room
                    // socket.emit('leaveRoom', receiverId); // Leave receiver's room
                }

                // Join the new room for the current receiver
                if (socket) {
                    socket.emit('joinRoom', senderId); // Rejoin sender's room
                    // socket.emit('joinRoom', receiverId); // Join receiver's room
                }

                // Update the selected user's details
                $('#selected-user-name').text(userName);
                $('#selected-user-image').attr('src', userPhoto);


                // Update chat header
                // $("#chat-avatar").attr("src", userPhoto);
                // $("#chat-username").text(userName);

                // Set the receiver ID
                $("#receiver_id").val(receiverId);

                // Clear the message container
                $("#message-container").empty();

                if($(window).width() < 768) {
                    $('#user-list-block').addClass('d-none');
                }

                // Add "active" class to the selected user and remove it from others
                $(".user-item").removeClass("active");
                $(this).addClass("active");

                // Fetch old messages
                $.ajax({
                    url: "{{ route('get.messages') }}",
                    type: "POST",
                    data: {
                        sender_id: $("#sender_id").val(),
                        receiver_id: receiverId,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function (messages) {
                        $("#message-container").empty();

                        messages.forEach((msg) => {                            
                            const alignment = msg.sender_id == $("#sender_id").val() ? "justify-content-end" : "";
                            const bgColor = msg.sender_id == $("#sender_id").val() ? "bg-primary-custom text-white" : "bg-light";
                            const textColor = msg.sender_id == $("#sender_id").val() ? "text-white-50" : "text-muted";

                            const messageHtml = `
                                <div class="d-flex ${alignment} mb-3">
                                    <div class="${bgColor} p-2 rounded">
                                        <p class="mb-1">${msg.content}</p>
                                        <small class="${textColor}">${msg.created_at}</small>
                                    </div>
                                </div>
                            `;
                            $("#message-container").append(messageHtml);
                        });
                        // Scroll to the bottom of the message container
                        $("#message-container").scrollTop($("#message-container").prop("scrollHeight"));

                    },
                    error: function (err) {
                        console.error("Error fetching messages:", err);
                    },
                });
            });




            // Fetch all messages using AJAX
            $.ajax({
                url: '{{ route("get.messages") }}', 
                type: "POST",
                data: {
                    sender_id: senderId,
                    receiver_id: receiverId,
                    _token: '{{ csrf_token() }}',
                },
                success: function (messages) {
                    $("#message-container").empty();
                    messages.forEach((msg) => {
                        const alignment =
                            msg.sender_id == senderId ? "justify-content-end" : "";
                        const bgColor =
                            msg.sender_id == senderId
                                ? "bg-primary-custom text-white"
                                : "bg-light";
                        const textColor =
                            msg.sender_id == senderId
                                ? "text-white-50"
                                : "text-muted";

                        const messageHtml = `
                            <div class="d-flex ${alignment} mb-3">
                                <div class="${bgColor} p-2 rounded">
                                    <p class="mb-1">${msg.content}</p>
                                    <small class="${textColor}">${msg.created_at}</small>
                                </div>
                            </div>
                        `;
                        $("#message-container").append(messageHtml);
                    });

                    setTimeout(() => {                        
                        $("#message-container").scrollTop($("#message-container").prop("scrollHeight"));
                    }, 2000);
                },
                error: function (err) {
                    console.error("Error fetching messages:", err);
                },
            });


            var socket = io('http://localhost:8443');

            // When connected
            socket.on('connect', function() {
                console.log('Connected to Socket:', socket.id);
                socket.emit('joinRoom', senderId); // Join a room for the user
            });

            // When a new message is received
            socket.on('sendChatToClient', function(data) {
                if (data.senderId == receiverId) {
                    console.log('Message received:', data);
                    
                    const messageContainer = $('#message-container');
    
                    const alignment = data.senderId === $("#sender_id").val() ? "justify-content-end" : "";
                    const bgColor = data.senderId === $("#sender_id").val() ? "bg-primary-custome text-white" : "bg-light";
                    const textColor = data.senderId === $("#sender_id").val() ? "text-white-50" : "text-muted";
    
                    const messageHtml = `
                        <div class="d-flex ${alignment} mb-3">
                            <div class="${bgColor} p-2 rounded">
                                <p class="mb-1">${data.message.content}</p>
                                <small class="${textColor}">
                                    ${(data.message.created_at)}
                                </small>
                            </div>
                        </div>
                    `;
                    messageContainer.append(messageHtml);
                    messageContainer.scrollTop(messageContainer[0].scrollHeight); // Auto-scroll
                }
            });

            // Send a message
            document.getElementById('send-message').addEventListener('click', function() {
                const message = $('#message-input').val();


                if (message.trim() !== '') {
                    $.ajax({
                        url: '{{ route("store.message") }}', 
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            sender_id: senderId,
                            receiver_id: $("#receiver_id").val(),
                            message: message
                        },
                        success: function (response) {
                            console.log('Message stored:', response);
                            if (response.success) {                                
                                socket.emit('sendChatToServer', {
                                    senderId: senderId,
                                    receiverId: $("#receiver_id").val(),
                                    message: response.message, 
                                });

                                // Add the message to the chat UI
                                const messageContainer = $('#message-container');
                                const messageHtml = `
                                    <div class="d-flex justify-content-end mb-3">
                                        <div class="bg-primary-custom text-white p-2 rounded">
                                            <p class="mb-1">${response.message.content}</p>
                                            <small class="text-white-50">
                                                ${response.message.created_at}
                                            </small>
                                        </div>
                                    </div>
                                `;
                                messageContainer.append(messageHtml);
                                // Scroll to the bottom of the message container
                                $("#message-container").scrollTop($("#message-container").prop("scrollHeight"));
                                $('#message-input').val(''); // Clear the input
                            }
                        },
                        error: function (error) {
                            console.error('Error storing message:', error);
                        }
                    });

                } else {
                    alert('Please type a message!');
                }
            });
        });


        $(document).on('input', '#city', function(e) {
            initAutocomplete('city');
        });

        $(document).on('click', '.btn-add-video-to-lesson', function(e) {
            var video_id = $(this).data('id');
            var formData = new FormData();
            formData.append('video_id', video_id);
            $.ajax({
                type: "get",
                url: "{{ route('get-add-lesson-video-html') }}?video_id=" + video_id,
                dataType: "json",
                data: formData,
                contentType: false,
                processData: false,
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total) * 100;;
                            submitBtn.val('Processing..' +
                                Math
                                .floor(percentComplete) + '%');
                        }
                    }, false);

                    return xhr;
                },
                success: function(response) {
                    $('.add-lesson-video-container').html(response.html);
                    $('.add-video-to-lesson-modal').modal('show');

                },
                error: function(response, status, error) {

                }
            });



        });

        $(document).on('click', '.video-add-to-lesson-submit-button', function(e) {
            $('#frm_add_video_to_lesson').submit();

        });

        $(document).on('input', '#city', function(e) {
            initAutocomplete('city');
        });




        $(document).on('submit', '#frm_add_video_to_lesson', function(e) {
            e.preventDefault();
            clearErrors();
            var submitBtn = $('.video-add-to-lesson-submit-button');
            submitBtn.val('Processing...');
            submitBtn.prop('disabled', true);
            $('.add_video_to_lesson_msg').addClass('d-none');
            $('.add_video_to_lesson_error_msg').addClass('d-none');
            var formData = new FormData(this);

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                dataType: "json",
                data: formData,
                contentType: false,
                processData: false,
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total) * 100;;
                            submitBtn.val('Processing..' +
                                Math
                                .floor(percentComplete) + '%');
                        }
                    }, false);

                    return xhr;
                },
                success: function(response) {
                    submitBtn.val('Submit');
                    submitBtn.prop('disabled', false);
                    $('.add_video_to_lesson_msg').removeClass('d-none');
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000); // 2000 milliseconds (2 seconds) delay, for example

                },
                error: function(response, status, error) {
                    submitBtn.prop('disabled', false);
                    submitBtn.val('Submit');
                    manageErrors(response.responseText, 'frm_add_video_to_lesson',
                        'add-video-to-lesson');
                    $('.add_video_to_lesson_error_msg').removeClass('d-none');
                }
            });

        });


        $(".play-bt-slider").click(function() {
            $('.play-bt-slider').show();
            $('.pause-bt-slider').hide();
            // Pause all videos before playing the clicked one
            $('.videotag-play-slider video').each(function() {
                this.pause();
            });
            var nearestVideo = $(this).closest('.videotag-play-slider').find('video')[
                0]; // Select the first video element
            $(this).hide();
            $(this).closest('.video-titile-group').find('.pause-bt-slider').show();
            nearestVideo.play();
        });

        $(".pause-bt-slider").click(function() {
            var nearestVideo = $(this).closest('.videotag-play-slider').find('video')[
                0]; // Select the first video element
            $(this).hide();
            $(this).closest('.video-titile-group').find('.play-bt-slider').show();
            nearestVideo.pause();
        });


        function tabView(element_id) {
            var wookmark1 = new Wookmark(element_id, {
                outerOffset: 10, // Optional, the distance to the containers border
                itemWidth: 260, // Optional, the width of a grid item
            });
        }
        $(document).ready(function() {

            $('.profile-tab-text').click(function() {
                $('.profile-update-box').show();
                $('.seo-box').hide();
                $('.profile-video-box').hide();
                $('.video-tab-text').removeClass('profile-active');
                $('.seo-tab-text').removeClass('profile-active');
                $(this).addClass('profile-active');
            });

            $('.seo-tab-text').click(function() {
                $('.seo-box').show();
                $('.profile-video-box').hide();
                $('.profile-update-box').hide();
                $(this).addClass('profile-active');
                $('.profile-tab-text').removeClass('profile-active');
                $('.video-tab-text').removeClass('profile-active');
            });

            $('.video-tab-text').click(function() {
                $('.profile-video-box').show();
                $('.profile-update-box').hide();
                $('.seo-box').hide();
                $(this).addClass('profile-active');
                $('.profile-tab-text').removeClass('profile-active');
                $('.seo-tab-text').removeClass('profile-active');
            });


            $('#profile-videoimg-carousel').owlCarousel({
                loop: true,
                margin: 30,
                dots: true,
                nav: true,
                items: 1
            });

            @if ($user->role_id != 3)
                tabView("#wookmark1");
            @else
                tabView("#wookmark3");
            @endif


            // $('.sharebtn').click(function() {
            //     $('.liked-video-box').hide();
            //     $('.share-video-box').show();
            //     $('.likedbtn').removeClass('share-active');
            //     $('.lessonbtn').removeClass('share-active');
            //     $(this).addClass('share-active');
            //     tabView("#wookmark1");
            // });

            $('.sharebtn').click(function() {
                $('.liked-video-box, .lesson-video-box').hide();
                $('.share-video-box').show();
                $('.likedbtn, .lessonbtn, .chatbtn').removeClass('share-active');
                $(this).addClass('share-active');
                tabView("#wookmark1");
            });

            $('.likedbtn').click(function() {
                $('.liked-video-box').show();
                $('.share-video-box, .lesson-video-box, .chat-box').hide();

                $(this).addClass('share-active');
                $('.sharebtn').removeClass('share-active');
                $('.lessonbtn').removeClass('share-active');
                $('.chatbtn').removeClass('share-active');
                tabView("#wookmark2");
            });

            $('.lessonbtn').click(function() {
                $('.lesson-video-box').show();
                $('.share-video-box, .liked-video-box, .chat-box').hide();
                $(this).addClass('share-active');
                $('.sharebtn').removeClass('share-active');
                $('.likedbtn').removeClass('share-active');
                $('.chatbtn').removeClass('share-active');
                // tabView("#wookmark4");
            });

            $('.chatbtn').click(function() {
                // $("#message-container").scrollTop($("#message-container").prop("scrollHeight"));

                $('.chat-box').show();
                $('.share-video-box, .liked-video-box, .lesson-video-box').hide();

                $(this).addClass('share-active');
                $('.sharebtn').removeClass('share-active');
                $('.likedbtn').removeClass('share-active');
                $('.lessonbtn').removeClass('share-active');
                // tabView("#wookmark5");

            });

            // tabView("#wookmark3");
            $('#multiple-select-field').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: false,
            });

            $('.category-editmodal').click(function() {
                $(this).siblings('ul').toggleClass("list-active").next().toggle();
                $(this).find('svg').toggleClass('fa-chevron-down fa-chevron-right');
            });

            $('.category-editmodal ul li a span').click(function() {
                $(this).closest('a').siblings('ul').toggle();
                $(this).find('svg').toggleClass('fa-chevron-right fa-chevron-down');
            });

        });

        function showViewerCount(element) {
            var viewerCount = element.querySelector('.viewer-count');
            viewerCount.style.display = 'inline-block';
        }

        function hideViewerCount(element) {
            var viewerCount = element.querySelector('.viewer-count');
            viewerCount.style.display = 'none';
        }
    </script>

    <script>
        $(document).on('click', '.unlike-like-video-btn', function(e) {
            e.preventDefault();
            var $button = $(this);
            var videoId = $(this).data('video-id');
            var userId = '{{ Auth::id() }}';

            $.ajax({
                type: 'POST',
                url: "{{ route('unlike.video') }}",
                dataType: "json",
                data: {
                    video_id: videoId,
                    user_id: userId
                },
                success: function(response) {
                    // Assuming the 'edit-deletegroupbox' is the container for the entire button
                    var $container = $button.closest('.edit-deletegroupbox');

                    // Replace the button with a new like button
                    var likeButton = `<button class="btn btn-info profile-liked-btn btn_like_video like-float-right"
                                data-video-id="${videoId}">
                                <i class="fa-regular fa-heart"></i>
                            </button>`;

                    $container.html(likeButton);
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error('Error unliking video:', error);
                }
            });
        });


        $(document).ready(function() {
            $(".multipleChosen").chosen({
                placeholder_text_multiple: "What's your rating" //placeholder
            });

            $('.open-login-modal').on('click', function(e) {
                $("#siguploginModal").modal('show');
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
    <script>
        $('.follow-btn').on('click', function(e) {
            e.preventDefault();
            var user_id = '';
            $('.follow-btn').prop('disabled', true).html('Processing...');

            @if (Auth::user())
                var user_id = "{{ Auth::user()->id }}";
            @endif

            var profession_id = "{{ $user->id ?? '' }}";

            $.ajax({
                type: 'POST',
                url: "{{ route('follow') }}",
                dataType: "json",
                data: {
                    user_id: user_id,
                    profession_id: profession_id
                },
                success: function(response) {
                    // Handle the successful response here
                    $('.follow-success-message').show();
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                },
                error: function(error) {
                    // Handle the error here
                    console.error('Error:', error);
                    $('.follow-btn').prop('disabled', false).html('Follow');
                }
            });
        });
        $('.unfollow-btn').on('click', function(e) {
            e.preventDefault();
            $('.unfollow-btn').prop('disabled', true).html('Processing...');

            var user_id = "{{ Auth::user()->id ?? null }}";
            var profession_id = "{{ $user->id ?? null }}";
            $.ajax({
                type: 'DELETE',
                url: "{{ route('unfollow') }}",
                dataType: "json",
                data: {
                    user_id: user_id,
                    profession_id: profession_id
                },
                success: function(response) {

                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                },
                error: function(error) {
                    // Handle the error here
                    console.error('Error:', error);
                    $('.unfollow-btn').prop('disabled', false).html('Unfollow...');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#profilePhotoInput').on('change', function(e) {
                var fileInput = e.target;
                var imgElement = $('.img_profile_photo');
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        imgElement.attr('src', e.target.result);
                        imgElement.show(); // Display the image
                    };
                    reader.readAsDataURL(fileInput.files[0]);
                }
            });

            $('#addVideoThumbnail').on('change', function(e) {
                var fileInput = e.target;
                var imgElement = $('.add-video-image');
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        imgElement.attr('src', e.target.result);
                        imgElement.removeClass('d-none');
                    };
                    reader.readAsDataURL(fileInput.files[0]);
                }
            });

            $(document).on("change", "#editVideoThumbnail", function(e) {
                var fileInput = e.target;
                var imgElement = $('.edit-video-image');
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        imgElement.attr('src', e.target.result);
                        imgElement.removeClass('d-none');
                    };
                    reader.readAsDataURL(fileInput.files[0]);
                }
            });
        });
    </script>
    <script>
        var duration = 0;
        var videoSizeInMb = 0;
        var is_subscribed = "{{ $is_subscribed }}";
        var subscription_name = "{{ $subscription_name }}";
        var videoCount = "{{ $videoCount }}";
        var privateVideoCount = "{{ $privateVideoCount }}";

        function showSubscriptionPopup(error = 'Error') {
            $('#profileditModal').modal('hide');
            $('.lessionAddModal').modal('hide');
            $("#subscribelistModal").modal('show');
        }

        function getVideoDuration(file) {

            return new Promise(function(resolve, reject) {

                if (file && file.type.startsWith('video/')) {
                    var video = document.createElement('video');
                    var objectUrl = URL.createObjectURL(file);

                    video.onloadedmetadata = function() {
                        duration = Math.floor(video.duration / 60);

                        var size = file.size;
                        var sizeInMB = size / (1024 * 1024);
                        videoSizeInMb = sizeInMB;

                        // Clean up
                        URL.revokeObjectURL(objectUrl);

                        resolve(duration, videoSizeInMb);
                    };
                    video.src = objectUrl;
                } else {
                    resolve(duration, videoSizeInMb);
                }
            });
        }

        $(document).ready(function() {
            // Trigger click event on page load
            $(".profile-upload-btn").trigger("click");

            $(document).on("submit", "#frm_add_lession", function(e) {
                e.preventDefault();
                clearErrors();
                $('#updateVideoBtn').html('Processing..');
                $('.update_video_msg').addClass('d-none');
                $('.update_video_error_msg').addClass('d-none');

                var formData = new FormData(this);

                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    dataType: "json",
                    data: formData,
                    contentType: false,
                    processData: false,
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = (evt.loaded / evt.total) * 100;;
                                $('#updateVideoBtn').html('Processing..' +
                                    Math
                                    .floor(percentComplete) + '%');
                            }
                        }, false);

                        return xhr;
                    },
                    success: function(response) {
                        $('#updateVideoBtn').html('Update Video');
                        $('.update_video_msg').removeClass('d-none');
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000); // 2000 milliseconds (2 seconds) delay, for example

                    },
                    error: function(response, status, error) {
                        $('#updateVideoBtn').html('Update Video');
                        manageErrors(response.responseText, 'frm_updateprofilevideo',
                            'editvideo');
                        $('.update_video_error_msg').removeClass('d-none');
                    }
                });
            });

            // $(document).on("click", ".editvideo-cat-click", function() {
            //     $(this).siblings('.category-show').toggleClass("list-active").next().toggle();
            //     $(this).find('svg').toggleClass('fa-chevron-down fa-chevron-right');
            // });

            // $(document).on("click", ".editvideo-cat ul li a span", function() {
            //     $(this).closest('a').siblings('ul').toggle();
            //     $(this).find('svg').toggleClass('fa-chevron-right fa-chevron-down');
            // });

            $(document).on("click", ".editvideo-cat-click", function(event) {
                event.stopPropagation(); // Prevent the click event from propagating to the document
                $(this).siblings('.category-show').toggleClass("list-active").next().toggle();
                $(this).find('svg').toggleClass('fa-chevron-down fa-chevron-right');
            });

            $(document).on("click", ".editvideo-cat ul li a span", function(event) {
                event.stopPropagation(); // Prevent the click event from propagating to the document
                $(this).closest('a').siblings('ul').toggle();
                $(this).find('svg').toggleClass('fa-chevron-right fa-chevron-down');
            });

            $(document).on("click", function(event) {
                if (!$(event.target).closest(
                        '.editvideo-cat-click, .category-show, .editvideo-cat ul li a span').length) {
                    // Close the elements and reset the chevron icons
                    $('.category-show').removeClass('list-active').hide();
                    $('.editvideo-cat ul').hide();
                    $('.editvideo-cat-click svg').removeClass('fa-chevron-down').addClass(
                        'fa-chevron-right');
                    $('.editvideo-cat ul li a span svg').removeClass('fa-chevron-down').addClass(
                        'fa-chevron-right');
                }
            });

            // $('.profile-editmodal-cat-click').click(function(event) {
            //     event.stopPropagation();
            //     $(this).siblings('.category-show').toggleClass("list-active").next().toggle();
            //     $(this).find('svg').toggleClass('fa-chevron-down fa-chevron-right');
            // });

            // $('.profile-editmodal-cat ul li a span').click(function(event) {
            //     event.stopPropagation();
            //     $(this).closest('a').siblings('ul').toggle();
            //     $(this).find('svg').toggleClass('fa-chevron-right fa-chevron-down');
            // });

            $(document).click(function(event) {
                if (!$(event.target).closest(
                        '.profile-editmodal-cat-click, .category-show, .profile-editmodal-cat ul li a span')
                    .length) {
                    // Close the elements and reset the chevron icons
                    $('.category-show').removeClass('list-active').hide();
                    $('.profile-editmodal-cat ul').hide();
                    $('.profile-editmodal-cat-click svg').removeClass('fa-chevron-down').addClass(
                        'fa-chevron-right');
                    $('.profile-editmodal-cat ul li a span svg').removeClass('fa-chevron-down').addClass(
                        'fa-chevron-right');
                }
            });

            $('.profile-editmodal-cat-click').click(function(event) {
                event.stopPropagation(); // Prevent the click event from propagating to document
                $(this).siblings('.category-show').toggleClass("list-active").next().toggle();
                $(this).find('svg').toggleClass('fa-chevron-down fa-chevron-right');
            });

            $('.profile-editmodal-cat ul li a span').click(function(event) {
                event.stopPropagation(); // Prevent the click event from propagating to document
                $(this).closest('a').siblings('ul').toggle();
                $(this).find('svg').toggleClass('fa-chevron-right fa-chevron-down');
            });

            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            });

            // $(document).on("click", ".profile-editmodal-cat-click", function() {
            //     $(this).siblings('.category-show').toggleClass("list-active").next().toggle();
            //     $(this).find('svg').toggleClass('fa-chevron-down fa-chevron-right');
            // });

            // $(document).on("click", ".profile-editmodal-cat ul li a span", function() {
            //     $(this).closest('a').siblings('ul').toggle();
            //     $(this).find('svg').toggleClass('fa-chevron-right fa-chevron-down');
            // });

            // $('.click-category').click(function() {
            //     $(this).siblings('.category-show').toggleClass("list-active").next().toggle();
            //     $(this).find('svg').toggleClass('fa-chevron-down fa-chevron-right');
            // });

            // $('.category-itembox ul li a span').click(function() {
            //     $(this).closest('a').siblings('ul').toggle();
            //     $(this).find('svg').toggleClass('fa-chevron-right fa-chevron-down');
            // });
        });

        //  button event
        $(document).ready(function() {
            $('form').submit(function() {
                $('#submitBtn').val('Adding...').prop('disabled', true);
            });

            $(document).on("click", ".delete-btn", function() {
                $(this).closest('.container-clone-section').remove();
            });
        });

        $(document).on("click", ".btn_addProfessionalLink", function() {
            var html = $(".professional-container-clone").html();
            $(".professional_section").append(html);
        });

        $(document).on("click", ".add-education-btn", function() {
            var html = $(".education-container-clone").html();
            $(".education-container").append(html);
        });

        $(document).on("click", "#updateVideoBtn", function() {
            $('#frm_updateprofilevideo').submit();
        });


        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on("submit", "#frm_updateprofilevideo", function(e) {
                e.preventDefault();
                clearErrors();
                $('#updateVideoBtn').html('Processing..');
                $('.update_video_msg').addClass('d-none');
                $('.update_video_error_msg').addClass('d-none');

                var fileInput = $("#editVideo")[0];
                var file = fileInput.files[0];

                var duration = 0;
                var maxUploadedMb = 0;

                function getVideoDuration(file) {
                    return new Promise(function(resolve, reject) {
                        if (file && file.type && file.type.startsWith('video/')) {
                            var video = document.createElement('video');
                            var objectUrl = URL.createObjectURL(file);

                            var privateVideo = false;
                            video.onloadedmetadata = function() {
                                // console.log(10);
                                // var duration = Math.floor(video.duration / 60);
                                var duration = Math.floor(video.duration);
                                var size = file.size;
                                var sizeInMB = size / (1024 * 1024);
                                // Clean up
                                URL.revokeObjectURL(objectUrl);
                                resolve({
                                    duration: duration,
                                    videoSizeInMb: sizeInMB
                                });

                            };
                            video.src = objectUrl;
                            // privatVideo

                        } else {

                            resolve(0);
                        }
                    });
                }
                e.preventDefault();
                getVideoDuration(file)
                    .then(function(result) {
                        var duration = result.duration;
                        var videoSizeInMb = result.videoSizeInMb;
                        if ($("#isPrivateCheckbox").prop('checked')) {
                            if (subscription_name == 'gold') {
                                privateVideo = true;
                            } else if (subscription_name == 'silver' && privateVideoCount >= 10) {
                                privateVideo = false;
                            }

                            if (!privateVideo) {
                                return showSubscriptionPopup('privatVideo');
                            }
                        }
                        // videoSize
                        if (subscription_name == '' || subscription_name == 'free') {
                            maxUploadedMb = 5;
                        } else if (subscription_name == 'silver') {
                            maxUploadedMb = 20;
                        }
                        if (maxUploadedMb < videoSizeInMb && subscription_name != 'gold') {
                            return showSubscriptionPopup('videoSize');
                        }
                        var formData = new FormData($('#frm_updateprofilevideo')[0]);
                        formData.append('duration', duration);
                        var video_update_route = "{{ route('profile.video.update') }}";
                        $.ajax({
                            type: "post",
                            url: video_update_route, // Retrieve the form action URL
                            dataType: "json",
                            data: formData,
                            contentType: false,
                            processData: false,
                            xhr: function() {
                                var xhr = new window.XMLHttpRequest();
                                xhr.upload.addEventListener("progress", function(evt) {
                                    if (evt.lengthComputable) {
                                        var percentComplete = (evt.loaded / evt
                                            .total) * 100;;
                                        $('#updateVideoBtn').html('Processing..' +
                                            Math
                                            .floor(percentComplete) + '%');
                                    }
                                }, false);

                                return xhr;
                            },
                            success: function(response) {
                                $('#updateVideoBtn').html('Update Video');
                                $('.update_video_msg').removeClass('d-none');
                                setTimeout(function() {
                                        window.location.reload();
                                    },
                                    2000);

                            },
                            error: function(response, status, error) {
                                $('#updateVideoBtn').html('Update Video');
                                manageErrors(response.responseText,
                                    'frm_updateprofilevideo',
                                    'editvideo');
                                $('.update_video_error_msg').removeClass('d-none');
                            }
                        });
                    });
            });

            // $(document).on("submit", "#frm_updateprofilevideo", function(e) {
            //     alert('test');
            //     clearErrors();
            //     $('#updateVideoBtn').html('Processing..');
            //     $('.update_video_msg').addClass('d-none');
            //     $('.update_video_error_msg').addClass('d-none');
            //     var fileInput = $("#editVideo")[0];
            //     var file = fileInput.files[0];
            //     var formData = new FormData(this);

            //     e.preventDefault();

            //     getVideoDuration(file)
            //         .then(function() {

            //             var maxUploadedMb = 0;
            //             var privateVideo = false;

            //             // privatVideo
            //             if ($("#isPrivateCheckbox").prop('checked')) {
            //                 if (subscription_name == 'gold') {
            //                     privateVideo = true;
            //                 } else if (subscription_name == 'silver' && privateVideoCount >= 10) {
            //                     privateVideo = false;
            //                 }

            //                 if (!privateVideo) {
            //                     return showSubscriptionPopup('privatVideo');
            //                 }
            //             }
            //             // videoSize
            //             if (subscription_name == '' || subscription_name == 'free') {
            //                 maxUploadedMb = 5;
            //             } else if (subscription_name == 'silver') {
            //                 maxUploadedMb = 20;
            //             }

            //             if (maxUploadedMb < videoSizeInMb && subscription_name != 'gold') {
            //                 return showSubscriptionPopup('videoSize');
            //             }



            //             $.ajax({
            //                 type: "post",
            //                 url: $(this).attr('action'),
            //                 dataType: "json",
            //                 data: formData,
            //                 contentType: false,
            //                 processData: false,
            //                 xhr: function() {
            //                     var xhr = new window.XMLHttpRequest();
            //                     xhr.upload.addEventListener("progress", function(evt) {
            //                         if (evt.lengthComputable) {
            //                             var percentComplete = (evt.loaded / evt
            //                                 .total) * 100;;
            //                             $('#updateVideoBtn').html('Processing..' +
            //                                 Math
            //                                 .floor(percentComplete) + '%');
            //                         }
            //                     }, false);

            //                     return xhr;
            //                 },
            //                 success: function(response) {
            //                     $('#updateVideoBtn').html('Update Video');
            //                     $('.update_video_msg').removeClass('d-none');
            //                     setTimeout(function() {
            //                         window.location.reload();
            //                     }, 2000);
            //                 },
            //                 error: function(response, status, error) {
            //                     $('#updateVideoBtn').html('Update Video');
            //                     manageErrors(response.responseText,
            //                         'frm_updateprofilevideo',
            //                         'editvideo');
            //                     $('.update_video_error_msg').removeClass('d-none');
            //                 }
            //             });
            //         });
            // });

            $('#frm_updateprofile').submit(function(e) {
                clearErrors();
                $('#btn_profile_update').val('Processing..');
                $('.profile_update_msg').addClass('d-none');
                $('.profile_update_error_msg').addClass('d-none');
                e.preventDefault();

                var formData = new FormData(this);
                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    dataType: "json",
                    data: formData,
                    contentType: false,
                    processData: false,
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = (evt.loaded / evt.total) * 100;;
                                $('#btn_profile_update').val('Processing..' +
                                    Math
                                    .floor(percentComplete) + '%');
                            }
                        }, false);

                        return xhr;
                    },
                    success: function(response) {
                        $('#btn_profile_update').val('Update Profile');
                        $('.profile_update_msg').removeClass('d-none');
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    },
                    error: function(response, status, error) {
                        $('#btn_profile_update').val('Update Profile');
                        manageErrors(response.responseText, 'frm_updateprofile', 'register');
                        $('.profile_update_error_msg').removeClass('d-none');
                    }
                });
            });

            $('#frm_updateseo').submit(function(e) {
                clearErrors();
                $('#btn_seo_update').val('Processing..');
                $('.update_seo_msg').addClass('d-none');
                $('.update_seo_error_msg').addClass('d-none');
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: $(this).attr('action'),
                    dataType: "json",
                    data: formData,
                    contentType: false,
                    processData: false,
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = (evt.loaded / evt.total) * 100;
                                $('#btn_seo_update').val('Processing..' + Math.floor(
                                    percentComplete) + '%');
                            }
                        }, false);

                        return xhr;
                    },
                    success: function(response) {
                        $('#btn_seo_update').val('Update');
                        $('.update_seo_msg').removeClass('d-none');
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    },
                    error: function(response, status, error) {
                        $('#btn_seo_update').val('Update');
                        manageErrors(response.responseText, 'frm_updateseo', 'seo');
                        $('.update_seo_error_msg').removeClass('d-none');
                    }
                });
            });

            $('.edit-video-btn').click(function(e) {
                var id = $(this).data('id');

                e.preventDefault();
                var formData = new FormData();
                formData.append('id', id);
                formData.append('_token', $('meta[name="csrf-token"]').attr('content')); // Add CSRF token

                var url = "{{ route('profile.video.edit') }}";
                $.ajax({
                    type: "post",
                    url: url, // Retrieve the form action URL
                    dataType: "json",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $(".edit-video-modal").modal('show');
                        $(".edit-video-container").html(response
                            .html); // Insert HTML into the modal's container
                    },
                    error: function(response, status, error) {

                    }
                });
            });




            $('#addVideoForm').submit(function(e) {
                $('.add_video_error_msg').addClass('d-none');
                clearErrors();
                var fileInput = $("#video")[0];
                var file = fileInput.files[0];
                e.preventDefault();
                getVideoDuration(file)
                    .then(function() {
                        var maxUploadedMb = 0;
                        var maxVideoCount = 0;
                        var privateVideo = false;


                        // videoCount
                        if (subscription_name == '' || subscription_name == 'free') {
                            maxVideoCount = 3;
                        } else if (subscription_name == 'silver') {
                            maxVideoCount = 10;
                        }



                        if (maxVideoCount <= videoCount & subscription_name != 'gold') {
                            return showSubscriptionPopup('videoCount' + maxVideoCount);
                        }


                        // privatVideo
                        if ($("#isPrivateCheckbox").prop('checked')) {
                            if (subscription_name == 'gold') {
                                privateVideo = true;
                            } else if (subscription_name == 'silver' && privateVideoCount >= 10) {
                                privateVideo = false;
                            }

                            if (!privateVideo) {
                                return showSubscriptionPopup('privatVideo');
                            }
                        }

                        // videoSize
                        if (subscription_name == '' || subscription_name == 'free') {
                            maxUploadedMb = 5;
                        } else if (subscription_name == 'silver') {
                            maxUploadedMb = 20;
                        }

                        if (maxUploadedMb < videoSizeInMb && subscription_name != 'gold') {
                            return showSubscriptionPopup('videoSize');
                        }

                        var formData = new FormData($('#addVideoForm')[0]);
                        formData.append('duration', duration);

                        // Continue with AJAX request
                        $.ajax({
                            type: "post",
                            url: $('#addVideoForm').attr('action'),
                            dataType: "json",
                            data: formData,
                            contentType: false,
                            processData: false,
                            xhr: function() {
                                var xhr = new window.XMLHttpRequest();
                                xhr.upload.addEventListener("progress", function(evt) {
                                    if (evt.lengthComputable) {
                                        var percentComplete = (evt.loaded / evt
                                            .total) * 100;
                                        $('#addVideoBtn').val('Processing..' + Math
                                            .floor(percentComplete) + '%');
                                    }
                                }, false);

                                return xhr;
                            },
                            success: function(response) {
                                $('#addVideoBtn').val('Add Video');
                                $('.add_video_msg').removeClass('d-none');
                                setTimeout(function() {
                                    window.location.reload();
                                }, 2000);
                            },
                            error: function(response, status, error) {
                                $('#addVideoBtn').val('Add Video');
                                manageErrors(response.responseText, 'addVideoForm',
                                    'addvideo');
                                $('.add_video_error_msg').removeClass('d-none');
                            }
                        });
                    })
            });

            $(document).on("submit", ".edit-video-form", function(e) {
                clearErrors();
                $('#addVideoBtn').val('Processing..');
                $('.add_video_msg').addClass('d-none');
                $('.add_video_error_msg').addClass('d-none');

                e.preventDefault();

                var formData = new FormData(this);
                var url = "{{ route('profile.video.update') }}";
                var id = $(this).data('id');
                var btnSelector = '.submit-btn-' + id;
                var submitButton = $(btnSelector);

                $.ajax({
                    type: "post",
                    url: url,
                    dataType: "json",
                    data: formData,
                    contentType: false,
                    processData: false,
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = (evt.loaded / evt.total) * 100;

                                submitButton.val('Processing..' +
                                    Math
                                    .floor(percentComplete) + '%');
                            }
                        }, false);

                        return xhr;
                    },
                    success: function(response) {
                        $('#updateVideoBtn').html('Update Video');
                        $('.update_video_msg').removeClass('d-none');
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    },
                    error: function(response, status, error) {
                        $('#updateVideoBtn').html('Update Video');
                        manageErrors(response.responseText, 'editVideoForm', 'editvideo');
                        $('.update_video_error_msg').removeClass('d-none');
                    }
                });
            });

            // delet video thumbnail
            $('.delete-video-btn').click(function(e) {
                var id = $(this).data('id');

                $("#finalDeleteBtn").data('id', id);
                $(".delete-video-modal").modal('show');

            });
            $('#finalDeleteBtn').click(function(e) {

                var id = $(this).data('id');
                var formData = new FormData();
                formData.append('id', id);

                var url = "{{ route('delete-video') }}";
                $('.delete-video-modal').modal('hide');
                $.ajax({
                    type: "post",
                    url: url,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $(".delete-video-info").modal('show');
                    },
                    error: function(response, status, error) {
                        alert('Something went wrong.');
                    }
                });
            });

            // video  shared & liked js code start
            $(".bio-video-tabs li").click(function() {
                var tab_id = $(this).attr("data-id");

                $(".bio-video-tabs li").removeClass("bv-current");
                $(".bio-video-tab-content").removeClass("bv-current");

                $(this).addClass("bv-current");
                $("#" + tab_id).addClass("bv-current");
            });

        });
    </script>


    <script>
        $(document).ready(function() {
            $("#btn-model-apply-badge").on("click", function() {
                $('.profile-update-box').show();
                $('#UploadDocumentModel').modal('show');
            });

            $("#btn-model-report-user").on("click", function() {
                $('#SubmitReportModel').modal('show');
            });

            $(".video-ban-btn").on("click", function() {
                var video_id = $(this).data('id');
                $('#malicious_video_id').val(video_id);
                $('#SubmitReportVideoModel').modal('show');
            });

            $(document).on("click", "#btn_delete_thumbnail", function() {
                var id = $(this).data('id');
                var formData = new FormData();
                formData.append('id', id);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('update.thumbnail.delete') }}", // Update the route as needed
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Handle success, e.g., remove the image element
                        $('.section_video_image').hide();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error deleting thumbnail:', error);
                        // Handle error if needed
                    }
                });
            });


        });
    </script>

    <script>
        $(document).ready(function() {
            $('#frm_upload_document').on('submit', function(e) {
                $('#btn_update_document').val('Processing..');
                $('#update_document_msg').addClass('d-none');
                $('#update_document_error_msg').addClass('d-none');

                e.preventDefault();
                var formData = new FormData(this);
                var formAction = $(this).attr('action');

                $.ajax({
                    type: "post",
                    url: formAction,
                    dataType: "json",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#btn_update_document').html('Update Documents');
                        $('.update_document_msg').removeClass('d-none');
                        setTimeout(function() {
                            window.location.reload();
                        }, 3000);
                    },

                    error: function(xhr, status, error) {
                        $('#btn_update_document').val('Update Documents');
                        $('.update_document_error_msg').removeClass('d-none');
                    }
                });
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#frm_submit_report').on('submit', function(e) {
                e.preventDefault();
                $('#btn_malicious_report').val('Processing..');
                $('#malicious_report_msg').addClass('d-none');
                $('#malicious_report_error_msg').addClass('d-none');

                var formData = new FormData(this);
                var formAction = $(this).attr('action');


                $.ajax({
                    type: "POST",
                    url: formAction,
                    dataType: "json",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#btn_malicious_report').html('Submit');
                        $('#malicious_report_msg').removeClass('d-none');
                        setTimeout(function() {
                            window.location.reload();
                        }, 3000);
                    },
                    error: function(xhr, status, error) {
                        $('#btn_malicious_report').html('Submit');
                        $('#malicious_report_error_msg').removeClass('d-none');
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#submit_form_report_video').on('submit', function(e) {
                e.preventDefault();
                $('#btn_malicious_video_report').val('Processing..');
                $('#malicious_video_report_msg').addClass('d-none');
                $('#malicious_video_report_error_msg').addClass('d-none');

                var formData = new FormData(this);
                var formAction = $(this).attr('action');

                $.ajax({
                    type: "POST",
                    url: formAction,
                    dataType: "json",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#btn_malicious_video_report').html('Submit');
                        $('#malicious_video_report_msg').removeClass('d-none');
                        setTimeout(function() {
                            window.location.reload();
                        }, 3000);
                    },
                    error: function(xhr, status, error) {
                        $('#btn_malicious_video_report').html('Submit');
                        $('#malicious_video_report_error_msg').removeClass('d-none');
                    }
                });
            });
        });
    </script>



    <script>
        $(document).ready(function() {
            $(document).on("change", "#editVideoThumbnail", function(e) {
                var fileInput = e.target;
                var imgElement = $('.img_profile_photo');
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        imgElement.attr('src', e.target.result);
                        imgElement.show(); // Display the image

                    };
                    reader.readAsDataURL(fileInput.files[0]);
                    $('#btn_delete_thumbnail').hide();
                    $('.section_video_image').show();

                } else {}
            });

            $(document).on("change", "#editVideo", function(e) {
                var fileInput = e.target;
                var imgElement = $('.edit-video');
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        imgElement.attr('src', e.target.result);
                        imgElement.show(); // Display the image

                    };
                    reader.readAsDataURL(fileInput.files[0]);
                    // $('#btn_delete_thumbnail').hide();
                    // $('.section_video_image').show();

                } else {}
            });
        });
    </script>



    <script>
        $(document).ready(function() {
            $(document).on('click', '.btn_like_video', function(e) {
                e.preventDefault();

                var $button = $(this); // Cache the button element
                var videoId = $button.data('video-id');
                var userId = '{{ Auth::id() }}';

                if (!userId) {
                    $('#siguploginModal').modal('show');
                    return; // Exit the function if user is not authenticated
                }

                // Send the AJAX request
                $.ajax({
                    type: 'POST',
                    url: "{{ route('like.video') }}",
                    dataType: "json",
                    data: {
                        video_id: videoId,
                        user_id: userId
                    },
                    success: function(response) {

                        $button.html('<i class="fa-solid fa-heart"></i>').removeClass(
                            'btn_like_video').addClass('unlike-like-video-btn');
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>

    <script>
        // delete slider video
        $(document).ready(function() {
            let page = 1;
            $('.delete-slide-btn').click(function() {
                var id = $(this).data('id');

                $("#finalSliderDeleteBtn").data('id', id);
                $(".delete-slider-modal").modal('show');

                $('#finalSliderDeleteBtn').click(function(e) {
                    e.preventDefault();

                    var id = $(this).data('id');
                    var formData = new FormData();
                    formData.append('id', id);

                    var url = "{{ route('delete-slider') }}";
                    $('.delete-slider-modal').modal('hide');

                    $.ajax({
                        type: "post",
                        url: url,
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            $(".delete-video-info").modal('show');
                            location.reload();
                        },
                        error: function(response, status, error) {
                            alert('Something went wrong.');
                        }
                    });
                });
            });

            $(document).on('change', '#isPrivateCheckbox', function(e) {
                // Check if the checkbox is checked
                if ($(this).is(':checked')) {
                    $(".user-select-box").removeClass('d-none');
                } else {
                    $(".user-select-box").addClass('d-none');
                }
            });

            $(document).on('click', '.lesson-add-btn', function(e) {

                page = 1;
                $.ajax({
                    type: 'GET',
                    url: "{{ route('lesson.create') }}",
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $(".lesson-container").html(response.data);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $(document).on('click', '#lessonVideoLoadMoreBtn', function(e) {

                var lesson_id = $(this).data('id');
                var loadMoreBtn = $("#lessonVideoLoadMoreBtn");
                loadMoreBtn.text('Please wait...');
                var url = "{{ url('get-more-lesson-videos') }}/" + page;
                if (lesson_id != null) {
                    url + '/' + lesson_id;
                }

                $.ajax({
                    type: 'GET',
                    url: url,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.data == '') {
                            loadMoreBtn.remove();
                        } else {
                            loadMoreBtn.text('Load more');
                            $(".lesson-videos-container").append(response.data);
                            page++;
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            // $(document).on('submit', '#addLessonForm', function(e) {
            //     e.preventDefault();
            //     var BtnLessonSubmit = $("#btnLessonSubmit");
            //     BtnLessonSubmit.prop('disabled', true);
            //     BtnLessonSubmit.val('Please wait...');
            //     $('.msg_lesson_update').addClass('d-none');
            //     $('.error_msg_lesson_update').addClass('d-none');

            //     var formData = new FormData(this);
            //     $.ajax({
            //         type: 'POST',
            //         url: "{{ route('lesson.store') }}",
            //         data: formData,
            //         processData: false,
            //         contentType: false,
            //         success: function(response) {
            //             $('.msg_lesson_update').removeClass('d-none');
            //             BtnLessonSubmit.val('Submit');
            //             BtnLessonSubmit.prop('disabled', false);
            //             setTimeout(function() {
            //                 window.location.reload(true);
            //             }, 2000);
            //         },
            //         error: function(response, status, error) {
            //             $('.error_msg_lesson_update').removeClass('d-none');
            //             BtnLessonSubmit.val('Submit');
            //             BtnLessonSubmit.prop('disabled', false);
            //             console.log(response.responseText);
            //             manageErrors(response.responseText, 'addLessonForm',
            //                 'lesson-add-form');

            //         }
            //     });
            // });

            $(document).on('submit', '#addLessonForm', function(e) {
                e.preventDefault();

                if (subscription_name != 'gold') {
                    return showSubscriptionPopup('losson');
                }

                var BtnLessonSubmit = $("#btnLessonSubmit");
                BtnLessonSubmit.prop('disabled', true);
                BtnLessonSubmit.val('Please wait...');
                $('.msg_lesson_update').addClass('d-none');
                $('.error_msg_lesson_update').addClass('d-none');

                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('lesson.store') }}',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('.msg_lesson_update').removeClass('d-none');
                        BtnLessonSubmit.val('Submit');
                        BtnLessonSubmit.prop('disabled', false);
                        setTimeout(function() {
                            window.location.reload(true);
                        }, 2000);
                    },
                    error: function(xhr, status, error) {
                        $('.error_msg_lesson_update').removeClass('d-none');
                        BtnLessonSubmit.val('Submit');
                        BtnLessonSubmit.prop('disabled', false);
                        manageErrors(xhr.responseText, 'addLessonForm',
                            'lesson-add-form');
                    }
                });
            });


            $(document).on('click', '.edit-lesson', function(e) {
                page = 1
                var lesson_id = $(this).data('id');
                var url = "{{ url('lesson') }}/" + lesson_id + "/edit";

                $(".lessionAddModal").modal('show');
                $.ajax({
                    type: 'GET',
                    url: url,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $(".lesson-container").html(response.data);

                    },
                    error: function(xhr, status, error) {
                        $(".lessionAddModal").modal('hide');
                        console.error(xhr.responseText);
                    }
                });
            });

            // $(document).on('submit', '#updateLessonForm', function(e) {
            //     e.preventDefault();
            //     var formData = new FormData(this);
            //     var url = $(this).attr('action');
            //     var BtnLessonSubmit = $("#btnLessonSubmit");
            //     BtnLessonSubmit.prop('disabled', true);
            //     BtnLessonSubmit.val('Please wait...');
            //     $('.msg_lesson_update').addClass('d-none');
            //     $('.error_msg_lesson_update').addClass('d-none');
            //     $.ajax({
            //         type: 'POST',
            //         url: url,
            //         data: formData,
            //         processData: false,
            //         contentType: false,
            //         headers: {
            //             'X-HTTP-Method-Override': 'PATCH'
            //         },
            //         success: function(response) {
            //             $('.msg_lesson_update').removeClass('d-none');
            //             BtnLessonSubmit.val('Submit');
            //             BtnLessonSubmit.prop('disabled', false);
            //             setTimeout(function() {
            //                 window.location.reload(true);
            //             }, 2000);
            //         },
            //         error: function(response, status, error) {
            //             $('.error_msg_lesson_update').removeClass('d-none');
            //             BtnLessonSubmit.val('Submit');
            //             BtnLessonSubmit.prop('disabled', false);
            //             manageErrors(response.responseText, 'updateLessonForm',
            //                 'lesson-add-form');

            //         }


            //     });
            // });

            $(document).on('submit', '#updateLessonForm', function(e) {

                e.preventDefault();
                if (subscription_name != 'gold') {
                    return showSubscriptionPopup('lesson');
                }

                var formData = new FormData(this);
                var url = $(this).attr('action');
                var BtnLessonSubmit = $("#btnLessonSubmit");
                BtnLessonSubmit.prop('disabled', true);
                BtnLessonSubmit.val('Please wait...');
                $('.msg_lesson_update').addClass('d-none');
                $('.error_msg_lesson_update').addClass('d-none');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-HTTP-Method-Override': 'PATCH'
                    },
                    success: function(response) {
                        $('.msg_lesson_update').removeClass('d-none');
                        BtnLessonSubmit.val('Submit');
                        BtnLessonSubmit.prop('disabled', false);
                        setTimeout(function() {
                            window.location.reload(true);
                        }, 2000);
                    },
                    error: function(xhr, status, error) {
                        $('.error_msg_lesson_update').removeClass('d-none');
                        BtnLessonSubmit.val('Submit');
                        BtnLessonSubmit.prop('disabled', false);
                        manageErrors(xhr.responseText, 'updateLessonForm',
                            'lesson-add-form');
                    }
                });
            });
            $(document).on('change', '#isPrivate', function(e) {

                if ($(this).is(':checked')) {
                    $('.lesson-users-private').removeClass('d-none')
                } else {
                    $('.lesson-users-private').addClass('d-none')
                }
            });
        });


        function updateDisplayedCategories(dropdown_class, label_id) {
            var checkedCategories = [];
            var old_html = 'Rien de sélectionné';

            $('.' + dropdown_class + ' input[type="checkbox"]:checked').each(function() {
                checkedCategories.push($(this).next('label').text().trim());
            });
            if (checkedCategories.length === 0) {
                $('#' + label_id).html('Rien de sélectionné');
            } else {
                var categorytext = checkedCategories.join(', ');
                $('#' + label_id).html(categorytext);
            }
        }

        $(document).on("click", ".dropdowncatgory_list", function() {
            updateDisplayedCategories('dropdowncatgory_list', 'lbl_add_video_category')
        });

        $(document).on("click", ".drp_lessons", function() {
            updateDisplayedCategories('drp_lessons', 'lbl_add_video_to_lesson')
        });


        $(document).on("click", ".drp_lesson_users_list", function() {
            updateDisplayedCategories('drp_lesson_users_list', 'lbl_lesson_users_list')
        });

        $(document).on("click", ".drp_lessons", function() {
            updateDisplayedCategories('drp_lessons', 'lbl_add_video_to_lesson')
        });
    </script>



    <script>
        $(document).ready(function() {
            $(document).on('click', '.btn-like-professional', function(e) {
                e.preventDefault();
                var $button = $(this); // Cache the button element
                var ProfessionalId = $button.data('user-id');
                var userId = '{{ Auth::id() }}';

                if (!userId) {
                    $('#siguploginModal').modal('show');
                    return; // Exit the function if user is not authenticated
                }

                // Send the AJAX request
                $.ajax({
                    type: 'POST',
                    url: "{{ route('like.professional') }}",
                    dataType: "json",
                    data: {
                        professional_id: ProfessionalId,
                        user_id: userId
                    },
                    success: function(response) {
                        var existing_count = $('#like_professinal_count').text();
                        let new_count = parseInt(existing_count) + parseInt(1);
                        $('#like_professinal_count').text(new_count);

                        var $container = $button.closest('#container-like-unlike-professinal');
                        var UnikeButton = `<button
                                            class="btn btn-info-btn profile-liked-btn btn-unlike-professional like-float-right"
                                            data-user-id="` +
                            ProfessionalId + `">
                                            <i class="fa-solid fa-heart"></i>
                                        </button>`;


                        $container.html(UnikeButton);


                    },
                    error: function(xhr, status, error) {
                        window.location.reload();
                    }
                });
            });
        });



        $(document).on('click', '.btn-unlike-professional', function(e) {
            e.preventDefault();
            var $button = $(this);
            var ProfessionalId = $(this).data('user-id');
            var userId = '{{ Auth::id() }}';

            $.ajax({
                type: 'POST',
                url: "{{ route('unlike.professional') }}",
                dataType: "json",
                data: {
                    professional_id: ProfessionalId,
                    user_id: userId
                },
                success: function(response) {
                    // Assuming the 'edit-deletegroupbox' is the container for the entire button
                    var $container = $button.closest('#container-like-unlike-professinal');

                    // Replace the button with a new like button
                    var likeButton = `<button
                                            class="btn btn-info profile-liked-btn btn-like-professional like-float-right"
                                            data-user-id="` + ProfessionalId + `">
                                            <i class="fa-regular fa-heart"></i>
                                        </button>`;

                    $container.html(likeButton);

                    var existing_count = $('#like_professinal_count').text();
                    let new_count = parseInt(existing_count) - parseInt(1);
                    $('#like_professinal_count').text(new_count);
                },
                error: function(xhr, status, error) {
                    window.location.reload();
                }
            });
        });



        $(document).ready(function() {
            $(".ads").click(function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                $("#confirmPurchase").attr('data-url', url);
                // Open the modal
                $("#purchaseVideoModal").modal('show');
            });
            // Handle click event of "Yes" button
            $('#confirmPurchase').click(function() {
                // Redirect to the video payment route
                var url = $(this).data('url');
                window.location.href = url;
            });
            // Handle click event of "No" button
            $('.btn-secondary').click(function() {
                // Close the modal
                $("#purchaseVideoModal").modal('hide');
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#videoPurchaseSuccessModal").modal('show')
        });
    </script>
    <script>
        // function lessonView(lessonid) {
        //     var wookmarkLesson = new Wookmark(lessonid, {
        //         outerOffset: 10, // Optional, the distance to the containers border
        //         itemWidth: 260, // Optional, the width of a grid item
        //     });
        // }

        /*        $(function(){
                    // var  lessonid = $('.lesson_data_id').attr('id');
                    // alert(lessonid);
                    $('.lesson_data_id').each(function(){
                        var  lessonid = $(this).attr('id');
                        alert(lessonid);
                    });
                    $('#auto-adjust').wallyti(function(){
                        console.info("FATTO!");
                    });
                }); */



        function toggleFolder(folderId) {
            document.getElementById('main-section').style.display = 'none'; // Hide main section
            document.getElementById(folderId).style.display = 'block'; // Show folder section
            $('.btn-folder-back').show();
            // tabView("#wookmark4");
            var lessonid = $('#' + folderId + ' .lesson_data_id').attr('id');
            // alert(lessonid);
            // lessonView(lessonid);
            $(lessonid).wallyti(function() {
                // console.info("FATTO!");
            });
        }

        function goBack() {
            document.getElementById('main-section').style.display = 'block'; // Show main section
            document.querySelectorAll('.folder-section').forEach(function(element) {
                element.style.display = 'none'; // Hide all folder sections
            });
            $('.btn-folder-back').hide();
        }
    </script>
    <script>
        $(document).on('click', '#profile_video', function(e) {});
    </script>


    <script>
        $(document).ready(function() {
            $('#addVideoLink').on('click', function() {
                $('#profileditModal').modal('show');
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#addVideoLink').on('click', function() {
                $('.video-tab-text').click();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.profile-upload-btn').on('click', function() {
                $('.profile-tab-text').click();
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
@endsection
