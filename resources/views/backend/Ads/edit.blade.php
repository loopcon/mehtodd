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
                        <li class="breadcrumb-item"><a href="#">Ads</a></li>
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
                        Update Ads
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::open([
                        'route' => ['ads.update', $ads->id],
                        'method' => 'PUT',
                        'enctype' => 'multipart/form-data',
                    ]) !!}


                    @csrf
                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('profile_adds', 'Profile Price') !!}
                                <span class="required">*</span>
                            </div>
                            <div class="col-md-6">
                                {!! Form::text('profile_adds', $ads->profile_adds, [
                                    'placeholder' => 'Enter Profile Ads',
                                    'class' => 'form-control mb-2',
                                ]) !!}
                                {!! $errors->first('profile_adds', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('video_adds', 'Video Price') !!}
                                <span class="required">*</span>
                            </div>
                            <div class="col-md-6">
                                {!! Form::text('video_adds', $ads->video_adds, [
                                    'placeholder' => 'Enter Profile Ads',
                                    'class' => 'form-control mb-2',
                                ]) !!}
                                {!! $errors->first('video_adds', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>



                    <div class="form-group text-center">
                        <div class="row mt-4">
                            <div class="col-md-2 offset-md-3 mx-auto my-auto">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    {!! Form::submit('Update Ads', ['class' => 'btn btn-secondary btn-wave form-group']) !!}
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
