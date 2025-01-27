@extends('frontend.partial.master')
@section('page-css')
    <style>
        .container_size {
            min-height: 12em !important;
        }

        li {
            list-style-type: none;
        }

        .msg-container {
            padding: 1px;
            margin: 10px 0;
            background: #fff;
        }

        .notification-heading {
            font-weight: 600;
            margin: 20px 0px;
        }

        .card-body {
            padding: 5px;
        }
    </style>

    <style>
        .notification-heading {
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .notification-card {
            border-left: 5px solid;
            transition: background-color 0.3s ease;
        }

        .notification-card.unread {
            /* background-color: #198FD9; */
            border-color: #198FD9;
        }

        .notification-card.read {
            /* background-color: #d4edda;
                                        border-color: #28a745; */
        }

        .notification-icon {
            font-size: 24px;
            margin-right: 15px;
        }

        /* .notification-icon.unread {
                                        color: #d9534f;
                                    }

                                    .notification-icon.read {
                                        color: #28a745;
                                    } */

        .notification-content a {
            color: #333;
            text-decoration: none;
        }

        .notification-content a:hover {
            text-decoration: underline;
        }

        .mark-read-btn {
            font-size: 12px;
        }

        .card-body {
            padding-left: 1em;
        }

        /* .icon-container {
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        width: 40px;
                                        height: 40px;
                                        border-radius: 50%;
                                        background-color: #f0f0f0;
                                    } */
    </style>
@endsection

@section('content')
    {{-- <div class="container container_size">

        <h4 class="notification-heading">Notifications</h4>
        <div class="row">
            <div class="col-md-12">
                @if ($notifications->isEmpty())
                    <div class="alert alert-info text-center" role="alert">
                        {{ __('messages.No Notifications') }}
                    </div>
                @else
                    @foreach ($notifications as $notification)
                        @php
                            $notificationStatus = $notification->is_read ? 'read' : 'unread';
                        @endphp

                        <div class="card mb-3 notification-card {{ $notificationStatus }}">
                            <div class="card-body d-flex align-items-center">
                                <div class="notification-content flex-grow-1">
                                    <a href="javascript:void(0)" class="all-notification-click" style="padding: 0px;"
                                        data-id="{{ $notification->id }}">
                                        <strong>{{ $notification->description }}</strong><br>
                                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $notifications->links('frontend.video-pagination') }}
                @endif
            </div>
        </div>

    </div> --}}



    <div class="container container_size">
        <h4 class="notification-heading">{{ __('messages.notifications') }}</h4>
        <div class="row">
            <div class="col-md-12">
                @if ($notifications->isEmpty())
                    <div class="alert alert-info text-center" role="alert">
                        {{ __('messages.No Notifications') }}
                    </div>
                @else
                    @foreach ($notifications as $notification)
                        @php
                            $notificationStatus = $notification->is_read ? 'read' : 'unread';
                        @endphp

                        <div class="card mb-3 notification-card {{ $notificationStatus }}">
                            <div class="card-body d-flex align-items-center">
                                <div class="notification-content flex-grow-1">
                                    <a href="javascript:void(0)" class="all-notification-click" style="padding: 0px;"
                                        data-id="{{ $notification->id }}">
                                        <strong>{{ $notification->description }}</strong><br>
                                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $notifications->links('frontend.video-pagination') }}
                @endif

            </div>
        </div>

    </div>
@endsection



@section('js')
    <script>
        $(document).ready(function() {
            $('.all-notification-click').click(function(event) {
                event.preventDefault();
                var $notification = $(this).closest('li');
                var notificationId = $(this).data('id');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('update.notification.status') }}",
                    method: 'POST',
                    data: {
                        id: notificationId
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            $notification.css('background-color', '#d3d3d3');
                            $notification.find('.circle').css('display', 'none');
                            $('#msg_subscribe').html('Notification marked as read.');
                            var slug = response.slug;
                            if (slug) {
                                window.location.href =
                                    "{{ route('front.physio.bio', ['slug' => ':slug']) }}"
                                    .replace(':slug', slug);
                            } else {
                                $('#msg_subscribe').html('Slug not found for the user.');
                            }
                        } else {
                            $('#msg_subscribe').html('Failed to update notification.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                        $('#msg_subscribe').html('Error occurred while updating notification.');
                    }
                });

            });
        });
    </script>
@endsection
