<div class="modal fade lessionAddModal" id="profileditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Lession Add</h2>
                <button data-bs-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i></button>
            </div>
            <div class="modal-body">

                <div class="profile-video-box">
                    {!! Form::model(null, [
                        'route' => ['lession.add.video', 'slug' => $user->slug],
                        'method' => 'post',
                        'enctype' => 'multipart/form-data',
                        'id' => 'addLessionVideoForm',
                    ]) !!}
                    @csrf
                    <div class="row mb-3">
                        <div class="col-12">
                            {!! Form::label('Lession Description', 'Lession Description') !!}
                            <span class="required">*</span>
                            {!! Form::text('lesson_description', null, [
                                'placeholder' => 'Enter Lession Description',
                                'class' => 'form-control mb-2',
                            ]) !!}
                            <span class="input-error text-danger font-required" role="alert">
                                <normal addvideo-data-input-error="lesson_description"></normal>
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            {!! Form::label('videotitle', 'Video Title') !!}
                            <span class="required">*</span>
                            {!! Form::text('title', null, [
                                'placeholder' => 'Enter Video Title',
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
                                    {!! Form::label('category_id', 'Category') !!}
                                    <span class="required">*</span>
                                </div>
                                <a href="javascript:void(0)" class="profile-editmodal-cat-click"
                                    data-bs-toggle="profile-editmodal-cat" aria-expanded="false"
                                    id="lbl_add_video_category">Select Category <i class="fa-solid fa-chevron-down"></i>
                                </a>

                                <ul class="category-show dropdowncatgory_list">
                                    @if (count($phisio_user_sub_category_list) > 0)
                                        @foreach ($phisio_user_sub_category_list as $key => $list)
                                            <li>
                                                <a href="javascript:void(0)" class="subcat-click-category">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="modal-category-1-{{ $list->id }}"
                                                            name="category_id[]" value="{{ $list->id }}">
                                                        <label class="form-check-label"
                                                            for="modal-category-1-{{ $list->id }}">{{ $list->name }}
                                                            {{-- {{ $level1 }} --}}
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

                                                                <a href="#" class="subcat-click-category">

                                                                    <div class="form-check">

                                                                        <input class="form-check-input" type="checkbox"

                                                                            id="modal-category-2-{{ $list1->id }}"

                                                                            name="category_id[]"

                                                                            value="{{ $list1->id }}">

                                                                        <label class="form-check-label"

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

                                                                                    <div class="form-check">

                                                                                        <input class="form-check-input"

                                                                                            type="checkbox"

                                                                                            name="category_id[]"

                                                                                            id="modal-category-3-{{ $list2->id }}">



                                                                                        <label class="form-check-label"

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

                                        <div class="alert alert-warning text-danger" role="alert">

                                            Please Update Category From Profile.

                                        </div>

                                    @endif

                                </ul>

                                <span class="input-error text-danger font-required" role="alert">

                                    <normal addvideo-data-input-error="category_id"></normal>

                                </span>

                            </div>

                        </div>

                    </div>





                    <div class="row">

                        <div class="col-12 col-md-6 mb-3 sub-multiple-catepopbox">

                            {!! Form::label('difficulty', 'Difficulty') !!}

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

                            {!! Form::label('tags', 'Tags') !!}

                            <span class="required">*</span>



                            {!! Form::select('tags[]', $tags, null, [

                                'class' => 'selectpicker w-100',

                                'id' => 'choices-multiple-remove-button',

                                'multiple' => true,

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

                            ]) !!}



                            <span class="input-error text-danger font-required" role="alert">

                                <normal addvideo-data-input-error="sports"></normal>

                            </span>

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

                        <div class="col-12 col-md-6 mb-3 sub-multiple-catepopbox">

                            {!! Form::checkbox('is_private', 1, false, ['class' => 'form-check-input', 'id' => 'isPrivateCheckbox']) !!}

                            {!! Form::label('isPrivateCheckbox', 'Is Video Private ?', ['class' => 'form-check-label']) !!}

                        </div>



                        <div class="col-12 col-md-6 mb-3 user-select-box d-none">

                            {!! Form::label('user', 'Users') !!}

                            <span class="required">*</span>



                            {!! Form::select('users[]', $users, null, [

                                'class' => 'selectpicker w-100',

                                'id' => 'choices-multiple-remove-button',

                                'multiple' => true,

                            ]) !!}



                            <span class="input-error text-danger font-required" role="alert">

                                <normal addvideo-data-input-error="users"></normal>

                            </span>

                        </div>

                    </div>





                    <div class="row">

                        <div class="col-md-6">

                            {!! Form::label('thumbnail', 'Video Thumbnail') !!}

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

                                <img src="" class="rounded elevation-2 add-video-image d-none mt-3"

                                    alt="Thumbnail" style="max-width: 80%;">

                            </div>

                        </div>

                    </div>



                    <div class="row">

                        <div class="col-12 col-md-6">

                            {!! Form::label('video', 'Video') !!}

                            <span class="required">*</span>



                            {!! Form::file('video', ['class' => 'form-control mb-2', 'accept' => 'video/*', 'id' => 'video']) !!}

                            <span class="font-required" role="alert" style="opacity: 0.5;">

                                The File should not be greater than 30 Mb.

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



                                    @if ($helper->IsUserAccess('video'))

                                        {!! Form::submit('Add Video', ['class' => 'profile-video-submitbtn', 'id' => 'addVideoBtn']) !!}

                                    @else

                                        {!! Form::button('Add Video', [

                                            'class' => 'profile-video-submitbtn',

                                            'data-bs-target' => '#subscribeVerifyDetailsModal',

                                            'data-bs-toggle' => 'modal',

                                        ]) !!}

                                    @endif

                                </div>

                            </div>

                            <div class="alert alert-success add_video_msg d-none mt-2">

                                <strong>Success!</strong> Video added successfully Redirecting..

                            </div>

                            <div class="alert alert-danger add_video_error_msg d-none mt-2">

                                <strong>Opps!</strong> Please check details you filled.

                            </div>

                        </div>

                    </div>

                    {!! Form::close() !!}

                </div>

            </div>

        </div>

    </div>

</div>

