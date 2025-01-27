@extends('frontend.partial.master')
@section('page-css')
    <style>
        .like-float-right {
            float: right;
        }

        .no-videos {
            opacity: 0.5;
            padding: 20px;
        }

        .viewer-count-videolist {
            float: right;

        }
    </style>
@endsection

@section('content')

    <!-- video  list page  start  -->
    <div>
        <div class="container">
            <div>
                <div class="searchbar-box">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="receipt_name" id="receipt_username"
                            placeholder="Nom d’utilisateur du destinataire" aria-label="Nom d’utilisateur du destinataire"
                            aria-describedby="basic-addon2" value="{{ request('receipt_name') }}">
                        <div class="input-group-append">
                            <button type="submit" class="input-group-text" id="btn_receipt_username"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="sorting-selectbox">
                        <select class="form-select" aria-label="Default select example" id="select_sort_by"
                            name="sort_type">
                            <option value="0" {{ request('sort_type') == '0' ? 'selected' : '' }}>{{ __('messages.search_by_popularity') }}
                            </option>
                            <option value="1" {{ request('sort_type') == '1' ? 'selected' : '' }}>{{ __('messages.longest_first') }}
                            </option>
                            <option value="2" {{ request('sort_type') == '2' ? 'selected' : '' }}>{{ __('messages.shortest_first') }}
                            </option>
                            <option value="3" {{ request('sort_type') == '3' ? 'selected' : '' }}>{{ __('messages.newest_first') }}
                            </option>
                            {{-- <option value="4" {{ request('sort_type') == '4' ? 'selected' : '' }}> from longest to
                                shortest
                            </option> --}}
                            {{-- <option value="5" {{ request('sort_type') == '5' ? 'selected' : '' }}>from expert to easy
                            </option> --}}
                        </select>
                    </div>

                </div>
            </div>
            <div class="row video-list-box">
                <div class="col-12 col-lg-3">
                    <form action="{{ route('front.video-list') }}" method="get" id = "frm_video_filter">
                        <input type="hidden" name="sort_type" id="sort_type" value="{{ request('sort_type') }}">
                        <input type="hidden" name="receipt_name" id="receipt_name" value="{{ request('receipt_name') }}">
                        <input type="hidden" name="added" id="added" value="{{ request('added') }}">


                        <div class="mobile-filter-icon"> <a href="javascript:void(0)">{{ __('messages.filters') }}
                            <i class="fa-solid fa-sliders"></i> </a>
                        </div>
                        <div class="category-border-show mobile-video-listfilter">
                            <h2 class="filter-heading-text mobile-filtertext"> <i class="fa-solid fa-filter"></i> {{ __('messages.filters') }}
                                @if (request()->has('category'))
                                    <a href="{{ route('front.video-list') }}">{{ __('messages.clear') }}</a>
                                @endif
                            </h2>
                            <div class="category-itembox">
                                <a href="javascript:void(0)" class="click-category">{{ __('messages.categories') }} <i
                                        class="fa-solid fa-chevron-down"></i>
                                </a>
                                <input type="hidden" name="category[]">
                                <ul class="category-show list-active">
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
                                                <div class="form-check category_btn">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $list->id }}" id="video-category{{ $level1 }}"
                                                        name="category[]"
                                                        {{ in_array($list->id, request('category', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="video-category{{ $level1 }}">{{ $list->name }}</label>
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
                                                                    $data['sub_category1_list'][$list->id][$list1->id],
                                                                ) > 0;
                                                        @endphp
                                                        <li>
                                                            <a href="javascript:void(0)" class="subcat-click-category">
                                                                <div class="form-check category_btn">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="{{ $list1->id }}"
                                                                        id="video-category{{ $level1 }}-{{ $level2 }}"
                                                                        name="category[]"
                                                                        {{ in_array($list1->id, request('category', [])) ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="video-category{{ $level1 }}-{{ $level2 }}">{{ $list1->name }}</label>
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
                                                                                <div class="form-check category_btn">
                                                                                    <input class="form-check-input"
                                                                                        type="checkbox"
                                                                                        value="{{ $list2->id }}"
                                                                                        id="video-category{{ $level1 }}-{{ $level2 }}-{{ $level3 }}"
                                                                                        name="category[]"
                                                                                        {{ in_array($list2->id, request('category', [])) ? 'checked' : '' }}>
                                                                                    <label class="form-check-label"
                                                                                        for="video-category{{ $level1 }}-{{ $level2 }}-{{ $level3 }}">{{ $list2->category_name }}</label>
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
                                                                                                    class="form-check category_btn">
                                                                                                    <input
                                                                                                        class="form-check-input"
                                                                                                        type="checkbox"
                                                                                                        value="{{ $list3->id }}"
                                                                                                        id="video-category-{{$key}}-{{ $level1 }}-{{ $level2 }}-{{ $level3 }}-{{ $level4 }}"
                                                                                                        name="category[]"
                                                                                                        {{ in_array($list3->id, request('category', [])) ? 'checked' : '' }}>
                                                                                                    <label
                                                                                                        class="form-check-label"
                                                                                                        for="video-category-{{$key}}-{{ $level1 }}-{{ $level2 }}-{{ $level3 }}-{{ $level4 }}">{{ $list3->category_name }} </label>
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
                            @php
                                $selectedTags = request()->has('tag');
                                $expandTags = $selectedTags || count(request('tag', [])) > 0;
                            @endphp

                            <div class="category-itembox">
                                <a href="javascript:void(0)"
                                    class="click-category{{ $expandTags ? ' active' : '' }}">{{ __('messages.tag') }}
                                    <i class="fa-solid fa-chevron-{{ $expandTags ? 'down' : 'right' }}"></i></a>
                                <div class="category-show tag_btn{{ $expandTags ? ' active list-active' : '' }}">
                                    <div class="form-check">
                                        @foreach ($tag as $list)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="{{ $list->id }}" id="tag{{ $list->id }}"
                                                    name="tag[]"
                                                    {{ $selectedTags && in_array($list->id, request('tag')) ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="tag{{ $list->id }}">{{ $list->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            @php
                                $selectedTags = request()->has('sport');
                                $expandTags = $selectedTags || count(request('sport', [])) > 0;
                            @endphp

                            <div class="category-itembox">
                                <a href="javascript:void(0)"
                                    class="click-category{{ $expandTags ? ' active' : '' }}">{{ __('messages.sports') }}
                                    <i class="fa-solid fa-chevron-{{ $expandTags ? 'down' : 'right' }}"></i></a>
                                <div class="category-show sport_btn{{ $expandTags ? ' active list-active' : '' }}">
                                    <div class="form-check">
                                        @foreach ($sport as $list)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="{{ $list->id }}" id="sport{{ $list->id }}"
                                                    name="sport[]"
                                                    {{ $selectedTags && in_array($list->id, request('sport')) ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="sport{{ $list->id }}">{{ $list->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>



                            @php
                                $selectedLength = request()->has('length');
                                $expandLength = $selectedLength || count(request('length', [])) > 0;
                                $lengthOptions = ['0-1', '1-3', '3-7', '7-15', '>15'];
                            @endphp

                            <div class="category-itembox">
                                <a href="javascript:void(0)"
                                    class="click-category{{ $expandLength ? ' active' : '' }}">{{ __('messages.length') }}
                                    <i class="fa-solid fa-chevron-{{ $expandLength ? 'down' : 'right' }}"></i></a>
                                <div class="category-show length_btn{{ $expandLength ? ' active list-active' : '' }}">
                                    @foreach ($lengthOptions as $index => $length)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $length }}"
                                                id="length{{ $index + 1 }}" name="length[]"
                                                {{ $selectedLength && in_array($length, request('length')) ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="length{{ $index + 1 }}">{{ $length }} min</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            @php
                                $selectedAdded = request()->has('added');
                                $expandAdded = $selectedAdded || !empty(request('added'));
                            @endphp

                            <div class="category-itembox">
                                <a href="javascript:void(0)"
                                    class="click-category{{ $expandAdded ? ' active' : '' }}">{{ __('messages.added') }}
                                    <i class="fa-solid fa-chevron-{{ $expandAdded ? 'down' : 'right' }}"></i>
                                </a>
                                <div class="category-show added_btn active {{ $expandAdded ? 'list-active' : '' }}">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="today" id="added1"
                                            name="added"
                                            {{ $selectedAdded && request('added') == 'today' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="added1"> {{ __('messages.today') }}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="this_week" id="added2"
                                            name="added"
                                            {{ $selectedAdded && request('added') == 'this_week' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="added2">{{ __('messages.this_week') }}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="this_month"
                                            id="added3" name="added"
                                            {{ $selectedAdded && request('added') == 'this_month' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="added3">{{ __('messages.this_month') }}
                                        </label>
                                    </div>
                                </div>
                            </div>


                            @php
                                $expandDifficulty = count(request('difficulty', [])) > 0;
                            @endphp

                            <div class="category-itembox">
                                <a href="javascript:void(0)"
                                    class="click-category{{ $expandDifficulty ? ' active' : '' }}">{{ __('messages.difficulty') }}
                                    <i class="fa-solid fa-chevron-{{ $expandDifficulty ? 'down' : 'right' }}"></i>
                                </a>
                                <div class="category-show active {{ $expandDifficulty ? 'list-active' : '' }}">
                                    <div class="form-check">
                                        @foreach ($difficulty as $list)
                                            <div class="form-check">
                                                <input class="form-check-input difficulty-checkbox difficulty_btn"
                                                    type="checkbox" value="{{ $list->id }}"
                                                    id="difficulty{{ $list->id }}" name="difficulty[]"
                                                    {{ in_array($list->id, request('difficulty', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="difficulty{{ $list->id }}">{{ $list->name }}{{ $list->category_id }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>

                <div class="col-12 col-lg-9">
                    <div class="video-listpage-main">
                        <ul class="tiles-wrap animated" id="wookmark4">
                            @if (count($video) === 0)
                                <div class="no-videos">
                                    <h5>{{ __('messages.no_videos_available') }}</h5>
                                </div>
                            @else
                                @php
                                    $user = Auth::user();
                                    $user_id = '';
                                    if ($user) {
                                        $user_id = $user->id;
                                    }
                                @endphp

                                @foreach ($video as $key => $value)
                                    @if ($value->video != null)
                                        <li>
                                            <div class="videotag-play">
                                                <div class="videotag-play">
                                                    @php
                                                        $hasLiked = $value->likes
                                                            ->where('user_id', $user_id)
                                                            ->isNotEmpty();

                                                        $video_length_min = $value->length / 60;
                                                    @endphp

                                                    @if ($hasLiked)
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
                                                    {{-- <span class="viewer-count_videolist">
                                                        <i class="fa-regular fa-eye"></i>
                                                    </span> --}}
                                                    <div class="video-actions" title="{{ $value->videoViewCount() }}">
                                                        <span class="viewer-count viewer-count-videolist ">
                                                            <i class="fa-regular fa-eye"></i>
                                                        </span>
                                                    </div>

                                                </div>

                                                <video class="video-play-pause" width="100%" height="100%"
                                                    id="video-custom-{{ $key }}"
                                                    @if ($value->thumbnail != null) poster="{{ asset('uploads/thumbnail/' . $value->thumbnail) }}" @endif>
                                                    {{-- {{ $key }} --}}
                                                    <source src="{{ asset('uploads/videos/' . $value->video) }}"
                                                        type="video/mp4">
                                                        {{ __('messages.browser_not_support_video') }}
                                                </video>
                                                <div class="video-titile-group">
                                                    <div class="play-bt" data-id={{ $value->id }}><i
                                                            class="fa-solid fa-play"></i></div>
                                                    <div class="pause-bt" style="display:none;"><i
                                                            class="fa-solid fa-pause"></i></div>
                                                    <div class="video-list-donametext">
                                                        {{-- <p>{{ $value['name'] }}</p> --}}
                                                        <p>
                                                            @if (isset($value['user']['displayname']) && $value['user']['displayname'] !== null)
                                                                {{ $value['user']['displayname'] }}
                                                            @else
                                                                &nbsp;
                                                            @endif
                                                        </p>
                                                        <p> {{ $value['title'] }} </p>
                                                        <p> {{ $video_length_min_short = number_format($video_length_min, 2, '.', '') }}
                                                            Min</p>
                                                    </div>
                                                </div>
                                            </div>

                                            {{ substr($value['description'], 0, 50) }}
                                            @if (strlen($value['description']) > 50)
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal-{{ $value['id'] }}">{{ __('messages.more') }}
                                                </a>
                                            @endif

                                            </p>
                                            <div class="modal fade" id="exampleModal-{{ $value['id'] }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header" style="padding: 0px;margin: 0px;">
                                                            <button data-bs-dismiss="modal"
                                                                style="position: absolute;top: -10px;right: -10px;height: 35px;width: 35px;background: #fff;border: 0px;border-radius: 50%;z-index: 1;">
                                                                <i class="fa-regular fa-circle-xmark"
                                                                    style="font-size: 22px;display: block;margin: auto;"></i></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>{{ $value['description'] }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            {{ $video->links('frontend.video-pagination') }}

        </div>
    </div>

@endsection


@section('js')
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
            $('.category_btn').click(function() {
                $('#frm_video_filter').submit();
            });
            $('.tag_btn').click(function() {
                $('#frm_video_filter').submit();
            });
            $('.sport_btn').click(function() {
                $('#frm_video_filter').submit();
            });
            $('.length_btn').click(function() {

                $('#frm_video_filter').submit();
            });
            $('.added_btn input[type="checkbox"]').click(function() {
                var isChecked = $(this).prop('checked');
                $('.added_btn input[type="checkbox"]').prop('checked', false);
                $(this).prop('checked', isChecked);
                $('#added').val(isChecked ? $(this).val() : '');
                $('#frm_video_filter').submit();
            });

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
        });
    </script>
@endsection
