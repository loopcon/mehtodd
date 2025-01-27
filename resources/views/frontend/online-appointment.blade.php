@extends('frontend.partial.master')

@section('page-css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <style>
        .profile-tab-box .profile-active {
            background-color: #198FD9 !important;
            color: #fff !important;
        }

        .profile-tab-box {
            display: flex;
            justify-content: center;
        }

        .profile-tab-box .meeting-text {
            background-color: #f6f6f6;
            display: inline-block;
            height: 45px;
            width: 150px;
            text-align: center;
            line-height: 45px;
            text-decoration: none;
            color: #333333;
            box-sizing: border-box;
        }

        .profile-tab-box .create-meeting-text {
            background-color: #f6f6f6;
            display: inline-block;
            height: 45px;
            width: 150px;
            text-align: center;
            line-height: 45px;
            text-decoration: none;
            color: #333333;
        }

        .center-text {
            text-align: center;
        }

        .custom-modal-closebtn {
            background-color: #fff;
            border: 0px;
            position: absolute;
            top: -10px;
            right: -10px;
            width: 35px;
            height: 35px;
            font-size: 21px;
            text-align: center;
            display: block;
            margin: auto;
            border-radius: 50%;
            line-height: 18px;
            z-index: 2;
        }

        .metting-table-btngroup {
            display: flex;
            gap: 5px;
        }
    </style>
@endsection

@section('content')
    @if (session()->has('active_type'))
        @php
            $active_type = session('active_type');
        @endphp
    @endif
    <div class="profile-tab-box mt-4">
        <a href="#" class="meeting-text @if ($active_type == 0) profile-active @endif ">Shared Meetings</a>
        <a href="#" class="create-meeting-text @if ($active_type == 1) profile-active @endif ">My Meetings</a>
    </div>
    <div class="container">
        <div class="metting-box">

            <div class="test-{{ $active_type }} meeting @if ($active_type == 1) d-none @endif">
                <div class="get-in-touchsection">
                    <div class="grid-get-in-touch row">
                        <div class="container">
                            <div class="table-responsive">
                                <table class="table" style="border: 1px solid lightgray;">
                                    <tr>
                                        <th>Organizer</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th style="width: 15%;">Meeting Link</th>
                                        <th>Description</th>
                                    </tr>
                                    @if (isset($meeting) && $meeting && !$meeting->isEmpty() && $meeting != '')
                                        @foreach ($meeting as $data)
                                            <tr>
                                                <td>{{ $data->organizer->displayname ?? '' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($data->date)->format('d-m-Y') }}</td>

                                                <td>{{ $data->start_time }} - {{ $data->end_time }}</td>
                                                <td style="width: 15%;"><a href="{{ $data->link }}"
                                                        target="_blank">{{ $data->link }}</a></td>
                                                <td>
                                                    <span class="description-text">{{ $data->description }}</span>
                                                    <span class="read-more" style="display: none;">
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#descriptionModal"
                                                            data-description="{{ $data->description }}">Read More</a>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="center-text">No Meeting Available</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="test-{{ $active_type }}  create-meeting @if ($active_type == 0) d-none @endif">
                <div class="get-in-touchsection">
                    <div class="row">
                        <div class="col-md-12 offset-md-3 mx-auto my-auto d-flex justify-content-end">
                            <div class="form-group">
                                <a href="javascript:void(0);" data-bs-toggle="modal"
                                    data-bs-target="#onlineOppointmentModal">
                                    <button class="profile-video-submitbtn">Add Meeting</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="grid-get-in-touch row">
                        <div class="container">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th class="metting-table-date">Date</th>
                                        <th>Time</th>
                                        <th>Meeting Link</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                    @if (isset($organizerCreateMeetings) &&
                                            $organizerCreateMeetings &&
                                            !$organizerCreateMeetings->isEmpty() &&
                                            $organizerCreateMeetings != '')
                                        @foreach ($organizerCreateMeetings as $meetingdata)
                                            <tr>
                                                {{-- <td>{{ $data->organizer->displayname ?? '' }}</td> --}}
                                                <td>
                                                    <div class="metting-table-date">
                                                        {{ \Carbon\Carbon::parse($meetingdata->date)->format('d-m-Y') }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="metting-table-time">
                                                        {{ $meetingdata->start_time }} - {{ $meetingdata->end_time }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="metting-table-link"><a href="{{ $meetingdata->link }}"
                                                            target="_blank">{{ $meetingdata->link }}</a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="description-text">{{ $meetingdata->description }}</span>
                                                    <span class="read-more" style="display: none;">
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#descriptionModal"
                                                            data-description="{{ $meetingdata->description }}">Read
                                                            More</a>
                                                    </span>
                                                </td>
                                                {{-- <td> --}}
                                                <td>
                                                    <div class="metting-table-btngroup">
                                                        <button class="btn btn-primary btn-sm edit-btn"
                                                            data-id="{{ $meetingdata->id }}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-danger btn-sm delete-btn"
                                                            data-id="{{ $meetingdata->id }}">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                {{-- </td> --}}
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3" class="center-text">No Meeting Available</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="onlineOppointmentModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog siguplogin-dailog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="padding: 0px; border-bottom: 0px;">
                    <button data-bs-dismiss="modal" class="custom-modal-closebtn"><i
                            class="fa-regular fa-circle-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row m-0">
                        <div class="container">
                            {!! Form::open([
                                'route' => ['online.appointments'],
                                'method' => 'POST',
                                'enctype' => 'multipart/form-data',
                            ]) !!}
                            @csrf
                            {{-- {!! Form::hidden('organizer_id', optional(Auth::user())->id) !!} --}}
                            <div class="row">
                                <div class="col-12 col-md-12 mb-3">
                                    {!! Form::label('date', 'Date') !!}
                                    <span class="required">*</span>
                                    {!! Form::text('date', null, [
                                        'placeholder' => 'Enter Date',
                                        'class' => 'form-control mb-2 datepicker',
                                        'required' => 'required',
                                    ]) !!}
                                    <span class="input-error text-danger font-required" role="alert">
                                        <normal register-data-input-error="date"></normal>
                                    </span>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-6 mb-3">
                                    {!! Form::label('start_time', 'Start Time') !!}
                                    <span class="required">*</span>
                                    {!! Form::time('start_time', null, [
                                        'placeholder' => 'Enter Start Time',
                                        'class' => 'form-control mb-2',
                                        'required' => 'required',
                                    ]) !!}
                                    <span class="input-error text-danger font-required" role="alert">
                                        <normal register-data-input-error="start_time"></normal>
                                    </span>
                                </div>
                                <div class="col-6 col-md-6 mb-3">
                                    {!! Form::label('end_time', 'End Time') !!}
                                    <span class="required">*</span>
                                    {!! Form::time('end_time', null, [
                                        'placeholder' => 'Enter End Time',
                                        'class' => 'form-control mb-2',
                                        'required' => 'required',
                                    ]) !!}
                                    <span class="input-error text-danger font-required" role="alert">
                                        <normal register-data-input-error="end_time"></normal>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 mb-3 user-select-box ">
                                    {!! Form::label('user_id', 'Select Professionals') !!}
                                    <span class="required">*</span>

                                    {!! Form::select('user_id[]', $users, null, [
                                        'class' => 'selectpicker w-100',
                                        'id' => 'choices-multiple-remove-button',
                                        'multiple' => true,
                                        'required' => 'required',
                                    ]) !!}

                                    <span class="input-error text-danger font-required" role="alert">
                                        <normal addvideo-data-input-error="user_id"></normal>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 mb-3">
                                    {!! Form::label('link', 'Meeting Link') !!}
                                    <span class="required">*</span>
                                    {!! Form::text('link', null, [
                                        'placeholder' => 'Enter meeting Link',
                                        'class' => 'form-control mb-2',
                                        'required' => 'required',
                                    ]) !!}
                                    <span class="input-error text-danger font-required" role="alert">
                                        <normal register-data-input-error="link"></normal>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 mb-3">
                                    {!! Form::label('description', 'Description') !!}
                                    <span class="required">*</span>
                                    {!! Form::textarea('description', null, [
                                        'placeholder' => 'Enter Description',
                                        'class' => 'form-control mb-2',
                                        'required' => 'required',
                                    ]) !!}

                                    <span class="input-error text-danger font-required" role="alert">
                                        <normal register-data-input-error="description"></normal>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 offset-md-3 mx-auto my-auto">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        {!! Form::submit('submit', ['class' => 'profile-video-submitbtn', 'id' => 'appointments']) !!}
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="descriptionModal" tabindex="-1" aria-labelledby="descriptionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="descriptionModalLabel">Description</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="fullDescription"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="onlineOppointmentEditModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog siguplogin-dailog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="padding: 0px; border-bottom: 0px;">
                    <button data-bs-dismiss="modal" class="custom-modal-closebtn"><i
                            class="fa-regular fa-circle-xmark"></i></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    <div class="modal delete-video-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Meeting</h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this Meeting?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="finalDeleteBtn">Yes! Delete
                        it</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onclick="$('.delete-video-modal').modal('hide');">Cancel</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <!-- Bootstrap Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#onlineAppointment').click(function() {
                $("#onlineOppointmentModal").modal('show');
            });
            $('input[name="date"]').datepicker({
                format: 'mm/dd/yyyy',
                autoclose: true,
                todayHighlight: true,
                startDate: new Date()

            });

            var meetings = {!! json_encode($meeting) !!};
            $('.description-text').each(function() {
                var maxLength = 100;
                var text = $(this).text();
                if (text.length > maxLength) {
                    var truncatedText = text.substr(0, maxLength) + '...';
                    $(this).text(truncatedText);
                    $(this).parent().find('.read-more').show();
                }
            });

            $('.read-more a').click(function(event) {
                event.preventDefault();
                var description = $(this).data('description');
                $('#fullDescription').text(description);
            });

            $('.edit-btn').click(function() {
                event.preventDefault();
                var meetingId = $(this).data('id');

                var formData = new FormData();
                formData.append('meeting_id', meetingId);

                $.ajax({
                    url: '{{ route('front.edit.appointment') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $("#onlineOppointmentEditModal .modal-body").html(response.html);
                        $("#onlineOppointmentEditModal").modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
            $('.delete-btn').click(function() {
                var meetingId = $(this).data('id');
                $("#finalDeleteBtn").data('id', meetingId);
                $(".delete-video-modal").modal('show');
            });
            $('#finalDeleteBtn').click(function(e) {
                var meetingId = $(this).data('id');
                var formData = new FormData();
                formData.append('meeting_id', meetingId);
                $(".delete-video-modal").modal('hide');
                $.ajax({
                    url: '{{ route('front.delete.appointment') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 'success') {
                            location.reload();
                        } else {
                            console.error('Failed to delete appointment');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });



            $('.meeting-text').click(function() {

                $('.meeting-text ').addClass('profile-active');
                $('.create-meeting-text').removeClass('profile-active');

                $('.meeting').removeClass('d-none');
                $('.create-meeting').addClass('d-none');
            });

            $('.create-meeting-text').click(function() {
                $('.meeting-text').removeClass('profile-active');
                $('.meeting').addClass('d-none');
                $('.create-meeting').removeClass('d-none');
                $(this).addClass('profile-active');
            });
        });
    </script>
@endsection
