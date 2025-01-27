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
                        <a href="{{ route('user.visitor.index') }}">
                            <button type="button" class="btn btn-outline-secondary btn-wave">
                                <i class="ri-arrow-left-line "></i>
                                Back
                            </button>
                        </a>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Update Vistior User

                    </div>
                </div>
                <div class="card-body">
                    {!! Form::model($user, [
                        'route' => ['user.visitor.update', 'user' => $user->id],
                        'method' => 'PUT',
                        'enctype' => 'multipart/form-data',
                    ]) !!}
                    @csrf
                    {{-- {!! Form::hidden('usertype', 3) !!}
                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('usertype', 'User Type') !!}
                                <span class="required">*</span>
                            </div>
                            <div class="col-md-6">
                                {!! Form::select('usertype', ['' => '--Select--', '2' => 'Provider', '3' => 'Seeker'], $user->role_id ?? null, [
                                    'class' => 'form-select',
                                ]) !!}
                                {!! $errors->first('usertype', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div> --}}

                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('fullname', 'Full Name') !!}
                                <span class="required">*</span>
                            </div>
                            <div class="col-md-6">
                                {!! Form::text('fullname', $user->fullname, [
                                    'placeholder' => 'Enter Full Name',
                                    'class' => 'form-control mb-2',
                                ]) !!}
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
                                {!! Form::text('displayname', $user->displayname, [
                                    'placeholder' => 'Enter Display Name',
                                    'class' => 'form-control mb-2',
                                ]) !!}
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
                                {!! Form::email('email', $user->email, ['placeholder' => 'Enter Email', 'class' => 'form-control mb-2']) !!}
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
                                {!! Form::text('mobile_number', $user->mobile_number, [
                                    'placeholder' => 'Enter Mobile Number',
                                    'class' => 'form-control mb-2',
                                ]) !!}
                                {!! $errors->first('mobile_number', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('is_top', 'Is Top') !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::checkbox('is_top', 1, $user->is_top, ['class' => 'form-check-input']) !!}
                                {!! $errors->first('is_top', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div> --}}


                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('instaname', 'Instagram  Name') !!}
                                <span class="required">*</span>
                            </div>
                            <div class="col-md-6">
                                {!! Form::text('instaname', $user->instalink, [
                                    'placeholder' => 'Enter Instagram  Name',
                                    'class' => 'form-control mb-2',
                                ]) !!}
                                {!! $errors->first('instaname', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('instalink', 'Instagram  Link') !!}
                                <span class="required">*</span>
                            </div>
                            <div class="col-md-6">
                                {!! Form::text('instalink', $user->instalink, [
                                    'placeholder' => 'Enter Instagram  Link',
                                    'class' => 'form-control mb-2',
                                ]) !!}
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
                                {!! Form::text('twittername', $user->twitterlink, [
                                    'placeholder' => 'Enter Twitter Name',
                                    'class' => 'form-control mb-2',
                                ]) !!}
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
                                {!! Form::text('twitterlink', $user->twitterlink, [
                                    'placeholder' => 'Enter Twitter Link',
                                    'class' => 'form-control mb-2',
                                ]) !!}
                                {!! $errors->first('twitterlink', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('profile_photo', 'Profile Photo') !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::file('profile_photo', ['class' => 'form-control', 'value' => $user->profile_photo]) !!}
                                {!! $errors->first('profile_photo', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div> --}}
                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('profile_photo', 'Profile Photo') !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::file('profile_photo', ['class' => 'form-control mb-2', 'id' => 'profilePhotoInput']) !!}
                                {!! $errors->first('profile_photo', '<span class="text-danger">:message</span>') !!}
                            </div>
                            {{-- @if ($user->profile_photo != null)
                                <div class="col-md-2 text-left">
                                    <div class="image">
                                        <img src="{{ asset('uploads/profilephoto/' . $user->profile_photo) }}"
                                            class="rounded elevation-2 img_profile_photo" alt="Profile Photo"
                                            style="max-width: 80%;">
                                    </div>
                                </div>
                            @endif --}}
                            <div class="col-md-2 text-left">
                                <div class="image">
                                    @if ($user->profile_photo != null)
                                        <img src="{{ asset('uploads/profilephoto/' . $user->profile_photo) }}"
                                            class="rounded elevation-2 img_profile_photo" alt="Profile Photo"
                                            style="max-width: 80%;">
                                    @else
                                        <img src="{{ asset('assets/images/media/no_image.png') }}"
                                            class="rounded elevation-2 img_profile_photo" alt="Profile Photo"
                                            style="max-width: 80%;">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group text-center">
                        <div class="row mt-4">
                            <div class="col-md-4 offset-md-3 mx-auto my-auto">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    {!! Form::submit('Update Vistior User', ['class' => 'btn btn-secondary btn-wave form-group']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- 
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
@endsection --}}
@section('js')
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
