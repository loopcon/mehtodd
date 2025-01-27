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

                        <a href="{{ route('setting.index') }}">

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

                        Add Setting

                    </div>

                </div>

                <div class="card-body">

                    {!! Form::open([

                        'route' => 'setting.store',

                        'method' => 'post',

                        'enctype' => 'multipart/form-data',

                    ]) !!}

                    @csrf



                    <div class="form-group mt-4">

                        <div class="row">

                            <div class="col-md-3">

                                {!! Form::label('site_name', 'Site Name') !!}

                                <span class="required">*</span>

                            </div>

                            <div class="col-md-6">

                                {!! Form::text('site_name', null, ['placeholder' => 'Enter Site Name', 'class' => 'form-control mb-2']) !!}

                                {!! $errors->first('site_name', '<span class="text-danger">:message</span>') !!}

                            </div>

                        </div>

                    </div>



                    <div class="form-group mt-4">

                        <div class="row">

                            <div class="col-md-3">

                                {!! Form::label('phone', 'Phone') !!}

                                <span class="required">*</span>

                            </div>

                            <div class="col-md-6">

                                {!! Form::text('phone', null, ['placeholder' => 'Enter PhoneNumber', 'class' => 'form-control mb-2']) !!}

                                {!! $errors->first('phone', '<span class="text-danger">:message</span>') !!}

                            </div>

                        </div>

                    </div> <div class="form-group mt-4">

                        <div class="row">

                            <div class="col-md-3">

                                {!! Form::label('address', 'Address') !!}

                                <span class="required">*</span>

                            </div>

                            <div class="col-md-6">

                                {!! Form::text('address', null, ['placeholder' => 'Enter Address', 'class' => 'form-control mb-2']) !!}

                                {!! $errors->first('address', '<span class="text-danger">:message</span>') !!}

                            </div>

                        </div>

                    </div>

                    <div class="form-group mt-4">

                        <div class="row">

                            <div class="col-md-3">

                                {!! Form::label('aboutus', 'AboutUs') !!}

                                <span class="required">*</span>

                            </div>

                            <div class="col-md-6">

                                {!! Form::text('aboutus', null, ['placeholder' => 'Enter AboutUs', 'class' => 'form-control mb-2']) !!}

                                {!! $errors->first('aboutus', '<span class="text-danger">:message</span>') !!}

                            </div>

                        </div>

                    </div>



                    <div class="form-group mt-4">

                        <div class="row">

                            <div class="col-md-3">

                                {!! Form::label('contact_email', 'Contact Email') !!}

                                <span class="required">*</span>

                            </div>

                            <div class="col-md-6">

                                {!! Form::email('contact_email', null, ['placeholder' => 'Enter Contact Email', 'class' => 'form-control mb-2']) !!}

                                {!! $errors->first('contact_email', '<span class="text-danger">:message</span>') !!}

                            </div>

                        </div>

                    </div>





                    <div class="form-group mt-4">

                        <div class="row">

                            <div class="col-md-3">

                                {!! Form::label('youtube', 'Youtube') !!}

                                <span class="required">*</span>

                            </div>

                            <div class="col-md-6">

                                {!! Form::text('youtube', null, ['placeholder' => 'Enter Youtube', 'class' => 'form-control mb-2']) !!}

                                {!! $errors->first('youtube', '<span class="text-danger">:message</span>') !!}

                            </div>

                        </div>

                    </div>

                    <div class="form-group mt-4">

                        <div class="row">

                            <div class="col-md-3">

                                {!! Form::label('fb', 'Fb') !!}

                                <span class="required">*</span>

                            </div>

                            <div class="col-md-6">

                                {!! Form::text('fb', null, ['placeholder' => 'Enter Fb', 'class' => 'form-control mb-2']) !!}

                                {!! $errors->first('fb', '<span class="text-danger">:message</span>') !!}

                            </div>

                        </div>

                    </div>

                    <div class="form-group mt-4">

                        <div class="row">

                            <div class="col-md-3">

                                {!! Form::label('insta', 'InstaGram') !!}

                                <span class="required">*</span>

                            </div>

                            <div class="col-md-6">

                                {!! Form::text('insta', null, ['placeholder' => 'Enter Insta', 'class' => 'form-control mb-2']) !!}

                                {!! $errors->first('insta', '<span class="text-danger">:message</span>') !!}

                            </div>

                        </div>

                    </div>

                    <div class="form-group mt-4">

                        <div class="row">

                            <div class="col-md-3">

                                {!! Form::label('copyright_year', 'CopyrightYear') !!}

                                <span class="required">*</span>

                            </div>

                            <div class="col-md-6">

                                {!! Form::text('copyright_year', null, ['placeholder' => 'Enter CopyrightYear', 'class' => 'form-control mb-2']) !!}

                                {!! $errors->first('copyright_year', '<span class="text-danger">:message</span>') !!}

                            </div>

                        </div>

                    </div>

                    <div class="form-group mt-4">

                        <div class="row">

                            <div class="col-md-3">

                                {!! Form::label('adminemail', 'AdminEmail') !!}

                                <span class="required">*</span>

                            </div>

                            <div class="col-md-6">

                                {!! Form::text('adminemail', null, ['placeholder' => 'Enter AdminEmail', 'class' => 'form-control mb-2']) !!}

                                {!! $errors->first('adminemail', '<span class="text-danger">:message</span>') !!}

                            </div>

                        </div>

                    </div>

                    <div class="form-group mt-4">

                        <div class="row">

                            <div class="col-md-3">

                                {!! Form::label('password', 'Password') !!}

                                <span class="required">*</span>

                            </div>

                            <div class="col-md-6">

                                {!! Form::text('password', null, ['placeholder' => 'Enter Password', 'class' => 'form-control mb-2']) !!}

                                {!! $errors->first('password', '<span class="text-danger">:message</span>') !!}

                            </div>

                        </div>

                    </div>

                    <div class="form-group mt-4">

                        <div class="row">

                            <div class="col-md-3">

                                {!! Form::label('logo', 'Logo') !!}

                                <span class="required">*</span>

                            </div>

                            <div class="col-md-6">

                                {!! Form::file('logo', ['class' => 'form-control mb-2']) !!}

                                {!! $errors->first('logo', '<span class="text-danger">:message</span>') !!}

                            </div>

                        </div>

                    </div>



                    <div class="form-group mt-4">

                        <div class="row">

                            <div class="col-md-3">

                                {!! Form::label('fevicon', 'Fevicon') !!}

                                <span class="required">*</span>

                            </div>

                            <div class="col-md-6">

                                {!! Form::text('fevicon', null, ['placeholder' => 'Enter Fevicon', 'class' => 'form-control mb-2']) !!}

                                {!! $errors->first('fevicon', '<span class="text-danger">:message</span>') !!}

                            </div>

                        </div>

                    </div>

                    <div class="form-group mt-4">

                        <div class="row">

                            <div class="col-md-3">

                                {!! Form::label('seo_title', 'SeoTitle') !!}

                                <span class="required">*</span>

                            </div>

                            <div class="col-md-6">

                                {!! Form::text('seo_title', null, ['placeholder' => 'Enter SeoTitle', 'class' => 'form-control mb-2']) !!}

                                {!! $errors->first('seo_title', '<span class="text-danger">:message</span>') !!}

                            </div>

                        </div>

                    </div> <div class="form-group mt-4">

                        <div class="row">

                            <div class="col-md-3">

                                {!! Form::label('meta_keyword', 'MetaKeyword') !!}

                                <span class="required">*</span>

                            </div>

                            <div class="col-md-6">

                                {!! Form::text('meta_keyword', null, ['placeholder' => 'Enter MetaKeyword', 'class' => 'form-control mb-2']) !!}

                                {!! $errors->first('meta_keyword', '<span class="text-danger">:message</span>') !!}

                            </div>

                        </div>

                    </div>

                     <div class="form-group mt-4">

                        <div class="row">

                            <div class="col-md-3">

                                {!! Form::label('meta_description', 'MetaDescription') !!}

                                <span class="required">*</span>

                            </div>

                            <div class="col-md-6">

                                {!! Form::text('meta_description', null, ['placeholder' => 'Enter MetaDescription', 'class' => 'form-control mb-2']) !!}

                                {!! $errors->first('meta_description', '<span class="text-danger">:message</span>') !!}

                            </div>

                        </div>

                    </div>

                    <div class="form-group mt-4">

                        <div class="row">

                            <div class="col-md-3">

                                {!! Form::label('canonical', 'Canonical') !!}

                                <span class="required">*</span>

                            </div>

                            <div class="col-md-6">

                                {!! Form::text('canonical', null, ['placeholder' => 'Enter Canonical', 'class' => 'form-control mb-2']) !!}

                                {!! $errors->first('canonical', '<span class="text-danger">:message</span>') !!}

                            </div>

                        </div>

                    </div>  <div class="form-group mt-4">

                        <div class="row">

                            <div class="col-md-3">

                                {!! Form::label('googletagmanager', 'Google Tag Manager') !!}

                                <span class="required">*</span>

                            </div>

                            <div class="col-md-6">

                                {!! Form::text('googletagmanager', null, ['placeholder' => 'Enter GFoogleTagManager', 'class' => 'form-control mb-2']) !!}

                                {!! $errors->first('googletagmanager', '<span class="text-danger">:message</span>') !!}

                            </div>

                        </div>

                    </div>

                    <div class="form-group text-center">

                        <div class="row mt-4">

                            <div class="col-md-2 offset-md-3 mx-auto my-auto">

                                <div class="form-group">

                                    <label>&nbsp;</label>

                                    {!! Form::submit('Add Setting', ['class' => 'btn btn-secondary btn-wave form-group']) !!}

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









