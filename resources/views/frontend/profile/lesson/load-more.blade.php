@foreach ($videos as $key => $value)
    @if ($value->is_private == 1 && !$value->userVideoShowOrNot())
        @continue
    @endif

    <div class="videotag-play col-md-6">

        <video id="video-custom-professional-like-{{ $value->id }}"
            @if ($value->thumbnail != null) poster="{{ asset('uploads/thumbnail/' . $value->thumbnail) }} @endif">
            <source src="{{ asset('uploads/videos/' . $value->video) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <div class="video-titile-group">
            <div class="play-bt" data-id="{{ $value->id }}">
                <i class="fa-solid fa-play"></i>
            </div>
            <div class="pause-bt" style="display:none;">
                <i class="fa-solid fa-pause"></i>
            </div>
            <p class="docpro-therapy-title">{{ $value->title }}</p>
            <p class="docpro-therapy-title">
                <div class="form-check form-switch docpro-addform-lesson">
                    {!! Form::checkbox('video_id[]', $value->id, null , ['class' => 'form-check-input']) !!}
                </div>    
            </p>
            <p class="docpro-therapy-name">
                @if (isset($value->user->displayname) && $value->user->displayname !== null)
                    {{ $value->user->displayname }}
                @else
                    &nbsp;
                @endif
            </p>
        </div>
    </div>
@endforeach
