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
            <div class="col-10 ms-0">
                @include('error_message')
            </div>
            <h1 class="page-title fw-semibold fs-18 mb-0"></h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update</li>
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
                        Update Profile
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::open([
                        'route' => ['profile-page.update', 'profile_page' => $profilepage->id],
                        'method' => 'PUT',
                        'enctype' => 'multipart/form-data',
                    ]) !!}
                    @csrf
                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('email', 'Email') !!}
                                <span class="required">*</span>
                            </div>

                            <div class="col-md-6">
                                {!! Form::text('email', $profilepage->email, [
                                    'placeholder' => 'Enter Email',
                                    'class' => 'form-control mb-2',
                                ]) !!}
                                {!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('password', 'Password') !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::password('password', [
                                    'placeholder' => 'Enter Password',
                                    'class' => 'form-control mb-2',
                                ]) !!}
                                {!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('password_confirmation', 'Confirm Password') !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::password('password_confirmation', [
                                    'placeholder' => 'Confirm Password',
                                    'class' => 'form-control mb-2',
                                ]) !!}
                                {!! $errors->first('password_confirmation', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>


                    <div class="form-group text-center">
                        <div class="row mt-4">
                            <div class="col-md-2 offset-md-3 mx-auto my-auto">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    {!! Form::submit('Update Profile ', ['class' => 'btn btn-secondary btn-wave form-group']) !!}
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
