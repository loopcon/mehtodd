@extends('frontend.partial.master')

@section('page-css')
    <style>
        .btn-disabled {
            pointer-events: none;
            opacity: 0.5;
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


        .no-videos {
            text-align: center;
            opacity: 0.39;
        }

        .btn-outline-primary-custom {
            --bs-btn-color: #198fd9 !important;
            --bs-btn-border-color: #198fd9 !important;
            --bs-btn-hover-bg: #198fd9 !important;
            --bs-btn-hover-border-color: #198fd9 !important;
            --bs-btn-active-bg: #198fd9 !important;
            --bs-btn-active-border-color: #198fd9 !important;
        }

        @media (max-width: 575px) {
            .hc-grid-item-skiled img {
                height: 70px;
                width: 100px;
                object-fit: contain;
            }
        }
    </style>
@endsection
@section('content')
    <!-- navbar  end  -->

    <!-- home page  banner  img  start  -->

    <div class="home-banner-imgsection">
        <img class="img-fluid" src="{{ asset('frontend/img/home-banner.png') }}" alt="">
        <div class="container">
            <div class="homebanner-text">
                <p>{{ GetHomePageSetting('title') }}</p>
                <h2>{{ GetHomePageSetting('description') }}</h2>
                <button onclick="openNewWindow('{{ GetHomePageSetting('link') }}')">{{ __('messages.learn_more') }}</button>

                {{-- <button onclick="window.location.href = 'your_redirect_url_here'">Learn More</button> --}}
            </div>
        </div>
    </div>

    <!-- home page  banner  img  end -->

    <!-- how  it  work  start  -->

    <div class="container">
        <div class="how-it-worksection">
            <h4 class="how-it-worktext">{{ __('messages.how_it_works') }}</h4>
            <div class="how-itwork-gridbhag">
                <div class="hiw-grid-item">
                    <div class="number-imagemain">
                        <p>1</p>
                        <img src="{{ asset('frontend/img/searchplay.png') }}" class="img-fluid" alt="">
                    </div>

                    <div class="hit-sign-uptext">
                        <h4>{{ __('messages.sign_up_platform') }}</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>

                <div class="hiw-grid-item">
                    <div class="number-imagemain">
                        <p>2</p>
                        <img src="{{ asset('frontend/img/peopleplus.png') }}" class="img-fluid" alt="">
                    </div>

                    <div class="hit-sign-uptext">
                        <h4>{{ __('messages.browse_videos') }}</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>

                <div class="hiw-grid-item">
                    <div class="number-imagemain">
                        <p>3</p>
                        <img src="{{ asset('frontend/img/taj.png') }}" class="img-fluid" alt="">
                    </div>

                    <div class="hit-sign-uptext">
                        <h4>{{ __('messages.find_your_pro') }}</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>

                </div>

                <div class="hiw-grid-item">
                    <div class="number-imagemain">
                        <p>4</p>
                        <img src="{{ asset('frontend/img/bookclick.png') }}" class="img-fluid" alt="">
                    </div>

                    <div class="hit-sign-uptext">
                        <h4>{{ __('messages.book_your_sessions') }}</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>

                <div class="hiw-grid-item">
                    <div class="number-imagemain">
                        <p>5</p>
                        <img src="{{ asset('frontend/img/star.png') }}" class="img-fluid" alt="">
                    </div>

                    <div class="hit-sign-uptext">
                        <h4>{{ __('messages.rate_your_pro') }}</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- how it work  end  -->

    <!-- happy  client start  -->

    <div class="happy-client-bg">
        <div class="container">
            <div class="happy-client-grid">
                <div class="hc-grid-item">
                    <div class="hc-grid-item-innerdata">
                        <img src="{{ asset('frontend/img/happy-client-1.png') }}" alt="">
                        <div>
                            <p class="hc-giinnr-numbers">778+</p>
                            <p class="hc-giinnr-text">{{ __('messages.happy_clients') }}</p>
                        </div>
                    </div>
                </div>

                <div class="hc-grid-item">
                    <div class="hc-grid-item-innerdata">
                        <img src="{{ asset('frontend/img/happy-client-2.png') }}" alt="">
                        <div>
                            <p class="hc-giinnr-numbers">106+</p>
                            <p class="hc-giinnr-text">{{ __('messages.message_therapy') }}</p>
                        </div>
                    </div>
                </div>

                <div class="hc-grid-item">
                    <div class="hc-grid-item-skiled" style="width:unset">
                        <img src="{{ asset('frontend/img/happy-client-3.png') }}"alt="">
                        <div>
                            <p class="hc-giinnr-numbers">880+</p>
                            <p class="hc-giinnr-text">{{ __('messages.skilled_therapy') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- happy  client end  -->

    <!-- top physio start  -->

    <div class="container">
        <div class="top-physio-section">
            <h2 class="top-physio-text">{{ __('messages.top_physio_therapies') }}</h2>
            <div id="top-physio-carousel" class="owl-carousel owl-theme">
                @foreach ($physio_list as $key => $value)
                    <div class="item">
                        @if ($value->slug != null)
                            <a class="doctor-namelink-box"
                                href="{{ route('front.physio.bio', ['slug' => $value->slug]) }}">
                            @else
                                <a class="doctor-namelink-box" href="javascript:void(0)">
                        @endif
                        <div>
                            <img src="{{ asset('uploads/profilephoto/' . $value->profile_photo) }}"
                                class="img-fluid doctor-slider-img" alt="">
                            <div class="doctor-data">
                                <p class="doctor-name">{{ $value->displayname }}</p>
                                @if ($value->year_of_experience != 0)
                                    <p class="doctor-exp">{{ $value->year_of_experience }} {{ __('messages.yrs_exp') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- top physio end  -->

    <!-- video  section  start  -->

    <div class="video-bg">

        <div class="container">
            <div class="row slider-sync-box">
                <div class="col-md-6">
                    <div id="sync1" class="owl-carousel owl-theme">
                        @foreach ($videos as $key => $value)
                            <div class="item">
                                <div class="videotag-play">
                                    <video width="100%" height="100%" id="home-video-{{ $value->id }}"
                                        poster="{{ asset('uploads/thumbnail/' . $value->thumbnail) }}">
                                        <source src="{{ asset('uploads/videos/' . $value->video) }}" type="video/mp4">
                                        {{ __('messages.browser_not_support_video') }}
                                    </video>
                                    <div class="video-titile-group">
                                        <div class="play-bt"><i class="fa-solid fa-play"></i></div>
                                        <div class="pause-bt" style="display:none;"><i class="fa-solid fa-pause"></i>
                                        </div>
                                        <div class="video-list-donametext">
                                            <p>
                                                {{ isset($value->user()->first()->first_name) ? $value->user()->first()->first_name : '' }}
                                                {{ isset($value->user()->first()->last_name) ? $value->user()->first()->last_name : '' }}
                                            </p>



                                            <p>{{ $value->title }}</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="home-textpara">{{ $value->title }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="sync2" class="owl-carousel owl-theme">
                        @foreach ($videos as $key => $value)
                            @if ($loop->first)
                                @continue;
                            @endif
                            <div class="item">
                                <div class="videotag-play">
                                    <video width="100%" height="100%" id="video-custom-1"
                                        poster="{{ asset('uploads/thumbnail/' . $value->thumbnail) }}">
                                        <source src="{{ asset('uploads/videos/' . $value->video) }}" type="video/mp4">
                                        {{ __('messages.browser_not_support_video') }}
                                    </video>
                                    <div class="video-titile-group">
                                        <div class="play-bt"><i class="fa-solid fa-play"></i></div>
                                        <div class="pause-bt" style="display:none;"><i class="fa-solid fa-pause"></i>
                                        </div>
                                        <div class="video-list-donametext">
                                            <p>
                                                {{ isset($value->user()->first()->first_name) ? $value->user()->first()->first_name : '' }}
                                                {{ isset($value->user()->first()->last_name) ? $value->user()->first()->last_name : '' }}
                                            </p>

                                            <p>{{ $value->title }}</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="home-textpara">{{ $value->title }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- video  section  end -->

    <!-- subscription  start  -->

    <div class="container">
        @php
            $subscriptions = getsubscribelist();
        @endphp

        <div class="subscription-section">
            <h2 class="subscription-head">{{ __('messages.subscriptions') }}</h2>
            <div class="grid-subscription">
                @foreach ($subscriptions as $key => $value)
                    <div class="home-subscrit-card-item">
                        <div class="subscrit-card-item">
                            <p class="subscrit-free-btn">
                                {{ $value->title }}
                            </p>
                            <div class="subscrit-free-datatext">
                                <span class="free-month-text">
                                    <span class="euro-text">
                                        <i class="fa-solid fa-euro-sign"></i> {{ $value->price }}
                                    </span>
                                    {{ $value->model_type == '1' ? 'Month' : 'Year' }}
                                </span>

                                <div class="subcribtion-height">
                                    @foreach ($value->SubscriptionDescription as $list)
                                        @if ($list->description != '')
                                            <p>{{ $list->description }}</p>
                                        @endif
                                    @endforeach
                                </div>
                                @auth
                                    @php
                                        $user = Auth::user();
                                        $isCurrentPlan = $user->subscription_id == $value->id;
                                        // $currentPlanPrice = $user->subscription->price;
                                        $currentPlanPrice = optional($user->subscription)->price;
                                    @endphp

                                    @if ($isCurrentPlan)
                                        <a href="javascript:void(0);" class="card-subscription-btn btn-disabled">
                                            {{ __('messages.subscribed') }}
                                        </a>
                                    @else
                                        {{-- @php
                                            $buttonText = $value->price < $currentPlanPrice ? 'DOWNGRADE' : 'UPGRADE';
                                        @endphp --}}
                                        {{-- @php
                                            $buttonText =
                                                $currentPlanPrice !== null && $value->price < $currentPlanPrice
                                                ? {{ __('messages.downgrade') }}
                                                : {{ __('messages.upgrade') }};
                                        @endphp
                                        <a href="{{ route('payment', ['subscription' => $value->id]) }}"
                                            class="card-subscription-btn btn-subscribe-upgrade">
                                            {{ $buttonText }}
                                        </a> --}}
                                        @php
                                            $buttonText =
                                                $currentPlanPrice !== null && $value->price < $currentPlanPrice
                                                    ? __('messages.downgrade')
                                                    : __('messages.upgrade');
                                        @endphp

                                        <a href="{{ route('payment', ['subscription' => $value->id]) }}"
                                            class="card-subscription-btn btn-subscribe-upgrade">
                                            {{ $buttonText }}
                                        </a>
                                    @endif
                                @else
                                    {{-- <a class="navbar-sign-upbtn unlog-subscription-btn" style="line-height:1" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#siguploginModal" onclick="clearErrors()">{{ __('messages.subscribe_now') }}</a> --}}
                                    
                                    <a class="navbar-sign-upbtn unlog-subscription-btn btn btn-outline-primary btn-outline-primary-custom" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#siguploginModal" onclick="clearErrors()">{{ __('messages.subscribe_now') }}</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <!-- subscription  end  -->
    @if (Session::has('is_subscribe'))
        @php
            $subscription = Session::get('subscription');
            $is_subscribe = Session::get('is_subscribe');
            Session::forget('subscription');
            Session::forget('is_subscribe');
        @endphp

        @if ($is_subscribe == 1)
            <!-- Modal -->
            <div class="modal fade" id="subscribeSuccessModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2>{{ __('messages.subscribed_successfully') }} 🎉</h2>
                            <button data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i></button>
                        </div>
                        <div class="modal-body">
                            @php
                                Session::has('is_subscribe');
                                $title = $subscription->title; // Get the title from your subscription object
                                $message = __('messages.subscription_success', ['title' => $title]);
                            @endphp
                            {{-- Congratulations on upgrading to our {{ $subscription->title }}
                            subscription plan! 🎉 Thank you for choosing to unlock the full
                            potential of our platform with the {{ $subscription->title }} plan.
                            With this subscription, you now have access to exclusive features and benefits that will enhance your
                            experience. We're thrilled to have you on board and look forward to helping you achieve your
                            goals.
                            If you have any questions or need assistance, don't hesitate to reach out to our support team. Happy
                            exploring! --}}

                            {!! $message !!}
                        </div>
                    </div>
                </div>
            </div>
        @elseif($is_subscribe == 0)
            @php
                $user = Session::get('user');
                Session::forget('user');
            @endphp
            <!-- Modal -->
            <div class="modal fade" id="subscribeSuccessModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2>{{ __('messages.subscribed_failed') }} 😞</h2>
                            <button data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i></button>
                        </div>
                        <div class="modal-body">
                            @php
                                Session::has('is_subscribe');
                                $title = $subscription->title; // Get the subscription title
                                $username = $user->username; // Get the user's username
$message = __('messages.payment_issue', ['username' => $username, 'title' => $title]);
                            @endphp
                            {{-- "Dear {{ $user->username }}, we're sorry, but it seems there was an issue processing your
                            payment
                            for the {{ $subscription->title }} subscription plan. 😞 We apologize for any inconvenience
                            this may have caused. Please double-check your payment information and try again. If the problem
                            persists, feel free to contact our support team for further assistance. Thank you for your
                            understanding. --}}
                            {!! $message !!}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif



    <div class="modal fade" id="UserSubscriptionNotification" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>{{ __('messages.subscription_notification') }}</h3>
                    <button data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <p>{{ __('messages.no_access_purchase_plan') }}</p>
                </div>
            </div>
        </div>
    </div>


    <!-- get  in touch  start  -->
    @include('frontend.partial.getintouch')
    @foreach ($video as $key => $value)
        <div class="modal fade" id="exampleModal-{{ $value['id'] }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" style="padding: 10px;margin: 0px;">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ $value['description'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection


@section('js')
    <script>
        $(document).ready(function() {
            $('#video-physio-carousel').owlCarousel({
                // stagePadding: 40,
                loop: true,
                // video-physio-carousel
                marginleft: 20,
                dots: true,
                nav: true,
                items: 1,
            });

            var sync1 = $("#sync1");
            var sync2 = $("#sync2");
            var slidesPerPage = 1; //globaly define number of elements per page
            var syncedSecondary = true;

            sync1.owlCarousel({
                items: 1,
                slideSpeed: 2000,
                nav: true,
                autoplay: false,
                dots: true,
                loop: true,
                autoHeight: true, // Enable auto height
                responsiveRefreshRate: 200,
                navText: [
                    '<svg width="100%" height="100%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>',
                    '<svg width="100%" height="100%" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'
                ],
            }).on('changed.owl.carousel', syncPosition);

            sync2
                .on('initialized.owl.carousel', function() {
                    sync2.find(".owl-item").eq(0).addClass("current");
                })
                .owlCarousel({
                    items: slidesPerPage,
                    dots: true,
                    nav: true,
                    smartSpeed: 200,
                    slideSpeed: 500,
                    slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
                    autoHeight: true, // Enable auto height
                    responsiveRefreshRate: 100
                }).on('changed.owl.carousel', syncPosition2);

            function syncPosition(el) {
                //if you set loop to false, you have to restore this next line
                //var current = el.item.index;

                //if you disable loop you have to comment this block
                var count = el.item.count - 1;
                var current = Math.round(el.item.index - (el.item.count / 2) - .5);

                if (current < 0) {
                    current = count;
                }
                if (current > count) {
                    current = 0;
                }

                //end block

                sync2
                    .find(".owl-item")
                    .removeClass("current")
                    .eq(current)
                    .addClass("current");
                var onscreen = sync2.find('.owl-item.active').length - 1;
                var start = sync2.find('.owl-item.active').first().index();
                var end = sync2.find('.owl-item.active').last().index();

                if (current > end) {
                    sync2.data('owl.carousel').to(current, 100, true);
                }
                if (current < start) {
                    sync2.data('owl.carousel').to(current - onscreen, 100, true);
                }
            }

            function syncPosition2(el) {
                if (syncedSecondary) {
                    var number = el.item.index;
                    sync1.data('owl.carousel').to(number, 100, true);
                }
            }

            sync2.on("click", ".owl-item", function(e) {
                e.preventDefault();
                var number = $(this).index();
                sync1.data('owl.carousel').to(number, 300, true);
            });
        });
    </script>


    <script>
        $('#top-physio-carousel').owlCarousel({
            loop: true,
            margin: 20,
            dots: true,
            nav: true,
            items: 4,
            autoplay: false,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                450: {
                    items: 1
                },
                600: {
                    items: 1
                },
                767: {
                    items: 3
                },
                1024: {
                    items: 4
                }
            }
        });
    </script>
    <script>
        function openNewWindow(url) {
            // alert('10');
            if (url) {
                window.open(url, '_blank');
            } else {
                // Handle the case where the URL is empty or undefined
                console.error('URL is empty or undefined');
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $("#subscribeSuccessModal").modal('show');
            var role_id = "{{ Auth::check() ? Auth::user()->role_id : '' }}"


            $(".btn-subscribe-upgrade").click(function() {
                if (role_id == 3) {
                    event.preventDefault();
                    $("#UserSubscriptionNotification").modal('show');

                    // alert('You have no access to purchase this plan');
                    return false
                } else {
                    return true
                }
            });

        });
    </script>

    {{-- <script>
        $(document).ready(function() {
            $("#subscribeSuccessModal").modal('show');
            var role_id = "{{ Auth::check() ? Auth::user()->role_id : '' }}"


            $(".btn-subscribe-upgrade").click(function() {
                if (role_id == 3) {
                    event.preventDefault();
                    alert('You have no access to purchase this plan');
                    return false
                } else {
                    return true
                }
            });

        });
    </script> --}}
@endsection
