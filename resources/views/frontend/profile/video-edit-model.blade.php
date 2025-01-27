{!! Form::model($video, [
    'route' => ['profile.video.update', 'id' => $video->id],
    'method' => 'PUT',
    'enctype' => 'multipart/form-data',
    'id' => 'frm_updateprofilevideo',
]) !!}

{!! Form::hidden('id', null) !!}

{!! Form::hidden('old_video', $video->video) !!}
{!! Form::hidden('old_thumbnail', $video->thumbnail) !!}

<div class="row mb-3 ">
    <div class="col-12">
        {!! Form::label('title', 'Title') !!}
        <span class="required">*</span>

        {!! Form::text('title', null, [
            'placeholder' => 'Enter Video Title',
            'class' => 'form-control mb-2',
        ]) !!}
        <span class="input-error text-danger font-required" role="alert">
            <normal editvideo-data-input-error="title"></normal>
        </span>
    </div>
</div>
<div class="row mb-3">
    {!! Form::label('category', 'Category') !!}

    <div class="category-selectbox">
        <div class="editvideo-cat category-border-show">
            <a href="javascript:void(0);" class="editvideo-cat-click" name="category_id[]" id="edit_category_video">
                {{ $selected_categories_string ? $selected_categories_string : 'Select Category' }}

                <span id="category-main-1"><i class="fa-solid fa-chevron-down"></i></span>
            </a>

            <ul class="category-show edit_dropdown_list">
                @foreach ($phisio_user_sub_category_list as $key => $list)
                    <li>
                        <a href="javascript:void(0)" class="subcat-click-category">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="category_id[]"
                                    value="{{ $list->id }}" id="editheader-health-1-{{ $list->id }}"
                                    {{ in_array($list->id, $selected_video_category_list) ? 'checked' : '' }}>
                                <label class="form-check-label"
                                    for="editheader-health-1-{{ $list->id }}">{{ $list->name }}
                                </label>

                            </div>
                            @if (count($sub_category1_list[$key]))
                                <span>
                                    <i class="fa-solid fa-chevron-right"></i></span>
                            @endif
                        </a>
                        <ul>
                            @if (isset($sub_category1_list[$key]))
                                @foreach ($sub_category1_list[$key] as $key1 => $list1)
                                    <li>
                                        <a href="javascript:void(0);" class="subcat-click-category">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="category_id[]"
                                                    value="{{ $list1->id }}"
                                                    id="editheader-health-2-{{ $list1->id }}"
                                                    {{ in_array($list1->id, $selected_video_category_list) ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="editheader-health-2-{{ $list1->id }}">{{ $list1->category_name }}
                                                </label>

                                            </div>
                                            @if (count($sub_category2_list[$key][$list1->id]))
                                                <span>
                                                    <i class="fa-solid fa-chevron-right"></i></span>
                                            @endif
                                        </a>
                                        <ul>
                                            @if (count($sub_category2_list[$key][$list1->id]))
                                                @foreach ($sub_category2_list[$key][$list1->id] as $key2 => $list2)
                                                    <li><a href="javascript:void(0);" class="subcat-click-category">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="category_id[]" value="{{ $list2->id }}"
                                                                    id="editheader-health-3-{{ $list2->id }}"
                                                                    {{ in_array($list2->id, $selected_video_category_list) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="editheader-health-3-{{ $list2->id }}">{{ $list2->category_name }}</label>
                                                            </div>
                                                            @if (count($sub_category3_list[$key][$list1->id][$list2->id]))
                                                                <span><i class="fa-solid fa-chevron-right"></i></span>
                                                            @endif
                                                        </a>
                                                        <ul>
                                                            @if (count($sub_category3_list[$key][$list1->id][$list2->id]))
                                                                @foreach ($sub_category3_list[$key][$list1->id][$list2->id] as $key3 => $list3)
                                                                    <li>
                                                                        <a href="javascript:void(0);"
                                                                            class="subcat-click-category">
                                                                            <div class="form-check">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox"
                                                                                    value="{{ $list3->id }}"
                                                                                    id="editheader-health-4-{{ $list3->id }}"
                                                                                    {{ in_array($list3->id, $selected_video_category_list) ? 'checked' : '' }}>
                                                                                <label class="form-check-label"
                                                                                    for="editheader-health-4-{{ $list3->id }}">{{ $list3->category_name }}</label>
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
            </ul>
        </div>
        <span class="input-error text-danger font-required" role="alert">
            <normal editvideo-data-input-error="category_id"></normal>
        </span>
    </div>
</div>

<div class="row mb-3">
    <div class="col-12 col-md-6">
        {!! Form::label('difficulty', 'Difficulty') !!}
        <span class="required">*</span>
        {!! Form::select('difficulty_id', $difficulty, null, [
            'class' => 'form-select w-100',
            'id' => 'choices-multiple-remove-button',
        ]) !!}

        <span class="input-error text-danger font-required" role="alert">
            <normal editvideo-data-input-error="difficulty"></normal>
        </span>
    </div>
    <div class="col-12 col-md-6">
        {!! Form::label('Tags', 'Tags') !!}
        <span class="required">*</span>
        <div class="category-selectbox">
            <div class="editvideo-cat category-border-show">
                <a href="javascript:void(0);" class="editvideo-cat-click"
                    name="tags[]">{{ $userTagsString ? $userTagsString : 'Select Tag' }}

                    <span id="category-main-1"><i class="fa-solid fa-chevron-down"></i>
                    </span>
                </a>
                <ul class="category-show">
                    @foreach ($tags as $key => $list)
                        <li>
                            <a href="javascript:void(0)" class="subcat-click-category">
                                <div class="form-check">
                                    <input class="form-check-input" name="tags[]" type="checkbox"
                                        value="{{ $key }}" id="editheader-health-{{ $key }}"
                                        {{ in_array($key, $userTag) ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="editheader-health-{{ $key }}">{{ $list }}</label>
                                </div>
                                {{-- <span><i class="fa-solid fa-chevron-right"></i></span> --}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <span class="input-error text-danger font-required" role="alert">
                <normal editvideo-data-input-error="tags"></normal>
            </span>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-12">
        {!! Form::label('Sports', 'Sports') !!}
        <span class="required">*</span>
        <div class="category-selectbox">
            <div class="editvideo-cat category-border-show">
                <a href="javascript:void(0);" class="editvideo-cat-click" name="sports[]">
                    {{ $videoSportsString ?? 'Select sport' }}


                    <span id="category-main-1"><i class="fa-solid fa-chevron-down"></i>
                    </span>
                </a>
                <ul class="category-show">
                    @foreach ($sports as $key => $list)
                        <li>
                            <a href="javascript:void(0)" class="subcat-click-category">
                                <div class="form-check">
                                    <input class="form-check-input" name="sports[]" type="checkbox"
                                        value="{{ $key }}" id="editheader-health-{{ $key }}"
                                        {{ in_array($key, $videoSport) ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="editheader-health-{{ $key }}">{{ $list }}</label>
                                </div>
                                {{-- <span><i class="fa-solid fa-chevron-right"></i></span> --}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <span class="input-error text-danger font-required" role="alert">
                <normal editvideo-data-input-error="sports"></normal>
            </span>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-12">
        {!! Form::label('description', ' Description') !!}
        <span class="required">*</span>
        {!! Form::textarea('description', null, [
            'placeholder' => 'Enter  Description',
            'class' => 'form-control mb-2',
        ]) !!}
    </div>
    <span class="input-error text-danger font-required" role="alert">
        <normal editvideo-data-input-error="description"></normal>
    </span>
</div>

<div class="row">
    <div class="col-md-6">

        <div class="form-check">
            {!! Form::checkbox('is_private', '1', $video->is_private, [
                'class' => 'form-check-input',
                'id' => 'isPrivateCheckbox',
            ]) !!}
            {!! Form::label('isPrivateCheckbox', 'Is Video  Private', ['class' => 'form-check-label']) !!}
        </div>
    </div>

    <div class="col-md-6 mb-3 user-select-box {{ $video->is_private == 0 ? 'd-none' : 'sd' }}">
        {!! Form::label('users', 'Users') !!}
        <span class="required">*</span>
        <div class="category-selectbox">
            <div class="editvideo-cat category-border-show">
                <a href="javascript:void(0);" class="editvideo-cat-click" name="users[]">                {{ $privateUserString ?: 'Nothing selected' }}

                    <span id="category-main-1"><i class="fa-solid fa-chevron-down"></i>
                    </span>
                </a>
                <ul class="category-show drp_lesson_users_list">


                    <div class="form-check search-container">
                        <input type="search" placeholder="Search..." id="user-search-input"
                            oninput="filterUsers()" class="search-input">
                    </div>

                    @foreach ($users as $id => $privateuser)
                        <li>
                            <a href="javascript:void(0);" class="subcat-click-category">
                                <div class="form-check">
                                    <input class="form-check-input" name="users[]" type="checkbox"
                                        value="{{ $id }}" id="private-user-{{ $id }}"
                                        {{ in_array($id, $selectedUsers) ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="private-user-{{ $id }}">{{ $privateuser }}</label>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <span class="input-error text-danger font-required" role="alert">
                <normal editvideo-data-input-error="users"></normal>
            </span>

        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-12 col-md-6">
        {!! Form::label('thumbnail', 'Video Thumbnail') !!}
        <span class="required">*</span>
        {!! Form::file('thumbnail', [
            'class' => 'form-control mb-2',
            'id' => 'editVideoThumbnail',
            'accept' => 'image/jpeg, image/png, image/jpg, image/gif',
        ]) !!}
        <span class="input-error text-danger font-required" role="alert">
            <normal editvideo-data-input-error="thumbnail"></normal>
        </span>
    </div>
    <div class="col-md-4 section_video_image">
        @if ($video->thumbnail != null)
            <a href="javascript:void(0)" id="btn_delete_thumbnail" data-id="{{ $video->id }}">
                <i class="fas fa-trash"></i>
            </a>
            <div class="image" style="position: auto;">
                <img src="{{ asset('uploads/thumbnail/' . $video->thumbnail) }}"
                    class="rounded elevation-2 img_profile_photo" alt="Profile Photo" style="max-width: 80%;">
            </div>
        @else
            <div class="image" style="position: auto;">
                <img src="{{ asset('frontend/img/default_image.png') }}"
                    class="rounded elevation-2 img_profile_photo" alt="Profile Photo" style="max-width: 80%;">
            </div>
        @endif
    </div>
</div>


<div class="row mb-3">
    <div class="col-md-6">
        {!! Form::label('video', 'Video') !!}
        {!! Form::file('video', ['class' => 'form-control mb-2', 'accept' => 'video/*', 'id' => 'editVideo']) !!}
        <span class="font-required" role="alert" style="opacity: 0.5;">
            {{ __('messages.profile_video_size_limit') }}
        </span>
        <br>
        <span class="input-error text-danger font-required" role="alert">
            <normal editvideo-data-input-error="video"></normal>
        </span>
    </div>
    <div class="col-md-4">
        @if ($video->video != null)
            <div class="video">
                <video controls class="rounded elevation-2 edit-video" style="max-width: 80%;">
                    <source src="{{ asset('uploads/videos/' . $video->video) }}" type="video/mp4">
                        {{ __('messages.browser_not_support_video') }}
                </video>
            </div>
        @endif
    </div>
</div>

<div class="form-group text-center">
    <div class="row mt-4">
        <div class="col-md-4 offset-md-3 mx-auto my-auto">
            <div class="form-group">
                <label>&nbsp;</label>
                {!! Form::button('Update Video', [
                    'class' => 'profile-video-submitbtn',
                    'id' => 'updateVideoBtn',
                    // 'onclick' => 'submitForm()',
                ]) !!}
            </div>
        </div>
        <div class="alert alert-success update_video_msg d-none mt-2">
            <strong>{{ __('messages.success') }}</strong> {{ __('messages.details_updated_successfully') }}
        </div>
        <div class="alert alert-danger update_video_error_msg d-none mt-2">
            <strong>{{ __('messages.oops') }}</strong> {{ __('messages.check_filled_details') }}
        </div>
    </div>
</div>

{!! Form::close() !!}
