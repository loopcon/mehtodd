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



                        <a href="{{ route('list.category') }}">



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



                        Add category



                    </div>



                </div>



                <div class="card-body">

                    {!! Form::open([

                        'route' => 'store.category',



                        'method' => 'post',



                        'enctype' => 'multipart/form-data',



                    ]) !!}



                    @csrf







                    <div class="form-group">

                        <div class="row">

                            <div class="col-md-3">

                                {!! Form::label('category_id', 'Category') !!}

                            </div>



                            <div class="col-md-6">

                                <select class="form-select"  name="category_id">

                                    <option value="">Select Category</option>

                                    @foreach($pluckedCategories as $id => $name)

                                        <option value="{{ $id }}">{{ $name }}</option>

                                    @endforeach

                                </select>

                                {!! $errors->first('category_id', '<span class="text-danger">:message</span>') !!}

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

                                    {!! Form::submit('Add Category', ['class' => 'btn btn-secondary btn-wave form-group']) !!}

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

$(document).ready(function () {

    $('form').submit(function () {

         $('#submitBtn').val('Adding...').prop('disabled', true);

    });



});



</script>



@endsection











