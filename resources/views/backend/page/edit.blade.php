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
                        <a href="{{ route('page.index') }}">
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
                        Update Page
                    </div>
                </div>

                <div class="card-body">

                    {!! Form::open([
                        'route' => ['page.update', 'page' => $page->id],
                        'method' => 'PUT',
                        'enctype' => 'multipart/form-data',
                    ]) !!}

                    @csrf

                    <div class="form-group mt-2">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('title', 'Title') !!}
                                <span class="required">*</span>
                            </div>

                            <div class="col-md-8">
                                {!! Form::text('title', $page->title, [
                                    'placeholder' => 'Enter Title',
                                    'class' => 'form-control mb-2',
                                    'required' => 'required',
                                ]) !!}
                                {!! $errors->first('title', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    {{-- <div class="form-group mt-2">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('slug', 'Slug') !!}
                                <span class="required">*</span>
                            </div>
                            <div class="col-md-8">
                                {!! Form::text('slug', $page->slug, [
                                    'placeholder' => 'Enter Slug',
                                    'class' => 'form-control mb-2',
                                    'required' => 'required',
                                ]) !!}
                                {!! $errors->first('slug', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div> --}}
                    <div class="form-group mt-2 ">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('description', 'Description') !!}
                                <span class="required">*</span>
                            </div>
                            <div class="col-md-8 mb-5">
                                {{-- <div id="editor" class="mb-3"> </div> --}}
                                <div id="editor" class="mb-3" style="max-height: 300px; overflow: hidden;">

                                    {!! $page->description !!}
                                </div>
                                {!! Form::textarea('description', $page->description, [
                                    'class' => 'form-control',
                                    'style' => 'display:none;',
                                    'id' => 'description',
                                ]) !!}
                                {!! $errors->first('description', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center mt-3 ">
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <div class="form-group">
                                    {!! Form::submit('Update Page', ['class' => 'btn btn-secondary btn-wave']) !!}
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
    <script>
        $(document).ready(function() {
            $('form').submit(function() {
                $('#submitBtn').val('Adding...').prop('disabled', true);
            });
        });
    </script>

@endsection
