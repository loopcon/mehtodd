@extends('frontend.partial.master')
@section('page-css')
    <style>
        .professinal-box {
            text-align: center;
            padding: 5px;
            /* Adjusted padding */
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        .container-professionals-box h5 {
            font-size: 1rem;

        }

        .professinal-box img {
            width: 100%;
            max-width: 120px;
            /* Adjusted max-width */
            height: 114px;
            border-radius: 50%;
            margin-bottom: 5px;
            /* Adjusted margin */
        }

        .professinal-box h4 {
            margin-bottom: 3px;
            /* Adjusted margin */
        }

        .professinal-box p {
            font-size: 12px;
            /* Adjusted font size */
            color: #666;
        }
    </style>
@endsection

@section('content')
    <!-- video  list page  start  -->
    <div class="container mb-4 container-professionals-box ">
        <div class="row  mt-4 mb-2">
            <div class="row">
                <div class="col-md-12 text-center mb-4">
                    <h4 class='text-left'>{{ __('messages.my_favorite_professionals') }}</h4>
                </div>
                @if ($favorites_list->isEmpty())
                    <div class="col-md-12 text-center mb-5 mt-5">
                        <h2 class="mb-5 mt-5" style="opacity: 21%;">{{ __('messages.no_favorites_available') }}</h2>
                    </div>
                @else
                    {{-- @foreach ($favorites_list as $like)
                        <div class="col-md-2 mb-3">
                            <a href="{{ route('front.physio.bio', ['slug' => $like->Professional->slug]) }}">
                            <div class="professinal-box">
                                @php
                                    $profilePhoto = $like->Professional->profile_photo
                                        ? 'uploads/profilephoto/' . $like->Professional->profile_photo
                                        : 'frontend/img/default_image.png';
                                @endphp
                                <img src="{{ asset($profilePhoto) }}" alt="Profile Photo">
                                <h5>{{ $like->Professional->displayname }}</h5>
                                <div id="container-like-unlike-professinal">
                                    <button class="btn btn-info profile-liked-btn btn-unlike-professional float-right"
                                        data-user-id="{{ $like->Professional->id }}">
                                        <i class="fa-solid fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach --}}

                    <div class="row">
                        @foreach ($favorites_list as $like)
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('front.physio.bio', ['slug' => $like->Professional->slug]) }}">
                                    <div class="professinal-box">
                                        @php
                                            $profilePhoto = $like->Professional->profile_photo
                                                ? 'uploads/profilephoto/' . $like->Professional->profile_photo
                                                : 'frontend/img/default_image.png';
                                        @endphp
                                        <img src="{{ asset($profilePhoto) }}" alt="Profile Photo" class="img-fluid">
                                        <h5>{{ $like->Professional->displayname }}</h5>
                                        <div id="container-like-unlike-professinal">
                                            <button class="btn btn-info profile-liked-btn btn-unlike-professional float-right"
                                                data-user-id="{{ $like->Professional->id }}">
                                                <i class="fa-solid fa-heart"></i>
                                            </button>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                @endif
            </div>

        </div>
    </div>
@endsection


@section('js')
    <script>
        $(document).on('click', '.btn-unlike-professional', function(e) {
            e.preventDefault();
            var $button = $(this);
            var ProfessionalId = $(this).data('user-id');
            var userId = '{{ Auth::id() }}';

            $.ajax({
                type: 'POST',
                url: "{{ route('unlike.professional') }}",
                dataType: "json",
                data: {
                    professional_id: ProfessionalId,
                    user_id: userId
                },
                success: function(response) {
                    // Assuming the 'edit-deletegroupbox' is the container for the entire button
                    var $container = $button.closest('#container-like-unlike-professinal');

                    // Replace the button with a new like button
                    var likeButton = `<button class="btn btn-info profile-liked-btn btn-like-professional like-float-right"
        data-user-id="` + ProfessionalId + `">
        <i class="fa-regular fa-heart"></i>
    </button>`;

                    $container.html(likeButton);

                    var existing_count = $('#like_professinal_count').text();
                    let new_count = parseInt(existing_count) - parseInt(1);
                    $('#like_professinal_count').text(new_count);
                },
                error: function(xhr, status, error) {
                    window.location.reload();
                }
            });
        });

        $(document).on('click', '.btn-like-professional', function(e) {
            e.preventDefault();
            var $button = $(this); // Cache the button element
            var ProfessionalId = $button.data('user-id');
            var userId = '{{ Auth::id() }}';

            if (!userId) {
                $('#siguploginModal').modal('show');
                return; // Exit the function if user is not authenticated
            }

            // Send the AJAX request
            $.ajax({
                type: 'POST',
                url: "{{ route('like.professional') }}",
                dataType: "json",
                data: {
                    professional_id: ProfessionalId,
                    user_id: userId
                },
                success: function(response) {
                    var existing_count = $('#like_professinal_count').text();
                    let new_count = parseInt(existing_count) + parseInt(1);
                    $('#like_professinal_count').text(new_count);

                    var $container = $button.closest('#container-like-unlike-professinal');
                    var UnikeButton = `<button
                                            class="btn btn-info-btn profile-liked-btn btn-unlike-professional like-float-right"
                                            data-user-id="` +
                        ProfessionalId + `">
                                            <i class="fa-solid fa-heart"></i>
                                        </button>`;


                    $container.html(UnikeButton);


                },
                error: function(xhr, status, error) {
                    window.location.reload();
                }
            });
        });
    </script>
@endsection
