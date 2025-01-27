@extends('partial.master')

@section('page-css')
    <style>
        .required {

            color: red;

        }
    </style>
@endsection
@section('content')
    <div class="row">
        <!-- Page Header -->
        <div class="d-md-flex d-block align-items-center justify-content-between mt-2 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0"></h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb">
                        <a href="{{ route('user.index') }}">
                            <button type="button" class="btn btn-outline-secondary btn-wave">
                                <i class="fa-solid fa-arrow-left"></i>
                                Back
                            </button>
                        </a>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Page Header Close -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Add User
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::open([
                        'route' => 'user.store',
                        'method' => 'post',
                        'enctype' => 'multipart/form-data',
                    ]) !!}
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            {!! Form::label('user_category_id', 'Profession Type') !!}
                            <span class="required">*</span>
                        </div>

                        <div class="col-md-6">
                            {!! Form::select('user_category_id', $category->pluck('name', 'id')->prepend('Select Profession '), null, [
                                'class' => 'form-select',
                                'id' => 'user_category_id',
                            ]) !!}
                            {!! $errors->first('user_category_id', '<span class="text-danger">:message</span>') !!}
                        </div>

                        <div class="col-md-3 d-none">
                            <select class="form-control" data-trigger name="" id="choices-multiple-default">
                            </select>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('fullname', 'Full Name') !!}
                                <span class="required">*</span>
                            </div>
                            <div class="col-md-6">
                                {!! Form::text('fullname', null, ['placeholder' => 'Enter FullName', 'class' => 'form-control mb-2']) !!}
                                {!! $errors->first('fullname', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('displayname', 'Display Name') !!}
                                <span class="required">*</span>
                            </div>
                            <div class="col-md-6">
                                {!! Form::text('displayname', null, ['placeholder' => 'Enter Display Name', 'class' => 'form-control mb-2']) !!}
                                {!! $errors->first('displayname', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('email', 'Email') !!}
                                <span class="required">*</span>
                            </div>
                            <div class="col-md-6">
                                {!! Form::email('email', null, ['placeholder' => 'Enter Email', 'class' => 'form-control mb-2']) !!}
                                {!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('mobile_number', 'Mobile Number') !!}
                                <span class="required">*</span>
                            </div>
                            <div class="col-md-6">
                                {!! Form::text('mobile_number', null, ['placeholder' => 'Enter Mobile Number', 'class' => 'form-control mb-2']) !!}
                                {!! $errors->first('mobile_number', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-md-3">
                                    {!! Form::label('year_of_experience', 'Year Of Experience') !!}
                                    <span class="required">*</span>
                                </div>
                                @php
                                $yearOfExperience = Getyearofexperience();
                                @endphp
                                <div class="col-md-6">
                                    {!! Form::select('year_of_experience', $yearOfExperience, null, [
                                        'class' => 'form-select',
                                    ]) !!}
                                    {!! $errors->first('year_of_experience', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-md-3">
                                    {!! Form::label('is_top', 'Is Top', ['class' => 'form-check-label']) !!}
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-check-lg d-flex align-items-center">
                                        {!! Form::checkbox('is_top', 1, false, ['class' => 'form-check-input']) !!}
                                        {!! $errors->first('is_top', '<span class="text-danger">:message</span>') !!}

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-md-3">
                                    {!! Form::label('services', 'Services') !!}
                                </div>
                                <div class="col-md-6">
                                    {!! Form::select('services[]', $service, null, [
                                        'class' => 'form-select',
                                        'id' => 'choices-multiple-remove-button',
                                        'multiple' => 'multiple',
                                    ]) !!}
                                </div>
                                <div class="col-md-3 d-none">
                                    <select class="form-control " data-trigger name="" id="choices-multiple-default">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-md-3">
                                    {!! Form::label('instaname', 'Instagram Name') !!}
                                    <span class="required">*</span>
                                </div>
                                <div class="col-md-6">
                                    {!! Form::text('instaname', null, ['placeholder' => ' Enter Instagram Name', 'class' => 'form-control mb-2']) !!}
                                    {!! $errors->first('instaname', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-md-3">
                                    {!! Form::label('instalink', 'Instagram Link') !!}
                                    <span class="required">*</span>
                                </div>
                                <div class="col-md-6">
                                    {!! Form::text('instalink', null, ['placeholder' => ' Enter Instagram Link', 'class' => 'form-control mb-2']) !!}
                                    {!! $errors->first('instalink', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-md-3">
                                    {!! Form::label('twittername', 'Twitter Name') !!}
                                    <span class="required">*</span>
                                </div>
                                <div class="col-md-6">
                                    {!! Form::text('twittername', null, ['placeholder' => 'Enter Twitter Name', 'class' => 'form-control mb-2']) !!}
                                    {!! $errors->first('twittername', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-md-3">
                                    {!! Form::label('twitterlink', 'Twitter Link') !!}
                                    <span class="required">*</span>
                                </div>
                                <div class="col-md-6">
                                    {!! Form::text('twitterlink', null, ['placeholder' => 'Enter Twitter Link', 'class' => 'form-control mb-2']) !!}
                                    {!! $errors->first('twitterlink', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-md-3">
                                    {!! Form::label('about_long', 'AboutMe Long') !!}
                                    <span class="required">*</span>
                                </div>
                                <div class="col-md-6">
                                    {!! Form::textarea('about_long', null, [
                                        'placeholder' => 'Enter AboutMe Long',
                                        'class' => 'form-control mb-2',
                                        'rows' => 5,
                                    ]) !!}
                                    {!! $errors->first('about_long', '<span class="text-danger">:message</span>') !!}

                                    <span class="font-required" role="alert" style="opacity: 0.5;">
                                        Can not be more than 200 characters.
                                    </span>
                                    {{-- <br>
                                    <span class="input-error text-danger font-required" role="alert">
                                        <normal register-data-input-error="about_long"></normal>
                                    </span> --}}
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-md-3">
                                    {!! Form::label('about_sort', 'AboutMe Sort') !!}
                                    <span class="required">*</span>
                                </div>
                                <div class="col-md-6">
                                    {!! Form::textarea('about_sort', null, [
                                        'placeholder' => 'Enter AboutMe Sort',
                                        'class' => 'form-control mb-2',
                                        'rows' => 5,
                                    ]) !!}
                                    {!! $errors->first('about_long', '<span class="text-danger">:message</span>') !!}

                                    <span class="font-required" role="alert" style="opacity: 0.5;">
                                        Can not be more than 50 characters.
                                    </span>
                                    {{-- <br>
                                    <span class="input-error text-danger font-required" role="alert">
                                        <normal register-data-input-error="about_sort"></normal>
                                    </span> --}}
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-md-3">
                                    {!! Form::label('profile_video', 'Profile Video') !!}
                                    {{-- <span class="required">*</span> --}}
                                </div>
                                <div class="col-md-6">
                                    {!! Form::file('profile_video', ['class' => 'form-control', 'accept' => 'video/*']) !!}
                                    {!! $errors->first('profile_video', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-md-3">
                                    {!! Form::label('profile_photo', 'Profile Photo') !!}
                                    {{-- <span class="required">*</span> --}}
                                </div>
                                <div class="col-md-6">
                                    {!! Form::file('profile_photo', ['class' => 'form-control', 'id' => 'profilePhotoInput']) !!}
                                    {!! $errors->first('profile_photo', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="col-md-2 text-left">
                                    <div class="image">
                                        <img src="{{ asset('assets/images/media/no_image.png') }}"
                                            class="rounded elevation-2 img_profile_photo" alt="Profile Photo"
                                            style="max-width: 80%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-md-3">
                                    {!! Form::label('professionaldetalis', 'Professional Detalis') !!}
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group">
                                        <div class="row">
                                            <li class="list-group-item professional_section">
                                                <div class="d-flex align-items-center">
                                                    {!! Form::text('professionaldetalis[]', null, [
                                                        'placeholder' => 'Enter Professional Detalis',
                                                        'class' => 'form-control mb-2',
                                                    ]) !!}
                                                    {!! $errors->first('professionaldetalis', '<span class="text-danger">:message</span>') !!}
                                                </div>
                                            </li>
                                        </div>
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <a href="javascript:void(0)" id="addDescriptionLink"
                                        class="btn btn-link btn-wave form-group add-director-btn">
                                        Add more
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-md-3">
                                    {!! Form::label('education_detalis', 'Education Detalis') !!}
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group">
                                        <div class="row">
                                            <li class="list-group-item education-container">
                                                <div class="d-flex align-items-center">
                                                    {!! Form::text('education_detalis[]', null, [
                                                        'placeholder' => 'Enter Education Detalis',
                                                        'class' => 'form-control mb-2',
                                                    ]) !!}
                                                    {!! $errors->first('education_section', '<span class="text-danger">:message</span>') !!}
                                                </div>
                                            </li>
                                        </div>
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <a href="javascript:void(0)" id="addMoreEduction"
                                        class="btn btn-link btn-wave form-group add-education-btn">
                                        Add more
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="row mt-4">
                                <div class="col-md-4 offset-md-3 mx-auto my-auto">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        {!! Form::submit('Add User', ['class' => 'btn btn-secondary btn-wave form-group']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center professional-container-clone  d-none">
            <div class="row form-group">
                <div class="col-10">
                    {!! Form::text('professionaldetalis[]', null, [
                        'placeholder' => 'Enter Professional Detalis',
                        'class' => 'form-control mb-2',
                    ]) !!}
                </div>
                <div class="col-2">
                    <a href="javascript:void(0)" id="delete-btn" class="btn btn-link btn-wave delete-btn  text-danger">
                        Delete
                    </a>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center education-container-clone  d-none">
            <div class="row form-group">
                <div class="col-10">
                    {!! Form::text('education_detalis[]', null, [
                        'placeholder' => 'Enter Education Detalis',
                        'class' => 'form-control mb-2',
                    ]) !!}
                </div>
                <div class="col-2">
                    <a href="javascript:void(0)" id="delete-btn" class="btn btn-link btn-wave delete-btn  text-danger">
                        Delete
                    </a>
                </div>
            </div>
        </div>
    @endsection

    @section('js')
        <script>
            //  button event
            $(document).ready(function() {
                $('form').submit(function() {
                    $('#submitBtn').val('Adding...').prop('disabled', true);

                });
                $(document).on("click", ".delete-btn", function() {
                    $(this).closest('.form-group').remove();
                });

            });
            $(document).on("click", ".add-director-btn", function() {
                var html = $(".professional-container-clone").html();
                $(".professional_section").append(html);
            });
            $(document).on("click", ".add-education-btn", function() {
                var html = $(".education-container-clone").html();
                $(".education-container").append(html);
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#profilePhotoInput').on('change', function(e) {
                    var fileInput = e.target;
                    var imgElement = $('.img_profile_photo');
                    // alert('10');
                    if (fileInput.files && fileInput.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            imgElement.attr('src', e.target.result);
                            imgElement.show(); // Display the image
                        };
                        reader.readAsDataURL(fileInput.files[0]);
                    }
                });
            });
        </script>
    @endsection
