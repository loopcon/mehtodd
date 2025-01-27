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
                        <a href="{{ route('module.index') }}">
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
                        Update Module
                    </div>
                </div>

                <div class="card-body">
                    {!! Form::model($module, [
                        'route' => ['module.update', 'module' => $module->id],
                        'method' => 'PUT',
                        'enctype' => 'multipart/form-data',
                    ]) !!}

                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('label', 'Label') !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::text('label', null, [
                                    'class' => 'form-control mb-2',
                                ]) !!}
                            </div>
                        </div>
                    </div>


                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('subscriptions', 'Subscriptions') !!}
                            </div>

                            <div class="col-md-6">
                                {!! Form::select('subscriptions[]', ['' => 'Select Subscriptions'] + $subscriptions, $subscriptionAccess, [
                                    'class' => 'form-select',
                                    'id' => 'choices-multiple-remove-button',
                                    'multiple' => 'multiple',
                                    'data-trigger' => true,
                                ]) !!}
                            </div>
                            <div class="col-md-3 d-none">
                                <select data-trigger id="choices-multiple-default">
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <div class="row mt-4">
                            <div class="col-md-4 offset-md-3 mx-auto my-auto">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    {!! Form::submit('Update Module', ['class' => 'btn btn-secondary btn-wave form-group']) !!}
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
