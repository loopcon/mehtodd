<!-- Include Select2 CSS and JS files -->
<style>
    .list-active {
        display: block !important;
    }
</style>
<div class="row m-0">
    <div class="container">
        {!! Form::open([
            'route' => ['front.update-appointment', 'id' => $appointment->id],
            'method' => 'PUT',
            'enctype' => 'multipart/form-data',
        ]) !!}
        @csrf
        {!! Form::hidden('id', $appointment->id, ['id' => 'id']) !!}
        <div class="row">
            <div class="col-12 col-md-12 mb-3">
                {!! Form::label('date', 'Date') !!}
                <span class="required">*</span>
                {!! Form::text('date', $appointment->date, [
                    'placeholder' => 'Enter Date',
                    'class' => 'form-control mb-2 datepicker',
                    'id' => 'date',
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
                {!! Form::time('start_time', date('H:i', strtotime($appointment->start_time)), [
                    'placeholder' => 'Enter Start Time',
                    'class' => 'form-control mb-2',
                    'id' => 'start_time',
                    'required' => 'required',
                ]) !!}
                <span class="input-error text-danger font-required" role="alert">
                    <normal register-data-input-error="start_time"></normal>
                </span>
            </div>
            <div class="col-6 col-md-6 mb-3">
                {!! Form::label('end_time', 'End Time') !!}
                <span class="required">*</span>
                {!! Form::time('end_time', date('H:i', strtotime($appointment->end_time)), [
                    'placeholder' => 'Enter End Time',
                    'class' => 'form-control mb-2',
                    'id' => 'end_time',
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
                <div class="category-selectbox">
                    <div class="edit-appointment-cat category-border-show">
                        <a href="javascript:void(0);" class="edit-appointment-cat-click" name="users[]"
                            id="lbl_lesson_users_list">
                            @if (!empty($selectedUsers))
                                {{ implode(', ', array_intersect_key($users, array_flip($selectedUsers))) }}
                            @else
                                {{ __('messages.select_user') }}
                            @endif
                            <span id="category-main-1"><i class="fa-solid fa-chevron-down"></i> </span>
                        </a>
                        <ul class="category-show edit-appointment-show">
                            @foreach ($users as $id => $privateuser)
                                <li>
                                    <a href="javascript:void(0);" class="subcat-click-category">
                                        <div class="form-check">
                                            {!! Form::checkbox('users[]', $id, isset($selectedUsers) && in_array($id, $selectedUsers), [
                                                'class' => 'form-check-input',
                                                'id' => 'calender-private-user-' . $id,
                                            ]) !!}
                                            {!! Form::label('calender-private-user-' . $id, $privateuser, ['class' => 'form-check-label']) !!}
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <span class="input-error text-danger font-required" role="alert">
                        <normal lesson-add-form-data-input-error="users"></normal>
                    </span>
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-12 col-md-12 mb-3 user-select-box ">
                {!! Form::label('user_id', 'Select Professionals User') !!}
                <span class="required">*</span>

                {!! Form::select('user_id[]', $users, $appointment->userMeeting->user_id, [
                    'class' => 'selectpicker w-100',
                    'id' => 'choices-multiple-remove-button',
                    'multiple' => true,
                ]) !!}

                <span class="input-error text-danger font-required" role="alert">
                    <normal addvideo-data-input-error="user_id"></normal>
                </span>
            </div>
        </div> --}}
        <div class="row">
            <div class="col-12 col-md-12 mb-3">
                {!! Form::label('link', 'Meeting Link') !!}
                <span class="required">*</span>
                {!! Form::text('link', $appointment->link, [
                    'placeholder' => 'Enter meeting Link',
                    'class' => 'form-control mb-2',
                    'id' => 'link',
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
                {!! Form::textarea('description', $appointment->description, [
                    'placeholder' => 'Enter Description',
                    'class' => 'form-control mb-2',
                    'id' => 'description',
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
                    {!! Form::submit('Update', ['class' => 'profile-video-submitbtn', 'id' => 'appointments']) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(function() {
        var appointmentDate = '{{ $appointment->date }}';
        $('.datepicker').datepicker({
            format: 'mm/dd/yyyy',
            autoclose: true,
            todayHighlight: true,
            startDate: new Date(),
            setDate: new Date(appointmentDate)
        });

        $('.editvideo-cat-click').click(function() {
            $(this).next('.category-show').toggleClass('list-active');
        });

        $(document).on("click", ".edit-appointment-cat-click", function(event) {
            event.stopPropagation(); // Prevent the click event from propagating to the document
            $(this).siblings('.category-show').toggleClass("list-active").next().toggle();
            $(this).find('svg').toggleClass('fa-chevron-down fa-chevron-right');
        });

        $(document).on("click", ".edit-appointment-cat ul li a span", function(event) {
            event.stopPropagation(); // Prevent the click event from propagating to the document
            $(this).closest('a').siblings('ul').toggle();
            $(this).find('svg').toggleClass('fa-chevron-right fa-chevron-down');
        });

    });
</script>
