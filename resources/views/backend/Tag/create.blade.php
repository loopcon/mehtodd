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
                        <a href="{{ route('tag.index') }}">
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
                        Add Tag
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::open([
                        'route' => 'tag.store',
                        'method' => 'post',
                        'enctype' => 'multipart/form-data',
                    ]) !!}
                    
                    @csrf
                    <div class="form-group mt-4">
                       
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('category_id', 'Category') !!}
                                <span class="required">*</span>
                            </div>
                        
                            <div class="col-md-6">
                                {!! Form::select('category_id', $categories->prepend('Select Category', ''), null, [
                                    'class' => 'form-select',
                                ]) !!}
                                {!! $errors->first('category_id', '<span class="text-danger">:message</span>') !!}
                            </div>
                        
                            <div class="col-md-3 d-none">
                                <select class="form-control" data-trigger name="" id="choices-multiple-default">
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('name', 'Name') !!}
                                <span class="required">*</span>
                            </div>
                            <div class="col-md-6">
                                {!! Form::text('name', null, ['placeholder' => 'Enter Name', 'class' => 'form-control mb-2']) !!}
                                {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <div class="row mt-4">
                            <div class="col-md-2 offset-md-3 mx-auto my-auto">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    {!! Form::submit('Add Tag', ['class' => 'btn btn-secondary btn-wave form-group']) !!}
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
