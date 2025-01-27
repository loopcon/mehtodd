
{!! Form::open([
    'route' => 'profile.video.update',
    'method' => 'post',
    'enctype' => 'multipart/form-data',
]) !!}

<div class="row mb-3">
    <div class="col-12">
        {!! Form::label('videotitle', 'Video Title') !!}
        <span class="required">*</span>
        {!! Form::text('title', null, [
            'placeholder' => 'Enter Video Title',
            'class' => 'form-control mb-2',
        ]) !!}
        <span class="input-error text-danger font-required" role="alert">
            <normal editvideo-data-input-error="videotitle"></normal>
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

    <div class="row mb-3">
        <div class="col-12 col-md-6">
            {!! Form::label('thumbnail', 'Video Thumbnail') !!}
            {!! Form::file('thumbnail', [
                'class' => 'form-control mb-2',
                'id' => 'editVideoThumbnail',
                'accept' => 'image/jpeg, image/png, image/jpg, image/gif',
            ]) !!}

            <span class="input-error text-danger font-required" role="alert">
                <normal editvideo-data-input-error="thumbnail"></normal>
            </span>
        </div>

        <div class="col-md-6">
            <div class="col-md-4 text-left">
                <div class="image">
                    <img src="" class="rounded elevation-2 edit-video-image d-none" alt="Thumbnail"
                        style="max-width: 80%;">
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12 col-md-6">
            {!! Form::label('video', 'Video') !!}
            <span class="required">*</span>

            {!! Form::file('video', ['class' => 'form-control mb-2', 'accept' => 'video/*']) !!}
            <span class="font-required" role="alert" style="opacity: 0.5;">
                {{ __('messages.profile_video_limit') }}
            </span>
            <br>
            <span class="input-error text-danger font-required" role="alert">
                <normal editvideo-data-input-error="video"></normal>
            </span>
        </div>
    </div>
    <div class="form-group text-center">
        <div class="row mt-4">
            <div class="col-md-4 offset-md-3 mx-auto my-auto">
                <div class="form-group">
                    @php
                        $submit_class = 'submit-btn-' . $value->id;
                    @endphp
                    <label>&nbsp;</label>
                    {!! Form::submit('Update Video', [
                        'class' => 'profile-video-submitbtn ' . $submit_class,
                        'id' => 'updateVideoBtn',
                    ]) !!}
                </div>
            </div>
            <div class="alert alert-success update_video_msg d-none mt-2">
                <strong>{{ __('messages.success') }}</strong> {{ __('messages.video_updated_successfully') }}
            </div>
            <div class="alert alert-danger update_video_error_msg d-none mt-2">
                <strong>{{ __('messages.oops') }}</strong> {{ __('messages.check_filled_details') }}
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}
{{-- @endforeach --}}
