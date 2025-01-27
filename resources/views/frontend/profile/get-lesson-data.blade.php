    <style>
        li {
            list-style: none;
        }
    </style>
    @if ($action == 'create')
        {!! Form::open([
            'route' => ['lesson.store'],
            'method' => 'post',
            'enctype' => 'multipart/form-data',
            'id' => 'addLessonForm',
        ]) !!}
    @elseif($action == 'edit')
        {!! Form::model($lesson, [
            'route' => ['lesson.update', 'lesson' => $lesson->id],
            'method' => 'put',
            'enctype' => 'multipart/form-data',
            'id' => 'updateLessonForm',
        ]) !!}
    @endif

    @include('frontend.profile.lesson.form')
    {!! Form::submit('Submit', ['class' => 'profile-video-submitbtn', 'id' => 'btnLessonSubmit']) !!}
    <div class="alert alert-success msg_lesson_update d-none mt-2">
        <strong>{{ __('messages.success') }}</strong> {{ __('messages.details_updated_successfully') }}
    </div>
    <div class="alert alert-danger error_msg_lesson_update d-none mt-2">
        <strong>{{ __('messages.oops') }}</strong> {{ __('messages.check_filled_details') }}
    </div>
    {!! Form::close() !!}
