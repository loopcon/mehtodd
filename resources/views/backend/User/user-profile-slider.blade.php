{{-- <div class="card-body">
    <div id="carouselExampleDark" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner slider_video_image">
            <div class="carousel-item active" data-bs-interval="10000">
                <video width="100%" height="100%" controls id="myProfilevideo">
                    <source src="{{ asset('uploads/profilemedia/1709552842_1707474234_video-1.mp4') }}"
                        type="video/mp4">
                </video>
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <img src="{{ asset('uploads/images/1706330234_1706011095_doctor-2.png') }}" class="d-block w-100"
                    alt="...">

            </div>
            <div class="carousel-item">
                <img src="{{ asset('uploads/images/1706330234_1706011095_doctor-2.png') }}" class="d-block w-100"
                    alt="...">
            </div>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div> --}}


{{-- <div class="carousel-item active" data-bs-interval="10000">
    <video width="100%" height="100%" controls id="myProfilevideo">
        <source src="{{ asset('uploads/profilemedia/1709552842_1707474234_video-1.mp4') }}" type="video/mp4">
    </video>
</div>
<div class="carousel-item" data-bs-interval="2000">
    <img src="{{ asset('uploads/images/1706330234_1706011095_doctor-2.png') }}" class="d-block w-100" alt="...">

</div>
<div class="carousel-item">
    <img src="{{ asset('uploads/images/1706330234_1706011095_doctor-2.png') }}" class="d-block w-100" alt="...">
</div>

 --}}
<div class="carousel-inner">
    @foreach ($sliders as $key => $value)
        <div class="carousel-item{{ $key === 0 ? ' active' : '' }}" data-bs-interval="10000">
            @if ($value->type === 'video')
                <video width="100%" height="100%" controls id="myProfilevideo{{ $key }}">
                    <source src="{{ asset('uploads/profilemedia/' . $value->name) }}" type="video/mp4">
                </video>
            @elseif ($value->type === 'image')
                <img src="{{ asset('uploads/profilemedia/' . $value->name) }}" class="d-block w-100" alt="...">
            @endif
        </div>
    @endforeach
</div>
