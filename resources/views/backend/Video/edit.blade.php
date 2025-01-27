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
                        <a href="{{ route('videos.index') }}">
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

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Update Video
                    </div>
                </div>

                <div class="card-body">
                    {!! Form::open([
                        'route' => ['videos.update', 'video' => $video->id],
                        'method' => 'PUT',
                        'enctype' => 'multipart/form-data',
                    ]) !!}

                    @csrf

                    {{-- <input type="hidden" name="id" value="{{$videos->id}}"> --}}

                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('name', 'User Name') !!}
                                {{-- <span class="required">*</span> --}}
                            </div>

                            <div class="col-md-6">
                                <select class="form-select" name="user_id">
                                    <option value="">Select Name</option>
                                    @foreach ($users as $key => $value)
                                        <option value="{{ $key }}"
                                            @if ($video->user_id == $key) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('user_id', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>



                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('title', 'Title') !!}
                                <span class="required">*</span>
                            </div>

                            <div class="col-md-6">
                                {!! Form::text('title', $video->title, ['placeholder' => 'Enter Title', 'class' => 'form-control mb-2']) !!}
                                {!! $errors->first('title', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <div class="row mt-4">
                            <div class="col-md-2 offset-md-3 mx-auto my-auto">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    {!! Form::submit('update video', ['class' => 'btn btn-secondary btn-wave form-group']) !!}
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
