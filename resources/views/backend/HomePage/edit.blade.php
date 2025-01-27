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
                        <li class="breadcrumb-item"><a href="#">Home Page</a></li>
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
                        Update HomePage
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::open([
                        'route' => ['homepage.update', 'homepage' => $setting->id],
                        'method' => 'PUT',
                        'enctype' => 'multipart/form-data',
                    ]) !!}

                    @csrf
                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('title', 'Title') !!}
                                <span class="required">*</span>
                            </div>
                            <div class="col-md-6">
                                {!! Form::text('title', $setting->title, [
                                    'placeholder' => 'Enter Title',
                                    'class' => 'form-control mb-2',
                                ]) !!}
                                {!! $errors->first('title', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('description', 'Description') !!}
                                <span class="required">*</span>
                            </div>
                            <div class="col-md-6">
                                {!! Form::textarea('description', $setting->description, [
                                    'placeholder' => 'Enter Description',
                                    'class' => 'form-control mb-2',
                                ]) !!}
                                {!! $errors->first('description', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('link', 'link') !!}
                                <span class="required">*</span>
                            </div>
                            <div class="col-md-6">
                                {!! Form::text('link', $setting->link, ['placeholder' => 'Enter link', 'class' => 'form-control mb-2']) !!}
                                {!! $errors->first('link', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>


                    <div class="form-group text-center">
                        <div class="row mt-4">
                            <div class="col-md-2 offset-md-3 mx-auto my-auto">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    {!! Form::submit('Update HomePage', ['class' => 'btn btn-secondary btn-wave form-group']) !!}
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
@section('js')
    {{-- <script>
        $(document).ready(function() {
            $('#logoInput').on('change', function(e) {
                var fileInput = e.target;
                var imgElement = $('.img_logo_1');
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
    </script> --}}
@endsection
