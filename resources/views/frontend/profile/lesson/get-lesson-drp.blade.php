{!! Form::open([
    'route' => 'add-video-to-lesson',
    'method' => 'post',
    'enctype' => 'multipart/form-data',
    'id' => 'frm_add_video_to_lesson',
]) !!}

{{ Form::hidden('video_id', $video_id, ['id' => 'video_id']) }}

<div class="row mb-3">
    <div class="col-md-12">
        <div class="row mb-3">
        </div>
        {!! Form::label('Lessons', 'Lessons ') !!}
        <span class="required">*</span>
        <div class="category-selectbox">
            <div class="editvideo-cat category-border-show">
                <a href="javascript:void(0);" class="editvideo-cat-click" id="lbl_add_video_to_lesson" name="lesson_id[]">
                    @if ($selected_lesson_names->count() > 0)
                        {{ $selected_lesson_names->implode(', ') }}
                    @else
                        Nothing Selected
                    @endif
                    <span id="category-main-1"><i class="fa-solid fa-chevron-down"></i></span>
                </a>
                <ul class="category-show drp_lessons">
                    @foreach ($lessons as $id => $privateuser)
                        <li>
                            <a href="javascript:void(0);" class="subcat-click-category">
                                <div class="form-check">
                                    {!! Form::checkbox('lesson_id[]', $id, $selected_lessons->contains($id), [
                                        'class' => 'form-check-input',
                                        'id' => 'lessons-id-' . $id,
                                    ]) !!}
                                    {!! Form::label('lessons-id-' . $id, $privateuser, ['class' => 'form-check-label']) !!}
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <span class="input-error text-danger font-required" role="alert">
                <normal add-video-to-lesson-data-input-error="lesson_id"></normal>
            </span>
        </div>
        <div class="row mb-3">
        </div>
        <div class="row mb-3">
        </div>
        &nbsp;

    </div>
</div>
{!! Form::close() !!}
