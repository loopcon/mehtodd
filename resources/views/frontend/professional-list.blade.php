@extends('frontend.partial.master')
@section('page-css')
    <style>
        .like-float-right {
            float: right;
        }

        .no-professionals {
            opacity: 0.5;
            padding: 20px;
        }

        .viewer-count-videolist {
            float: right;

        }

        .professinal-box {
            text-align: center;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        .container-professionals-box h5 {
            font-size: 1rem;
        }

        .professinal-box img {
            max-width: 120px;
            height: 114px;
            border-radius: 50%;
            margin-bottom: 5px;
        }

        .professinal-box h4 {
            margin-bottom: 3px;
        }

        .professinal-box p {
            font-size: 12px;
            color: #666;
        }
    </style>
@endsection

@section('content')
    <!-- profile list page  start  -->
    <div>
        <div class="container">
            <div>
                <form action="javascript:void(0);" method="get" id="frm_username">
                    <div class="searchbar-box">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="receipt_name" id="receipt_username"
                                placeholder="Nom d’utilisateur du destinataire" aria-label="Nom d’utilisateur du destinataire"
                                aria-describedby="basic-addon2" value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="input-group-text" id="btn_receipt_username"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="row professional-list-box">
                <div class="col-12 col-lg-3">

                    <form action="{{ route('front.professional-list') }}" method="get" id="frm_video_filter">

                        <input type="hidden" name="search" id="receipt_name" value="{{ request('search') }}">
                        @php
                            $selectedCategories = request()->has('select_categories')
                                ? request()->get('select_categories')
                                : [];

                        @endphp

                        <div class="mobile-filter-icon">
                            <a href="javascript:void(0)">{{ __('messages.filters') }} <i class="fa-solid fa-sliders"></i> </a>
                        </div>
                        <div class="category-border-show mobile-professional-listfilter">
                            <h2 class="filter-heading-text mobile-filtertext">
                                <i class="fa-solid fa-filter"></i> {{ __('messages.filters') }}
                                @if (request()->has('select_categories'))
                                    <a href="{{ route('front.professional-list') }}">{{ __('messages.clear') }}</a>
                                @endif
                            </h2>
                            <div class="category-itembox">
                                <a href="javascript:void(0)" class="click-category active">{{ __('messages.categories') }}
                                    <i class="fa-solid fa-chevron-{{ $selectedCategories ? 'down' : 'right' }}"></i></a>

                                <div
                                    class="category-show category_btn  {{ $selectedCategories ? 'video-list-active' : '' }} ">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="select_categories[]"
                                            value="1" id="category1"
                                            {{ in_array('1', $selectedCategories) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="category1"> {{ __('messages.sports') }} </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="2"
                                            name="select_categories[]" id="category2"
                                            {{ in_array('2', $selectedCategories) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="category2"> {{ __('messages.Kinésithérapie') }} </label>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </form>
                </div>

                <div class="col-12 col-lg-9">
                    <div class="professional-listpage-main">
                        <ul class="tiles-wrap animated" id="wookmark4">
                            @if (count($professionals) <= 0)
                                <div class="no-professionals">
                                    <h5>{{ __('messages.no_professionals_available') }}</h5>
                                </div>
                            @else
                                @php
                                    $user = Auth::user();
                                    $user_id = '';
                                    if ($user) {
                                        $user_id = $user->id;
                                    }
                                    // dd($user_id)
                                @endphp

                                <!-- professional-list.blade.php -->
                                {{-- @dd($professionals); --}}
                                {{-- @foreach ($professionals as $professional)
                                    <li class="col-md-3 col-sm-6 mb-4">
                                        @if (isset($professional->slug))
                                            <a href="{{ route('front.physio.bio', ['slug' => $professional->slug]) }}">
                                                <div>
                                                    @php
                                                        $profilePhoto = $professional->profile_photo
                                                            ? 'uploads/profilephoto/' . $professional->profile_photo
                                                            : 'frontend/img/default_image.png';
                                                    @endphp
                                                    <img src="{{ asset($profilePhoto) }}" alt="Profile Photo"
                                                        class="img-fluid rounded-circle mb-3"
                                                        style="width: 100px; height: 100px;">
                                                    @if ($professional->is_ads == 1)
                                                        <span class="badge badge-success mb-2">Ad</span>
                                                    @endif
                                                    <h6 class="mt-2 ">{{ htmlspecialchars($professional->displayname) }}
                                                    </h6>
                                                </div>
                                            </a>
                                        @endif
                                    </li>
                                @endforeach --}}

                                @foreach ($professionals as $professional)
                                    <li class="col-md-3 col-sm-6 mb-4">
                                        @if (isset($professional->slug))
                                            <a href="{{ route('front.physio.bio', ['slug' => $professional->slug]) }}">
                                                <div
                                                    class="professinal-box p-3 border rounded text-center shadow-sm d-flex flex-column align-items-center position-relative">
                                                    @php
                                                        $profilePhoto = $professional->profile_photo
                                                            ? 'uploads/profilephoto/' . $professional->profile_photo
                                                            : 'frontend/img/default_image.png';
                                                    @endphp
                                                    <img src="{{ asset($profilePhoto) }}" alt="Profile Photo"
                                                        class="img-fluid rounded-circle mb-3"
                                                        style="width: 100px; height: 100px;">

                                                    @if ($professional->is_ads == 1)
                                                        {{-- <span class="badge badge-success position-absolute"
                                                            style="top: 10px; right: 10px;">Ad</span> --}}
                                                        <a class="position-absolute" style="top: 10px; right: 10px;"><i
                                                                class="fas fa-ad" style="font-size:1.5em;"></i></a>
                                                    @endif

                                                    {{-- <h6 class="mt-2">{{ htmlspecialchars($professional->displayname) }}
                                                        <span>
                                                            @if (auth()->user())
                                                                @if (auth()->user()->role_id == 3)
                                                                    <a href="{{route('front.physio.bio', ['slug' => Auth::user()->slug, 'user_id' => $professional->id])}}"><i class="fa-solid fa-envelope"></i></a>
                                                                @endif                                                        
                                                            @endif
                                                        </span>
                                                    </h6> --}}

                                                    <h6 class="mt-2 mb-1">
                                                        {{ htmlspecialchars($professional->displayname) }}
                                                    </h6>

                                                    @if (auth()->check() && auth()->user()->role_id == 3)
                                                        <a href="{{ route('front.physio.bio', ['slug' => auth()->user()->slug, 'user_id' => $professional->id]) }}"
                                                        class="btn btn-outline-primary btn-sm mt-2">
                                                            <i class="fa-solid fa-envelope me-1"></i> Contact
                                                        </a>
                                                    @endif
                                


                                                </div>
                                            </a>
                                        @endif
                                    </li>
                                @endforeach

                                <!-- Pagination Links -->



                                {{-- <!-- Ensure category is handled correctly -->
                                @php
                                    $selectedCategories = is_array(request('category'))
                                        ? implode(', ', request('category'))
                                        : request('category');
                                @endphp

                                <p>Selected Categories: {{ htmlspecialchars($selectedCategories) }}</p> --}}
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            {{ $professionals->links('frontend.video-pagination') }}

        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.category_btn input[type="checkbox"]').click(function() {
                var selectedVal = $(this).val();
                var isChecked = $(this).prop('checked');

                // Set value of selected_categories field
                $('#select_categories').val(isChecked ? selectedVal : '');

                // Debugging: Alert to see the value
                console.log("Selected Category Value: " + $('#select_categories').val());
                // return true;

                // Uncheck other checkboxes
                $('.category_btn input[type="checkbox"]').prop('checked', false);

                // Re-check the current checkbox if it was originally checked
                $(this).prop('checked', isChecked);

                // Submit the form
                $('#frm_video_filter').submit();
            });
        });
    </script>

    <script>
        function tabView(element_id) {
            var wookmark1 = new Wookmark(element_id, {
                outerOffset: 10, // Optional, the distance to the containers border
                itemWidth: 260, // Optional, the width of a grid item
            });
        };


        $(document).ready(function() {

            $('.click-category').click(function() {
                $(this).siblings('.category-show').toggleClass("video-list-active").next().toggle();
                $(this).find('svg').toggleClass('fa-chevron-down fa-chevron-right');
            });

            $('.category-itembox ul li a span').click(function() {
                $(this).closest('a').siblings('ul').toggle();
                $(this).find('svg').toggleClass('fa-chevron-right fa-chevron-down');
            });

            tabView("#wookmark4");
            // search  header open  js
            $(document).on("click", ".navbar-search-btn", function() {
                $('.navbar-searchbar-box').show();
                $(this).find('svg').removeClass('fa-magnifying-glass').addClass('fa-xmark');
                $(this).addClass('nav-searchbar-close').removeClass('navbar-search-btn');
            });

            $(document).on("click", ".nav-searchbar-close", function() {
                $('.navbar-searchbar-box').hide();
                $(this).find('svg').removeClass('fa-xmark').addClass('fa-magnifying-glass');
                $(this).removeClass('nav-searchbar-close').addClass('navbar-search-btn');
            });

            $('.categories-heading').click(function() {
                $(this).find('svg').toggleClass('fa-chevron-up fa-chevron-down');
            });

            $(".bio-video-tabs li").click(function() {
                var tab_id = $(this).attr("data-id");

                $(".bio-video-tabs li").removeClass("bv-current");
                $(".bio-video-tab-content").removeClass("bv-current");

                $(this).addClass("bv-current");
                $("#" + tab_id).addClass("bv-current");
            });
            // search  header open  js
            $('.mobile-filter-icon').click(function() {
                $('.mobile-video-listfilter').toggle();
            });


        });
    </script>

    <script>
        $(document).ready(function() {
            // $('.category_btn').click(function() {
            //     $('#frm_video_filter').submit();
            // });
            $('.tag_btn').click(function() {
                $('#frm_video_filter').submit();
            });
            $('.sport_btn').click(function() {
                $('#frm_video_filter').submit();
            });
            $('.length_btn').click(function() {

                $('#frm_video_filter').submit();
            });
            // $('.added_btn input[type="checkbox"]').click(function() {
            //     var isChecked = $(this).prop('checked');
            //     $('.added_btn input[type="checkbox"]').prop('checked', false);
            //     $(this).prop('checked', isChecked);
            //     $('#added').val(isChecked ? $(this).val() : '');
            //     $('#frm_video_filter').submit();
            // });

            $('#select_sort_by').change(function() {
                $('#sort_type').val($(this).val());
                $('#frm_video_filter').submit();
            });
            $('#btn_receipt_username').click(function() {
                var receipt_username = $('#receipt_username').val();
                $('#receipt_name').val(receipt_username);
                $('#frm_video_filter').submit();
            });
            $('.difficulty_btn').click(function() {
                $('#frm_video_filter').submit();
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
                        // Change button style if like is successful
                        // Update button HTML based on the response
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

        $(document).ready(function() {
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

                        $button.html('<i class="fa-regular fa-heart"></i>').removeClass(
                            'unlike-like-video-btn').addClass('btn_like_video');

                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error('Error liking video:', error);
                    }
                });
            });
            $(document).on('submit', '#frm_username', function(e) {

                e.preventDefault();


                $('#receipt_name').val($('#receipt_username').val(););
                $('#frm_video_filter').submit();


            });
        });
    </script>
@endsection
